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
use App\Bisnis_Unit;
use App\Area;

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

      
        return view('/manager_non_crm/dashboard_manager_non_crm', $data);
    }
   
    public function customer()
    {  
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_customer', $data);
    }
    public function filter(Request $request)
    {
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $customers = Customer::all();
        if($request->bu_id)
            $customers = $customers->where('bu_id', $request->bu_id);
        if($request->area_id)
            $customers = $customers->where('area_id', $request->area_id);
        $data['customers'] = $customers;
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_customer', $data);
    }
    public function kontrak()
    {  
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['kontraks'] = Kontrak::all();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_kontrak', $data);
    }
    public function filter_kontrak_noncrm(Request $request)
    {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();
        
        if($request->bu_id || $request->area_id){
            $kontraks = Kontrak::whereHas('customer', function($query) use($request){
            if($request->bu_id)
                $query->where('bu_id',$request->bu_id);

            if($request->area_id)
                $query->where('area_id',$request->area_id);
            });
        }
        $data['kontraks'] = $kontraks->get();
        return view('manager_non_crm/manager_non_crm_kontrak', $data);
    }
    public function mou()
    {  
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['datamous'] = DB::table('datamou')
        ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
        ->join('customer','customer.kode_customer','=','kontrak.kode_customer')
        ->get();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_mou', $data);
    }
    public function filter_mou(Request $request)
    {
        if($request->bu_id && $request->area_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->where('area.area_id', '=', $request->area_id)
            ->get();
            return view('manager_non_crm/manager_non_crm_mou', $data);
        }
        if($request->bu_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->get();
            return view('manager_non_crm/manager_non_crm_mou', $data);
        }
        if($request->area_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('area.area_id', '=', $request->area_id)
            ->get();
            return view('manager_non_crm/manager_non_crm_mou', $data);
        }
    }
}
