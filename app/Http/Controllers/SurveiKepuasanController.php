<?php

namespace App\Http\Controllers;

use App\Models\SurveiKepuasan;
use Illuminate\Http\Request;

class SurveiKepuasanController extends Controller
{
    // ==========================================
    // SISI PUBLIK
    // ==========================================
    public function store(Request $request)
    {
        $request->validate([
            'nama'     => 'required|string|max:255',
            'peran'    => 'nullable|string|max:100',
            'kepuasan' => 'required|string|max:50',
            'saran'    => 'nullable|string',
        ]);

        SurveiKepuasan::create($request->all());

        return back()->with('success_survei', 'Terima kasih atas penilaian dan masukan Anda! Hal ini sangat berharga bagi peningkatan layanan kami.');
    }


    // ==========================================
    // SISI ADMIN
    // ==========================================
    public function index()
    {
        // Mengambil data terbaru dengan pagination (opsional, diset 10 per halaman)
        $survei = SurveiKepuasan::latest()->paginate(10);
        return view('admin.survei_kepuasan.index', compact('survei'));
    }

    public function destroy($id)
    {
        $survei = SurveiKepuasan::findOrFail($id);
        $survei->delete();

        return back()->with('success', 'Data survei kepuasan berhasil dihapus!');
    }
}
