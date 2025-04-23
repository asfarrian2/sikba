<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function view(){

        return view('admin.dashboard.view');
    }

    public function dashboard_2(){

        return view('operator2.dashboard.view');
    }
}
