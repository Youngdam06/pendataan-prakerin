<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginsController extends Controller
{
    //
    public function index()
    {
        return view('login');
    }

    public function postLogin(Request $request) {
        Session::flash('loginError', 'Gagal Sign in, periksa kembali email dan password anda!');
        Session::flash('loginBerhasil', 'Selamat datang!');
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        // menggunakan guard admin yang sudah ditambahkan di auth.php
        if(Auth::guard('admin')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }else{
            return redirect('/signin');
        }
    }

    public function indexReg()
    {
        return view('register');
    }

    public function store(Request $request) 
    {
        Session::flash('berhasil', 'Anda telah berhasil register!');
        // Validasi data yang dikirimkan oleh pengguna
        $validatedData = $request->validate([
            'nama' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email|unique:admin,email', // Menambahkan validasi unik untuk bidang email
            'password' => 'required',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'no_telp.required' => 'Nomor telepon wajib diisi.',
            'email.required' => 'Alamat email wajib diisi.',
            'email.email' => 'Alamat email tidak valid.',
            'email.unique' => 'Alamat email sudah digunakan.', // Pesan kustom jika email sudah ada dalam database
            'password.required' => 'Password wajib diisi.',
        ]);
        

        // Mengenkripsi password sebelum menyimpannya
        $validatedData['password'] = Hash::make($validatedData['password']);

        // Membuat admin baru dengan data yang sudah divalidasi
        Admin::create($validatedData);

        // Jika berhasil membuat admin, arahkan ke halaman signin
        return redirect('signin');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return view('logout'); // Gantilah 'logout' dengan tampilan logout Anda.

        // $response = response()->redirectToRoute('signin'); // Ganti 'signin' dengan rute halaman login Anda

        // // Set header untuk mengontrol cache
        // $response->header('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0');
        // $response->header('Pragma', 'no-cache');

        // return $response;
    }
}
