<?php

namespace App\Http\Controllers;

use App\Models\ProfilPerpustakaan;
use App\Models\PengurusPerpustakaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfilPerpustakaanController extends Controller
{
    public function index()
    {
        $profil = ProfilPerpustakaan::firstOrCreate([], [
            'nama_perpustakaan' => 'SIPERPUS SMPN 2 Kadugede'
        ]);
        $pengurus = PengurusPerpustakaan::orderBy('urutan', 'asc')->get();

        return view('admin.profil.index', compact('profil', 'pengurus'));
    }

    public function updateProfil(Request $request)
    {
        $profil = ProfilPerpustakaan::first();

        $validated = $request->validate([
            'nama_perpustakaan'   => 'required|string|max:255',
            'deskripsi_hero'      => 'nullable|string',
            'sejarah'             => 'nullable|string',
            'visi_misi'           => 'nullable|string',
            'tata_tertib'         => 'nullable|string',
            'alamat'              => 'nullable|string',
            'email'               => 'nullable|email',
            'telepon'             => 'nullable|string',
            'jam_kerja_buka'      => 'nullable|string',
            'jam_kerja_tutup'     => 'nullable|string',
            'bagan_struktur_image'=> 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('bagan_struktur_image')) {
            if ($profil->bagan_struktur_image && Storage::exists('public/' . $profil->bagan_struktur_image)) {
                Storage::delete('public/' . $profil->bagan_struktur_image);
            }
            $validated['bagan_struktur_image'] = $request->file('bagan_struktur_image')->store('profil', 'public');
        }

        $profil->update($validated);

        return redirect()->back()->with('success', 'Profil perpustakaan berhasil diperbarui.');
    }
}