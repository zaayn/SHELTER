<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\datamou;
use App\Kontrak;
use App\Customer;

class AdminController extends Controller
{
    public function index()
    {
        $data['customer'] = DB::table('customer')->count();
        $data['kontrak'] = DB::table('kontrak')->count();        

        return view('/admin/dashboard_admin',$data);
    }

    public function superadmin()
    {
        $data['bisnis_unit'] = DB::table('bisnis_unit')->count();
        $data['wilayah'] = DB::table('wilayah')->count();
        $data['area'] = DB::table('area')->count();
        $data['users'] = DB::table('users')->count();

        return view('/admin/dashboard_superadmin',$data);
    }
    public function data_customer()
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
        return view('admin/data_customer', $data);
    }
}
