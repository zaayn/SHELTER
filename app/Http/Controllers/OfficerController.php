<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Datamou;
use PDF;
use Auth;
use App\Bisnis_unit;
use App\Wilayah;

class OfficerController extends Controller
{
    public function index()
    {
        $data['calls'] = DB::table('call')->count();
        $data['kontraks'] = DB::table('kontrak')->count();   
        $data['visits'] = DB::table('visit')->count();   
        $data['keluhans'] = DB::table('keluhan')->count();
        


        $amount = DB::table('customer')
                    ->select(
                    DB::raw('nama_area as area'),
                    DB::raw('count(*) as jumlah'))
                    ->groupBy('nama_area')
                    ->get();
        $cat[] = ['area','jumlah'];
        foreach($amount as $key => $value){
            $cat[++$key] = [$value->area, $value->jumlah];
        }

        return view('/officer/dashboard_officer')->with($data)->with('cat',$cat);
    }
    public function mou(){
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['no'] = 1;
        $data['datamous'] = DB::table('datamou')
        ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
        ->get();
        return view('officer/mou', $data);
    }
    public function filter_mou(Request $request)
    {
        if($request->bu_id && $request->wilayah_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
            ->get();
            return view('officer/mou', $data);
        }
        if($request->bu_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->get();
            return view('officer/mou', $data);
        }
        if($request->wilayah_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
            ->get();
            return view('officer/mou', $data);
        }
    }
    public function exportPDF()
	{
		$mou = Datamou::all();
        $pdf = PDF::loadview('officer/pdfmou',['datamou'=>$mou]);
        $pdf->setPaper('A4','landscape');
    	return $pdf->download('Laporan-MoU-CRM.pdf');
    }
}
