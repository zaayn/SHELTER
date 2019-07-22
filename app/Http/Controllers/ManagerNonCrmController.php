<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Call;
use App\Keluhan;
use App\Visit;
use App\Kontrak;
use App\mou;
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
        // $data['mou'] = DB::table('mou')->count();
        return view('/manager_non_crm/dashboard_manager_non_crm',$data);
    }
   
    public function customer()
    {  
        $data['customers'] = customer::all();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_customer', $data);
    }
    public function kontrak()
    {  
        $data['kontrak'] = kontrak::all();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_kontrak', $data);
    }
    public function mou()
    {  
        $data['mou'] = mou::all();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_mou', $data);
    }
}
