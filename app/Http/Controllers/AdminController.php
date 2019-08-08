<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\datamou;
use App\Kontrak;
use App\Customer;
use Carbon;
use DateTime;
use PDF;
use App\Listeners\LogSuccessfulLogin;

class AdminController extends Controller
{
    public function index()
    {
        $data['customer'] = DB::table('customer')->count();
        $data['kontrak'] = DB::table('kontrak')->count();   
        $data['datamou'] = DB::table('datamou')->count();             

        $lastUser = DB::table('users')
                    ->select('username')
                    ->orderBy('current_login_at','desc')
                    ->skip(1)->first();
        //dd($lastUser);
        return view('/admin/dashboard_admin')->with($data)->with('lastUser',$lastUser);
    }

    public function superadmin()
    {
        $data['bisnis_unit'] = DB::table('bisnis_unit')->count();
        $data['wilayah'] = DB::table('wilayah')->count();
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
        $data['datamous'] = DB::table('datamou')
        ->join('kontrak','datamou.id_kontrak','=','kontrak.id_kontrak')
        ->join('customer', 'kontrak.kode_customer', '=', 'customer.kode_customer')
        ->join('bisnis_unit','customer.bu_id','=','bisnis_unit.bu_id')
        ->select('kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan',
        'kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan',
        'kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran',
        'kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing',
        'nama_bisnis_unit','provinsi','alamat','jenis_usaha','periode_kontrak','hc','invoice','mf',
        'mf_persen','bpjs_tenagakerja','bpjs_kesehatan','jiwasraya','ramamusa','ditagihkan','diprovisasikan',
        'overheadcost','training','tanggal_invoice','time_of_payment','cut_of_date','kaporlap','devices',
        'chemical','pendaftaran_mou')
        ->get();

        $data['no'] = 1;
        //dd($data);
        $date1 = new DateTime("$request->periode_kontrak");
        $date2 = new DateTime("$request->akhir_periode");

        $diff = $date1->diff($date2);
        $data['different'] = (($diff->format('%y') * 12) + $diff->format('%m'));
        // return (int) round($data['different']);
        // var_dump($request->periode_kontrak);
        // dd($request->periode_kontrak);
        // print_r($diff_in_months);

        if($data['different'] < 24)
        {
            $data['different'] = "Silver";
        }
        if($data['different'] >= 24 && $data['different'] < 60)
        {
            $data['different'] = "Gold";
        }
        if($data['different'] >= 60)
        {
            $data['different'] = "Platinum";
        }

        return view('admin/data_customer', $data);
    }
    public function exportPDF(){
        $data['datamous'] = DB::table('datamou')
        ->join('kontrak','datamou.id_kontrak','=','kontrak.id_kontrak')
        ->join('customer', 'kontrak.kode_customer', '=', 'customer.kode_customer')
        ->join('bisnis_unit','customer.bu_id','=','bisnis_unit.bu_id')
        ->select('kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan',
        'kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan',
        'kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran',
        'kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing',
        'nama_bisnis_unit','provinsi','alamat','jenis_usaha','periode_kontrak','hc','invoice','mf',
        'mf_persen','bpjs_tenagakerja','bpjs_kesehatan','jiwasraya','ramamusa','ditagihkan','diprovisasikan',
        'overheadcost','training','tanggal_invoice','time_of_payment','cut_of_date','kaporlap','devices',
        'chemical','pendaftaran_mou')
        ->first();
        
        $pdf = PDF::loadview('admin/customer/pdfdatacustomer',['datamous'=>$data]);
        $pdf->setPaper('A4','landscape');
        return $pdf->download('Laporan-Data-CustomerAll-CRM.pdf');
    }
    public function lastLogin(){
        $lastUser = Auth::user()
                    ->select('username')
                    ->latest();
        //dd($lastUser);
                
        return view('admin/dashboard_admin', compact('lastUser'));
    }
}
