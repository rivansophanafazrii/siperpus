<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;

// PENTING: Pastikan nama-nama Model di bawah ini sesuai dengan yang ada di folder app/Models/ Anda.
use App\Models\Buku;
use App\Models\User;
use App\Models\Peminjaman;

class DashboardController extends Controller
{
    public function index()
    {
        $tahun_ini = date('Y');

        // 1. Mengambil Statistik Utama dari Database
        $total_buku = Buku::count();

        $total_anggota = User::count();

        $buku_dipinjam = Peminjaman::where('status', 'dipinjam')->count();

        // MENGGANTI BUKU TERLAMBAT MENJADI PENDAPATAN DENDA BULAN INI
        $pendapatan_denda = Peminjaman::whereMonth('created_at', Carbon::now()->month)
            ->whereYear('created_at', $tahun_ini)
            ->sum('denda'); // Pastikan kolom 'denda' ada di database Anda

        // 2. Mengambil Data Chart (Peminjaman per Bulan di Tahun Ini)
        $chart_data = [];
        for ($bulan = 1; $bulan <= 12; $bulan++) {
            $chart_data[] = Peminjaman::whereYear('created_at', $tahun_ini)
                ->whereMonth('created_at', $bulan)
                ->count();
        }

        // 3. Mengambil 5 Data Terbaru untuk Tabel di Bawah
        $transaksi_terbaru = Peminjaman::with(['user', 'buku'])->latest()->take(5)->get();
        $buku_terbaru = Buku::with('kategori')->latest()->take(5)->get();
        $anggota_terbaru = User::latest()->take(5)->get();

        // 4. Mengirim Data ke View 'admin.dashboard'
        return view('admin.dashboard', compact(
            'total_buku',
            'total_anggota',
            'buku_dipinjam',
            'pendapatan_denda',
            'tahun_ini',
            'chart_data',
            'transaksi_terbaru',
            'buku_terbaru',
            'anggota_terbaru'
        ));
    }
}
