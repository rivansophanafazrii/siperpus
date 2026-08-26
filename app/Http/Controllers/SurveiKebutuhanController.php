<?php

namespace App\Http\Controllers;

use App\Models\SurveiKebutuhan;
use Illuminate\Http\Request;

class SurveiKebutuhanController extends Controller
{
    // ==========================================
    // SISI PUBLIK (PENGUNJUNG)
    // ==========================================

    // Menyimpan data survei dari halaman depan
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'peran' => 'nullable|string|max:100',
            'judul_buku' => 'required|string|max:255',
            'pengarang' => 'nullable|string|max:255',
            'alasan' => 'nullable|string',
        ]);

        SurveiKebutuhan::create($request->all());

        return back()->with('success_survei', 'Terima kasih! Usulan buku Anda telah kami terima dan akan dipertimbangkan.');
    }


    // ==========================================
    // SISI ADMIN
    // ==========================================

    // Menampilkan daftar survei di Dashboard Admin
    public function index()
    {
        $survei = SurveiKebutuhan::latest()->get();
        return view('admin.survei_kebutuhan.index', compact('survei'));
    }

    // Menghapus data survei
    public function destroy($id)
    {
        $survei = SurveiKebutuhan::findOrFail($id);
        $survei->delete();

        return redirect()->route('admin.survei-kebutuhan.index')
            ->with('success', 'Data survei kebutuhan berhasil dihapus!');
    }
}
