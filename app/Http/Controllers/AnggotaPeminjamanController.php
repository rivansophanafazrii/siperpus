<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Peminjaman;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaPeminjamanController extends Controller
{
    // Halaman Peminjaman Saya (Hanya Aktif)
    public function index()
    {
        // 1. Ambil data peminjaman milik pengguna terkait (kode Anda sebelumnya)
        $peminjaman = Peminjaman::with('buku')
            ->where('user_id', Auth::id())
            ->where('status', 'Dipinjam')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // 2. TAMBAHAN: Ambil data buku yang stoknya masih ada untuk ditampilkan di modal
        $buku_tersedia = \App\Models\Buku::where('stok', '>', 0)
            ->orderBy('judul', 'asc')
            ->get();

        // 3. Sertakan $buku_tersedia dalam fungsi compact()
        return view('anggota.peminjaman.index', compact('peminjaman', 'buku_tersedia'));
    }

    // Fungsi untuk memproses peminjaman buku oleh anggota
    public function store(Request $request)
    {
        $request->validate([
            'buku_id'     => 'required|exists:buku,id',
            'lama_pinjam' => 'required|integer|min:1|max:14', // Batas waktu pinjam 1-14 hari
        ]);

        $buku = Buku::findOrFail($request->buku_id);

        if ($buku->stok <= 0) {
            return back()->with('error', 'Maaf, stok buku ini sedang kosong.');
        }

        $tanggal_sekarang = Carbon::now();
        $tenggat = $tanggal_sekarang->copy()->addDays((int) $request->lama_pinjam);

        Peminjaman::create([
            // Membuat kode transaksi unik menggunakan tanggal, waktu, dan ID user
            'kode_transaksi' => 'TRX-' . date('YmdHis') . Auth::id(),
            'user_id'        => Auth::id(),
            'buku_id'        => $request->buku_id,
            'tanggal_pinjam' => $tanggal_sekarang->toDateString(),
            'tenggat_waktu'  => $tenggat->toDateString(),
            'status'         => 'Dipinjam'
        ]);

        $buku->decrement('stok');

        return redirect()->route('anggota.peminjaman.index')->with('success', 'Buku berhasil dipinjam!');
    }

    // Fungsi untuk memproses pengembalian buku
    public function kembali($id)
    {
        $peminjaman = Peminjaman::where('id', $id)
            ->where('user_id', Auth::id())
            ->where('status', 'Dipinjam')
            ->firstOrFail();

        // Perbarui status dan catat tanggal pengembalian
        $peminjaman->update([
            'status' => 'Dikembalikan',
            'tanggal_dikembalikan' => Carbon::now()->toDateString()
        ]);

        // Tambahkan kembali stok buku
        $buku = Buku::find($peminjaman->buku_id);
        if ($buku) {
            $buku->increment('stok');
        }

        return redirect()->route('anggota.peminjaman.index')->with('success', 'Buku berhasil dikembalikan. Terima kasih!');
    }

    // Halaman Riwayat Sirkulasi (Hanya Selesai)
    public function riwayat()
    {
        $peminjaman = Peminjaman::with('buku')
            ->where('user_id', Auth::id())
            ->where('status', 'Dikembalikan') // Filter khusus selesai
            ->orderBy('tanggal_dikembalikan', 'desc')
            ->paginate(10);

        return view('anggota.peminjaman.riwayat', compact('peminjaman'));
    }
}
