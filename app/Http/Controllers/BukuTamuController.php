<?php

namespace App\Http\Controllers;

use App\Models\BukuTamu;
use Illuminate\Http\Request;

class BukuTamuController extends Controller
{
    /**
     * Menampilkan daftar buku tamu
     */
    public function index()
    {
        // Ambil data buku tamu, urutkan dari yang terbaru, paginasi 10 data per halaman
        $bukuTamu = BukuTamu::latest()->paginate(10);

        return view('admin.buku_tamu.index', compact('bukuTamu'));
    }

    /**
     * Menghapus data buku tamu
     */
    public function destroy($id)
    {
        $bukuTamu = BukuTamu::findOrFail($id);
        $bukuTamu->delete();

        return redirect()->route('admin.buku-tamu.index')
            ->with('success', 'Data pengunjung berhasil dihapus!');
    }

    /**
     * Menampilkan detail spesifik buku tamu
     */
    public function show($id)
    {
        $bukuTamu = BukuTamu::findOrFail($id);
        return view('admin.buku_tamu.show', compact('bukuTamu'));
    }

    /**
     * Menyimpan data buku tamu dari Landing Page
     */
    public function store(Request $request)
    {
        // 1. Validasi input dari pengunjung
        $request->validate([
            'nama'           => 'required|string|max:255',
            'kelas_instansi' => 'nullable|string|max:255',
            'tujuan'         => 'required|string|max:255',
            'keterangan'     => 'nullable|string',
        ]);

        // 2. Simpan ke database
        BukuTamu::create([
            'nama'           => $request->nama,
            'kelas_instansi' => $request->kelas_instansi,
            'tujuan'         => $request->tujuan,
            'keterangan'     => $request->keterangan,
        ]);

        // 3. Kembalikan pengunjung ke halaman sebelumnya (landing page) dengan pesan sukses
        return back()->with('success_buku_tamu', 'Terima kasih! Kunjungan Anda telah tercatat di Buku Tamu Perpustakaan.');
    }
}
