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


}
