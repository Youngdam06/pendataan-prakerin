<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Instansi extends Model
{
    use HasFactory;
    protected $table = 'instansi';
    protected $fillable = [
        'nama_instansi',
        'no_telp',
        'email',
    ];

    public function siswa(): BelongsTo
    {
        return $this->belongsTo(siswa::class);
    }
}
