<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Buku;
use App\Models\PengurusPerpustakaan;
use App\Models\ProfilPerpustakaan;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // 1. Ambil 4 berita terbaru yang berstatus published
        $beritaTerbaru = Berita::where('is_published', 1)
            ->latest()
            ->take(10)
            ->get();

        // 2. Ambil data profil perpustakaan
        // Menggunakan firstOrCreate agar jika database kosong, web tidak error
        $profil = ProfilPerpustakaan::firstOrCreate([], [
            'nama_perpustakaan' => 'SIPERPUS SMPN 2 Kadugede'
        ]);

        // 3. Ambil data pengurus perpustakaan berdasarkan urutan
        $pengurus = PengurusPerpustakaan::orderBy('urutan', 'asc')->get();

        // Mengambil 4 buku yang paling baru ditambahkan ke database
        $bukuTerbaru = Buku::orderBy('created_at', 'desc')->take(10)->get();

        $totalBuku = \App\Models\Buku::count();
        $totalAnggota = \App\Models\User::count(); // Mengambil jumlah dari tabel users
        $totalSirkulasi = \App\Models\Peminjaman::count(); // Mengambil dari tabel peminjamans

        // 4. Kirim semua variabel ke view 'welcome' (atau nama view landing page Anda)
        return view('welcome', compact('beritaTerbaru', 'profil', 'pengurus', 'bukuTerbaru', 'totalBuku', 'totalAnggota', 'totalSirkulasi'));
    }

    public function opac(Request $request)
    {
        $kategoriList = \App\Models\Kategori::orderBy('nama_kategori', 'asc')->get();

        $query = Buku::with('kategori');

        // Logika Pencarian Teks
        if ($request->filled('cari')) {
            $query->where(function ($q) use ($request) {
                $q->where('judul', 'like', '%' . $request->cari . '%')
                    ->orWhere('penulis', 'like', '%' . $request->cari . '%')
                    ->orWhere('penerbit', 'like', '%' . $request->cari . '%');
            });
        }

        // Logika Filter Kategori
        if ($request->filled('kategori')) {
            $query->where('kategori_id', $request->kategori);
        }

        // TAMBAHAN: Logika Filter Jenis (Ebook / Fisik)
        if ($request->filled('jenis')) {
            if ($request->jenis == 'Ebook') {
                // Tampilkan buku yang punya file ebook
                $query->whereNotNull('file_ebook');
            } elseif ($request->jenis == 'Fisik') {
                // Tampilkan buku yang tidak punya file ebook (hanya fisik)
                $query->whereNull('file_ebook');
            }
        }

        // Logika Pengurutan (Sorting)
        if ($request->filled('sort')) {
            if ($request->sort == 'judul_asc') {
                $query->orderBy('judul', 'asc');
            } elseif ($request->sort == 'judul_desc') {
                $query->orderBy('judul', 'desc');
            } else {
                $query->latest();
            }
        } else {
            $query->latest();
        }

        $koleksiBuku = $query->paginate(12);

        return view('front.opac.index', compact('koleksiBuku', 'kategoriList'));
    }

    public function show($slug)
    {
        // Mengambil data buku berdasarkan SLUG
        $buku = Buku::with('kategori')->where('slug', $slug)->firstOrFail();

        // Mengambil rekomendasi buku lain di kategori yang sama
        $bukuTerkait = Buku::where('kategori_id', $buku->kategori_id)
            ->where('id', '!=', $buku->id)
            ->take(4)
            ->get();

        return view('front.opac.detail', compact('buku', 'bukuTerkait'));
    }

    public function berita()
    {
        // Mengambil daftar kategori unik dari tabel berita yang tidak kosong
        $semuaKategori = \App\Models\Berita::where('is_published', 1)
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->pluck('kategori');

        $berita = \App\Models\Berita::where('is_published', 1)
            ->latest()
            ->paginate(6);

        return view('front.berita.index', compact('berita', 'semuaKategori'));
    }

    public function beritaByKategori($kategori)
    {
        $semuaKategori = \App\Models\Berita::where('is_published', 1)
            ->whereNotNull('kategori')
            ->where('kategori', '!=', '')
            ->distinct()
            ->pluck('kategori');

        // Filter berita berdasarkan teks kategori
        $berita = \App\Models\Berita::where('kategori', $kategori)
            ->where('is_published', 1)
            ->latest()
            ->paginate(6);

        return view('front.berita.index', compact('berita', 'semuaKategori', 'kategori'));
    }

    public function detailBerita($slug)
    {
        // Hapus with(['kategori', 'user']) karena kita tidak pakai relasi
        $berita = \App\Models\Berita::where('slug', $slug)
            ->where('is_published', 1)
            ->firstOrFail();

        $beritaTerbaru = \App\Models\Berita::where('is_published', 1)
            ->where('id', '!=', $berita->id)
            ->latest()
            ->take(10)
            ->get();

        return view('front.berita.detail', compact('berita', 'beritaTerbaru'));
    }

    public function sejarah()
    {
        $profil = \App\Models\ProfilPerpustakaan::first();
        return view('front.profil.sejarah', compact('profil'));
    }

    public function visiMisi()
    {
        $profil = \App\Models\ProfilPerpustakaan::first();
        return view('front.profil.visi-misi', compact('profil'));
    }

    public function tataTertib()
    {
        $profil = \App\Models\ProfilPerpustakaan::first();
        return view('front.profil.tata-tertib', compact('profil'));
    }

    public function strukturOrganisasi()
    {
        $pengurus = \App\Models\PengurusPerpustakaan::orderBy('urutan', 'asc')->get();
        return view('front.profil.struktur-organisasi', compact('pengurus'));
    }

    public function jamLayanan()
    {
        $profil = \App\Models\ProfilPerpustakaan::first();
        return view('front.profil.jam-layanan', compact('profil'));
    }
}
