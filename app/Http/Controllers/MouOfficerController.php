<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use PDF;
use App\Datamou;
use App\Kontrak;
use App\Customer;
use Excel;
use App\Exports\MouOfficerExport;
use App\Bisnis_unit;
use App\Area;

class MouOfficerController extends Controller
{
    public function index()
    {
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['no'] = 1;
        $data['datamous'] = DB::table('datamou')
        ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
        ->join('customer','customer.kode_customer','=','kontrak.kode_customer')
        // ->whereBetween('kontrak.akhir_periode',array('2020-09-01','2020-09-10'))
        // ->where('kontrak.akhir_periode','=','2020-09-10')
        ->get();
        // $mou = Datamou::whereHas('customer', function($query){
        //     $query->where('nama_depan',Auth::user()->nama_depan);
        // });
        // $data['mous'] = $mou->get();
        // $data['datamous'] = Datamou::all();
        return view('officer/mou/mou', $data);
    }
    public function filter_mou(Request $request)
    {
        if($request->from && $request->to && $request->bu_id && $request->area_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->where('area.area_id', '=', $request->area_id)
            ->whereBetween('kontrak.akhir_periode',array($request->from,$request->to))
            ->get();
            return view('officer/mou/mou', $data);
        }
        elseif($request->bu_id && $request->area_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->where('area.area_id', '=', $request->area_id)
            ->get();
            return view('officer/mou/mou', $data);
        }
        elseif($request->from && $request->to && $request->bu_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->whereBetween('kontrak.akhir_periode',array($request->from,$request->to))
            ->get();
            return view('officer/mou/mou', $data);
        }
        elseif($request->from && $request->to &&  $request->area_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('area.area_id', '=', $request->area_id)
            ->whereBetween('kontrak.akhir_periode',array($request->from,$request->to))
            ->get();
            return view('officer/mou/mou', $data);
        }
        elseif($request->bu_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->get();
            return view('officer/mou/mou', $data);
        }
        elseif($request->area_id)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('area.area_id', '=', $request->area_id)
            ->get();
            return view('officer/mou/mou', $data);
        }
        elseif($request->from && $request->to)
        {
            $data['no'] = 1;
            $data['areas'] = Area::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['datamous'] = DB::table('datamou')
            ->join('kontrak', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('area','area.area_id','=','customer.area_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->whereBetween('kontrak.akhir_periode',array($request->from,$request->to))
            ->get();
            return view('officer/mou/mou', $data);
        }
    }
    

    public function insert()
    {
        $data['kontraks'] = Kontrak::where('status','Aktif')->get();
        $data['customers'] = Customer::all();
        return view('officer/mou/insertmou',$data);
    }

    public function store(Request $request, $id_kontrak)
    {
        $check=Datamou::where('id_kontrak', $id_kontrak)->first();
        if($check) return redirect('/offiver_crm/kontrak')->with('error', 'Kontrak sudah memiliki MoU');

        $request->validate([
            'hc'                    => 'required',
            'invoice'               => 'required',
            'mf'                    => 'required',
            'mf_persen'             => 'required',
            'overheadcost'          => 'required',
            'training'              => 'required',
            'tanggal_invoice'       =>'required',
            'time_of_payment'       => 'required',
            'cut_of_date'           => 'required',
            'kaporlap'              =>'required',
            'devices'               => 'required',
            'chemical'              =>'required',
            'pendaftaran_mou'       => 'required',
        ]);
        
        $datamou = new Datamou;
        $datamou->no_mou = $request->no_mou;
        $datamou->id_kontrak = $request->id_kontrak;
        $datamou->no_adendum = $request->no_adendum;
        $datamou->hc = $request->hc;
        $datamou->invoice = $request->invoice;
        $datamou->mf = $request->mf;
        $datamou->mf_persen = $request->mf_persen;
        $datamou->bpjs_tk_persen = $request->bpjs_tk_persen;
        $datamou->bpjs_tenagakerja = $request->bpjs_tenagakerja;
        $datamou->bpjs_kes_persen = $request->bpjs_kes_persen;
        $datamou->bpjs_kesehatan = $request->bpjs_kesehatan;
        $datamou->jiwasraya = $request->jiwasraya;
        $datamou->ramamusa = $request->ramamusa;
        $datamou->ditagihkan = $request->ditagihkan;
        $datamou->diprovisasikan = $request->diprovisasikan;
        $datamou->overheadcost = $request->overheadcost;
        $datamou->training = $request->training;
        $datamou->tanggal_invoice = $request->tanggal_invoice;
        $datamou->time_of_payment = $request->time_of_payment;
        $datamou->cut_of_date = $request->cut_of_date;
        $datamou->kaporlap = $request->kaporlap;
        $datamou->devices = $request->devices;
        $datamou->chemical = $request->chemical;
        $datamou->pendaftaran_mou = $request->pendaftaran_mou;

        if ($datamou->save()){
            return redirect('/officer_crm/kontrak')->with('success', 'item berhasil ditambahkan');
        }
        else{
            return redirect('/officer_crm/insertmou')->with('error', 'item gagal ditambahkan');
        }
    }

    public function edit($no_mou)
    {
        $where = array('no_mou' => $no_mou);
        $datamou  = Datamou::where($where)->first();
 
        return view('officer/mou/editmou')->with('datamou', $datamou);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datamou = Datamou::findorFail($id);
        $request->validate([
            'hc' => 'required',
            'invoice' => 'required',
            'mf' => 'required',
            'mf_persen' => 'required',
            'overheadcost' => 'required',
            'training' => 'required',
            'tanggal_invoice' =>'required',
            'time_of_payment' => 'required',
            'cut_of_date' => 'required',
            'kaporlap' =>'required',
            'devices' => 'required',
            'chemical' =>'required',
            'pendaftaran_mou' => 'required',
        ]);

        $datamou->no_adendum = $request->no_adendum;
        $datamou->hc = $request->hc;
        $datamou->invoice = $request->invoice;
        $datamou->mf = $request->mf;
        $datamou->mf_persen = $request->mf_persen;
        $datamou->bpjs_tk_persen = $request->bpjs_tk_persen;
        $datamou->bpjs_tenagakerja = $request->bpjs_tenagakerja;
        $datamou->bpjs_kes_persen = $request->bpjs_kes_persen;
        $datamou->bpjs_kesehatan = $request->bpjs_kesehatan;
        $datamou->jiwasraya = $request->jiwasraya;
        $datamou->ramamusa = $request->ramamusa;
        $datamou->ditagihkan = $request->ditagihkan;
        $datamou->diprovisasikan = $request->diprovisasikan;
        $datamou->overheadcost = $request->overheadcost;
        $datamou->training = $request->training;
        $datamou->tanggal_invoice = $request->tanggal_invoice;
        $datamou->time_of_payment = $request->time_of_payment;
        $datamou->cut_of_date = $request->cut_of_date;
        $datamou->kaporlap = $request->kaporlap;
        $datamou->devices = $request->devices;
        $datamou->chemical = $request->chemical;
        $datamou->pendaftaran_mou = $request->pendaftaran_mou;
        
        if ($datamou->save())
          return redirect()->route('index.officer.datamou')->with(['success'=>'edit sukses']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($no_mou)
    {
        $datamou = Datamou::where('no_mou',$no_mou)->delete();
        return redirect()->route('index.officer.datamou')->with('success', 'delete sukses');
    }
    public function exportPDF(){
        $mou = Datamou::all();
        $pdf = PDF::loadview('officer/mou/pdfmou',['datamou'=>$mou]);
        $pdf->setPaper('A4','landscape');
        return $pdf->download('Laporan-Mou-Officer-CRM.pdf');
    }
    public function exportExcel(){
        return Excel::download(new MouOfficerExport, 'Laporan-Mou-CRM-Officer.xlsx');
    }
}
