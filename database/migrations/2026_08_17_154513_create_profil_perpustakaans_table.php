<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('profil_perpustakaans', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perpustakaan')->default('SIPERPUS SMPN 2 Kadugede');
            $table->text('deskripsi_hero')->nullable();
            $table->text('sejarah')->nullable();
            $table->text('visi_misi')->nullable();
            $table->string('bagan_struktur_image')->nullable();
            $table->text('tata_tertib')->nullable();
            $table->string('alamat')->nullable();
            $table->string('email')->nullable();
            $table->string('telepon')->nullable();
            $table->string('jam_kerja_buka')->nullable();
            $table->string('jam_kerja_tutup')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('profil_perpustakaans');
    }
};
