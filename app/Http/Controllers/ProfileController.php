<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman Profil Saya
     */
    public function index()
    {
        // Mengambil data user yang sedang login
        $user = Auth::user();
        return view('admin.profile.index', compact('user'));
    }

    /**
     * Memperbarui data profil dasar
     */
    public function update(Request $request)
    {
        // 1. Ambil data user yang sedang login
        $user = Auth::user();

        // 2. Validasi Input
        $request->validate([
            'name' => 'required|string|max:100',
            // Pengecualian unique untuk ID user saat ini agar bisa menyimpan email/username yang sama
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_telepon' => 'nullable|string|max:20',
            'alamat' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'username.unique' => 'Username ini sudah digunakan oleh orang lain.',
            'email.unique' => 'Email ini sudah terdaftar di sistem.',
            'foto.max' => 'Ukuran foto profil maksimal adalah 2 MB.',
        ]);

        // 3. Siapkan data yang akan diupdate
        $data = $request->only(['name', 'username', 'email', 'no_telepon', 'alamat']);

        // 4. Proses upload foto baru jika ada
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto && Storage::disk('public')->exists($user->foto)) {
                Storage::disk('public')->delete($user->foto);
            }
            // Simpan foto baru ke folder storage/app/public/profil
            $data['foto'] = $request->file('foto')->store('profil', 'public');
        }

        // 5. Simpan ke database
        // Karena $user adalah instance langsung dari model, kita bisa pakai update()
        /** @var \App\Models\User $user */
        $user->update($data);

        return redirect()->back()->with('success', 'Informasi profil berhasil diperbarui!');
    }

    /**
     * Memperbarui kata sandi (password)
     */
    public function updatePassword(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'current_password' => 'required',
            // 'confirmed' mengharuskan ada input 'password_confirmation' di form HTML
            'password' => 'required|string|min:8|confirmed',
        ], [
            'current_password.required' => 'Kata sandi saat ini wajib diisi.',
            'password.required' => 'Kata sandi baru wajib diisi.',
            'password.min' => 'Kata sandi baru minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi kata sandi baru tidak cocok.',
        ]);

        /** @var \App\Models\User $user */
        $user = Auth::user();

        // 2. Cek apakah password lama yang dimasukkan sesuai dengan di database
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'Kata sandi saat ini yang Anda masukkan salah.']);
        }

        // 3. Enkripsi dan simpan password baru
        $user->update([
            'password' => Hash::make($request->password)
        ]);

        return back()->with('success', 'Kata sandi berhasil diperbarui! Silakan gunakan kata sandi baru pada login berikutnya.');
    }
}
