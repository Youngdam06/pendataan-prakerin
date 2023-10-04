<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = [
        'nis',
        'nama',
        'no_telp',
        'kelas',
        'angkatan',
        'email',
        'id_instansi',
        'id_pembimbing',
    ];
}
