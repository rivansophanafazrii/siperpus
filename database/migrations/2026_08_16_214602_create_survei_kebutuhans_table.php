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
        Schema::create('survei_kebutuhans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('peran')->nullable(); // Siswa, Guru, atau Staf
            $table->string('judul_buku');
            $table->string('pengarang')->nullable();
            $table->text('alasan')->nullable(); // Kenapa butuh buku ini
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survei_kebutuhans');
    }
};
