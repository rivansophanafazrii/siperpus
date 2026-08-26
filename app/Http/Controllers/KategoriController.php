<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class KategoriController extends Controller
{
    public function index(Request $request)
    {

        $kategori = Kategori::when($request->search, function ($query) use ($request) {
            $query->where('nama_kategori', 'like', "%{$request->search}%")
                ->orWhere('deskripsi', 'like', "%{$request->search}%");
        })->latest()->paginate(10);

        return view('admin.kategori.index', compact('kategori'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function show(Kategori $kategori)
    {
        return view('admin.kategori.show', compact('kategori'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris',
            'deskripsi'     => 'nullable|string'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'slug'          => Str::slug($request->nama_kategori),
            'deskripsi'     => $request->deskripsi
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori buku berhasil ditambahkan!');
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:255|unique:kategoris,nama_kategori,' . $kategori->id,
            'deskripsi'     => 'nullable|string'
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'slug'          => Str::slug($request->nama_kategori),
            'deskripsi'     => $request->deskripsi
        ]);

        return redirect()->route('admin.kategori.index')->with('success', 'Kategori buku berhasil diperbarui!');
    }

    public function destroy(Kategori $kategori)
    {
        try {
            $kategori->delete();
            return redirect()->route('admin.kategori.index')->with('success', 'Kategori buku berhasil dihapus!');
        } catch (\Illuminate\Database\QueryException $e) {
            // Mendeteksi jika error disebabkan oleh relasi foreign key
            if ($e->getCode() == "23000") {
                return redirect()->route('admin.kategori.index')->with('error', 'Kategori gagal dihapus karena masih digunakan oleh data buku. Silakan hapus atau ubah kategori buku terkait terlebih dahulu!');
            }

            // Untuk error database lainnya
            return redirect()->route('admin.kategori.index')->with('error', 'Terjadi kesalahan sistem saat menghapus data.');
        }
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:kategoris,id'
        ]);

        Kategori::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.kategori.index')->with('success', 'Data kategori yang dipilih berhasil dihapus!');
    }
}
