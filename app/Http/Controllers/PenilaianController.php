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
    public function index(Request $request)
    {
        // Mengambil data pembimbing yang sedang login
        $pembimbing = Auth::guard('pembimbing')->user();

        // Mengambil data siswa prakerin yang dibimbing oleh pembimbing yang login
        $penilaian = DB::select("CALL tampilkan_data_innerjoin_penilaian_pembimbing('{$pembimbing->id}')");
        
        foreach ($penilaian as $siswa) {
            // Cek apakah siswa sudah dinilai berdasarkan data penilaian dalam database
            $siswa->sudahDinilai = Penilaian::where('id_siswa', $siswa->id_siswa)->exists();
        }
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $tanggal_awal = $request->input('tanggal_awal');
            $tanggal_akhir = $request->input('tanggal_akhir');

            if (!empty($tanggal_awal) && !empty($tanggal_akhir)) { 
                $penilaian = collect($penilaian)->filter(function ($item) use ($tanggal_awal, $tanggal_akhir) {
                    return $item->tanggal_awal >= $tanggal_awal && $item->tanggal_akhir <= $tanggal_akhir;
                });
            } else {
                return back()->with('status_error', 'Tanggal awal dan akhir harus diisi');
            }
        }

        return view('pembimbing.penilaian', compact('penilaian'));
    }

    public function create(string $id)
    {
        // menampilkan halaman create sesuai dengan id siswa yang ingin dinilai
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
            'ketepatan_waktu.required' => 'field wajib diisi.',
            'sikap_kerja.required' => 'field wajib diisi.',
            'tanggung_jawab.required' => 'field wajib diisi.',
            'kehadiran.required' => 'field wajib diisi.',
            'kemampuan_kerja.required' => 'field wajib diisi.',
            'keterampilan_kerja.required' => 'field wajib diisi.',
            'kualitas_kerja.required' => 'field wajib diisi.',
            'berkomunikasi.required' => 'field wajib diisi.',
            'kerjasama.required' => 'field wajib diisi.',
            'kerajinan.required' => 'field wajib diisi.',
            'rasa_pd.required' => 'field wajib diisi.',
            'mematuhi_aturan.required' => 'field wajib diisi.',
            'penampilan.required' => 'field wajib diisi.',
        ]);
        // mengambil id pembimbing yang sedang login
        $id_pembimbing = Auth::guard('pembimbing')->user()->id;

        // Menghitung nilai total (ttl_nilai)
        $ttl_nilai = $request->ketepatan_waktu + $request->sikap_kerja + $request->tanggung_jawab + $request->kehadiran + $request->kemampuan_kerja + $request->keterampilan_kerja + $request->kualitas_kerja + $request->berkomunikasi + $request->kerjasama + $request->kerajinan + $request->rasa_pd + $request->mematuhi_aturan + $request->penampilan;

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
            'ttl_nilai' =>  $ttl_nilai,
        ]);

        // Simpan data ke database
        $penilaian->save();

        return redirect()->route('indexNilai')->with('success', 'Data berhasil disimpan.');
    }

    public function laporanNilai()
    {
        // call store procedure untuk menampilkan data penilaian
        $nilai = DB::select("CALL tampilkan_laporan_data_penilaian()");
         // Iterasi melalui data penilaian dan menghitung total nilai untuk setiap baris
        foreach ($nilai as $data) {
            $data->ttl_nilai = $data->ketepatan_waktu + $data->sikap_kerja + $data->tanggung_jawab + $data->kehadiran + $data->kemampuan_kerja + $data->keterampilan_kerja + $data->kualitas_kerja + $data->berkomunikasi + $data->kerjasama + $data->kerajinan + $data->rasa_pd + $data->mematuhi_aturan + $data->penampilan;
        }
        return view('nilai', compact('nilai'));
    }
}
