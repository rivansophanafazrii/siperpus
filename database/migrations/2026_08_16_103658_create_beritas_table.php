<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Menggunakan nama tabel 'berita' agar rapi dan tidak perlu plural bahasa Inggris
        Schema::create('berita', function (Blueprint $table) {
            $table->id();
            $table->string('judul');
            $table->string('slug')->unique(); // Slug harus unik untuk URL
            $table->text('kategori');
            $table->text('konten');
            $table->string('gambar')->nullable(); // Boleh kosong jika tidak ada gambar
            $table->boolean('is_published')->default(true); // Default langsung tayang
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('berita');
    }
};