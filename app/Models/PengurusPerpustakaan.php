<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengurusPerpustakaan extends Model
{
    use HasFactory;

    protected $table = 'pengurus_perpustakaans';
    protected $guarded = ['id'];
}
