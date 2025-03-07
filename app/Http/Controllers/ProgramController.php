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

class ProgramController extends Controller
{

    //Tampil Data
    public function view()
    {
        $program = DB::table('tb_program')
        ->get();
        return view('admin.program.view', compact('program'));

    }


   //Simpan Data
   public function store(Request $request)
   {

       $id_program=DB::table('tb_program')
       ->latest('id_program', 'DESC')
       ->first();

       $kodeobjek ="PR-";

       if($id_program == null){
           $nomorurut = "0001";
       }else{
           $nomorurut = substr($id_program->id_program, 3, 4) + 1;
           $nomorurut = str_pad($nomorurut, 4, "0", STR_PAD_LEFT);
       }
       $id=$kodeobjek.$nomorurut;

       $kode_program = $request->kode;
       $nama_program = $request->nama;

       $cekkode = DB::table('tb_program')
       ->where('kode_program', '=', $kode_program)
       ->count();
        if ($cekkode > 0) {
       return Redirect::back()->with(['warning' => 'Kode Program Sudah Digunakan']);
        }
       else {
       $data = [
           'id_program'     => $id,
           'kode_program'   => $kode_program,
           'nama_program'   => $nama_program,
           'status_program' => '1'
       ];
       $simpan = DB::table('tb_program')->insert($data);
       if ($simpan) {
           return Redirect('/admin/program')->with(['success' => 'Data Berhasil Disimpan.']);
       } else {
           return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
       }
     }
   }

    //Edit Data
    public function edit(Request $request)
    {
        $id_program = $request->id_program;
        $id         = Crypt::decrypt($id_program);

        $program = DB::table('tb_program')
        ->where('id_program', $id)
        ->first();

        return view('admin.program.edit', compact('id_program', 'program'));
    }


    //Update Data
    public function update($id_program, Request $request)
    {
        $id_program   = Crypt::decrypt($id_program);
        $kode_program = $request->kode;
        $kode_baru = $request->kode_baru;
        $nama_program = $request->nama;

        $cekkode = DB::table('tb_program')
        ->where('kode_program', $kode_baru)
        ->where('kode_program', '!=', $kode_program)
        ->count();
         if ($cekkode > 0) {
        return Redirect::back()->with(['warning' => 'Kode Program Sudah Digunakan.']);
         }
        try {

             $data = [
                 'kode_program' => $kode_program,
                 'nama_program' => $nama_program,

             ];

             $update = DB::table('tb_program')->where('id_program', $id_program)->update($data);
             return redirect('admin/program/')->with(['success' => 'Data Berhasil Diubah.']);
             } catch (\Exception $e) {
             return Redirect::back()->with(['warning' => 'Data Gagal Diubah.']);
        }
    }


    //Status Data
    public function status($id_program)
    {
        $id_program   = Crypt::decrypt($id_program);

        $program = DB::table('tb_program')
        ->where('id_program', $id_program)
        ->first();

        $status = $program->status_program;

        $aktif = [
            'status_program' => '1',
        ];

        $nonaktif = [
            'status_program' => '0',
        ];

        if($status == '0'){
            $update = DB::table('tb_program')->where('id_program', $id_program)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_program')->where('id_program', $id_program)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }




}
