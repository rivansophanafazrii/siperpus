<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveiKebutuhan extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama', 
        'peran', 
        'judul_buku', 
        'pengarang', 
        'alasan'
    ];
}