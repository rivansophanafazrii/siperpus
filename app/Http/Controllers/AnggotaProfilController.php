<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class AnggotaProfilController extends Controller
{
    // Menampilkan halaman profil
    public function index()
    {
        $user = Auth::user();
        return view('anggota.profil.index', compact('user'));
    }

    // Memproses update data profil
    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'no_telepon' => 'nullable|string|max:20',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'nullable|min:8|confirmed', // Harus ada input password_confirmation
        ]);

        // Update data dasar
        $user->name = $request->name;
        $user->email = $request->email;
        $user->no_telepon = $request->no_telepon;

        // Cek jika ada upload foto profil baru
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            // Simpan foto baru
            $user->foto = $request->file('foto')->store('profil', 'public');
        }

        // Cek jika user mengisi password baru
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->back()->with('success', 'Profil Anda berhasil diperbarui!');
    }
}
