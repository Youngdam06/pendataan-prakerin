<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Instansi;
use App\Models\Prakerin;
use App\Models\Pembimbing;
use Illuminate\Http\Request;

class MaindashboardController extends Controller
{
    public function index() 
    {
        $instansi = Instansi::count();
        $siswa = Siswa::count();
        $pembimbing = Pembimbing::count();
        $prakerin = Prakerin::count();
        return view('maindash', compact('instansi', 'siswa', 'pembimbing', 'prakerin'));
    }
}
