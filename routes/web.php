<?php

use App\Models\Instansi;
use App\Models\Pembimbing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginsController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\PembimbingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
// route sesi login dan logout
Route::get('/signin', [LoginsController::class, 'index']);
Route::get('/signup', [LoginsController::class, 'indexReg']);
Route::post('/post', [LoginsController::class, 'postLogin'])->name("postLog");
Route::post('/storeReg', [LoginsController::class, 'store'])->name("postReg");
Route::get('/', function() {
    return view('/maindash');
});
Route::get('/logout', [LoginsController::class, 'logout']);

// sesi kelola data instansi
// Route::get('/instansi', [InstansiController::class, 'index']);
// Route::post('/storeInstansi', [InstansiController::class, 'store'])->name('storeInstansi');
// Route::get('/tambahInstansi', [InstansiController::class, 'create'])->name('Instansi');
route::resource('datainstansi', InstansiController::class);
route::resource('datapembimbing', PembimbingController::class);

