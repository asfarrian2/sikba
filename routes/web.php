<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\SeksiController;
use App\Http\Controllers\KoderekeningController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\KegiatanController;
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
Route::get('/admin/koderekening/{id_koderekening}/status', [KoderekeningController::class, 'status']);

//Crud Operator
Route::get('/admin/operator', [OperatorController::class, 'view']);
Route::post('/admin/operator/store', [OperatorController::class, 'store']);
Route::post('/admin/operator/edit', [OperatorController::class, 'edit']);
Route::post('/admin/operator/{id_opt}/update', [OperatorController::class, 'update']);
Route::get('/admin/operator/{id_opt}/resetpassword', [OperatorController::class, 'reset']);
Route::get('/admin/operator/{id_opt}/status', [OperatorController::class, 'status']);

//Crud Program
Route::get('/admin/program', [ProgramController::class, 'view']);
Route::post('/admin/program/store', [ProgramController::class, 'store']);
Route::post('/admin/program/edit', [ProgramController::class, 'edit']);
Route::post('/admin/program/{id_program}/update', [ProgramController::class, 'update']);
Route::get('/admin/program/{id_program}/status', [ProgramController::class, 'status']);

//Crud Kegiatan
Route::get('/admin/kegiatan', [KegiatanController::class, 'view']);

