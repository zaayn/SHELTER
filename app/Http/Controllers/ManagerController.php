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
        $data['calls'] = DB::table('call')
        ->join('customer', 'call.kode_customer', '=', 'customer.kode_customer')
        ->get();
        $data['no'] = 1;
        return view('manager_crm/manager_call', $data);
    }
    public function keluhan()
    {  
        $data['keluhan'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->select('id_keluhan','customer.kode_customer','customer.nama_perusahaan','keluhan.kode_customer','spv_pic','tanggal_keluhan','jam_keluhan','keluhan','pic','jam_follow','follow_up','closing_case','via','keluhan.status')
        ->get();
        $data['no'] = 1;
        return view('manager_crm/manager_keluhan', $data);
    }
    public function visit()
    {  
        $data['visits'] = DB::table('visit')
        ->join('customer', 'visit.kode_customer', '=', 'customer.kode_customer')
        ->select('customer.kode_customer','visit.kode_customer','visit_id','customer.nama_perusahaan','spv_pic','tanggal_visit','waktu_in','waktu_out','pic_meeted','kegiatan')
        ->get();
        $data['no'] = 1;
        return view('manager_crm/manager_visit', $data);
    }
    public function kontrak()
    {  
        $data['kontrak'] = DB::table('kontrak')
        ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
        ->get();
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
