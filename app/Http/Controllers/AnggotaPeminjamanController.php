<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AnggotaPeminjamanController extends Controller
{
    // Halaman Peminjaman Saya (Hanya Aktif)
    public function index()
    {
        $peminjaman = Peminjaman::with('buku')
            ->where('user_id', Auth::id())
            ->where('status', 'Dipinjam') // Filter khusus aktif
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('anggota.peminjaman.index', compact('peminjaman'));
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