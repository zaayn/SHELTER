<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Call;
use App\Keluhan;
use App\Visit;
use App\Kontrak;
use App\datamou;
use App\Customer;

class ManagerNonCrmController extends Controller
{
    public function index()
    {
        $data['calls'] = DB::table('call')->count();
        $data['keluhan'] = DB::table('keluhan')->count();
        $data['visits'] = DB::table('visit')->count();
        $data['kontrak'] = DB::table('kontrak')->count();
        $data['customers'] = DB::table('customer')->count();
        $data['datamous'] = DB::table('datamou')->count();

        $lastUser = DB::table('users')
                    ->select('username')
                    ->orderBy('current_login_at','desc')
                    ->skip(1)->first();
        return view('/manager_non_crm/dashboard_manager_non_crm')->with($data)->with('lastUser',$lastUser);
    }
   
    public function customer()
    {  
        $data['customers'] = customer::all();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_customer', $data);
    }
    public function kontrak()
    {  
        $data['kontrak'] = DB::table('kontrak')
        ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
        ->get();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_kontrak', $data);
    }
    public function mou()
    {  
        $data['datamous'] = datamou::all();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_mou', $data);
    }
}
