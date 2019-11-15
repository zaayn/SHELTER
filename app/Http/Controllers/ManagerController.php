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
use App\Wilayah;
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
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['calls'] = DB::table('call')
        ->join('customer', 'call.kode_customer', '=', 'customer.kode_customer')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->get();
        $data['no'] = 1;
        return view('manager_crm/manager_call', $data);
    }
    public function filter_call(Request $request)
    {

    }
    public function keluhan()
    {  
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhan'] = Keluhan::all();
        $data['no'] = 1;
        return view('manager_crm/manager_keluhan', $data);
    }
    public function visit()
    {  
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
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
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['no'] = 1;
        return view('manager_crm/manager_kontrak', $data);
    }
    public function filter_kontrak(Request $request)
    {
        if($request->bu_id && $request->wilayah_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            
            $data['kontrak'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
            ->orderBy('kontrak.id_kontrak','asc')
            ->get();
            return view('manager_crm/manager_kontrak', $data);
        }
        if($request->bu_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            // $data['kontraks'] = Kontrak::all();
            $data['kontrak'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->get();
            return view('manager_crm/manager_kontrak', $data);
        }
        if($request->wilayah_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            // $data['kontraks'] = Kontrak::all();
            $data['kontrak'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
            ->get();
            return view('manager_crm/manager_kontrak', $data);
        }
    }
    public function mou()
    {  
        $data['datamous'] = Datamou::all();
        $data['no'] = 1;
        return view('manager_crm/manager_mou', $data);
    }
    public function customer()
    {  
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();
        $data['no'] = 1;
        return view('manager_crm/manager_customer', $data);
    }
    public function filter(Request $request)
    {
      if($request->status && $request->wilayah_id)
      {
        $data['wilayahs'] = Wilayah::all();
        $data['customers'] = DB::table('customer')
        ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('customer.kode_customer','customer.nama_perusahaan','customer.jenis_usaha','nama_bisnis_unit','customer.alamat','customer.provinsi','customer.kabupaten','customer.telpon','customer.cp','customer.nama_area','wilayah.nama_wilayah','customer.nama_depan','status','jenis_perusahaan','negara')
        ->where('customer.status', '=', $request->status)
        ->where('wilayah.wilayah_id', '=', $request->wilayah_id)->get();  
        $data['no'] = 1;
        return view('manager_crm/manager_customer', $data);
      }
      if($request->wilayah_id)
      {
        $data['wilayahs'] = Wilayah::all();
        $data['customers'] = DB::table('customer')
        ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('customer.kode_customer','customer.nama_perusahaan','customer.jenis_usaha','nama_bisnis_unit','customer.alamat','customer.provinsi','customer.kabupaten','customer.telpon','customer.cp','customer.nama_area','wilayah.nama_wilayah','customer.nama_depan','status','jenis_perusahaan','negara')
        ->where('wilayah.wilayah_id', '=', $request->wilayah_id)->get();  
        $data['no'] = 1;
        return view('manager_crm/manager_customer', $data);
      }
      
    }
}
