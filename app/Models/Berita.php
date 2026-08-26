<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Berita extends Model
{
    use HasFactory;

    // Mendefinisikan nama tabel secara eksplisit
    protected $table = 'berita';

    // Mendefinisikan kolom yang boleh diisi
    protected $fillable = [
        'judul',
        'slug',
        'kategori',
        'konten',
        'gambar',
        'is_published',
    ];

    /**
     * Relasi ke model Kategori
     */
    public function kategori()
    {
        // Sesuaikan 'Kategori::class' jika nama model Anda berbeda (misal: KategoriBerita::class)
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }

    /**
     * Relasi ke model User (Penulis)
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
