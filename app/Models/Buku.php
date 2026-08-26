<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Buku extends Model
{
    use HasFactory, SoftDeletes; // Tambahkan trait SoftDeletes

    protected $table = 'buku'; // Sesuaikan dengan nama tabel di migration kamu

    protected $fillable = [
        'kategori_id',
        'kode_buku',
        'judul',
        'slug',
        'isbn',
        'penulis',
        'penerbit',
        'tahun_terbit',
        'stok',
        'rak',
        'cover',
        'file_ebook',
        'deskripsi'
    ];

    // Relasi ke tabel kategori
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    public function rak()
    {
        // Sesuaikan tipe relasinya, ini contoh jika tabel buku memiliki kolom 'rak_id'
        return $this->belongsTo(Rak::class, 'rak_id');
    }
}
