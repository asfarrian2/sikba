<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Psy\Command\WhereamiCommand;

class KoderekeningController extends Controller
{
    //Tampil Data
    public function view()
    {
        $koderekening = DB::table('tb_koderekening')
        ->get();
        return view('admin.koderekening.view', compact('koderekening'));

    }

   //Simpan Data
   public function store(Request $request)
   {

       $id_koderekening=DB::table('tb_koderekening')
       ->latest('id_koderekening', 'DESC')
       ->first();

       $kodeobjek ="KR-";

       if($id_koderekening == null){
           $nomorurut = "0001";
       }else{
           $nomorurut = substr($id_koderekening->id_koderekening, 3, 4) + 1;
           $nomorurut = str_pad($nomorurut, 4, "0", STR_PAD_LEFT);
       }
       $id=$kodeobjek.$nomorurut;

       $kode_rekening = $request->kode_rekening;
       $nama_rekening = $request->nama_rekening;

       $data = [
           'id_koderekening'     => $id,
           'kode_rekening'       => $kode_rekening,
           'nama_rekening'       => $nama_rekening,
           'status_rekening'     => '1'
       ];
       $simpan = DB::table('tb_koderekening')->insert($data);
       if ($simpan) {
           return Redirect('/admin/koderekening')->with(['success' => 'Data Berhasil Disimpan.']);
       } else {
           return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
       }
   }

    //Edit Data
    public function edit(Request $request)
    {
        $id_koderekening = $request->id_koderekening;
        $id              = Crypt::decrypt($id_koderekening);

        $koderekening = DB::table('tb_koderekening')
        ->where('id_koderekening', $id)
        ->first();

        return view('admin.koderekening.edit', compact('koderekening'));
    }

    //Update Data
    public function update($id_koderekening, Request $request)
    {
        $id = Crypt::decrypt($id_koderekening);
        $kode            = $request->kode;
        $nama            = $request->nama;

        $data = [
            'kode_rekening' => $kode,
            'nama_rekening' => $nama
        ];

        $update = DB::table('tb_koderekening')->where('id_koderekening', $id)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update.']);
        }
    }


}
