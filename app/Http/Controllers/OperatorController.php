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


class OperatorController extends Controller
{
    //Tampil Data
    public function view()
    {
        $view = DB::table('tb_operator')
        ->leftjoin('tb_seksi', 'tb_operator.id_seksi', '=', 'tb_seksi.id_seksi')
        ->get();

        $seksi = DB::table('tb_seksi')
        ->where('status_seksi', '1')
        ->get();

        return view('admin.operator.view', compact('view', 'seksi'));

    }

    //Simpan Data
    public function store(Request $request)
    {

        $operator=DB::table('tb_operator')
        ->latest('id_opt', 'DESC')
        ->first();

        $kodeobjek ="opt-";

        if($operator == null){
            $nomorurut = "001";
        }else{
            $nomorurut = substr($operator->id_opt, 4, 3) + 1;
            $nomorurut = str_pad($nomorurut, 3, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $nama        = $request->nama;
        $username    = $request->username;
        $password    = Hash::make($username.'2000');
        $seksi       = $request->seksi;

        $data = [
            'id_opt'      => $id,
            'nama_opt'    => $nama,
            'username'    => $username,
            'password'    => $password,
            'status_opt'  => '1',
            'id_seksi'    => $seksi
        ];
        $simpan = DB::table('tb_operator')->insert($data);
        if ($simpan) {
            return Redirect('/admin/operator')->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }
    }


    //Edit Data
    public function edit(Request $request)
    {
        $id_opt = $request->id_opt;
        $id = Crypt::decrypt($id_opt);

        $operator = DB::table('tb_operator')
        ->where('id_opt', $id)
        ->first();
        return view('admin.operator.edit', compact('id_opt','operator'));

    }

    //Update Data
    public function update($id_opt, Request $request)
    {
        $id_opt   = Crypt::decrypt($id_opt);

        $nama     = $request->nama;
        $username = $request->username;

        $data = [
            'nama_opt' => $nama,
            'username' => $username

        ];

        $update = DB::table('tb_operator')->where('id_opt', $id_opt)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Data Berhasil Di Update.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Di Update.']);
        }
    }

    //Status
    public function status($id_opt)
    {
        $id_opt   = Crypt::decrypt($id_opt);

        $operator = DB::table('tb_operator')
        ->where('id_opt', $id_opt)
        ->first();

        $status_opt    = $operator->status_opt;

        $aktif = [
            'status_opt' => '1',
        ];

        $nonaktif = [
            'status_opt' => '0',
        ];

        if($status_opt == '0'){
            $update = DB::table('tb_operator')->where('id_opt', $id_opt)->update($aktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Diaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Diaktifkan.']);
            }

        }else{
            $update = DB::table('tb_operator')->where('id_opt', $id_opt)->update($nonaktif);
            if ($update) {
                return Redirect::back()->with(['success' => 'Data Berhasil Dinonaktifkan.']);
            } else {
                return Redirect::back()->with(['warning' => 'Data Gagal Dinonaktifkan.']);
            }
        }

    }


    //Reset Password
    public function reset($id_opt)
    {
        $id_opt   = Crypt::decrypt($id_opt);

        $operator = DB::table('tb_operator')
        ->where('id_opt', $id_opt)
        ->first();

        $username    = $operator->username;

        $password    = Hash::make($username.'2000');

        $data = [
            'password' => $password
        ];

        $update = DB::table('tb_operator')->where('id_opt', $id_opt)->update($data);
        if ($update) {
            return Redirect::back()->with(['success' => 'Reset Password Berhasil.']);
        } else {
            return Redirect::back()->with(['warning' => 'Reset Password Gagal.']);
        }
    }




}
