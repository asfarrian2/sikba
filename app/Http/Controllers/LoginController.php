<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    //Login Admin
    public function login_admin(Request $request) {
        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect('/admin/dashboard');
        } else {
            return back()->with->with(['warning' => 'Username / Password Salah']);
        }
    }

    public function admin_proses(Request $request){

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
            $tahun      = $request->tahun;
            $username   = $request->email;

            $data = [
                'id_tahun' => $tahun
            ];

            DB::table('users')->where('email', $username)->update($data);
            return redirect('/admin/dashboardAll');
        } else {
            return redirect('/ctr_admin')->with(['warning' => 'Username / Password Salah']);
        }

    }

        //login operator
        public function operator(){

            return view('auth.log-operator');

        }

    //Login Operator Penganggaran
    public function operator_proses(Request $request){
        // Jika yg Login Penganggaran
        $jenis_opt = $request->jenis;
        if ($jenis_opt < 2){
            if (Auth::guard('operator1')->attempt(['username' => $request->email, 'password' => $request->password, 'jenis_opt' => $request->jenis])) {
                $tahun      = $request->tahun;
                $username   = $request->email;

                $data = [
                    'ta' => $tahun
                ];

                DB::table('tb_operator')->where('username', $username)->update($data);

                return redirect('/opt1/dashboard');
            } else {
                return redirect('/')->with(['warning' => 'Username / Password Salah']);
            }
            }else{
                if (Auth::guard('operator2')->attempt(['username' => $request->email, 'password' => $request->password, 'jenis_opt' => $request->jenis])) {
                    $tahun      = $request->tahun;
                    $username   = $request->email;

                    $data = [
                        'ta' => $tahun
                    ];

                    DB::table('tb_operator')->where('username', $username)->update($data);

                    return redirect('/opt2/dashboard');
                } else {
                    return redirect('/')->with(['warning' => 'Username / Password Salah']);
            }
        }

    }


    public function logout(Request $request)
    {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
    }

}
