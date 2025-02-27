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

class SeksiController extends Controller
{
    //Tampil Data
    public function view()
    {
        $seksi = DB::table('tb_seksi')
        ->get();
        return view('admin.seksi.view', compact('seksi'));

    }

    //Simpan Data
    public function store(Request $request)
    {

        $id_seksi=DB::table('tb_seksi')
        ->latest('id_seksi', 'DESC')
        ->first();

        $kodeobjek ="SE-";

        if($id_seksi == null){
            $nomorurut = "001";
        }else{
            $nomorurut = substr($id_seksi->id_seksi, 3, 3) + 1;
            $nomorurut = str_pad($nomorurut, 3, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama_seksi = $request->nama_seksi;

        $data = [
            'id_seksi'        => $id,
            'nama_seksi'      => $nama_seksi,
            'status_seksi'    => '1'
        ];
        $simpan = DB::table('tb_seksi')->insert($data);
        if ($simpan) {
            return Redirect('/admin/seksi')->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }

    //Edit Data
    public function edit(Request $request)
    {
        $id_seksi = $request->id_seksi;
        $id = Crypt::decrypt($id_seksi);

        $seksi = DB::table('tb_seksi')
        ->where('id_seksi', $id)
        ->first();
        return view('admin.seksi.edit', compact('id_seksi','seksi'));

    }

    //Update Data
    public function update($id_seksi, Request $request)
    {
        $id_seksi   = Crypt::decrypt($id_seksi);
        $nama_seksi = $request->nama_seksi;

        $data = [
            'nama_seksi' => $nama_seksi,

        ];

        $update = DB::table('tb_seksi')->where('id_seksi', $id_seksi)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update.']);
        }
    }

    //Status Data
    public function status($id_seksi)
    {
        $id_seksi   = Crypt::decrypt($id_seksi);

        $seksi = DB::table('tb_seksi')
        ->where('id_seksi', $id_seksi)
        ->first();

        $status_seksi = $seksi->status_seksi;

        $aktif = [
            'status_seksi' => '1',
        ];

        $nonaktif = [
            'status_seksi' => '0',
        ];

        if($status_seksi == '0'){
            $update = DB::table('tb_seksi')->where('id_seksi', $id_seksi)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_seksi')->where('id_seksi', $id_seksi)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }



}
