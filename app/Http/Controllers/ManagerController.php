<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Call;
use App\Keluhan;
use App\Visit;
use App\Kontrak;
use App\Datamou;
use App\Customer;

class ManagerController extends Controller
{
    public function index()
    {
        $data['calls'] = DB::table('call')->count();
        $data['keluhan'] = DB::table('keluhan')->count();
        $data['visits'] = DB::table('visit')->count();
        $data['kontrak'] = DB::table('kontrak')->count();
        $data['customers'] = DB::table('customer')->count();
        $data['datamous'] = DB::table('datamou')->count();

        
        return view('/manager_crm/dashboard_manager_crm', $data);
    }
    public function call()
    {  
        $data['calls'] = Call::all();
        $data['no'] = 1;
        return view('manager_crm/manager_call', $data);
    }
    public function keluhan()
    {  
        $data['keluhan'] = Keluhan::all();
        $data['no'] = 1;
        return view('manager_crm/manager_keluhan', $data);
    }
    public function visit()
    {  
        $data['visits'] = Visit::all();
        $data['no'] = 1;
        return view('manager_crm/manager_visit', $data);
    }
    public function kontrak()
    {  
        $data['kontrak'] = Kontrak::all();
        $data['no'] = 1;
        return view('manager_crm/manager_kontrak', $data);
    }
    public function mou()
    {  
        $data['datamous'] = Datamou::all();
        $data['no'] = 1;
        return view('manager_crm/manager_mou', $data);
    }
    public function customer()
    {  
        $data['customers'] = Customer::all();
        $data['no'] = 1;
        return view('manager_crm/manager_customer', $data);
    }
}
