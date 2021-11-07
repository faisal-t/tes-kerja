<?php

use App\Http\Controllers\Web\BarangController;
use App\Http\Controllers\Web\JenisBarangController;
use App\Http\Controllers\Web\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/",[JenisBarangController::class,"index"]);
Route::prefix("admin")->name("admin.")->group( function(){
    Route::resource('jenis', JenisBarangController::class);
    Route::resource('barang', BarangController::class);
    Route::resource('transaksi', TransaksiController::class);
    Route::get('transaksis/detail',[TransaksiController::class,"transaksis"]);
});
