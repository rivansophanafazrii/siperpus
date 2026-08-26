<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


class BeritaController extends Controller
{
    /**
     * Menampilkan halaman daftar berita
     */
    public function index(Request $request)
    {
        $search = $request->search;

        // Mengambil data berita, diurutkan dari yang terbaru
        $berita = Berita::when($search, function ($query) use ($search) {
            $query->where('judul', 'like', "%{$search}%")
                ->orWhere('kategori', 'like', "%{$search}%");
        })
            ->latest()
            ->paginate(10);

        $berita->appends(['search' => $search]);

        return view('admin.berita.index', compact('berita'));
    }

    public function create()
    {
        return view('admin.berita.create');
    }

    /**
     * Menyimpan data berita baru ke database
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari user dengan Pesan Custom
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // max:5120 artinya maksimal 5 MB
            'is_published' => 'required|boolean',
        ], [
            // Kumpulan Pesan Error Custom berbahasa Indonesia
            'judul.required' => 'Judul publikasi wajib diisi.',
            'judul.max' => 'Judul terlalu panjang, maksimal 255 karakter.',
            'kategori.required' => 'Kategori publikasi wajib dipilih.',
            'konten.required' => 'Isi konten berita tidak boleh kosong.',
            'gambar.image' => 'File yang Anda unggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar yang diperbolehkan hanya JPG, JPEG, atau PNG.',
            'gambar.max' => 'Gagal mengunggah! Ukuran gambar maksimal adalah 5 MB.',
            'is_published.required' => 'Status tayang wajib ditentukan.',
        ]);

        // 2. Proses upload gambar (jika ada)
        $gambarPath = null;
        if ($request->hasFile('gambar')) {
            $gambarPath = $request->file('gambar')->store('berita', 'public');
        }

        // 3. Simpan data ke database
        $berita = new \App\Models\Berita();
        $berita->judul = $request->judul;

        // Gunakan Str::random(6) agar slug dijamin unik dan terhindar dari error duplikat
        $berita->slug = Str::slug($request->judul) . '-' . Str::random(6);

        $berita->kategori = $request->kategori;
        $berita->konten = $request->konten;
        $berita->gambar = $gambarPath;
        $berita->is_published = $request->is_published;
        $berita->user_id = Auth::id();

        $berita->save();

        // 4. Kembali ke halaman index dengan pesan sukses
        return redirect()->route('admin.berita.index')->with('success', 'Berita publikasi berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail berita (Show)
     */
    public function show($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.show', compact('berita'));
    }

    /**
     * Menampilkan form edit berita
     */
    public function edit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('admin.berita.edit', compact('berita'));
    }

    /**
     * Memperbarui data berita di database
     */
    public function update(Request $request, $id)
    {
        // 1. Cari data berita berdasarkan ID
        $berita = Berita::findOrFail($id);

        // 2. Validasi Input
        $request->validate([
            'judul'        => 'required|string|max:255',
            'kategori'     => 'required|string',
            'konten'       => 'required',
            'is_published' => 'required|in:0,1',
            // Gunakan nullable agar opsional, dan beri batasan mimes + max size (2MB)
            'gambar'       => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ], [
            'gambar.image' => 'File yang diunggah harus berupa gambar.',
            'gambar.mimes' => 'Format gambar harus jpeg, png, jpg, gif, atau webp.',
            'gambar.max'   => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        // 3. Menyiapkan data yang akan diupdate
        $data = [
            'judul'        => $request->judul,
            'slug'         => Str::slug($request->judul),
            'kategori'     => $request->kategori,
            'konten'       => $request->konten,
            'is_published' => $request->is_published,
        ];

        // 4. Cek apakah ada file gambar baru yang diunggah
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari storage jika ada
            if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                Storage::disk('public')->delete($berita->gambar);
            }

            // Simpan gambar baru ke folder 'public/berita'
            $data['gambar'] = $request->file('gambar')->store('berita', 'public');
        }

        // 5. Eksekusi Update ke Database
        $berita->update($data);

        // 6. Redirect dengan pesan sukses
        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    /**
     * Menghapus berita secara spesifik (Single Delete)
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);

        // Hapus file gambar dari storage jika ada, agar server tidak penuh
        if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
            Storage::disk('public')->delete($berita->gambar);
        }

        $berita->delete();

        return redirect()->back()->with('success', 'Data berita berhasil dihapus secara permanen.');
    }

    /**
     * Menghapus banyak berita sekaligus (Bulk Delete)
     */
    public function bulkDestroy(\Illuminate\Http\Request $request)
    {
        $ids = $request->ids;

        if ($ids) {
            $beritas = Berita::whereIn('id', $ids)->get();

            // Loop untuk menghapus gambar-gambar terkait dari storage
            foreach ($beritas as $berita) {
                if ($berita->gambar && Storage::disk('public')->exists($berita->gambar)) {
                    Storage::disk('public')->delete($berita->gambar);
                }
            }

            Berita::whereIn('id', $ids)->delete();
            return redirect()->back()->with('success', count($ids) . ' data berita berhasil dihapus.');
        }

        return redirect()->back()->with('error', 'Tidak ada data yang dipilih untuk dihapus.');
    }
}
