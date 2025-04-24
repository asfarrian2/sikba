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

class RanggaranController extends Controller
{
    public function tambah(Request $request){
        $id_anggaran = $request->id_anggaran;

        return view('operator2.anggaran.rincian', compact('id_anggaran'));

    }

    public function store(Request $request){

        $id_anggaran = $request->anggaran;
        $id_anggaran = Crypt::decrypt($id_anggaran);

        $ranggaran=DB::table('tb_ranggaran')
        ->where('id_anggaran', $id_anggaran)
        ->latest('id_anggaran', 'DESC')
        ->first();

        $kodeobjek ="R-";

        if($ranggaran == null){
            $nomorurut = "0001";
        }else{
            $nomorurut = substr($ranggaran->id_ranggaran, 10, 4) + 1;
            $nomorurut = str_pad($nomorurut, 4, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$id_anggaran.$nomorurut;

        $nama          = $request->nama;
        $spesifikasi   = $request->spesifikasi;
        $pagu          = $request->pagu;
        $pagu          = str_replace('.','', $pagu);
        $koefesien     = $request->koefesien;
        $satuan        = $request->satuan;

        $data = [
            'id_ranggaran'          => $id,
            'nama_ranggaran'        => $nama,
            'spesifikasi_ranggaran' => $spesifikasi,
            'pagu_ranggaran'        => $pagu,
            'koefesien_ranggaran'   => $koefesien,
            'satuan_ranggaran'      => $satuan,
            'id_anggaran'           => $id_anggaran
        ];
        $simpan = DB::table('tb_ranggaran')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

        //Edit Data
    public function edit(Request $request)
    {
        $id_ranggaran = $request->id_ranggaran;
        $id           = Crypt::decrypt($id_ranggaran);

        $ranggaran = DB::table('tb_ranggaran')
        ->where('id_ranggaran', $id)
        ->first();

        return view('operator2.anggaran.editr', compact('id_ranggaran', 'ranggaran'));
    }


}
