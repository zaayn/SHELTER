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
use App\Area;
use App\Bisnis_unit;

class DirekturController extends Controller
{
    public function index()
    {
        $data['calls'] = DB::table('call')->count();
        $data['keluhan'] = DB::table('keluhan')->count();
        $data['visits'] = DB::table('visit')->count();
        $data['kontrak'] = DB::table('kontrak')->count();
        $data['customers'] = DB::table('customer')->count();
        $data['datamous'] = DB::table('datamou')->count();

        return view('/direktur/dashboard_direktur')->with($data);
    }
    public function customer()
    {  
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();
        $data['no'] = 1;
        return view('direktur/direktur_customer', $data);
    }
    public function call()
    {  
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['calls'] = Call::all();
        $data['no'] = 1;
        return view('direktur/direktur_call', $data);
    }
    public function keluhan()
    {  
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhan'] = Keluhan::all();
        $data['no'] = 1;
        return view('direktur/direktur_keluhan', $data);
    }
    public function visit()
    {  
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['visits'] = Visit::all();
        $data['no'] = 1;
        return view('direktur/direktur_visit', $data);
    }
    public function kontrak()
    {  
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['kontrak'] = Kontrak::all();
        $data['no'] = 1;
        return view('direktur/direktur_kontrak', $data);
    }
    public function mou()
    {  
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['datamous'] = Datamou::all();
        $data['no'] = 1;
        return view('direktur/direktur_mou', $data);
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
            return view('direktur/direktur_mou', $data);
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
            return view('direktur/direktur_mou', $data);
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
            return view('direktur/direktur_mou', $data);
          }
    }
    public function filter_call(Request $request)
    {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        
        if($request->bu_id || $request->area_id || $request->from || $request->to){
          $data['calls'] = Call::whereHas('customer', function($query) use($request){
            if($request->bu_id)
              $query->where('bu_id',$request->bu_id);

            if($request->area_id)
              $query->where('area_id',$request->area_id);

            if($request->from || $request->to)
            $query->whereBetween('tanggal_call',[$request->from, $request->to]);
          })->get();
        }
        else{
          $data['calls'] = Call::all();
        }
        
        return view('direktur/direktur_call', $data);
    }
    public function filter_keluhan(Request $request)
    {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        
        if($request->bu_id || $request->area_id || $request->from || $request->to){
          $data['keluhans'] = Keluhan::whereHas('customer', function($query) use($request){
            if($request->bu_id)
              $query->where('bu_id',$request->bu_id);

            if($request->area_id)
              $query->where('area_id',$request->area_id);
            
              if($request->from || $request->to)
            $query->whereBetween('tanggal_keluhan',[$request->from, $request->to]);
          })->get();
        }
        else{
          $data['keluhans'] = Keluhan::all();
        }
        return view('direktur/direktur_keluhan', $data);
    }
    public function filter_visit(Request $request)
    {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        
        if($request->bu_id || $request->area_id || $request->from || $request->to){
          $data['visits'] = Visit::whereHas('customer', function($query) use($request){
            if($request->bu_id)
              $query->where('bu_id',$request->bu_id);

            if($request->area_id)
              $query->where('area_id',$request->area_id);
            
            if($request->from || $request->to)
              $query->whereBetween('tanggal_visit',[$request->from, $request->to]);
          })->get();
        }
        else{
          $data['visits'] = Visit::all();
        }
        
        return view('direktur/direktur_visit', $data);
    }
    public function filter_kontrak(Request $request)
    {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();
        
        if($request->bu_id || $request->area_id || $request->from || $request->to){
          $data['kontraks'] = Kontrak::whereHas('customer', function($query) use($request){
            if($request->bu_id)
              $query->where('bu_id',$request->bu_id);

            if($request->area_id)
              $query->where('area_id',$request->area_id);

            if($request->from || $request->to)
              $query->whereBetween('akhir_periode',[$request->from, $request->to]);
          })->get();
        }
        else{
          $data['kontrak'] = Kontrak::all();
        }
        
        return view('direktur/direktur_kontrak', $data);
        
    }
    public function filter_customer(Request $request)
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

        return view('direktur/direktur_customer', $data);
    }
}
