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
use App\Area;
use App\Bisnis_unit;

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
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['calls'] = DB::select('call call_officer_manager()');
        // $data['calls'] = DB::table('call');
        // ->join('customer', 'call.kode_customer', '=', 'customer.kode_customer')
        // ->join('users','users.nama_depan','=','customer','=','nama_depan')
        // ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        // ->get();
        $data['no'] = 1;
        return view('manager_crm/manager_call', $data);
    }
    public function filter_call(Request $request)
    {
        if($request->bu_id && $request->area_id)
        {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['calls'] = Call::all();
        $data['calls'] = DB::table('call')
        ->join('customer', 'call.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->where('area.area_id', '=', $request->area_id)
        ->get();

        return view('manager_crm/manager_call', $data);
      }
      elseif ($request->bu_id) {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['calls'] = Call::all();
        $data['calls'] = DB::table('call')
        ->join('customer', 'call.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->get();
        return view('manager_crm/manager_call', $data);

      } 
      elseif ($request->area_id) {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['calls'] = Call::all();
        $data['calls'] = DB::table('call')
        ->join('customer', 'call.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('area.area_id', '=', $request->area_id)
        ->get();
        return view('manager_crm/manager_call', $data);
      }
    }
    public function keluhan()
    {  
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::select('call keluhan_officer_manager()');
        // $data['keluhans'] = DB::table('keluhan')
        // ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        // ->join('users','users.nama_depan','=','customer','=','nama_depan')
        // ->get();
        $data['no'] = 1;
        return view('manager_crm/manager_keluhan', $data);
    }
    public function filter_keluhan(Request $request)
    {
      if($request->bu_id && $request->area_id)
      {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->where('area.area_id', '=', $request->area_id)
        ->get();

        return view('manager_crm/manager_keluhan', $data);
        
      }
      elseif($request->bu_id)
      {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->get();

        return view('manager_crm/manager_keluhan', $data);
        
      }
      elseif($request->area_id)
      {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('area.area_id', '=', $request->area_id)
        ->get();

        return view('manager_crm/manager_keluhan', $data);
        
      }
    }
    public function visit()
    {  
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['visits'] = DB::select('call visit_officer_manager()');
        // $data['visits'] = DB::table('visit')
        // ->join('customer', 'visit.kode_customer', '=', 'customer.kode_customer')
        // ->get();
        $data['no'] = 1;
        return view('manager_crm/manager_visit', $data);
    }
    public function filter_visit(Request $request)
    {
      if($request->bu_id && $request->area_id)
      {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['visits'] = DB::table('visit')
        ->join('customer', 'visit.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->where('area.area_id', '=', $request->area_id)
        ->get();

        return view('manager_crm/manager_visit', $data);
      }
      elseif($request->bu_id)
      {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['visits'] = DB::table('visit')
        ->join('customer', 'visit.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->get();

        return view('manager_crm/manager_visit', $data);
      }
      elseif($request->area_id)
      {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['visits'] = DB::table('visit')
        ->join('customer', 'visit.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('area.area_id', '=', $request->area_id)
        ->get();

        return view('manager_crm/manager_visit', $data);
      }
    }
    public function kontrak()
    {  
        // $data['kontrak'] = DB::table('kontrak')
        // ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
        // ->get();
        $data['kontrak'] = DB::select('call kontrak_officer_manager()');
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['no'] = 1;
        return view('manager_crm/manager_kontrak', $data);
    }
    public function filter_kontrak(Request $request)
    {
        if($request->bu_id && $request->area_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            
            $data['kontrak'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->where('area.area_id', '=', $request->area_id)
            ->orderBy('kontrak.id_kontrak','asc')
            ->get();
            return view('manager_crm/manager_kontrak', $data);
        }
        if($request->bu_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            // $data['kontraks'] = Kontrak::all();
            $data['kontrak'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->get();
            return view('manager_crm/manager_kontrak', $data);
        }
        if($request->area_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            // $data['kontraks'] = Kontrak::all();
            $data['kontrak'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('area.area_id', '=', $request->area_id)
            ->get();
            return view('manager_crm/manager_kontrak', $data);
        }
    }
    public function mou()
    {  
      $data['areas'] = Area::all();
      $data['bisnis_units'] = Bisnis_unit::all();
      $data['datamous'] = Datamou::all();
      $data['no'] = 1;
      return view('manager_crm/manager_mou', $data);
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
            return view('manager_crm/manager_mou', $data);
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
            return view('manager_crm/manager_mou', $data);
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
            return view('manager_crm/manager_mou', $data);
          }
    }
    public function customer()
    {  
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = DB::table('customer')
        ->join('area', 'customer.area_id', '=', 'area.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->get();
        $data['no'] = 1;
        return view('manager_crm/manager_customer', $data);
    }
    public function filter_customer(Request $request)
    {
      if($request->bu_id && $request->area_id)
      {
        $data['bisnis_units'] = bisnis_unit :: all();
        $data['areas'] = Area::all();
        $data['customers'] = DB::table('customer')
        ->join('area', 'customer.area_id', '=', 'area.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->where('area.area_id', '=', $request->area_id)->get();  
        $data['no'] = 1;

        return view('manager_crm/manager_customer', $data);
      }
      if($request->area_id)
      {
        $data['bisnis_units'] = bisnis_unit :: all();
        $data['areas'] = Area::all();
        $data['customers'] = DB::table('customer')
        ->join('area', 'customer.area_id', '=', 'area.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('area.area_id', '=', $request->area_id)->get();  
        $data['no'] = 1;

        return view('manager_crm/manager_customer', $data);
      }
      if($request->bu_id)
      {
        $data['bisnis_units'] = bisnis_unit :: all();
        $data['areas'] = Area::all();
        $data['customers'] = DB::table('customer')
        ->join('area', 'customer.area_id', '=', 'area.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->get();
        $data['no'] = 1;

        return view('manager_crm/manager_customer', $data);
      }
    }
}
