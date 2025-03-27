<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class KegiatanController extends Controller
{
    //Tampil Data
    public function view()
    {
        $kegiatan = DB::table('tb_kegiatan')
        ->get();
        return view('admin.kegiatan.view', compact('kegiatan'));

    }




}
