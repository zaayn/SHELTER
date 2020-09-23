<?php

namespace App\Http\Controllers;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Kontrak;
use App\Customer;
use App\Datamou;
use Carbon;
use PDF;
use Excel;
Use App\Exports\KontrakExport;
use App\Bisnis_unit;
use App\Area;

class KontrakadminController extends Controller
{
    public function index()
    {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();  
        $data['kontraks'] = Kontrak::all();

        return view('admin/kontrak/kontrak', $data);
    }
    public function filter(Request $request)
    {
      $data['no'] = 1;
      $data['areas'] = Area::all();
      $data['bisnis_units'] = Bisnis_unit::all();
      $data['customers'] = Customer::all();
      
      if($request->bu_id || $request->area_id || $request->from || $request->to){
        $data['kontraks'] = Kontrak::whereHas('customer', function($query) use($request){
            if($request->bu_id)
                $query->where('bu_id',$request->bu_id);

            if($request->area_id)
                $query->where('area_id',$request->area_id);

            if($request->from || $request->to)
                $query->whereBetween('akhir_periode',[$request->from, $request->to]);
        })->get();
      }
      else{
          $data['kontraks'] = Kontrak::all();
      }
      return view('admin/kontrak/kontrak', $data);
    }

    public function insert()
    {
        $data['customers'] = Customer::where('status','Aktif')->get();
        return view('admin/kontrak/insertkontrak',$data);
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
            'nomor_kontrak' => 'required',
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
            ]);

            $kontrak = new Kontrak;
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

            $customer = Customer::findOrFail($request->kode_customer);
            $to = \Carbon\Carbon::createFromFormat('Y-m-d',$kontrak->periode_kontrak);
            $from = \Carbon\Carbon::createFromFormat('Y-m-d',$kontrak->akhir_periode);
            $diff_in_month = $to->diffInMonths($from);
            $customer->month_kontrak += $diff_in_month;
        
       
            if ($kontrak->save() && $customer->save()){
                return redirect('/admin/insertkontrak')->with('success', 'item berhasil ditambahkan');
            }
            else{
                return redirect('/admin/insertkontrak')->with('error', 'item gagal ditambahkan');
            }
        }
        catch(\Illuminate\Database\QueryException $e){
            $errorCode = $e->errorInfo[1];
            if($errorCode == '1062'){
                return redirect('/admin/insertkontrak')->with('error', 'Nomor kontrak sudah ada!');
            }
        }
    }

    public function edit($id_kontrak)
    {
        $where = array('id_kontrak' => $id_kontrak);
        $kontrak  = Kontrak::where($where)->first();
 
        return view('admin/kontrak/editkontrak')->with('kontrak', $kontrak);
    }
  
    public function closing(Request $request, $id_kontrak)
    {
        $kontrak = Kontrak::findorFail($id_kontrak);

        $kontrak->dealing = "Sudah Deal";
        $kontrak->posisi_pks = "di Shelter";
        $kontrak->closing = "Closed";
        
        if ($kontrak->save())
          return redirect()->route('index.kontrak')->with(['success'=>'Closing Kontrak sukses']);
    }

    public function update(Request $request, $id_kontrak)
    {
        try {
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
    
            $kontrak->nomor_kontrak = $request->nomor_kontrak;
            $kontrak->akhir_periode = $request->akhir_periode;
            $kontrak->srt_pemberitahuan = $request->srt_pemberitahuan;
            $kontrak->tgl_srt_pemberitahuan = $request->tgl_srt_pemberitahuan;
            $kontrak->srt_penawaran = $request->srt_penawaran;
            $kontrak->tgl_srt_penawaran = $request->tgl_srt_penawaran;
            $kontrak->dealing = $request->dealing;
            $kontrak->tgl_dealing = $request->tgl_dealing;
            $kontrak->posisi_pks = $request->posisi_pks;
            $kontrak->closing = "Aktif";
            
            if ($kontrak->save())
              return redirect()->route('index.kontrak')->with(['success'=>'edit sukses']);
    
            // $no_kontrak = DB::table('kontrak')->select('nomor_kontrak')->get();
            // foreach($no_kontrak as $no){
            //     $findno = Kontrak::find($no->nomor_kontrak);
            //     if($kontrak->nomor_kontrak == $findno)
            //     return redirect('/admin/insertkontrak')->with('error', 'nomor kontrak sudah ada');
            }
            catch(\Illuminate\Database\QueryException $e){
                $errorCode = $e->errorInfo[1];
                if($errorCode == '1062'){
                    return 'Nomor kontrak sudah ada!';
                }
            }
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
    public function reminder() //filter kontrak h-30 hari 
    {
        $data['customers'] = Customer::all();
        $data['kontraks'] = DB::table('kontrak')
        ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
        ->whereRaw('akhir_periode - INTERVAL 60 DAY <= NOW()')
        ->whereRaw('NOW() < akhir_periode')
        ->get();

        $now = Carbon\Carbon::now();
        $data['sisa'] = array();

        foreach ($data['kontraks'] as $key => $value) 
        {
            $sisa = $now->diffInDays($value->akhir_periode);
            array_push($data['sisa'],$sisa);

        }

        return view('admin/kontrak/reminder', $data);
    }
    public function endKontrak() //filter kontrak h-30 hari 
    {
        $data['customers'] = Customer::all();
        $data['kontraks'] = DB::table('kontrak')
        ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
        // ->whereRaw('akhir_periode - INTERVAL 60 DAY <= NOW()')
        ->whereRaw('NOW() > akhir_periode')
        ->get();
        //dd($data['kontraks']);

        // $now = Carbon\Carbon::now();
        // $data['sisa'] = array();
        // foreach ($data['kontraks'] as $key => $value) 
        // {
        //     $sisa = $now->diffInDays($value->akhir_periode);
        //     array_push($data['sisa'],$sisa);
        // }

        return view('admin/kontrak/endkontrak', $data);
    }

    public function insertmou($id_kontrak){
        $kontrak = Kontrak::findOrFail($id_kontrak);
 
        return view('admin/mou/insertmou')->with('kontrak',$kontrak);
    }

    public function rekontrak($id_kontrak){
        $kontrak = Kontrak::findOrFail($id_kontrak);
        $kontrak->closing = "Closed Rekontrak";
        if ($kontrak->save())
            return redirect()->route('insert.kontrak');
        // return view('admin/mou/insertmou', $data)->with('kontrak',$kontrak);
    }
}
