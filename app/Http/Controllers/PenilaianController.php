<?php

namespace App\Http\Controllers;

use App\Exports\ExportNilai;
use App\Imports\ImportNilai;
use App\Models\Penilaian;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PenilaianController extends Controller
{
    //
    public function index()
    {
        // Mengambil data pembimbing yang sedang login
        $pembimbing = Auth::guard('pembimbing')->user();

        // Mengambil data siswa prakerin yang dibimbing oleh pembimbing yang login
        $penilaian = DB::select("CALL tampilkan_data_innerjoin_penilaian_pembimbing('{$pembimbing->id}')");

        return view('pembimbing.penilaian', compact('penilaian'));
    }

    public function create(string $id)
    {
        $penilaian = Siswa::firstWhere('id', $id);
        return view('pembimbing.create-nilai', compact('penilaian'));
    }

    public function export_nilai($id)
    {
        // Ambil data siswa berdasarkan ID
        $siswa = DB::select("CALL tampil_penilaian_persiswa('{$id}')");

        // Lakukan export menggunakan data siswa yang telah diambil
        return Excel::download(new ExportNilai($siswa), "nilai.xlsx");
    }

    public function import_nilai(Request $request)
    {
        $file = $request->file('excelFile');

        // Validasi file Excel
        $request->validate([
            'excelFile' => 'required|mimes:xlsx,xls',
        ]);

        // Proses impor data dari file Excel
        Excel::import(new ImportNilai, $file);

        return redirect()->back()->with('success', 'Data berhasil diimpor dari Excel.');
    }

    public function store(Request $request, string $id)
    {
        $request->validate([
            'id_siswa' => 'unique:penilaian,id_siswa',
            // 'id_pembimbing' => 'required',
            'ketepatan_waktu' => 'required',
            'sikap_kerja' => 'required',
            'tanggung_jawab' => 'required',
            'kehadiran' => 'required',
            'kemampuan_kerja' => 'required',
            'keterampilan_kerja' => 'required',
            'kualitas_kerja' => 'required',
            'berkomunikasi' => 'required',
            'kerjasama' => 'required',
            'kerajinan' => 'required',
            'rasa_pd' => 'required',
            'mematuhi_aturan' => 'required',
            'penampilan' => 'required',
        ],[
            'id_siswa.unique' => 'Siswa sudah dinilai!.',
        ]);
        
        $existingPenilaian = Penilaian::where('id_siswa', $id)->first();

        if ($existingPenilaian) {
            return redirect()->back()->with('error-siswa', 'Data untuk siswa ini sudah ada.');
        }

        $id_pembimbing = Auth::guard('pembimbing')->user()->id;

        // Membuat instance Penilaian dan mengisinya dengan data yang valid
        $penilaian = new Penilaian([
            'id_siswa' => $id,
            'id_pembimbing' => $id_pembimbing, // Mengisi id_pembimbing dengan ID pembimbing yang sedang login
            'ketepatan_waktu' => $request->ketepatan_waktu,
            'sikap_kerja' => $request->sikap_kerja,
            'tanggung_jawab' => $request->tanggung_jawab,
            'kehadiran' => $request->kehadiran,
            'kemampuan_kerja' => $request->kemampuan_kerja,
            'keterampilan_kerja' => $request->keterampilan_kerja,
            'kualitas_kerja' => $request->kualitas_kerja,
            'berkomunikasi' => $request->berkomunikasi,
            'kerjasama' => $request->kerjasama,
            'kerajinan' => $request->kerajinan,
            'rasa_pd' => $request->rasa_pd,
            'mematuhi_aturan' => $request->mematuhi_aturan,
            'penampilan' => $request->penampilan,
        ]);

        // Simpan data ke database
        $penilaian->save();

        return redirect()->route('indexNilai')->with('success', 'Data berhasil disimpan.');
    }

    public function laporanNilai()
    {
        // call store procedure untuk menampilkan data penilaian
        $nilaiadmin = DB::select("CALL tampilkan_data_penilaian_admin()");
        return view('nilai-admin', compact('nilaiadmin'));
    }
}
