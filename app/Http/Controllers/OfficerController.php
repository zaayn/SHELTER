<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\datamou;
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
        
        $lastUser = Auth::user()
                    ->select('username')
                    ->orderBy('last_login_at','desc')
                    ->first();

        return view('/officer/dashboard_officer')->with($data)->with('lastUser',$lastUser);
    }
    public function mou(){
        $data['datamous'] = datamou::all();
        return view('officer/mou', $data);
    }
    public function exportPDF()
	{
		$mou = datamou::all();
        $pdf = PDF::loadview('officer/pdfmou',['datamou'=>$mou]);
        $pdf->setPaper('A4','landscape');
    	return $pdf->download('Laporan-MoU-CRM.pdf');
    }
}
