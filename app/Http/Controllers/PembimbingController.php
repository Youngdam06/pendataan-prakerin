<?php

namespace App\Http\Controllers;

use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembimbingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // call store procedure untuk menampilkan data pembimbing
        $pembimbing = DB::select("CALL tampilkan_data_pembimbing()");
        return view('pembimbing.dash', compact('pembimbing'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pembimbing.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validasi request input yang akan disimpan
        $request->validate([
            'nik' => 'required|numeric|unique:pembimbing,nik',
            'nama_pembimbing' => 'required',
            'no_telp' =>'required',
            'email' => 'required|email|unique:pembimbing,email'
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nama_pembimbing.required' => 'Nama pembimbing wajib diisi.',
            'no_telp.required' => 'nomor telepon wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah ada.',
        ]);

        // simpan data jika berhasil
        Pembimbing::create($request->all());
        // lempar ke form pembimbing
        return redirect()->route('datapembimbing.index')->with('success', 'Data pembimbing berhasil ditambah!');
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
        $pembimbing = Pembimbing::firstWhere('id', $id);
        return view('pembimbing/edit', compact('pembimbing'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nik' => 'required|numeric|unique:pembimbing,nik,' . $id, // Menghindari validasi unik untuk dirinya sendiri
            'nama_pembimbing' => 'required',
            'no_telp' =>'required',
            'email' => 'required|email|unique:pembimbing,email,' . $id // Menghindari validasi unik untuk dirinya sendiri
        ], [
            'nik.required' => 'NIK wajib diisi.',
            'nama_pembimbing.required' => 'Nama pembimbing wajib diisi.',
            'no_telp.required' => 'nomor telepon wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah ada.',
        ]);

        $pembimbing = Pembimbing::find($id);
        $pembimbing->nik = $request->nik;
        $pembimbing->nama_pembimbing = $request->nama_pembimbing;
        $pembimbing->no_telp = $request->no_telp;
        $pembimbing->email = $request->email;
        $pembimbing->save();
        return redirect()->route('datapembimbing.index')->with('success2', 'Data pembimbing berhasil diubah!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pembimbing = Pembimbing::find($id);
        $pembimbing->delete();
        return redirect()->route('datapembimbing.index');
    }

    public function laporan_data()
    {
        $pembimbing = DB::select("CALL tampilkan_data_innerjoin_pembimbing()");
        return view('pembimbing.laporan', compact('pembimbing'));
    }
}
