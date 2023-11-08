<?php

namespace App\Exports;

use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ExportNilai implements FromCollection, WithTitle, ShouldAutoSize, WithHeadings
{
    protected $siswa;

    public function __construct($siswa)
    {
        $this->siswa = $siswa;
    }

    public function collection()
    {
        return collect($this->siswa);
    }

    public function title(): string
    {
        return 'Data Nilai Siswa';
    }

    public function headings(): array
    {
        return [
            [
                'Nama Siswa',
                'Nama Pembimbing',
                'Ketepatan Waktu',
                'Sikap Kerja',
                'Tanggung Jawab',
                'Kehadiran',
                'Kemampuan Kerja',
                'Keterampilan Kerja',
                'Kualitas Kerja',
                'Berkomunikasi',
                'Kerjasama',
                'Kerajinan',
                'Rasa Percaya Diri',
                'Mematuhi Aturan',
                'Penampilan',
                'Total Nilai',
            ],
        ];
    }
}
