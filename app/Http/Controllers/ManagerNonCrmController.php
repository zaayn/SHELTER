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
use App\Wilayah;

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
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = bisnis_unit :: all();
        $data['customers'] = DB::table('customer')
        ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->get();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_customer', $data);
    }
    public function filter(Request $request)
    {
      if($request->bu_id && $request->wilayah_id)
      {
        $data['bisnis_units'] = bisnis_unit :: all();
        $data['wilayahs'] = Wilayah::all();
        $data['customers'] = DB::table('customer')
        ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->where('wilayah.wilayah_id', '=', $request->wilayah_id)->get();  
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_customer', $data);
      }
      if($request->wilayah_id)
      {
        $data['bisnis_units'] = bisnis_unit :: all();
        $data['wilayahs'] = Wilayah::all();
        $data['customers'] = DB::table('customer')
        ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('wilayah.wilayah_id', '=', $request->wilayah_id)->get();  
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_customer', $data);
      }
      if($request->bu_id)
      {
        $data['bisnis_units'] = bisnis_unit :: all();
        $data['wilayahs'] = Wilayah::all();
        $data['customers'] = DB::table('customer')
        ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->get();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_customer', $data);
      }
    }
    public function kontrak()
    {  
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = bisnis_unit :: all();
        $data['kontraks'] = DB::table('kontrak')
        ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
        ->get();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_kontrak', $data);
    }
    public function filter_kontrak_noncrm(Request $request)
    {
        if($request->bu_id && $request->wilayah_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
            ->orderBy('kontrak.id_kontrak','asc')
            ->get();
            return view('manager_non_crm/manager_non_crm_kontrak', $data);
        }
        if($request->bu_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            // $data['kontraks'] = Kontrak::all();
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->get();
            return view('manager_non_crm/manager_non_crm_kontrak', $data);
        }
        if($request->wilayah_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            // $data['kontraks'] = Kontrak::all();
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
            ->get();
            return view('manager_non_crm/manager_non_crm_kontrak', $data);
        }
    }
    public function mou()
    {  
        $data['datamous'] = Datamou::all();
        $data['no'] = 1;
        return view('manager_non_crm/manager_non_crm_mou', $data);
    }
}
