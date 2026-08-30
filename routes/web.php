<?php

use App\Http\Controllers\Admin\AnggotaController;
use App\Http\Controllers\AnggotaBeritaController;
use App\Http\Controllers\AnggotaDashboardController;
use App\Http\Controllers\AnggotaKatalogController;
use App\Http\Controllers\AnggotaPeminjamanController;
use App\Http\Controllers\AnggotaProfilController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PengurusPerpustakaanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfilPerpustakaanController;
use Illuminate\Support\Facades\Route;



Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Rute Statis untuk Halaman Layanan
Route::prefix('layanan')->name('layanan.')->group(function () {
    Route::view('/sirkulasi', 'front.layanan.sirkulasi')->name('sirkulasi');
    Route::view('/opac', 'front.layanan.opac')->name('opac');
    Route::view('/referensi', 'front.layanan.referensi')->name('referensi');
    Route::view('/literasi', 'front.layanan.literasi')->name('literasi');
    Route::view('/pojok-baca', 'front.layanan.pojok-baca')->name('pojok-baca');
    Route::view('/baca-ditempat', 'front.layanan.baca-ditempat')->name('baca-ditempat');
    Route::view('/digital', 'front.layanan.digital')->name('digital');
    Route::view('/info', 'front.layanan.info')->name('info');
});

// Route Publik untuk OPAC
Route::get('/opac', [\App\Http\Controllers\HomeController::class, 'opac'])->name('opac.index');
Route::get('/opac/buku/{slug}', [\App\Http\Controllers\HomeController::class, 'show'])->name('opac.show');

// Route Publik untuk Berita
Route::get('/berita', [App\Http\Controllers\HomeController::class, 'berita'])->name('berita.index');
Route::get('/berita/kategori/{kategori}', [App\Http\Controllers\HomeController::class, 'beritaByKategori'])->name('berita.kategori');
Route::get('/berita/{slug}', [\App\Http\Controllers\HomeController::class, 'detailBerita'])->name('berita.detail');
// Route untuk MENAMPILKAN halaman form buku tamu (bisa diakses langsung di browser)
Route::get('/buku-tamu', function () {
    return view('buku_tamu'); // Pastikan nama ini sesuai dengan file buku_tamu.blade.php Anda
})->name('buku-tamu.form');
Route::post('/isi-buku-tamu', [\App\Http\Controllers\BukuTamuController::class, 'store'])->name('buku-tamu.store');

// Rute untuk Survei Kebutuhan Pustaka (Publik)
Route::get('/survei-kebutuhan', function () {
    return view('survei_kebutuhan');
})->name('survei-kebutuhan.form');

Route::post('/survei-kebutuhan', [\App\Http\Controllers\SurveiKebutuhanController::class, 'store'])->name('survei-kebutuhan.store');

// Rute untuk Survei Kepuasan (Publik)
Route::get('/survei-kepuasan', function () {
    return view('survei_kepuasan');
})->name('survei-kepuasan.form');

Route::post('/survei-kepuasan', [\App\Http\Controllers\SurveiKepuasanController::class, 'store'])->name('survei-kepuasan.store');


