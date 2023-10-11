<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Prakerin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PrakerinController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $prakerin = DB::select("CALL tampilkan_data_innerjoin_prakerin()");
        return view('prakerin.dash', compact('prakerin'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
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
            'id_siswa' => 'required|numeric|unique:prakerin,id_siswa,' . $id,
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
        return redirect()->route('dataprakerin.index')->with('success', 'Data Prakerin berhasil diubah!');
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

    public function laporan_data()
    {
        $prakerin = DB::select("CALL tampilkan_data_innerjoin_prakerin()");
        return view('prakerin.laporan', compact('prakerin'));
    }
}
