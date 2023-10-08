<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MaindashboardController extends Controller
{
    public function index() 
    {
        return view('maindash');
    }
}
