<?php

use App\Models\Instansi;
use App\Models\Pembimbing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LoginsController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\PrakerinController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\MaindashboardController;

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
Route::get('/', [MaindashboardController::class, 'index']);
Route::get('/logout', [LoginsController::class, 'logout']);

// routing kelola data instansi, pembimbing, siswa, dan prakerin.
route::resource('datainstansi', InstansiController::class);
route::resource('datapembimbing', PembimbingController::class);
route::resource('datasiswa', SiswaController::class);
route::resource('dataprakerin', PrakerinController::class);

// routing laporan data instansi, pembimbing, siswa, dan prakerin.
Route::get('datatabel', function () {
    return view('datatabel');
});