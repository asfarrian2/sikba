<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TahunController;
use App\Http\Controllers\SeksiController;
use App\Http\Controllers\KoderekeningController;
use App\Http\Controllers\OperatorController;
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\KegiatanController;
use App\Http\Controllers\SubkegiatanController;
use App\Http\Controllers\AnggaranController;
use App\Http\Controllers\RanggaranController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

Route::get('/admin', function () {
    return view('auth.log-admin');
});

//proses login admin
Route::post('/login_admin', [LoginController::class, 'login_admin']);
Route::get('/logout', [LoginController::class, 'logout']);

//Level Akun Admin

Route::middleware('auth:admin')->group(function () {
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
Route::get('/admin/program/{id_program}/hapus', [ProgramController::class, 'hapus']);

//Crud Kegiatan
Route::get('/admin/kegiatan', [KegiatanController::class, 'view']);
Route::post('/admin/kegiatan/store', [KegiatanController::class, 'store']);
Route::post('/admin/kegiatan/edit', [KegiatanController::class, 'edit']);
Route::post('/admin/kegiatan/{id_keg}/update', [KegiatanController::class, 'update']);
Route::get('/admin/kegiatan/{id_keg}/status', [KegiatanController::class, 'status']);
Route::get('/admin/kegiatan/{id_keg}/hapus', [KegiatanController::class, 'hapus']);

//Crud Sub Keg
Route::get('/admin/kegiatan/sub{id_keg}', [SubkegiatanController::class, 'view']);
Route::post('/admin/subkeg/store', [SubkegiatanController::class, 'store']);
Route::post('/admin/subkeg/edit', [SubkegiatanController::class, 'edit']);
Route::post('/admin/subkeg/{id_subkeg}/update', [SubkegiatanController::class, 'update']);

});


//<!------------------- CRUD OPERTOR PENGANGGARAN --------------------->
//proses login
Route::get('/', [LoginController::class, 'operator']);
Route::post('/login_operator', [LoginController::class, 'operator_proses']);

Route::middleware('auth:operator2')->group(function () {
//dashboard
Route::get('/opt2/dashboard', [DashboardController::class, 'dashboard_2']);

//anggaran
Route::get('/opt2/anggaran', [AnggaranController::class, 'view']);
Route::get('/opt2/filterkeg/{id_program}', [AnggaranController::class, 'getkegiatan']);
Route::get('/opt2/filtersub/{id_keg}', [AnggaranController::class, 'getsubkeg']);
Route::post('/opt2/koderekening/store', [AnggaranController::class, 'koderekening']);
Route::get('/opt2/anggaran/{id_anggaran}/hapus', [AnggaranController::class, 'hapus']);

Route::post('/opt2/ranggaran/tambah', [RanggaranController::class, 'tambah']);
Route::post('/opt2/ranggaran/store', [RanggaranController::class, 'store']);
Route::post('/opt2/ranggaran/edit', [RanggaranController::class, 'edit']);
Route::post('/opt2/ranggaran/{id_ranggaran}/update', [RanggaranController::class, 'update']);
Route::get('/opt2/ranggaran/{id_ranggaran}/hapus', [RanggaranController::class, 'hapus']);


});
