<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AnggotaDashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        // 1. Hitung jumlah buku yang sedang dipinjam (Mendukung variasi kapital)
        $sedangDipinjam = Peminjaman::where('user_id', $userId)
            ->whereIn('status', ['dipinjam', 'Dipinjam'])
            ->count();

        // 2. Hitung jumlah transaksi peminjaman yang sudah selesai
        $riwayatSelesai = Peminjaman::where('user_id', $userId)
            ->whereIn('status', ['dikembalikan', 'Dikembalikan'])
            ->count();

        // 3. Hitung Denda Belum Dibayar (Hanya dari buku yang SEDANG dipinjam dan terlambat)
        $peminjamanAktif = Peminjaman::where('user_id', $userId)
            ->whereIn('status', ['dipinjam', 'Dipinjam'])
            ->get();

        $totalDenda = 0;
        $hariIni = \Carbon\Carbon::now()->startOfDay();

        foreach ($peminjamanAktif as $item) {
            $tenggat = \Carbon\Carbon::parse($item->tenggat_waktu)->startOfDay();

            // Jika hari ini melebihi tenggat waktu, hitung selisih harinya
            if ($hariIni->gt($tenggat)) {
                $selisihHari = $tenggat->diffInDays($hariIni);
                $totalDenda += $selisihHari * 500; // Asumsi denda Rp 500/hari. Sesuaikan jika berbeda!
            }
        }

        // 4. Ambil daftar peminjaman aktif beserta data bukunya
        $peminjamanAktif = Peminjaman::with('buku')
            ->where('user_id', $userId)
            ->whereIn('status', ['dipinjam', 'Dipinjam'])
            ->orderBy('tenggat_waktu', 'asc')
            ->get();

        // 5. Data Grafik Peminjaman 6 Bulan Terakhir
        $chartLabels = [];
        $chartData = [];

        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $chartLabels[] = $date->translatedFormat('M Y');

            $chartData[] = Peminjaman::where('user_id', $userId)
                ->whereYear('tanggal_pinjam', $date->year)
                ->whereMonth('tanggal_pinjam', $date->month)
                ->count();
        }

        return view('anggota.index', compact(
            'sedangDipinjam',
            'riwayatSelesai',
            'totalDenda',
            'peminjamanAktif',
            'chartLabels',
            'chartData'
        ));
    }
}
