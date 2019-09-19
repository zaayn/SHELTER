<?php

namespace App\Http\Controllers;
//use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use App\Kontrak;
use App\Customer;
use App\Bisnis_unit;
use App\Wilayah;
use PDF;

class KontrakController extends Controller
{
    public function index()
    {
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();        
        $data['kontraks'] = DB::table('kontrak')
        ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
        ->select('kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan','kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan','kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran','kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing')
        ->get();
        return view('officer/kontrak', $data);

    }

    public function insert()
    {
        $data['customers'] = DB::table('customer')
                            ->where('status','Aktif')
                            ->get();
        //dd($data['customers']);
        return view('officer/insertkontrak',$data);
    }

    public function store(Request $request)
    {
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
        $kontrak->closing = "Aktif";

        if ($kontrak->save()){
            return redirect('/officer_crm/insertkontrak')->with('success', 'item berhasil ditambahkan');
        }
        else{
            return redirect('/officer_crm/insertkontrak')->with('error', 'item gagal ditambahkan');
        }
    }

    public function edit($id_kontrak)
    {
        $where = array('id_kontrak' => $id_kontrak);
        $kontrak  = Kontrak::where($where)->first();
 
        return view('officer/editkontrak')->with('kontrak', $kontrak);
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
        $kontrak->closing = "aktif";
        
        if ($kontrak->save())
          return redirect()->route('index.kontrak.officer')->with(['success'=>'edit sukses']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id_kontrak)
    {
        $kontrak = Kontrak::where('id_kontrak',$id_kontrak)->delete();
        return redirect()->route('index.kontrak.officer')->with('success', 'delete sukses');
    }
    public function exportPDF(){
		$kontrak = Kontrak::all();
        $pdf = PDF::loadview('officer/pdfkontrak',['kontrak'=>$kontrak]);
        $pdf->setPaper('A4','landscape');
    	return $pdf->download('Laporan-Kontrak-CRM.pdf');
    }
    public function filter(Request $request)
    {
        if($request->bu_id && $request->wilayah_id)
        {
            $data['wilayahs'] = wilayah::all();
            $data['bisnis_units'] = bisnis_unit::all();
            $data['customers'] = customer::all();
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->select('wilayah.wilayah_id','bisnis_unit.nama_bisnis_unit','bisnis_unit.bu_id','kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan','kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan','kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran','kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
            ->get();
            return view('officer/kontrak', $data);
        }
        elseif($request->bu_id)
        {
            $data['wilayahs'] = wilayah::all();
            $data['bisnis_units'] = bisnis_unit::all();
            $data['customers'] = customer::all();
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->select('wilayah.wilayah_id','bisnis_unit.nama_bisnis_unit','bisnis_unit.bu_id','kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan','kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan','kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran','kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->get();
            return view('officer/kontrak', $data);
        }
        if($request->wilayah_id)
        {
            $data['wilayahs'] = wilayah::all();
            $data['bisnis_units'] = bisnis_unit::all();
            $data['customers'] = customer::all();
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->select('wilayah.wilayah_id','bisnis_unit.nama_bisnis_unit','bisnis_unit.bu_id','kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan','kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan','kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran','kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing')
            ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
            ->get();
            return view('officer/kontrak', $data);
        }
    }
}
