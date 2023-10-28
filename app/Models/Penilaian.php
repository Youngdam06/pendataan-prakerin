<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penilaian extends Model
{
    use HasFactory;
    protected $table = 'penilaian';
    protected $fillable = [
        'id_siswa',
        'id_pembimbing',
        'ketepatan_waktu',
        'sikap_kerja',
        'tanggung_jawab',
        'kehadiran',
        'kemampuan_kerja',
        'keterampilan_kerja',
        'kualitas_kerja',
        'berkomunikasi',
        'kerjasama',
        'kerajinan',
        'rasa_pd',
        'mematuhi_aturan',
        'penampilan',
    ];
}
