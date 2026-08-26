<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PengembalianController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Query Dasar
        $peminjamanAktifQuery = Peminjaman::with(['user', 'buku'])->where('status', 'Dipinjam');
        $riwayatPengembalianQuery = Peminjaman::with(['user', 'buku'])->where('status', 'dikembalikan');

        // Logika Pencarian
        if ($search) {
            $peminjamanAktifQuery->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('nis_nip', 'like', "%{$search}%");
            })->orWhereHas('buku', function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")->orWhere('kode_buku', 'like', "%{$search}%");
            });

            $riwayatPengembalianQuery->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")->orWhere('nis_nip', 'like', "%{$search}%");
            })->orWhereHas('buku', function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")->orWhere('kode_buku', 'like', "%{$search}%");
            });
        }

        $peminjamanAktif = $peminjamanAktifQuery->latest()->get();
        $riwayatPengembalian = $riwayatPengembalianQuery->latest()->get();

        return view('admin.pengembalian.index', compact('peminjamanAktif', 'riwayatPengembalian', 'search'));
    }

    public function proses($id)
    {
        try {
            DB::beginTransaction();

            // Cari data peminjaman
            $peminjaman = Peminjaman::findOrFail($id);

            // Jika buku sudah dikembalikan, batalkan proses
            if (strtolower($peminjaman->status) === 'dikembalikan') {
                return redirect()->back()->with('error', 'Buku ini sudah dikembalikan sebelumnya.');
            }

            // Hitung denda jika ada
            $tenggatWaktu = Carbon::parse($peminjaman->tenggat_waktu)->startOfDay();
            $tanggalKembali = Carbon::now()->startOfDay();
            $denda = 0;

            if ($tanggalKembali->gt($tenggatWaktu)) {
                $denda = (int)$tenggatWaktu->diffInDays($tanggalKembali) * 500; // Asumsi denda Rp500/hari
            }

            // Update status peminjaman menjadi dikembalikan
            $peminjaman->update([
                'status' => 'Dikembalikan',
                'tanggal_dikembalikan' => Carbon::now(),
                'denda' => $denda
            ]);

            // Tambahkan kembali stok buku
            $buku = Buku::find($peminjaman->buku_id);
            if ($buku) {
                $buku->increment('stok');
            }

            DB::commit();

            // Buat pesan sukses
            $pesan = "Buku berhasil dikembalikan.";
            if ($denda > 0) {
                $pesan .= " Terdapat denda keterlambatan sebesar Rp " . number_format($denda, 0, ',', '.') . ".";
            }

            return redirect()->back()->with('success', $pesan);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function prosesMasal(Request $request)
    {
        $ids = $request->input('ids');

        if (!$ids || count($ids) == 0) {
            return redirect()->back()->with('error', 'Pilih minimal satu buku untuk diproses.');
        }

        try {
            DB::beginTransaction();
            $totalDenda = 0;
            $count = 0;

            foreach ($ids as $id) {
                $peminjaman = Peminjaman::find($id);
                if (!$peminjaman || $peminjaman->status === 'dikembalikan') continue;

                $tenggatWaktu = Carbon::parse($peminjaman->tenggat_waktu)->startOfDay();
                $tanggalKembali = Carbon::now()->startOfDay();
                $denda = 0;

                if ($tanggalKembali->gt($tenggatWaktu)) {
                    $denda = (int)$tenggatWaktu->diffInDays($tanggalKembali) * 500;
                    $totalDenda += $denda;
                }

                $peminjaman->update([
                    'status' => 'Dikembalikan',
                    'tanggal_dikembalikan' => Carbon::now(),
                    'denda' => $denda
                ]);

                $buku = Buku::find($peminjaman->buku_id);
                if ($buku) $buku->increment('stok');
                $count++;
            }

            DB::commit();
            $pesan = "$count buku berhasil dikembalikan.";
            if ($totalDenda > 0) $pesan .= " Total denda terkumpul: Rp " . number_format($totalDenda, 0, ',', '.');

            return redirect()->back()->with('success', $pesan);
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage());
        }
    }

    public function perpanjang($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        // 1. Pastikan buku belum dikembalikan
        if ($peminjaman->status === 'dikembalikan') {
            return redirect()->back()->with('error', 'Buku sudah dikembalikan, tidak dapat diperpanjang.');
        }

        $hariIni = Carbon::now()->startOfDay();
        $tenggatWaktu = Carbon::parse($peminjaman->tenggat_waktu)->startOfDay();

        // 2. Validasi Jatah Waktu: Hanya bisa diperpanjang jika sudah jatuh tempo/hari H
        if ($hariIni->lessThan($tenggatWaktu)) {
            return redirect()->back()->with('error', 'Belum waktunya! Perpanjangan hanya bisa dilakukan saat masa pinjam habis atau pada hari H.');
        }

        // 3. PERBAIKAN: Proses perpanjang 7 hari dari HARI INI (bukan dari tenggat lama)
        $tenggatBaru = Carbon::now()->addDays(7)->format('Y-m-d');

        // 4. Update data peminjaman
        $peminjaman->update([
            'tenggat_waktu' => $tenggatBaru
        ]);

        return redirect()->back()->with('success', 'Berhasil! Masa peminjaman telah diperpanjang 7 hari dari hari ini.');
    }
}
