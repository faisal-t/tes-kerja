<?php

use App\Http\Controllers\BarangController;
use App\Http\Controllers\JenisBarangController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('v1/jenis', JenisBarangController::class);
Route::resource('v1/barang', BarangController::class);
Route::resource('v1/transaksi', TransaksiController::class);
