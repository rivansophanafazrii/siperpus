<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Membuat Akun Admin (Staf Perpustakaan)
        User::create([
            'username' => 'adminperpus',
            'email' => 'admin@smpn2kadugede.sch.id',
            'password' => Hash::make('admin123'), // Password untuk login
            'role' => 'admin',
            'nis_nip' => '198001012005011001', // Contoh NIP
            'name' => 'Bapak Administrator',
            'jenis_kelamin' => 'L',
            'tipe_anggota' => 'staf',
            'kelas' => null, // Staf tidak memiliki kelas
            'no_telepon' => '081234567890',
            'alamat' => 'Jl. Raya Kadugede No. 123, Kuningan',
            'status' => 'aktif',
        ]);

        // 2. Membuat Akun Anggota (Siswa)
        User::create([
            'username' => '2324001', // Username menggunakan NIS agar mudah diingat siswa
            'email' => 'siswa@smpn2kadugede.sch.id',
            'password' => Hash::make('siswa123'), // Password untuk login
            'role' => 'anggota',
            'nis_nip' => '2324001', // NIS Siswa
            'name' => 'Budi Santoso',
            'jenis_kelamin' => 'L',
            'tipe_anggota' => 'siswa',
            'kelas' => 'VII-A', // Kelas spesifik untuk siswa
            'no_telepon' => '089876543210',
            'alamat' => 'Desa Kadugede RT 01 RW 02',
            'status' => 'aktif',
        ]);

        // Opsional: Membuat Akun Anggota (Guru) untuk variasi data
        User::create([
            'username' => 'gurubasa',
            'email' => 'guru@smpn2kadugede.sch.id',
            'password' => Hash::make('guru123'),
            'role' => 'anggota',
            'nis_nip' => '198502022010022002',
            'name' => 'Ibu Siti Aminah, S.Pd.',
            'jenis_kelamin' => 'P',
            'tipe_anggota' => 'guru',
            'kelas' => null, // Guru tidak memiliki kelas spesifik seperti siswa
            'no_telepon' => '085612349876',
            'alamat' => 'Perumahan Guru Kadugede',
            'status' => 'aktif',
        ]);
    }
}