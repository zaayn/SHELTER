<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Datamou;
use PDF;
use Auth;

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
        $data['no'] = 1;
        $data['datamous'] = Datamou::all();
        return view('officer/mou', $data);
    }
    public function exportPDF()
	{
		$mou = Datamou::all();
        $pdf = PDF::loadview('officer/pdfmou',['datamou'=>$mou]);
        $pdf->setPaper('A4','landscape');
    	return $pdf->download('Laporan-MoU-CRM.pdf');
    }
}
