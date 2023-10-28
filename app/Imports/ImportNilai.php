<?php

namespace App\Imports;

use App\Models\Penilaian;
use Maatwebsite\Excel\Concerns\ToModel;

class ImportNilai implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Penilaian([
            'id_siswa' => $row[1],
            'id_pembimbing' => $row[2],
            'ketepatan_waktu' => $row[3],
            'sikap_kerja' => $row[4],
            'tanggung_jawab' => $row[5],
            'kehadiran' => $row[6],
            'kemampuan_kerja' => $row[7],
            'keterampilan_kerja' => $row[8],
            'kualitas_kerja' => $row[9],
            'berkomunikasi' => $row[10],
            'kerjasama' => $row[11],
            'kerajinan' => $row[12],
            'rasa_pd' => $row[13],
            'mematuhi_aturan' => $row[14],
            'penampilan' => $row[15],
        ]);
    }
}
