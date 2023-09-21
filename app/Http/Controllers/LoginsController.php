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
        $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required',
        ], [
            'email.required' => 'Email wajib diisi!',
            'password.required' => 'Password wajib diisi!',
        ]);

        $info = [
            'email'=> $request->email,
            'password'=> $request->password,
        ];

        if(Auth::guard('admin')->attempt($info)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }else{
            return redirect('signin');
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
            'email' => 'required',
            'password' => 'required'
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
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('signin');
    }
}
