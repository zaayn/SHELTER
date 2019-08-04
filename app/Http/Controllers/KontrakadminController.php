<?php

namespace App\Http\Controllers;
// namespace App\Http\Controllers\Auth;
// use Auth;
//use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use App\Kontrak;
use App\Customer;
use Carbon;
use PDF;
use Excel;
Use App\Exports\KontrakExport;

class KontrakadminController extends Controller
{
    public function filter(Request $request)
    {
        if($request->kode_customer)
        {
            $data['customers'] = customer::all();
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->select('kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan','kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan','kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran','kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing')
            ->where('customer.kode_customer', '=', $request->kode_customer)
            ->get();
            return view('admin/kontrak/kontrak', $data);
        }
        else {
            return index();
        }
    }
    public function index()
    {
        $data['customers'] = customer::all();
        $data['kontraks'] = DB::table('kontrak')
        ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
        ->select('kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan','kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan','kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran','kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing')
        ->get();
        return view('admin/kontrak/kontrak', $data);

    }

    public function insert()
    {
        $data['customers'] = customer::all();
        return view('admin/kontrak/insertkontrak',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kontrak' => 'required',
            'kode_customer' => 'required',
            'periode_kontrak' => 'required|date',
            'akhir_periode' => 'required|date',
            'srt_pemberitahuan' => 'required',
            'tgl_srt_pemberitahuan' => 'required',
            'srt_penawaran' =>'required',
            'tgl_srt_penawaran' => 'required',
            'dealing' => 'required',
            'tgl_dealing' =>'required',
            'posisi_pks' => 'required',
            'closing' =>'required',
        ]);

        $kontrak = new kontrak;
        $kontrak->id_kontrak = $request->id_kontrak;
        $kontrak->kode_customer = $request->kode_customer;
        $kontrak->periode_kontrak = $request->periode_kontrak;
        $kontrak->akhir_periode = $request->akhir_periode;
        $kontrak->srt_pemberitahuan = $request->srt_pemberitahuan;
        $kontrak->tgl_srt_pemberitahuan = $request->tgl_srt_pemberitahuan;
        $kontrak->srt_penawaran = $request->srt_penawaran;
        $kontrak->tgl_srt_penawaran = $request->tgl_srt_penawaran;
        $kontrak->dealing = $request->dealing;
        $kontrak->tgl_dealing = $request->tgl_dealing;
        $kontrak->posisi_pks = $request->posisi_pks;
        $kontrak->closing = $request->closing;

        if ($kontrak->save()){
            return redirect('/admin/insertkontrak')->with('success', 'item berhasil ditambahkan');
        }
        else{
            return redirect('/admin/insertkontrak')->with('error', 'item gagal ditambahkan');
        }
    }

    public function edit($id_kontrak)
    {
        $where = array('id_kontrak' => $id_kontrak);
        $kontrak  = Kontrak::where($where)->first();
 
        return view('admin/kontrak/editkontrak')->with('kontrak', $kontrak);
    }

    public function update(Request $request, $id_kontrak)
    {
        $kontrak = Kontrak::findorFail($id_kontrak);
        $request->validate([
            'id_kontrak' => 'required',
            'kode_customer' => 'required',
            'periode_kontrak' => 'required|date',
            'akhir_periode' => 'required',
            'srt_pemberitahuan' => 'required',
            'tgl_srt_pemberitahuan' => 'required',
            'srt_penawaran' =>'required',
            'tgl_srt_penawaran' => 'required',
            'dealing' => 'required',
            'tgl_dealing' =>'required',
            'posisi_pks' => 'required',
            'closing' =>'required',
        ]);

        $kontrak->id_kontrak = $request->id_kontrak;
        $kontrak->kode_customer = $request->kode_customer;
        $kontrak->periode_kontrak = $request->periode_kontrak;
        $kontrak->akhir_periode = $request->akhir_periode;
        $kontrak->srt_pemberitahuan = $request->srt_pemberitahuan;
        $kontrak->tgl_srt_pemberitahuan = $request->tgl_srt_pemberitahuan;
        $kontrak->srt_penawaran = $request->srt_penawaran;
        $kontrak->tgl_srt_penawaran = $request->tgl_srt_penawaran;
        $kontrak->dealing = $request->dealing;
        $kontrak->tgl_dealing = $request->tgl_dealing;
        $kontrak->posisi_pks = $request->posisi_pks;
        $kontrak->closing = $request->closing;
        
        if ($kontrak->save())
          return redirect()->route('index.kontrak')->with(['success'=>'edit sukses']);
    }

    public function destroy($id_kontrak)
    {
        $kontrak = Kontrak::where('id_kontrak',$id_kontrak)->delete();
        return redirect()->route('index.kontrak')->with('success', 'delete sukses');
    }
    public function exportPDF(){
		$kontrak = Kontrak::all();
        $pdf = PDF::loadview('admin/kontrak/pdfkontrak',['kontrak'=>$kontrak]);
        $pdf->setPaper('A4','landscape');
    	return $pdf->download('Laporan-Kontrak-CRM.pdf');
    }
    public function exportExcel(){
        return Excel::download(new KontrakExport, 'Laporan-Kontrak-CRM.xlsx');
    }
    public function reminder(Request $request) //filter kontrak h-30 hari 
    {
        $now = Carbon\Carbon::now();
        $reminder = $now->diffInDays($request->akhir_periode) . str_plural(' day', $now->diffInDays($request->akhir_periode)). ' left';
        if($reminder > 30)
        {
            $data['customers'] = customer::all();
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->select('kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan','kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan','kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran','kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing')
            // ->where('kontrak.akhir_kontrak', '=', $request->akhir_)
            ->get();
            return view('admin/kontrak/reminder', $data);
        }else {
            return "hello";
        }
    }

    // public function insert_reminder()
    // {
    //     $now = Carbon\Carbon::now();
    //     if ($now->diffInDays($this->akhir_periode) > 0)
    //     {
    //         $reminder = $now->diffInDays($this->akhir_periode) . str_plural(' day', $now->diffInDays($this->akhir_periode)). ' left';
    //         if($reminder < 30)
    //         {
    //             $ewminder = new reminder;
    //             $reminder->id_kontrak           = $request->id_kontrak;
    //             $reminder->periode_kontrak      = $request->periode_kontrak;
    //             $reminder->akhir_periode        = $request->akhir_periode;
    //             $reminder->srt_pemberitahuan    = $request->srt_pemberitahuan;
    //             $reminder->tgl_srt_pemberitahuan = $request->tgl_srt_pemberitahuan;
    //             $reminder->srt_penawaran        = $request->srt_penawaran;
    //             $reminder->tgl_srt_penawaran    = $request->tgl_srt_penawaran;
    //             $reminder->dealing              = $request->dealing;
    //             $reminder->tgl_dealing          = $request->tgl_dealing;
    //             $reminder->posisi_pks           = $request->posisi_pks;
    //             $reminder->closing              = $request->closing;
    //             if ($remenider->save()){
    //                 return redirect('/admin/reminder')->with('success', 'item berhasil ditambahkan');
    //             }
    //         }
    //     }
    // }
    // public function index_reminder()
    // {
    //     $data['reminders'] = reminder::all();
    //     return view('admin/kontrak/reminder', $data);
    // }
}
