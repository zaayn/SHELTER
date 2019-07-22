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

class ManagerController extends Controller
{
    public function index()
    {
        $data['calls'] = DB::table('call')->count();
        $data['keluhan'] = DB::table('keluhan')->count();
        $data['visits'] = DB::table('visit')->count();
        $data['kontrak'] = DB::table('kontrak')->count();
        $data['customers'] = DB::table('customer')->count();
        // $data['mou'] = DB::table('mou')->count();
        return view('/manager_crm/dashboard_manager_crm',$data);
    }
    public function call()
    {  
        $data['calls'] = call::all();
        $data['no'] = 1;
        return view('manager_crm/manager_call', $data);
    }
    public function keluhan()
    {  
        $data['keluhan'] = keluhan::all();
        $data['no'] = 1;
        return view('manager_crm/manager_keluhan', $data);
    }
    public function visit()
    {  
        $data['visits'] = visit::all();
        $data['no'] = 1;
        return view('manager_crm/manager_visit', $data);
    }
    public function kontrak()
    {  
        $data['kontrak'] = kontrak::all();
        $data['no'] = 1;
        return view('manager_crm/manager_kontrak', $data);
    }
    public function mou()
    {  
        $data['mou'] = mou::all();
        $data['no'] = 1;
        return view('manager_crm/manager_mou', $data);
    }
    public function customer()
    {  
        $data['customers'] = customer::all();
        $data['no'] = 1;
        return view('manager_crm/manager_customer', $data);
    }
}