// Route Publik untuk Profil Perpustakaan
Route::get('/profil/sejarah', [App\Http\Controllers\HomeController::class, 'sejarah'])->name('profil.sejarah');
Route::get('/profil/visi-misi', [App\Http\Controllers\HomeController::class, 'visiMisi'])->name('profil.visi-misi');
Route::get('/profil/tata-tertib', [App\Http\Controllers\HomeController::class, 'tataTertib'])->name('profil.tata-tertib');
Route::get('/profil/struktur-organisasi', [App\Http\Controllers\HomeController::class, 'strukturOrganisasi'])->name('profil.struktur-organisasi');
Route::get('/profil/jam-layanan', [App\Http\Controllers\HomeController::class, 'jamLayanan'])->name('profil.jam-layanan');

Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// --- AREA TERKUNCI (HARUS LOGIN) ---
Route::middleware(['auth'])->group(function () {

    Route::get('/profil', [\App\Http\Controllers\AnggotaProfilController::class, 'index'])->name('profile.index');
    Route::put('/profil', [\App\Http\Controllers\AnggotaProfilController::class, 'update'])->name('profile.update');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


    // 1. AREA KHUSUS ADMIN
    // 1. AREA KHUSUS ADMIN
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {

        // Dashboard
        // Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        // Route Bulk Delete
        Route::delete('/anggota/bulk-delete', [AnggotaController::class, 'bulkDestroy'])->name('anggota.bulkDestroy');
        Route::delete('/kategori/bulk-delete', [\App\Http\Controllers\KategoriController::class, 'bulkDestroy'])->name('kategori.bulkDestroy');
        Route::delete('/rak/bulk-delete', [\App\Http\Controllers\RakController::class, 'bulkDestroy'])->name('rak.bulkDestroy');
        Route::delete('/berita/bulk-destroy', [\App\Http\Controllers\BeritaController::class, 'bulkDestroy'])->name('berita.bulkDestroy');

        // Route Bulk Delete Buku
        Route::delete('/buku/bulk-delete', [\App\Http\Controllers\BukuController::class, 'bulkDestroy'])->name('buku.bulkDestroy');
        Route::delete('/peminjaman/bulk-delete', [\App\Http\Controllers\PeminjamanController::class, 'bulkDestroy'])->name('peminjaman.bulkDestroy');

        // Route CRUD Data Anggota
        // Karena ada di dalam grup, otomatis URL-nya jadi /admin/anggota 
        // Route::resource sudah otomatis membuatkan route untuk index, create, store, dll. Jadi tidak perlu Route::get('/anggota') lagi.
        Route::resource('anggota', AnggotaController::class);
        Route::resource('kategori', \App\Http\Controllers\KategoriController::class);
        Route::resource('rak', \App\Http\Controllers\RakController::class);
        Route::resource('buku', \App\Http\Controllers\BukuController::class);
        // Route Kustom untuk Pengembalian Buku
        Route::put('/peminjaman/{id}/kembali', [\App\Http\Controllers\PeminjamanController::class, 'kembali'])->name('peminjaman.kembali');
        // Tambahkan baris ini di bawah route pengembalian lainnya
        Route::put('/pengembalian/{id}/perpanjang', [\App\Http\Controllers\PengembalianController::class, 'perpanjang'])->name('pengembalian.perpanjang');
        Route::resource('peminjaman', PeminjamanController::class);

        // 2. MENU PENGEMBALIAN
        Route::get('/pengembalian', [\App\Http\Controllers\PengembalianController::class, 'index'])->name('pengembalian.index');
        Route::put('/pengembalian/{id}', [\App\Http\Controllers\PengembalianController::class, 'proses'])->name('pengembalian.proses');
        Route::post('/pengembalian/proses-masal', [\App\Http\Controllers\PengembalianController::class, 'prosesMasal'])->name('pengembalian.proses_masal');
        Route::resource('peminjaman', \App\Http\Controllers\PeminjamanController::class);
        //  menu berita
        Route::resource('berita', \App\Http\Controllers\BeritaController::class);

        // Route Kelola Buku Tamu
        Route::get('/buku-tamu', [\App\Http\Controllers\BukuTamuController::class, 'index'])->name('buku-tamu.index');
        Route::delete('/buku-tamu/{id}', [\App\Http\Controllers\BukuTamuController::class, 'destroy'])->name('buku-tamu.destroy');

        // Rute Kelola Survei Kebutuhan
        Route::get('/survei-kebutuhan', [\App\Http\Controllers\SurveiKebutuhanController::class, 'index'])->name('survei-kebutuhan.index');

        Route::delete('/survei-kebutuhan/{id}', [\App\Http\Controllers\SurveiKebutuhanController::class, 'destroy'])->name('survei-kebutuhan.destroy');

        // Rute Kelola Survei Kepuasan
        Route::get('/survei-kepuasan', [\App\Http\Controllers\SurveiKepuasanController::class, 'index'])->name('survei-kepuasan.index');
        Route::delete('/survei-kepuasan/{id}', [\App\Http\Controllers\SurveiKepuasanController::class, 'destroy'])->name('survei-kepuasan.destroy');

        // Rute Laporan
        Route::get('/laporan', [\App\Http\Controllers\LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/generate', [\App\Http\Controllers\LaporanController::class, 'generate'])->name('laporan.generate');

        // Profil Umum
        Route::get('/profil-perpustakaan', [ProfilPerpustakaanController::class, 'index'])->name('profil.index');
        Route::put('/profil-perpustakaan', [ProfilPerpustakaanController::class, 'updateProfil'])->name('profil.update');

        // Pengurus / Struktur Organisasi
        Route::post('/pengurus', [PengurusPerpustakaanController::class, 'store'])->name('pengurus.store');
        Route::put('/pengurus/{id}', [PengurusPerpustakaanController::class, 'update'])->name('pengurus.update');
        Route::delete('/pengurus/{id}', [PengurusPerpustakaanController::class, 'destroy'])->name('pengurus.destroy');

        // // Rute untuk halaman Profil Saya
        Route::get('/profil-saya', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
        Route::put('/profil-saya/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
        Route::put('/profil-saya/password', [App\Http\Controllers\ProfileController::class, 'updatePassword'])->name('profile.password');
        // Route::get('/admin/profile', [ProfileController::class, 'index'])->name('admin.profile.index');
    }); // <-- Penutup grup pindah ke sini

    Route::get('/profil-saya', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profil-saya/update', [ProfileController::class, 'update'])->name('profile.update');
    Route::put('/profil-saya/password', [ProfileController::class, 'updatePassword'])->name('profile.password');


    // 2. AREA KHUSUS ANGGOTA (SISWA/GURU)
    Route::middleware(['role:anggota'])->prefix('anggota')->name('anggota.')->group(function () {
        // Rute Dashboard
        Route::get('/dashboard', [AnggotaDashboardController::class, 'index'])->name('dashboard');

        // Rute Katalog/OPAC
        Route::get('/katalog', [AnggotaKatalogController::class, 'index'])->name('katalog.index');
        Route::get('/katalog/{slug}', [AnggotaKatalogController::class, 'show'])->name('katalog.show');
        // Rute Peminjaman & Riwayat
        Route::get('/peminjaman', [AnggotaPeminjamanController::class, 'index'])->name('peminjaman.index');
        Route::post('/peminjaman', [App\Http\Controllers\AnggotaPeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::post('/peminjaman/store', [App\Http\Controllers\AnggotaPeminjamanController::class, 'store'])->name('peminjaman.store');
        Route::put('/peminjaman/{id}/kembali', [App\Http\Controllers\AnggotaPeminjamanController::class, 'kembali'])->name('peminjaman.kembali');
        Route::get('/riwayat-sirkulasi', [AnggotaPeminjamanController::class, 'riwayat'])->name('peminjaman.riwayat');
        // Rute Profil Saya
        Route::get('/profil', [AnggotaProfilController::class, 'index'])->name('profil.index');
        Route::put('/profil', [AnggotaProfilController::class, 'update'])->name('profil.update');
    });
});
