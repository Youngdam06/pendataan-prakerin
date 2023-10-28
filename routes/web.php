<?php

use App\Models\Instansi;
use App\Models\Prakerin;
use App\Models\Pembimbing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\LoginPController;
use App\Http\Controllers\LoginsController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\PrakerinController;
use App\Http\Controllers\PenilaianController;
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
// route sesi register, login dan logout admin
Route::get('/signin-admin', [LoginsController::class, 'index'])->name('signin');
Route::get('/signup', [LoginsController::class, 'indexReg']);
Route::post('/post', [LoginsController::class, 'postLogin'])->name("postLog");
Route::post('/storeReg', [LoginsController::class, 'store'])->name("postReg");
Route::get('/logout', [LoginsController::class, 'logout'])->name('logout');
// route sesi login dan logout pembimbing
Route::get('/signin-pembimbing', [LoginPController::class, 'index']);
Route::post('/post-pembimbing', [LoginPController::class, 'postLogin'])->name('postPemb');
Route::get('/logoutP', [LoginPController::class, 'logout'])->name('logout');

// routing middleware untuk guard admin dan pembimbing
Route::middleware(['auth:admin,pembimbing'])->group(function() {
    Route::get('/', [MaindashboardController::class, 'index']);
    // routing kelola data instansi, pembimbing, siswa, dan prakerin.
    route::resource('datainstansi', InstansiController::class);
    route::resource('datapembimbing', PembimbingController::class);
    route::resource('datasiswa', SiswaController::class);
    route::resource('dataprakerin', PrakerinController::class);
    
    // routing laporan data instansi, pembimbing, siswa, dan prakerin.
    route::get('laporan-data-siswa', [SiswaController::class, 'laporan_data'])->name('laporansiswa');
    route::get('laporan-data-pembimbing', [PembimbingController::class, 'laporan_data'])->name('laporanpembimbing');
    route::get('laporan-data-instansi', [InstansiController::class, 'laporan_data'])->name('laporaninstansi');
    route::get('laporan-data-prakerin', [PrakerinController::class, 'laporan_data'])->name('laporanprakerin');

    // kelola penilaian siswa pembimbing
    route::get('nilai', [PenilaianController::class, 'index'])->name('indexNilai');
    route::get('create-nilai/{id}', [PenilaianController::class, 'create'])->name('createNilai');
    route::post('create-nilai-store/{id}', [PenilaianController::class, 'store'])->name('postNilai');
    route::get('laporan-nilai', [PenilaianController::class, 'laporanNilai'])->name('laporan-nilai');
    route::get('nilai/export/excel/{id}', [PenilaianController::class, 'export_nilai'])->name('exportNilai');
    route::post('/import-excel', [PenilaianController::class, 'import_nilai'])->name('importExcel');

});

// Route::middleware(['auth:pembimbing'])->group(function() {
//     Route::get('/', [MaindashboardController::class, 'index']);
//     // routing laporan data instansi, pembimbing, siswa, dan prakerin.
//     route::get('laporan-data-siswa', [SiswaController::class, 'laporan_data'])->name('laporansiswa');
//     route::get('laporan-data-pembimbing', [PembimbingController::class, 'laporan_data'])->name('laporanpembimbing');
//     route::get('laporan-data-instansi', [InstansiController::class, 'laporan_data'])->name('laporaninstansi');
//     route::get('laporan-data-prakerin', [PrakerinController::class, 'laporan_data'])->name('laporanprakerin');
// });



