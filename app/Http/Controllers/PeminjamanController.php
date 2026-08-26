<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\User; // Panggil model User
use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PeminjamanController extends Controller
{
    public function index(Request $request)
    {
        // Jika Anda menambahkan fitur pencarian
        $search = $request->search;

        $peminjaman = Peminjaman::with(['user', 'buku'])
            ->where('status', 'Dipinjam')
            ->when($search, function ($query) use ($search) {
                $query->whereHas('user', function ($q) use ($search) {
                    $q->where('name', 'like', "%{$search}%");
                })->orWhereHas('buku', function ($q) use ($search) {
                    $q->where('judul', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10); // <--- UBAH get() DI SINI MENJADI paginate(10)

        // Tambahkan appends agar pagination tidak hilang saat melakukan pencarian
        $peminjaman->appends(['search' => $search]);

        return view('admin.peminjaman.index', compact('peminjaman'));
    }

    public function create()
    {
        // Ambil user yang memiliki role 'anggota' (atau User::all() jika belum filter role)
        $users = User::where('role', 'anggota')->get();

        // Jika belum ada kolom role di users, bisa pakai: $users = User::all();

        $buku = Buku::where('stok', '>', 0)->get();

        return view('admin.peminjaman.create', compact('users', 'buku'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'buku_id'     => 'required|exists:buku,id',
            'lama_pinjam' => 'required|integer|min:1|max:14',
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku ini sedang kosong.');
        }

        // 1. Ambil waktu saat ini sebagai patokan pasti
        $tanggal_sekarang = Carbon::now();

        // 2. Gunakan copy() agar $tanggal_sekarang tidak ikut termodifikasi
        $tenggat = $tanggal_sekarang->copy()->addDays((int) $request->lama_pinjam);

        Peminjaman::create([
            'kode_transaksi' => 'TRX-' . date('YmdHis'),
            'user_id'        => $request->user_id,
            'buku_id'        => $request->buku_id,
            'tanggal_pinjam' => $tanggal_sekarang->toDateString(),
            'tenggat_waktu'  => $tenggat->toDateString(), // <-- Pakai variabel yang sudah diolah
            'status'         => 'Dipinjam'
        ]);

        $buku->decrement('stok');

        return redirect()->route('admin.peminjaman.index')->with('success', 'Transaksi Peminjaman berhasil dicatat!');
    }


    /**
     * Menghapus data peminjaman (Single Delete)
     */
    public function destroy($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);
        $peminjaman->delete();

        return redirect()->back()->with('success', 'Data peminjaman berhasil dihapus.');
    }

    /**
     * Menghapus banyak data peminjaman sekaligus (Bulk Delete)
     */
    public function bulkDestroy(\Illuminate\Http\Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            Peminjaman::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', count($ids) . ' data peminjaman berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada data yang dipilih untuk dihapus.');
    }


    public function kembali($id)
    {
        $peminjaman = Peminjaman::findOrFail($id);

        if ($peminjaman->status === 'Dikembalikan') {
            return back()->with('error', 'Buku ini sudah dikembalikan.');
        }

        $tarif_denda_per_hari = 500;
        $denda = 0;

        $tanggal_sekarang = Carbon::now();
        $tenggat_waktu = Carbon::parse($peminjaman->tenggat_waktu);

        if ($tanggal_sekarang->greaterThan($tenggat_waktu)) {
            $selisih_hari = $tenggat_waktu->diffInDays($tanggal_sekarang);
            $denda = $selisih_hari * $tarif_denda_per_hari;
        }

        $peminjaman->update([
            'status' => 'Dikembalikan',
            'tanggal_dikembalikan' => $tanggal_sekarang->toDateString(),
            'denda' => $denda
        ]);

        $peminjaman->buku->increment('stok');

        $pesan = 'Buku berhasil dikembalikan!';
        if ($denda > 0) {
            $pesan .= ' Terlambat ' . $selisih_hari . ' hari, dikenakan denda Rp ' . number_format($denda, 0, ',', '.');
        }

        return redirect()->route('admin.peminjaman.index')->with('success', $pesan);
    }
}
