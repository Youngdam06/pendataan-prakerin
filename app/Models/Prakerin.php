<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prakerin extends Model
{
    use HasFactory;
    protected $table = 'prakerin';
    protected $fillable = [
        'tanggal_awal',
        'tanggal_akhir',
        'id_siswa',
    ];
}
