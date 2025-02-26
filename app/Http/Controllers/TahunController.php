<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

class TahunController extends Controller
{
    public function view()
    {
        $tahun = DB::table('tb_tahun')
        ->get();

        return view('admin.tahun.view', compact('tahun'));
    }

    public function store(Request $request)
    {

        $id_tahun=DB::table('tb_tahun')
        ->latest('id_thn', 'DESC')
        ->first();

        $kodeobjek ="TA-";

        if($id_tahun == null){
            $nomorurut = "001";
        }else{
            $nomorurut = substr($id_tahun->id_thn, 3, 3) + 1;
            $nomorurut = str_pad($nomorurut, 3, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $tahun = $request->tahun;

        $data = [
            'id_thn' => $id,
            'thn'    => $tahun,
        ];
        $simpan = DB::table('tb_tahun')->insert($data);
        if ($simpan) {
            return Redirect('/admin/tahun/view')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan']);
        }
    }


}
