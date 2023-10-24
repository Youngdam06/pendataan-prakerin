<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PenilaianController extends Controller
{
    //
    public function index()
    {
        // Mengambil data pembimbing yang sedang login
        $pembimbing = Auth::guard('pembimbing')->user();

        // Mengambil data siswa prakerin yang dibimbing oleh pembimbing yang login
        $penilaian = DB::select("CALL tampilkan_data_innerjoin_penilaian('{$pembimbing->id}')");
        
        return view('pembimbing.penilaian', compact('penilaian'));
        }
}
