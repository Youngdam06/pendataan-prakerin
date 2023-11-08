<?php

namespace App\Http\Controllers;

use App\Models\Instansi;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class InstansiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Ambil data dengan call store procedure mysql
        $instansi = DB::select("CALL tampilkan_data_instansi()");
        return view('instansi.dash', compact('instansi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('instansi.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi request input yang akan disimpan
        $request->validate([
        'nama_instansi' => 'required',
        'no_telp' => 'required|min:10|max:20',
        'email' => 'required|email|unique:instansi,email',
    ], [
        'nama_instansi.required' => 'Nama Instansi wajib diisi.',
        'no_telp.required' => 'Nomor Telepon wajib diisi.',
        'no_telp.min' => 'nomor telepon tidak boleh lebih pendek dari 10 angka.',
        'no_telp.max' => 'nomor telepon tidak boleh lebih panjang dari 20 angka.',
        'email.required' => 'Alamat Email wajib diisi.',
        'email.email' => 'Alamat Email tidak valid.',
        'email.unique' => 'Alamat Email sudah digunakan.',
    ]);
    // Simpan data jika validasi berhasil
        Instansi::create($request->all());
        return redirect()->route('datainstansi.index')->with('success', 'Data Instansi berhasil ditambahkan.');
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
        //
        $instansi = Instansi::firstWhere('id', $id);
        return view('instansi/edit', compact('instansi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //validasi request input yang akan disimpan
        $request->validate([
            'nama_instansi' => 'required',
            'no_telp' => 'required|min:10|max:20',
            'email' => 'required|email|unique:instansi,email,' . $id, // Menghindari validasi unik untuk dirinya sendiri
        ], [
            'nama_instansi.required' => 'Nama Instansi wajib diisi.',
            'no_telp.required' => 'Nomor Telepon wajib diisi.',
            'no_telp.min' => 'nomor telepon tidak boleh lebih pendek dari 10 angka.',
            'no_telp.max' => 'nomor telepon tidak boleh lebih panjang dari 20 angka.',
            'email.required' => 'Alamat Email wajib diisi.',
            'email.email' => 'Alamat Email tidak valid.',
            'email.unique' => 'Alamat Email sudah digunakan.',
        ]);

        // Ambil data instansi yang akan diubah
        $instansi = Instansi::find($id);
        // Update data instansi
        $instansi->nama_instansi = $request->nama_instansi;
        $instansi->no_telp = $request->no_telp;
        $instansi->email = $request->email;
        $instansi->save();
        return redirect()->route('datainstansi.index')->with('success2', 'Data Instansi berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $instansi = Instansi::find($id);
        $instansi->delete();
        return redirect()->route('datainstansi.index');
    }

    // public function laporan_data()
    // {
    //     $instansi = DB::select("CALL tampilkan_data_innerjoin_instansi()");
    //     return view('instansi.laporan', compact('instansi'));
    // }
}
