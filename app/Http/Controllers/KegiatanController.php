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

class KegiatanController extends Controller
{
    //Tampil Data
    public function view(Request $request)
    {
        $filter = $request->filter;
        //Data Select
        $program = DB::table('tb_program')
        ->get();

        $id_program = DB::table('tb_program')
        ->where('status_program', '1')
        ->get();

        //Data Utama
        if ($filter) {
        $terapkan = Crypt::decrypt($filter);
        $view = DB::table('tb_kegiatan')
        ->where('id_program',$terapkan)
        ->orderby('kode_keg', 'ASC')
        ->get();

        }else{
            $view = [];
        }

        return view('admin.kegiatan.view', compact('view', 'program', 'id_program'));

    }

    //Simpan Data
   public function store(Request $request)
   {

       $id_keg=DB::table('tb_kegiatan')
       ->latest('id_keg', 'DESC')
       ->first();

       $kodeobjek ="KG-";

       if($id_keg == null){
           $nomorurut = "00001";
       }else{
           $nomorurut = substr($id_keg->id_keg, 3, 5) + 1;
           $nomorurut = str_pad($nomorurut, 5, "0", STR_PAD_LEFT);
       }
       $id=$kodeobjek.$nomorurut;

       $kode_kegiatan = $request->kode;
       $nama_kegiatan = $request->nama;
       $id_program    = $request->id_program;

       $cekkode = DB::table('tb_kegiatan')
       ->where('kode_keg', '=', $kode_kegiatan)
       ->count();
        if ($cekkode > 0) {
       return Redirect::back()->with(['warning' => 'Kode Kegiatan Sudah Digunakan']);
        }
       else {
       $data = [
           'id_keg'     => $id,
           'kode_keg'   => $kode_kegiatan,
           'nama_keg'   => $nama_kegiatan,
           'id_program' => $id_program,
           'status_keg' => '1'
       ];
       $simpan = DB::table('tb_kegiatan')->insert($data);
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
        $id_keg     = $request->id_keg;
        $id         = Crypt::decrypt($id_keg);
        $id_program = DB::table('tb_program')
        ->where('status_program', '1')
        ->get();

        $kegiatan = DB::table('tb_kegiatan')
        ->where('id_keg', $id)
        ->first();

        return view('admin.kegiatan.edit', compact('kegiatan', 'id_program'));
    }


    //Update Data
    public function update($id_keg, Request $request)
    {
        $id_keg   = Crypt::decrypt($id_keg);
        $kode_keg = $request->kode;
        $kode_baru = $request->kode_baru;
        $nama_keg = $request->nama;
        $id_program = $request->id_program;

        $cekkode = DB::table('tb_kegiatan')
        ->where('kode_keg', $kode_baru)
        ->where('kode_keg', '!=', $kode_keg)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Kode Kegiatan Sudah Digunakan.']);
         }
        try {

             $data = [
                 'kode_keg' => $kode_baru,
                 'nama_keg' => $nama_keg,
                 'id_program' => $id_program

             ];

             $update = DB::table('tb_kegiatan')->where('id_keg', $id_keg)->update($data);
             return Redirect::back()->with('admin/kegiatan/')->with(['success' => 'Data Berhasil Diubah.']);
             } catch (\Exception $e) {
             return Redirect::back()->with(['warning' => 'Data Gagal Diubah.']);
        }
    }


    //Status Data
    public function status($id_keg)
    {
        $id_kegiatan   = Crypt::decrypt($id_keg);

        $kegiatan = DB::table('tb_kegiatan')
        ->where('id_keg', $id_kegiatan)
        ->first();

        $status = $kegiatan->status_keg;

        $aktif = [
            'status_keg' => '1',
        ];

        $nonaktif = [
            'status_keg' => '0',
        ];

        if($status == '0'){
            $update = DB::table('tb_kegiatan')->where('id_keg', $id_kegiatan)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_kegiatan')->where('id_keg', $id_kegiatan)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }

    //Hapus Data
     public function hapus($id_keg)
     {
         $id_keg   = Crypt::decrypt($id_keg);

         $subkeg = DB::table('tb_subkeg')
         ->where('id_keg', $id_keg)
         ->count();

         if($subkeg == 0){
             $update = DB::table('tb_kegiatan')->where('id_keg', $id_keg)->delete();
                 return Redirect::back()->with(['success' => 'Data Berhasil Dihapus.']);
             } else {
                 return Redirect::back()->with(['warning' => 'Data Gagal Dihapus.']);
             }

     }




}
