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

class AnggaranController extends Controller
{
    //Get Select Kegiatan
    public function getkegiatan($id_program){
        $id_program   = Crypt::decrypt($id_program);
        $keg = DB::table('tb_kegiatan')
        ->where('status_keg', '1')
        ->where('id_program', $id_program)
        ->get();

        return response()->json($keg);
    }
    //

    //Get Select Objek SubKegiatan
    public function getsubkeg($id_keg){
        $subkeg = DB::table('tb_subkeg')
        ->where('status_subkeg', '1')
        ->where('id_keg', $id_keg)
        ->get();

        return response()->json($subkeg);
    }
    //


    public function view(Request $request){

    $ta         = Auth::guard('operator2')->user()->ta;
    $id_seksi   = Auth::guard('operator2')->user()->id_seksi;

    $program = DB::table('tb_program')
    ->where('status_program', '1')
    ->get();

    $filter = $request->SelectSubkegiatan;
    if ($filter) {

        $id_program = $request->selectProgram;
        $id_program = Crypt::decrypt($id_program);
        $id_keg     = $request->SelectKegiatan;


        $kegiatan = DB::table('tb_kegiatan')
        ->where('status_keg', '1')
        ->where('id_program', $id_program)
        ->get();

        $subkeg = DB::table('tb_subkeg')
        ->where('status_subkeg', '1')
        ->where('id_keg', $id_keg)
        ->get();

        $view = DB::table('tb_anggaran')
        ->leftJoin('tb_koderekening', 'tb_anggaran.id_koderekening', '=', 'tb_koderekening.id_koderekening')
        ->leftJoin('tb_ranggaran', 'tb_anggaran.id_anggaran', '=', 'tb_ranggaran.id_anggaran')
        ->select('tb_anggaran.*', 'tb_koderekening.kode_rekening', 'tb_koderekening.nama_rekening',  DB::raw('SUM(tb_ranggaran.pagu_ranggaran) as total_ranggaran') )
        ->where('id_subkeg', $filter)
        ->where('id_seksi', $id_seksi)
        ->where('ta', $ta)
        ->groupBy('tb_anggaran.id_anggaran')
        ->get();

        $rincian = DB::table('tb_ranggaran')
        ->get();

        $koderekening = DB::table('tb_koderekening')
        ->where('status_rekening', '1')
        ->get();

        }else{
            $view=[];
            $kegiatan=[];
            $subkeg=[];
            $koderekening=[];
            $rincian=[];
        }

    return view('operator2.anggaran.view', compact('program', 'view', 'rincian', 'koderekening', 'kegiatan', 'subkeg'));
    }

    public function koderekening(Request $request){

        $operator=DB::table('tb_anggaran')
        ->latest('id_anggaran', 'DESC')
        ->first();

        $kodeobjek ="ANG-";

        if($operator == null){
            $nomorurut = "0001";
        }else{
            $nomorurut = substr($operator->id_anggaran, 4, 4) + 1;
            $nomorurut = str_pad($nomorurut, 4, "0", STR_PAD_LEFT);
        }
        $id=$kodeobjek.$nomorurut;

        $id_koderekening = $request->koderekening;
        $id_subkeg       = $request->subkeg;
        $ta         = Auth::guard('operator2')->user()->ta;
        $id_seksi   = Auth::guard('operator2')->user()->id_seksi;

        $data = [
            'id_anggaran'    => $id,
            'id_koderekening'=> $id_koderekening,
            'id_subkeg'      => $id_subkeg,
            'id_seksi'       => $id_seksi,
            'ta'             => $ta
        ];
        $simpan = DB::table('tb_anggaran')->insert($data);
        if ($simpan) {
            return Redirect::back()->with(['success' => 'Data Berhasil Disimpan.']);
        } else {
            return Redirect::back()->with(['warning' => 'Data Gagal Disimpan.']);
        }

    }

    //Hapus Data
     public function hapus($id_anggaran)
     {
         $id_anggaran   = Crypt::decrypt($id_anggaran);

         $ranggaran = DB::table('tb_ranggaran')
         ->where('id_anggaran', $id_anggaran)
         ->count();

         if($ranggaran == 0){
             $update = DB::table('tb_anggaran')->where('id_anggaran', $id_anggaran)->delete();
                 return Redirect::back()->with(['success' => 'Data Berhasil Dihapus.']);
             } else {
                 return Redirect::back()->with(['warning' => 'Data Gagal Dihapus.']);
             }

     }




}
