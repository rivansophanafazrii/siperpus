<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;

class AnggotaBeritaController extends Controller
{
    // Menampilkan daftar berita
    public function index()
    {
        // Mengambil berita terbaru, 6 berita per halaman
        $berita = Berita::latest()->paginate(6);
        return view('anggota.berita.index', compact('berita'));
    }

    // Menampilkan isi berita secara detail
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('anggota.berita.show', compact('berita'));
    }
}
