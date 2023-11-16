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
            if (count($row) >=16) {
                return new Penilaian([
                'id_siswa' => $row[0],
                'id_pembimbing' => $row[1],
                'ketepatan_waktu' => $row[2],
                'sikap_kerja' => $row[3],
                'tanggung_jawab' => $row[4],
                'kehadiran' => $row[5],
                'kemampuan_kerja' => $row[6],
                'keterampilan_kerja' => $row[7],
                'kualitas_kerja' => $row[8],
                'berkomunikasi' => $row[9],
                'kerjasama' => $row[10],
                'kerajinan' => $row[11],
                'rasa_pd' => $row[12],
                'mematuhi_aturan' => $row[13],
                'penampilan' => $row[14],
                'ttl_nilai' => $row[15],
            ]);
    } else {
        return null;
    }
}

}
