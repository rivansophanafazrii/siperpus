<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('peminjamans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_transaksi', 50)->unique();

            // Relasi ke tabel Anggota dan Buku
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('buku_id')->constrained('buku')->onUpdate('cascade')->onDelete('restrict');

            $table->date('tanggal_pinjam');
            $table->date('tenggat_waktu')->comment('Batas maksimal pengembalian');
            $table->date('tanggal_dikembalikan')->nullable();

            $table->enum('status', ['Dipinjam', 'Dikembalikan'])->default('Dipinjam');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('peminjamans');
    }
};
