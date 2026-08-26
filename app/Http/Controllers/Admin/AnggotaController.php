<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AnggotaController extends Controller
{
    /**
     * Menampilkan daftar anggota.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $anggota = User::when($search, function ($query, $search) {
            return $query->where('name', 'like', "%{$search}%")
                ->orWhere('nis_nip', 'like', "%{$search}%")
                ->orWhere('email', 'like', "%{$search}%")
                ->orWhere('username', 'like', "%{$search}%");
        })->latest()->paginate(10);

        return view('admin.anggota.index', compact('anggota'));
    }

    /**
     * Menampilkan form tambah anggota.
     */
    public function create()
    {
        return view('admin.anggota.create');
    }

    /**
     * Menyimpan data anggota baru ke database.
     */
    public function store(Request $request)
    {
        // Validasi disesuaikan ketat dengan migration
        $request->validate([
            'username'      => 'required|string|max:50|unique:users,username',
            'email'         => 'nullable|email|max:255|unique:users,email', // Sesuai migration: nullable
            'password'      => 'required|string|min:8|confirmed',
            'role'          => 'required|in:admin,anggota',
            'nis_nip'       => 'nullable|string|max:30|unique:users,nis_nip',
            'name'          => 'required|string|max:100',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tipe_anggota'  => 'nullable|in:siswa,guru,staf,umum',
            'kelas'         => 'nullable|string|max:20',
            'no_telepon'    => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status'        => 'nullable|in:aktif,nonaktif,lulus,pindah',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);

        // Jika status tidak diisi dari form, default ke aktif sesuai database
        if (!$request->filled('status')) {
            $data['status'] = 'aktif';
        }

        // Logika Upload Foto
        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto_profil', 'public');
        }

        User::create($data);

        return redirect()->route('admin.anggota.index')->with('success', 'Data pengguna berhasil ditambahkan!');
    }

    /**
     * Menampilkan detail anggota.
     */
    public function show($id)
    {
        $anggota = User::findOrFail($id);
        return view('admin.anggota.show', compact('anggota'));
    }

    /**
     * Menampilkan form edit anggota.
     */
    public function edit($id)
    {
        $anggota = User::findOrFail($id);
        return view('admin.anggota.edit', compact('anggota'));
    }

    /**
     * Memperbarui data anggota di database.
     */
    public function update(Request $request, $id)
    {
        $anggota = User::findOrFail($id);

        // Validasi update (abaikan unique untuk ID yang sedang diedit)
        $request->validate([
            'username'      => 'required|string|max:50|unique:users,username,' . $id,
            'email'         => 'nullable|email|max:255|unique:users,email,' . $id,
            'password'      => 'nullable|string|min:8|confirmed',
            'role'          => 'required|in:admin,anggota',
            'nis_nip'       => 'nullable|string|max:30|unique:users,nis_nip,' . $id,
            'name'          => 'required|string|max:100',
            'jenis_kelamin' => 'nullable|in:L,P',
            'tipe_anggota'  => 'nullable|in:siswa,guru,staf,umum',
            'kelas'         => 'nullable|string|max:20',
            'no_telepon'    => 'nullable|string|max:20',
            'alamat'        => 'nullable|string',
            'foto'          => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status'        => 'required|in:aktif,nonaktif,lulus,pindah',
        ]);

        $data = $request->except(['password', 'password_confirmation']);

        // Update password hanya jika diisi
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        // Logika Update Foto
        if ($request->hasFile('foto')) {
            if ($anggota->foto && Storage::disk('public')->exists($anggota->foto)) {
                Storage::disk('public')->delete($anggota->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto_profil', 'public');
        }

        $anggota->update($data);

        return redirect()->route('admin.anggota.index')->with('success', 'Data pengguna berhasil diperbarui!');
    }

    /**
     * Menghapus anggota dari database.
     */
    public function destroy($id)
    {
        $anggota = User::findOrFail($id);

        // Hapus foto fisik dari storage
        if ($anggota->foto && Storage::disk('public')->exists($anggota->foto)) {
            Storage::disk('public')->delete($anggota->foto);
        }

        $anggota->delete(); // Karena menggunakan softDeletes, data tidak benar-benar hilang dari database

        return redirect()->route('admin.anggota.index')->with('success', 'Data pengguna berhasil dihapus!');
    }

    public function bulkDestroy(Request $request)
    {
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'exists:users,id'
        ]);

        // Opsi: Hapus foto dari storage juga jika kamu menghendakinya
        // $users = User::whereIn('id', $request->ids)->get();
        // foreach($users as $user) { ...hapus storage... }

        User::whereIn('id', $request->ids)->delete();

        return redirect()->route('admin.anggota.index')->with('success', 'Data anggota yang dipilih berhasil dihapus!');
    }
}
