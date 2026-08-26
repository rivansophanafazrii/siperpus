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
        Schema::create('survei_kepuasans', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('peran')->nullable(); // Siswa, Guru, Umum, dll
            $table->string('kepuasan'); // Sangat Puas, Puas, Cukup, Kurang
            $table->text('saran')->nullable(); // Kritik dan saran
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('survei_kepuasans');
    }
};
