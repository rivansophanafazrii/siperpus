<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Kategori;
use App\Models\Rak;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class BukuController extends Controller
{
    public function index(Request $request)
    {
        // Memanggil relasi kategori agar tidak N+1 query problem
        $buku = Buku::with('kategori')
            ->when($request->search, function ($query) use ($request) {
                $query->where('judul', 'like', "%{$request->search}%")
                    ->orWhere('kode_buku', 'like', "%{$request->search}%")
                    ->orWhere('penulis', 'like', "%{$request->search}%");
            })->latest()->paginate(10);

        return view('admin.buku.index', compact('buku'));
    }

    public function create()
    {
        $kategori = Kategori::all();
        $rak = Rak::all(); // Diambil agar bisa jadi dropdown pilihan

        // 1. Logika Pembuatan Kode Buku Otomatis
        $bukuTerakhir = \App\Models\Buku::orderBy('id', 'desc')->first();

        if ($bukuTerakhir && $bukuTerakhir->kode_buku) {
            // Misal kode terakhir adalah "BUKU-015"
            // Kita pecah teksnya berdasarkan tanda strip "-"
            $pecahKode = explode('-', $bukuTerakhir->kode_buku); 
            
            // Ambil angka di bagian belakang (015) lalu ubah ke integer dan tambah 1
            $angkaBaru = (int) end($pecahKode) + 1; 
            
            // Format ulang menjadi 3 digit (misal: 16 menjadi 016)
            $kode_otomatis = 'BK-' . str_pad($angkaBaru, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada buku sama sekali di database
            $kode_otomatis = 'BK-001';
        }

        // 2. Ambil data lain yang mungkin dibutuhkan di form (contoh: kategori)
        // $kategori = \App\Models\Kategori::all();

        // 3. Kirim variabel $kode_otomatis ke View
        return view('admin.buku.create', compact('kategori', 'rak','kode_otomatis'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kategori_id'  => 'required|exists:kategoris,id',
            'kode_buku'    => 'required|string|max:50|unique:buku,kode_buku',
            'judul'        => 'required|string|max:255',
            'isbn'         => 'nullable|string|max:50|unique:buku,isbn',
            'penulis'      => 'nullable|string|max:150',
            'penerbit'     => 'nullable|string|max:150',
            'tahun_terbit' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'stok'         => 'required|integer|min:0',
            'rak'          => 'nullable|string|max:50',
            'cover'        => 'nullable|image|mimes:jpeg,png,jpg|max:10240', // Maksimal 2MB
            'file_ebook'   => 'nullable|mimes:pdf|max:204800', // Maksimal 200MB PDF
            'deskripsi'    => 'nullable|string'
        ]);

        $data = $request->except(['cover', 'file_ebook']);
        $data['slug'] = Str::slug($request->judul . '-' . Str::random(5)); // Tambah random agar benar-benar unik

        // Proses Upload Cover
        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('buku/cover', 'public');
        }

        // Proses Upload File E-Book
        if ($request->hasFile('file_ebook')) {
            $data['file_ebook'] = $request->file('file_ebook')->store('buku/ebook', 'public');
        }

        Buku::create($data);

        return redirect()->route('admin.buku.index')->with('success', 'Data buku berhasil ditambahkan!');
    }

    public function show(Buku $buku)
    {
        return view('admin.buku.show', compact('buku'));
    }

    public function edit(Buku $buku)
    {
        $kategori = Kategori::all();
        $rak = Rak::all();

        return view('admin.buku.edit', compact('buku', 'kategori', 'rak'));
    }

    public function update(Request $request, Buku $buku)
    {
        $request->validate([
            'kategori_id'  => 'required|exists:kategoris,id',
            'kode_buku'    => 'required|string|max:50|unique:buku,kode_buku,' . $buku->id,
            'judul'        => 'required|string|max:255',
            'isbn'         => 'nullable|string|max:50|unique:buku,isbn,' . $buku->id,
            'penulis'      => 'nullable|string|max:150',
            'penerbit'     => 'nullable|string|max:150',
            'tahun_terbit' => 'nullable|digits:4|integer|min:1900|max:' . (date('Y') + 1),
            'stok'         => 'required|integer|min:0',
            'rak'          => 'nullable|string|max:50',
            'cover'        => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'file_ebook'   => 'nullable|mimes:pdf|max:204800',
            'deskripsi'    => 'nullable|string'
        ]);

        $data = $request->except(['cover', 'file_ebook']);

        // Update slug hanya jika judul berubah
        if ($request->judul !== $buku->judul) {
            $data['slug'] = Str::slug($request->judul . '-' . Str::random(5));
        }

        // Ganti Cover Lama jika ada yang baru
        if ($request->hasFile('cover')) {
            if ($buku->cover && Storage::disk('public')->exists($buku->cover)) {
                Storage::disk('public')->delete($buku->cover);
            }
            $data['cover'] = $request->file('cover')->store('buku/cover', 'public');
        }

        // Ganti E-Book Lama jika ada yang baru
        if ($request->hasFile('file_ebook')) {
            if ($buku->file_ebook && Storage::disk('public')->exists($buku->file_ebook)) {
                Storage::disk('public')->delete($buku->file_ebook);
            }
            $data['file_ebook'] = $request->file('file_ebook')->store('buku/ebook', 'public');
        }

        $buku->update($data);

        return redirect()->route('admin.buku.index')->with('success', 'Data buku berhasil diperbarui!');
    }

    public function destroy(Buku $buku)
    {
        // Karena kita pakai SoftDeletes, data file TIDAK kita hapus secara fisik agar riwayat tetap utuh
        $buku->delete();

        return redirect()->route('admin.buku.index')->with('success', 'Data buku berhasil dihapus!');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:buku,id'
        ]);

        Buku::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.buku.index')->with('success', 'Data buku yang dipilih berhasil dihapus!');
    }
}
