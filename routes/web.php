<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TahunController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.log-admin');
});

//proses login admin
Route::post('/login_admin', [LoginController::class, 'login_admin']);
Route::get('/logout', [LoginController::class, 'logout']);

//Level Akun Admin
Route::get('/admin/dashboard', [DashboardController::class, 'view']);

//Crud Tahun Anggaran
Route::get('/admin/tahun/view', [TahunController::class, 'view']);
Route::post('/admin/tahun/store', [TahunController::class, 'store']);

