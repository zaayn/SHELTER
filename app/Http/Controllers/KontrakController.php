<?php

namespace App\Http\Controllers;
//use Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use App\Exports\KontrakOfficerExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Kontrak;
use App\Customer;
use App\Bisnis_unit;
use App\Area;
use PDF;

class KontrakController extends Controller
{
    public function index()
    {
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();        
        $kontrak = Kontrak::whereHas('customer', function($query){
            $query->where('nama_depan', Auth::user()->nama_depan);
        });
        $data['kontraks'] = $kontrak->get();

        return view('officer/kontrak', $data);
    }
    public function filter(Request $request)
    {
      $data['no'] = 1;
      $data['areas'] = Area::all();
      $data['bisnis_units'] = Bisnis_unit::all();
      $data['customers'] = Customer::all();
      
      if($request->from || $request->to){
        $kontraks = Kontrak::whereHas('customer', function($query) use($request){
            if($request->from || $request->to)
                $query->whereBetween('akhir_periode',[$request->from, $request->to]);
        });
      }
      $data['kontraks'] = $kontraks->get();
      return view('officer/kontrak', $data);
    }

    public function insert()
    {
        // $data['customers'] = Customer::where('status','Aktif')->get();
        $data['customers'] = Customer::where('nama_depan', Auth::user()->nama_depan)->get();
        return view('officer/insertkontrak',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomor_kontrak' => 'required',
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
        $kontrak->nomor_kontrak = $request->nomor_kontrak;
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
            'nomor_kontrak' => 'required',
            'akhir_periode' => 'required',
            'srt_pemberitahuan' => 'required',
            'tgl_srt_pemberitahuan' => 'required',
            'srt_penawaran' =>'required',
            'tgl_srt_penawaran' => 'required',
            'dealing' => 'required',
            'tgl_dealing' =>'required',
            'posisi_pks' => 'required',
        ]);

        // $kontrak->id_kontrak = $request->id_kontrak;
        $kontrak->nomor_kontrak = $request->nomor_kontrak;
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
		$kontrak = Kontrak::whereHas('customer', function($query){
            $query->where('nama_depan', Auth::user()->nama_depan);
        })->get();
        $pdf = PDF::loadview('officer/pdfkontrak',['kontrak'=>$kontrak]);
        $pdf->setPaper('A4','landscape');
    	return $pdf->download('Laporan-Kontrak-Officer-CRM.pdf');
    }
    public function exportExcel()
	{
		return Excel::download(new KontrakOfficerExport, 'Laporan-Kontrak-CRM-Officer.xlsx');
    }
}
