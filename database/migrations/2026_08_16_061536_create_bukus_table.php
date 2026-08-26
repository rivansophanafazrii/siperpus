<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->id();
            
            // Relasi ke tabel Kategori
            $table->foreignId('kategori_id')->constrained('kategoris')->onUpdate('cascade')->onDelete('restrict');
            
            // Identitas Buku
            $table->string('kode_buku', 50)->unique()->comment('Nomor Induk Buku / Barcode Internal');
            $table->string('judul');
            $table->string('slug')->unique()->comment('URL friendly untuk detail buku');
            $table->string('isbn', 50)->unique()->nullable();
            $table->string('penulis', 150)->nullable();
            $table->string('penerbit', 150)->nullable();
            $table->year('tahun_terbit')->nullable();
            
            // Manajemen Inventaris & Digital
            $table->integer('stok')->default(0)->comment('Jumlah total fisik buku');
            $table->string('rak', 50)->nullable()->comment('Lokasi rak, misal: Rak A1');
            $table->string('cover')->nullable()->comment('Path file gambar sampul buku');
            
            // Fitur E-Book
            $table->string('file_ebook')->nullable()->comment('Path file PDF untuk dibaca online');
            
            // Detail Tambahan
            $table->text('deskripsi')->nullable();
            
            $table->timestamps();
            
            // Soft Deletes agar riwayat peminjaman buku yang dihapus tidak error
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buku');
    }
};