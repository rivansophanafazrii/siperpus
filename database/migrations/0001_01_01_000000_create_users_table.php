<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. TABEL USERS (Kode kamu sebelumnya)
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            
            $table->string('username', 50)->unique()->comment('Bisa diisi NIS/NIP atau username custom');
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('role', ['admin', 'anggota'])->default('anggota')->comment('Level akses sistem');
            $table->string('nis_nip', 30)->unique()->nullable()->comment('NIS untuk Siswa, NIP/NIK untuk Guru/Staf');
            $table->string('name', 100);
            $table->enum('jenis_kelamin', ['L', 'P'])->nullable();
            $table->enum('tipe_anggota', ['siswa', 'guru', 'staf', 'umum'])->nullable()->comment('Klasifikasi jenis anggota');
            $table->string('kelas', 20)->nullable()->comment('Misal: VII-A, VIII-B');
            $table->string('no_telepon', 20)->nullable();
            $table->text('alamat')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['aktif', 'nonaktif', 'lulus', 'pindah'])->default('aktif')->comment('Status keanggotaan saat ini');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes(); 
        });

        // 2. TABEL PASSWORD RESET TOKENS (Wajib ada bawaan Laravel)
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        // 3. TABEL SESSIONS (Ini yang menyebabkan error tadi)
        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    public function down(): void
    {
        // Pastikan tabel di-drop saat rollback
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};