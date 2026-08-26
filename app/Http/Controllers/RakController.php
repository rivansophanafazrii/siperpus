<?php

namespace App\Http\Controllers;

use App\Models\Rak;
use Illuminate\Http\Request;

class RakController extends Controller
{
    public function index(Request $request)
    {
        $rak = Rak::when($request->search, function ($query) use ($request) {
            $query->where('nama_rak', 'like', "%{$request->search}%")
                ->orWhere('lokasi', 'like', "%{$request->search}%");
        })->latest()->paginate(10);

        return view('admin.rak.index', compact('rak'));
    }

    public function create()
    {
        return view('admin.rak.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_rak'   => 'required|string|max:255|unique:raks',
            'lokasi'     => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        Rak::create($request->all());

        return redirect()->route('admin.rak.index')->with('success', 'Data rak berhasil ditambahkan!');
    }

    public function show(Rak $rak)
    {
        return view('admin.rak.show', compact('rak'));
    }

    public function edit(Rak $rak)
    {
        return view('admin.rak.edit', compact('rak'));
    }

    public function update(Request $request, Rak $rak)
    {
        $request->validate([
            'nama_rak'   => 'required|string|max:255|unique:raks,nama_rak,' . $rak->id,
            'lokasi'     => 'required|string|max:255',
            'keterangan' => 'nullable|string'
        ]);

        $rak->update($request->all());

        return redirect()->route('admin.rak.index')->with('success', 'Data rak berhasil diperbarui!');
    }

    public function destroy(Rak $rak)
    {
        $rak->delete();
        return redirect()->route('admin.rak.index')->with('success', 'Data rak berhasil dihapus!');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:raks,id'
        ]);

        Rak::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.rak.index')->with('success', 'Data rak yang dipilih berhasil dihapus!');
    }
}
