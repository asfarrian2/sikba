<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\SeksiController;
use App\Http\Controllers\KoderekeningController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.log-admin');
});

//proses login admin
Route::post('/login_admin', [LoginController::class, 'login_admin']);
Route::get('/logout', [LoginController::class, 'logout']);

//Level Akun Admin
Route::get('/admin/dashboard', [DashboardController::class, 'view']);

//Crud Seksi/Bidang
Route::get('/admin/seksi', [SeksiController::class, 'view']);
Route::post('/admin/seksi/store', [SeksiController::class, 'store']);
Route::post('/admin/seksi/edit', [SeksiController::class, 'edit']);
Route::post('/admin/seksi/{id_seksi}/update', [SeksiController::class, 'update']);
Route::get('/admin/seksi/{id_seksi}/status', [SeksiController::class, 'status']);

//Crud Kode Rekening
Route::get('/admin/koderekening', [KoderekeningController::class, 'view']);
Route::post('/admin/koderekening/store', [KoderekeningController::class, 'store']);
Route::post('/admin/koderekening/edit', [KoderekeningController::class, 'edit']);
Route::post('/admin/koderekening/{id_koderekening}/update', [KoderekeningController::class, 'update']);
