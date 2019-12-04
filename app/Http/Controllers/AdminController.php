<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Datamou;
use App\Kontrak;
use App\Customer;
use App\Keluhan;
use App\User;
use Carbon;
use DateTime;
use PDF;
use App\Listeners\LogSuccessfulLogin;

class AdminController extends Controller
{
    public function index()
    {
        $data['no'] = 1;
        $data['customer'] = DB::table('customer')->count();
        $data['kontrak'] = DB::table('kontrak')->count();   
        $data['datamou'] = DB::table('datamou')->count();   
        $data['customers'] = Customer::all();
        $data['kontraks'] = DB::table('kontrak')
        ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
        ->whereRaw('akhir_periode < NOW() + INTERVAL 60 DAY') 
        ->get();    
        foreach($data['kontraks'] as $key => $kontraa){
            $awok = DB::table('kontrak')
            ->join('datamou', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->where('kontrak.id_kontrak', '=', $kontraa->id_kontrak)
            ->get();
            
            $data['kontraks'][$key]->datamou_flag = count($awok);


        }
        $data['keluhans'] = Keluhan::where('status', 'Belum ditangani')->get();

        $lastUser = User::whereNotNull('current_login_at')
                    ->orderBy('current_login_at','desc')
                    ->get();
      
        
        

        $amount = DB::table('customer')
                    ->select(
                    DB::raw('area_id as area'),
                    DB::raw('count(*) as jumlah'))
                    ->where('status', 'aktif')
                    ->groupBy('area')
                    ->get();
        $cat[] = ['area','jumlah'];
        foreach($amount as $key => $value){
            $cat[++$key] = [$value->area, $value->jumlah];
        }
        return view('/admin/dashboard_admin')->with($data)->with('lastUser',$lastUser)->with('cat',$cat);
    }

    public function superadmin()
    {
        $data['no'] = 1;
        $data['bisnis_unit'] = DB::table('bisnis_unit')->count();
        $data['area'] = DB::table('area')->count();
        $data['users'] = DB::table('users')->count();

        $lastUser = DB::table('users')
                    ->select('username')
                    ->orderBy('current_login_at','desc')
                    ->skip(1)->first();

        return view('/admin/dashboard_superadmin')->with($data)->with('lastUser',$lastUser);
    }
    public function data_customer(Request $request)
    {
        $data['no'] = 1;
        $data['datamous'] = DB::table('datamou')
        ->join('kontrak','datamou.id_kontrak','=','kontrak.id_kontrak')
        ->join('customer', 'kontrak.kode_customer', '=', 'customer.kode_customer')
        ->join('bisnis_unit','customer.bu_id','=','bisnis_unit.bu_id')
        ->get();
        $data['no'] = 1;

        foreach ($data['datamous'] as $datas) {
            $to = \Carbon\Carbon::createFromFormat('Y-m-d',$datas->periode_kontrak);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d',$datas->akhir_periode);
            $diff_in_days = $to->diffInDays($from);
            $data['lama'] = $diff_in_days;

            if($data['lama'] < 720)
            {
            $data['lama'] = "Silver";
            }
            if($data['lama'] >= 720 && $data['lama'] < 1800)
            {
               $data['lama'] = "Gold";
            }
            if($data['lama'] >= 1800)
            {
                $data['lama'] = "Platinum";
            }
            
        }
        
        return view('admin/data_customer', $data);
    }
    
    public function exportPDF(){
        $data['datamous'] = DB::table('datamou')
        ->join('kontrak','datamou.id_kontrak','=','kontrak.id_kontrak')
        ->join('customer', 'kontrak.kode_customer', '=', 'customer.kode_customer')
        ->join('bisnis_unit','customer.bu_id','=','bisnis_unit.bu_id')
        ->first();
        
        $pdf = PDF::loadview('admin/customer/pdfdatacustomer',['datamous'=>$data]);
        $pdf->setPaper('A4','landscape');
        return $pdf->download('Laporan-Data-CustomerAll-CRM.pdf');
    }
    public function keluhanBelum(){
        $data['keluhans'] = Keluhan::where('status','Belum ditangani')
        ->get();
        return view('admin/dashboard_admin', $data);
    }
}
