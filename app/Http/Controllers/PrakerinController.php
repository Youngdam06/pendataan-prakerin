<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Siswa;
use App\Models\Prakerin;
use App\Exports\ExportNilai;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Session;

class PrakerinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data prakerin dengan call store procedure mysql
        $prakerin = DB::select("CALL tampilkan_data_innerjoin_prakerin()");
        //  jika permintaan (request) memiliki parameter 'tanggal_awal' dan 'tanggal_akhir', maka kode akan mengambil nilai dari kedua parameter tersebut.
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $tanggal_awal = $request->input('tanggal_awal');
            $tanggal_akhir = $request->input('tanggal_akhir');
            //  jika kedua tanggal tersebut tidak kosong, maka data prakerin akan difilter berdasarkan rentang tanggal tersebut menggunakan fungsi filter
            if (!empty($tanggal_awal) && !empty($tanggal_akhir)) { 
                $prakerin = collect($prakerin)->filter(function ($item) use ($tanggal_awal, $tanggal_akhir) {
                    return $item->tanggal_awal >= $tanggal_awal && $item->tanggal_akhir <= $tanggal_akhir;
                });
            } else {
                return back()->with('status_error', 'Tanggal awal dan akhir harus diisi');
            }
        }
        return view('prakerin.dash', compact('prakerin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Mengambil data siswa dari tabel Instansi untuk dropdown item
        $siswa = Siswa::pluck('nama', 'id');
        return view('prakerin.create', compact('siswa'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
            'id_siswa' => 'required|numeric|unique:prakerin,id_siswa',
        ], [
            'tanggal_awal.required' => 'Tanggal Awal wajib diisi.',
            'tanggal_akhir.required' => 'Tanggal Akhir wajib diisi.',
            'id_siswa.required' => 'ID Siswa wajib diisi.',
            'id_siswa.unique' => 'Data ID Siswa sudah ada.',
        ]);
        // Simpan data jika validasi berhasil
            Prakerin::create($request->all());
            return redirect()->route('dataprakerin.index')->with('success', 'Data Prakerin berhasil ditambahkan.');
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
        $siswa = Siswa::pluck('nama', 'id');
        $prakerin = Prakerin::firstWhere('id', $id);
        return view('prakerin/edit', compact('prakerin', 'siswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'tanggal_awal' => 'required',
            'tanggal_akhir' => 'required',
            'id_siswa' => 'required|numeric|unique:prakerin,id_siswa,' . $id, // Menghindari validasi unik untuk dirinya sendiri
        ], [
            'tanggal_awal.required' => 'Tanggal Awal wajib diisi.',
            'tanggal_akhir.required' => 'Tanggal Akhir wajib diisi.',
            'id_siswa.required' => 'ID Siswa wajib diisi.',
            'id_siswa.unique' => 'Data ID Siswa sudah ada.',
        ]);

        // ambil data prakerin yang ingin diubah
        $prakerin = Prakerin::find($id);
        $prakerin->tanggal_awal = $request->tanggal_awal;
        $prakerin->tanggal_akhir = $request->tanggal_akhir;
        $prakerin->id_siswa = $request->id_siswa;
        $prakerin->save();
        return redirect()->route('dataprakerin.index')->with('success2', 'Data Prakerin berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $prakerin = Prakerin::find($id);
        $prakerin->delete();
        return redirect()->route('dataprakerin.index');
    }

    public function laporan_data(Request $request)
    {
        $prakerin = DB::select("CALL tampilkan_data_innerjoin_prakerinn()");
        //  jika permintaan (request) memiliki parameter 'tanggal_awal' dan 'tanggal_akhir', maka kode akan mengambil nilai dari kedua parameter tersebut.
        if ($request->has('tanggal_awal') && $request->has('tanggal_akhir')) {
            $tanggal_awal = $request->input('tanggal_awal');
            $tanggal_akhir = $request->input('tanggal_akhir');
            //  jika kedua tanggal tersebut tidak kosong, maka data prakerin akan difilter berdasarkan rentang tanggal tersebut menggunakan fungsi filter
            if (!empty($tanggal_awal) && !empty($tanggal_akhir)) { 
                $prakerin = collect($prakerin)->filter(function ($item) use ($tanggal_awal, $tanggal_akhir) {
                    return $item->tanggal_awal >= $tanggal_awal && $item->tanggal_akhir <= $tanggal_akhir;
                });
            } else {
                return back()->with('status_error', 'Tanggal awal dan akhir harus diisi');
            }
        }
        return view('prakerin.laporan', compact('prakerin'));
    }
}
