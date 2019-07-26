<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $data['customer'] = DB::table('customer')->count();
        $data['kontrak'] = DB::table('kontrak')->count();        

        return view('/admin/dashboard_admin',$data);
    }
    // public function insertkontrak()
    // {
    //   return view('admin/admin_insertkontrak');
    // }
    public function superadmin()
    {
        $data['bisnis_unit'] = DB::table('bisnis_unit')->count();
        $data['wilayah'] = DB::table('wilayah')->count();
        $data['area'] = DB::table('area')->count();
        $data['users'] = DB::table('users')->count();

        return view('/admin/dashboard_superadmin',$data);
    }
}
