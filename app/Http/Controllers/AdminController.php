<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\datamou;
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
        $data['customer'] = DB::table('customer')->count();
        $data['kontrak'] = DB::table('kontrak')->count();   
        $data['datamou'] = DB::table('datamou')->count();   
        $data['customers'] = customer::all();
        $data['kontraks'] = DB::table('kontrak')
        ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
        ->select('kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan',
        'kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan',
        'kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran',
        'kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing')
        ->whereRaw('akhir_periode < NOW() + INTERVAL 60 DAY') 
        ->get();    
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->select('id_keluhan','customer.kode_customer','customer.nama_perusahaan','keluhan.kode_customer','spv_pic','tanggal_keluhan','jam_keluhan','keluhan','pic','jam_follow','follow_up','closing_case','via','keluhan.status')
        ->where('keluhan.status', 'belum ditangani')->get();

        $lastUser = DB::table('users')
                    ->whereNotNull('current_login_at')
                    ->orderBy('current_login_at','desc')
                    ->get();
      
        
        

        $amount = DB::table('customer')
                    ->select(
                    DB::raw('nama_area as area'),
                    DB::raw('count(*) as jumlah'))
                    ->where('status', 'aktif')
                    ->groupBy('nama_area')
                    ->get();
        $cat[] = ['area','jumlah'];
        foreach($amount as $key => $value){
            $cat[++$key] = [$value->area, $value->jumlah];
        }
        return view('/admin/dashboard_admin')->with($data)->with('lastUser',$lastUser)->with('cat',$cat);
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
        ->select('bpjs_tk_persen','bpjs_kes_persen','kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan',
        'kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan',
        'kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran',
        'kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing',
        'nama_bisnis_unit','provinsi','alamat','jenis_usaha','periode_kontrak','hc','invoice','mf',
        'mf_persen','bpjs_tenagakerja','bpjs_kesehatan','jiwasraya','ramamusa','ditagihkan','diprovisasikan',
        'overheadcost','training','tanggal_invoice','time_of_payment','cut_of_date','kaporlap','devices',
        'chemical','pendaftaran_mou')
        ->get();
        $data['no'] = 1;
        // dd($data['datamous']);
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
        // $fdate = $request->periode_kontrak;
        // $tdate = $request->akhir_periode;
        // $datetime1 = new DateTime($fdate);
        // $datetime2 = new DateTime($tdate);
        // $interval = $datetime1->diff($datetime2);
        // $days = $interval->format('%a');
        // dd($days);
        
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
    public function keluhanBelum(){
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->select('id_keluhan','customer.kode_customer','customer.nama_perusahaan','keluhan.kode_customer','spv_pic','tanggal_keluhan','jam_keluhan','keluhan','pic','jam_follow','follow_up','closing_case','via','keluhan.status')
        ->where('keluhan.status', '=', 'Belum ditangani')
        ->get();
        return view('admin/dashboard_admin', $data);
    }
}
