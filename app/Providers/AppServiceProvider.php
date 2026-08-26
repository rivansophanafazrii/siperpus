<?php

namespace App\Providers;

use App\Models\ProfilPerpustakaan;
use Illuminate\Pagination\Paginator; // 1. Impor Paginator
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\Peminjaman;           // Tambahkan ini
use Carbon\Carbon;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Paginator::useBootstrapFour(); // 2. Set default gaya paginasi
        
        View::composer('*', function ($view) {
            $view->with('profil', ProfilPerpustakaan::first());

            // 1. Hitung buku terlambat
            $bukuTerlambat = Peminjaman::where('status', 'Dipinjam')
                ->whereDate('tanggal_dikembalikan', '<', Carbon::today())
                ->count();

            // 2. Hitung peminjaman baru 
            // (Asumsi: dihitung dari transaksi yang dibuat hari ini)
            $peminjamanBaru = Peminjaman::whereDate('created_at', Carbon::today())->count();

            // 3. Total notifikasi
            $totalNotifikasi = $bukuTerlambat + $peminjamanBaru;

            // Kirim variabel ke view
            $view->with(compact('bukuTerlambat', 'peminjamanBaru', 'totalNotifikasi'));
        });   
    }
}