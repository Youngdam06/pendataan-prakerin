<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Siswa extends Model
{
    use HasFactory;
    protected $table = 'siswa';
    protected $fillable = [
        'nis',
        'nama',
        'no_telp',
        'kelas',
        'jurusan',
        'angkatan',
        'email',
        'id_instansi',
        'id_pembimbing',
    ];

    public function instansi(): HasOne
    {
        return $this->hasOne(instansi::class);
    }
}
