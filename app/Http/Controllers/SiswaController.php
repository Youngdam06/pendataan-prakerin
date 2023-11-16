<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Instansi;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil data siswa dari database menggunakan store procedure
        $siswa = DB::select("CALL tampilkan_data_innerjoin_siswa()");
        // lempar ke form siswa
        return view('siswa.dash', compact('siswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil data Instansi dari tabel Instansi untuk dropdown item
        $instansi = Instansi::pluck('nama_instansi', 'id');

        // Mengambil data Pembimbing dari tabel Pembimbing untuk dropdown item
        $pembimbing = Pembimbing::pluck('nama_pembimbing', 'id');
        return view('siswa.create', compact('instansi', 'pembimbing'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis',
            'nama' => 'required',
            'no_telp' =>'required|max:20',
            'kelas' =>'required',
            'jurusan' =>'required',
            'angkatan' =>'required',
            'email' => 'required|email|unique:pembimbing,email',
            'id_instansi' =>'required',
            'id_pembimbing' =>'required',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah ada.',
            'nama.required' => 'Nama siswa wajib diisi.',
            'no_telp.required' => 'nomor telepon wajib diisi.',
            'no_telp.max' => 'nomor telepon tidak boleh lebih panjang dari 20 angka.',
            'kelas.required' => 'kelas wajib diisi.',
            'jurusan.required' => 'jurusan wajib diisi.',
            'angkatan.required' => 'angkatan wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah ada.',
            'id_instansi.required' => 'angkatan wajib diisi.',
            'id_pembimbing.required' => 'angkatan wajib diisi.',
        ]);

        // simpan data jika berhasil
        Siswa::create($request->all());
        // 
        return redirect()->route('datasiswa.index')->with('success', 'Data siswa berhasil ditambah!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siswa = Siswa::firstWhere('id', $id);
        // mengambil isi dari kolom nama_instansi di instansi
        $instansi = Instansi::pluck('nama_instansi', 'id');
        // mengambil isi dari kolom nama_pembimbing di pembimbing
        $pembimbing = Pembimbing::pluck('nama_pembimbing', 'id');
        return view('siswa/edit', compact('siswa', 'instansi', 'pembimbing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nis' => 'required|numeric|unique:siswa,nis,' . $id, // Menghindari validasi unik untuk dirinya sendiri
            'nama' => 'required',
            'no_telp' =>'required|max:20',
            'kelas' =>'required',
            'jurusan' =>'required',
            'angkatan' =>'required',
            'email' => 'required|email|unique:pembimbing,email,' . $id, // Menghindari validasi unik untuk dirinya sendiri
            'id_instansi' =>'required',
            'id_pembimbing' =>'required',
        ], [
            'nis.required' => 'NIS wajib diisi.',
            'nis.unique' => 'NIS sudah ada.',
            'nama.required' => 'Nama pembimbing wajib diisi.',
            'no_telp.required' => 'nomor telepon wajib diisi.',
            'no_telp.max' => 'nomor telepon tidak boleh lebih panjang dari 20 angka.',
            'kelas.required' => 'kelas wajib diisi.',
            'jurusan.required' => 'jurusan wajib diisi.',
            'angkatan.required' => 'angkatan wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah ada.',
            'id_instansi.required' => 'angkatan wajib diisi.',
            'id_pembimbing.required' => 'angkatan wajib diisi.',
        ]);

        $siswa = Siswa::find($id);
        // mengisi atribut-atribut entitas siswa seperti 'nis', 'nama', 'no_telp', dan sebagainya dengan nilai dari input yang diterima dari $request.
        $siswa->nis = $request->nis;
        $siswa->nama = $request->nama;
        $siswa->no_telp = $request->no_telp;
        $siswa->kelas = $request->kelas;
        $siswa->jurusan = $request->jurusan;
        $siswa->angkatan = $request->angkatan;
        $siswa->email = $request->email;
        $siswa->id_instansi = $request->id_instansi;
        $siswa->id_pembimbing = $request->id_pembimbing;
        // simpan ke dalam database
        $siswa->save();
        return redirect()->route('datasiswa.index')->with('success2', 'Data pembimbing berhasil diubah!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siswa = Siswa::find($id);
        $siswa->delete();
        return redirect()->route('datasiswa.index');
    }

    public function laporan_data()
    {
        $siswa = DB::select("CALL tampilkan_data_innerjoin_siswa()");
        return view('siswa.laporan', compact('siswa'));
    }
}
