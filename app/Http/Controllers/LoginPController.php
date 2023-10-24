<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginPController extends Controller
{
    public function index()
    {
        return view('logins');
    }

    public function postLogin(Request $request) {
        Session::flash('loginError', 'Gagal Sign in, periksa kembali email dan password anda!');
        Session::flash('loginBerhasil', 'Selamat datang!');
        $credentials = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
        // menggunakan guard admin yang sudah ditambahkan di auth.php
        if(Auth::guard('pembimbing')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }else{
            return redirect('/signin-pembimbing');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken(); 
        return redirect('signin-pembimbing');
    }
}
