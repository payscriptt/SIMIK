<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\BarangMasukController;
use App\Http\Controllers\BarangKeluarController;
use App\Http\Controllers\SupplierController;

Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/barang', [BarangController::class, 'index']);

Route::get('/barang_masuk', [BarangMasukController::class, 'index']);
Route::post('/barang_masuk', [BarangMasukController::class, 'store']);

Route::get('/barang_keluar', [BarangKeluarController::class, 'index']);

Route::get('/supplier/create', [SupplierController::class, 'create']);

Route::get('/supplier', [SupplierController::class, 'index']);