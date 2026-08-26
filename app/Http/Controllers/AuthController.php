<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Nama method disesuaikan dengan rute: [AuthController::class, 'showLoginForm']
    public function index()
    {
        return view('auth.login');
    }


    // Nama method disesuaikan dengan rute: [AuthController::class, 'login']
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required',
        ], [
            'username.required' => 'Username / NIS / NIP wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        // Cek user berdasarkan kolom 'username' ATAU 'nis_nip'
        $user = User::where('username', $request->username)
            ->orWhere('nis_nip', $request->username)
            ->first();

        // Verifikasi keberadaan user dan kecocokan password
        if ($user && Hash::check($request->password, $user->password)) {

            // Cek apakah akun aktif (mencegah siswa lulus/pindah untuk login)
            if ($user->status !== 'aktif') {
                return back()->withErrors([
                    'username' => 'Akun Anda berstatus tidak aktif. Silakan hubungi admin.',
                ])->onlyInput('username');
            }

            // Lakukan Login
            Auth::login($user, $request->has('remember'));
            $request->session()->regenerate();

            // Redirect sesuai Role (menggunakan route names sesuai gambarmu)
            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                return redirect()->route('anggota.dashboard');
            }
        }

        // Jika salah password/username
        return back()->withErrors([
            'username' => 'Informasi login yang Anda masukkan salah.',
        ])->onlyInput('username');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login')->with('success', 'Anda berhasil keluar dari sistem.');
    }
}
