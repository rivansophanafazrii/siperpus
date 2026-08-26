<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use Illuminate\Http\Request;

class AnggotaKatalogController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil data kategori untuk ditampilkan di dropdown
        $kategoris = Kategori::all();

        // 2. Mulai query buku
        $query = Buku::query();

        // 3. Filter berdasarkan Kata Kunci (Pencarian)
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('penulis', 'like', "%{$search}%")
                    ->orWhere('penerbit', 'like', "%{$search}%");
            });
        }

        // 4. Filter berdasarkan Kategori
        if ($request->filled('kategori_id')) {
            $query->where('kategori_id', $request->kategori_id);
        }

        // 5. Filter berdasarkan Format (Semua / E-Book / Fisik)
        if ($request->filled('format')) {
            if ($request->format == 'ebook') {
                // Asumsi: jika kolom file_ebook tidak kosong, berarti ada e-book
                $query->whereNotNull('file_ebook');
            } elseif ($request->format == 'fisik') {
                $query->whereNull('file_ebook');
            }
        }

        // 6. Eksekusi query dengan pagination, tambahkan withQueryString() agar filter tidak hilang saat pindah halaman
        $buku = $query->latest()->paginate(12)->withQueryString();

        return view('anggota.katalog.index', compact('buku', 'kategoris'));
    }

    public function show($slug)
    {
        // Mencari buku berdasarkan slug, jika tidak ada akan memunculkan error 404
        $buku = Buku::where('slug', $slug)->firstOrFail();

        return view('anggota.katalog.show', compact('buku'));
    }
}
