<?php

namespace App\Http\Controllers;

use App\Models\PengurusPerpustakaan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengurusPerpustakaanController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'urutan'  => 'required|integer',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        PengurusPerpustakaan::create($validated);

        return redirect()->back()->with('success', 'Pengurus berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $pengurus = PengurusPerpustakaan::findOrFail($id);

        $validated = $request->validate([
            'nama'    => 'required|string|max:255',
            'jabatan' => 'required|string|max:255',
            'urutan'  => 'required|integer',
            'foto'    => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($pengurus->foto && Storage::exists('public/' . $pengurus->foto)) {
                Storage::delete('public/' . $pengurus->foto);
            }
            $validated['foto'] = $request->file('foto')->store('pengurus', 'public');
        }

        $pengurus->update($validated);

        return redirect()->back()->with('success', 'Data pengurus berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pengurus = PengurusPerpustakaan::findOrFail($id);

        if ($pengurus->foto && Storage::exists('public/' . $pengurus->foto)) {
            Storage::delete('public/' . $pengurus->foto);
        }

        $pengurus->delete();

        return redirect()->back()->with('success', 'Pengurus berhasil dihapus.');
    }
}
