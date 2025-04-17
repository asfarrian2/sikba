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

class SubkegiatanController extends Controller
{
    //Tampil Data
    public function view($id_keg)
    {

        $id_keg = Crypt::decrypt($id_keg);

        $kegiatan = DB::table('tb_kegiatan')
        ->where('id_keg', $id_keg)
        ->first();

        $view = DB::table('tb_subkeg')
        ->where('id_keg', $id_keg)
        ->get();

        return view('admin.kegiatan.sub.view', compact('view', 'kegiatan'));

    }

   //Simpan Data
   public function store(Request $request)
   {

       $id_subkeg=DB::table('tb_subkeg')
       ->latest('id_subkeg', 'DESC')
       ->first();

       $kodeobjek ="SK-";

       if($id_subkeg == null){
           $nomorurut = "00001";
       }else{
           $nomorurut = substr($id_subkeg->id_subkeg, 3, 5) + 1;
           $nomorurut = str_pad($nomorurut, 5, "0", STR_PAD_LEFT);
       }
       $id=$kodeobjek.$nomorurut;

       $kode_subkeg   = $request->kode;
       $nama_subkeg   = $request->nama;
       $id_keg        = $request->kegiatan;

       $cekkode = DB::table('tb_subkeg')
       ->where('kode_subkeg', '=', $kode_subkeg)
       ->count();
        if ($cekkode > 0) {
       return Redirect::back()->with(['warning' => 'Kode Sub Kegiatan Sudah Digunakan']);
        }
       else {
       $data = [
           'id_subkeg'     => $id,
           'kode_subkeg'   => $kode_subkeg,
           'nama_subkeg'   => $nama_subkeg,
           'id_keg'        => $id_keg,
           'status_subkeg' => '1'
       ];
       $simpan = DB::table('tb_subkeg')->insert($data);
       if ($simpan) {
           return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
       } else {
           return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
       }
     }
   }

    //Edit Data
    public function edit(Request $request)
    {
        $id_subkeg  = $request->id_subkeg;
        $id         = Crypt::decrypt($id_subkeg);

        $subkeg = DB::table('tb_subkeg')
        ->where('id_subkeg', $id)
        ->first();

        return view('admin.kegiatan.sub.edit', compact('subkeg'));
    }

    //Update Data
    public function update($id_subkeg, Request $request)
    {
        $id_subkeg   = Crypt::decrypt($id_subkeg);
        $kode_keg = $request->kode;
        $kode_baru = $request->kode_baru;
        $nama_subkeg = $request->nama;

        $cekkode = DB::table('tb_subkeg')
        ->where('kode_subkeg', $kode_baru)
        ->where('kode_subkeg', '!=', $kode_keg)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Kode Sub Kegiatan Sudah Digunakan.']);
         }
        try {

             $data = [
                 'kode_subkeg' => $kode_baru,
                 'nama_subkeg' => $nama_subkeg

             ];

             $update = DB::table('tb_subkeg')->where('id_subkeg', $id_subkeg)->update($data);
             return Redirect::back()->with('admin/kegiatan/')->with(['success' => 'Data Berhasil Diubah.']);
             } catch (\Exception $e) {
             return Redirect::back()->with(['warning' => 'Data Gagal Diubah.']);
        }
    }



}
