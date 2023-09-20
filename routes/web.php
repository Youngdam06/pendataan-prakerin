<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginsController;

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

Route::get('/signin', [LoginsController::class, 'index']);
Route::get('/signup', [LoginsController::class, 'indexReg']);
Route::post('/post', [LoginsController::class, 'postLogin'])->name("postLog");
Route::post('/storeReg', [LoginsController::class, 'store'])->name("postReg");
Route::get('/', function() {
return view('/layout');
});

