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
        Schema::create('buku_tamu', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('kelas_instansi')->nullable()->comment('Isi kelas jika siswa, atau asal instansi jika tamu luar');
            $table->string('tujuan');
            $table->text('keterangan')->nullable()->comment('Pesan, kesan, atau keterangan tambahan');
            $table->timestamps(); // Otomatis mencatat tanggal dan jam kedatangan (created_at)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('buku_tamu');
    }
};
