<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rak extends Model
{
    use HasFactory;

    protected $table = 'raks';

    protected $fillable = [
        'nama_rak',
        'lokasi',
        'keterangan'
    ];
}