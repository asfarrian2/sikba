<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Psy\Command\WhereamiCommand;

class DashboardController extends Controller
{
    public function view(){

        return view('admin.dashboard.view');
    }

    public function dashboard_2(){
        $id_seksi = Auth::guard('operator2')->user()->id_seksi;
        $ta       = Auth::guard('operator2')->user()->ta;

        $profil = DB::table('tb_seksi')
        ->where('id_seksi', $id_seksi)
        ->first();

        $anggaran = DB::table('tb_ranggaran')
        ->leftJoin('tb_anggaran', 'tb_ranggaran.id_anggaran', '=', 'tb_anggaran.id_anggaran')
        ->select('tb_ranggaran.*', 'tb_anggaran.id_anggaran', 'tb_anggaran.ta', 'tb_anggaran.id_seksi')
        ->where('tb_anggaran.ta', $ta)
        ->where('tb_anggaran.id_seksi', $id_seksi)
        ->sum('pagu_ranggaran');

        return view('operator2.dashboard.view', compact('profil', 'anggaran'));
    }
}
