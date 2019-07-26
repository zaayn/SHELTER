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
        return view('/officer/dashboard_officer');
    }
    public function mou(){
        $data['datamous'] = datamou::all();
        return view('officer/mou', $data);
    }
}
