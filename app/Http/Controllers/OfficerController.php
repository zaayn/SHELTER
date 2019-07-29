<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\datamou;

class OfficerController extends Controller
{
    public function index()
    {
        $data['calls'] = DB::table('call')->count();
        $data['kontraks'] = DB::table('kontrak')->count();   
        $data['visits'] = DB::table('visit')->count();   
        $data['keluhans'] = DB::table('keluhan')->count();   

        return view('/officer/dashboard_officer',$data);
    }
    public function mou(){
        $data['datamous'] = datamou::all();
        return view('officer/mou', $data);
    }
}
