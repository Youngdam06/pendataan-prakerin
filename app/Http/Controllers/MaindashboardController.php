<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Instansi;
use App\Models\Prakerin;
use App\Models\Pembimbing;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaindashboardController extends Controller
{
    public function index() 
    {
        // menghitung data instansi
        $instansi = Instansi::count();
        // menghitung data siswa
        $siswa = Siswa::count();
        // menghitung data pembimbing
        $pembimbing = Pembimbing::count();
        // menghitung data siswa yang prakerin
        $prakerin = Prakerin::count();
        $prakerin1 = DB::select("CALL tampilkan_data_innerjoin_prakerinn()");
        return view('maindash', compact('instansi', 'siswa', 'pembimbing', 'prakerin', 'prakerin1'));
    }
}
