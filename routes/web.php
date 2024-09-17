<?php

use App\Http\Controllers\BarangAPIController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\DashboardController;
use App\Models\BarangKeluar;

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

Route::get('/', function () {
    return to_route('dashboard');
});


Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::resource('barang',BarangController::class);
Route::resource('barang-masuk',BarangMasukController::class);
Route::resource('barang-keluar',BarangKeluarController::class);
// Route::resource('barang',BarangController::class);


Route::post('barang-detail/{id}', [BarangAPIController::class, 'detail']);
