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
use App\Wilayah;

class KontrakadminController extends Controller
{
    public function filter(Request $request)
    {
        if($request->bu_id && $request->wilayah_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
            ->orderBy('kontrak.id_kontrak','asc')
            ->get();

            foreach($data['kontraks'] as $key => $kontraa){
                $awok = DB::table('kontrak')
                ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
                ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
                ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
                ->join('datamou', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
                ->where('bisnis_unit.bu_id', '=', $request->bu_id)
                ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
                ->where('kontrak.id_kontrak', '=', $kontraa->id_kontrak)
                ->orderBy('kontrak.id_kontrak','asc')
                ->get();
                
                $data['kontraks'][$key]->datamou_flag = count($awok);
            }
            
            return view('admin/kontrak/kontrak', $data);
        }
    
        if($request->bu_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            // $data['kontraks'] = Kontrak::all();
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('bisnis_unit.bu_id', '=', $request->bu_id)
            ->get();
            foreach($data['kontraks'] as $key => $kontraa){
                $awok = DB::table('kontrak')
                ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
                ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
                ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
                ->join('datamou', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
                ->where('bisnis_unit.bu_id', '=', $request->bu_id)
                // ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
                ->where('kontrak.id_kontrak', '=', $kontraa->id_kontrak)
                ->orderBy('kontrak.id_kontrak','asc')
                ->get();
                
                $data['kontraks'][$key]->datamou_flag = count($awok);
            }
            return view('admin/kontrak/kontrak', $data);
        }
        if($request->wilayah_id)
        {
            $data['no'] = 1;
            $data['wilayahs'] = Wilayah::all();
            $data['bisnis_units'] = Bisnis_unit::all();
            $data['customers'] = Customer::all();
            // $data['kontraks'] = Kontrak::all();
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
            ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
            ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
            ->get();
            foreach($data['kontraks'] as $key => $kontraa){
                $awok = DB::table('kontrak')
                ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
                ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
                ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
                ->join('datamou', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
                // ->where('bisnis_unit.bu_id', '=', $request->bu_id)
                ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
                ->where('kontrak.id_kontrak', '=', $kontraa->id_kontrak)
                ->orderBy('kontrak.id_kontrak','asc')
                ->get();
                
                $data['kontraks'][$key]->datamou_flag = count($awok);
            }
            return view('admin/kontrak/kontrak', $data);
        }
    }
    public function index()
    {
        $data['no'] = 1;
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();  
        $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->get();
            foreach($data['kontraks'] as $key => $kontraa){
                $awok = DB::table('kontrak')
                ->join('datamou', 'datamou.id_kontrak', '=', 'kontrak.id_kontrak')
                ->where('kontrak.id_kontrak', '=', $kontraa->id_kontrak)
                ->get();
                
                $data['kontraks'][$key]->datamou_flag = count($awok);


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
        $request->validate([
            'nomor_kontrak' => 'required|unique',
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
        $kontrak->putus_kontrak = $request->putus_kontrak;

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

    public function edit($id_kontrak)
    {
        $where = array('id_kontrak' => $id_kontrak);
        $kontrak  = Kontrak::where($where)->first();
 
        return view('admin/kontrak/editkontrak')->with('kontrak', $kontrak);
    }
    public function putus_kontrak($id_kontrak)
    {
        $where = array('id_kontrak' => $id_kontrak);
        $kontrak  = Kontrak::where($where)->first();
 
        return view('admin/kontrak/putus_kontrak')->with('kontrak', $kontrak);
    }
    public function update_putus(Request $request, $id_kontrak)
    {
        $kontrak = Kontrak::findorFail($id_kontrak);
        $request->validate([
            'putus_kontrak' => 'required',
        ]);
        $kontrak->putus_kontrak = $request->putus_kontrak;
        $kontrak->dealing = "Sudah Deal";
        $kontrak->posisi_pks = "di Shelter";
        $kontrak->closing = "Closed";
        
        if ($kontrak->save())
          return redirect()->route('index.kontrak')->with(['success'=>'Closing Kontrak sukses']);
    }

    public function update(Request $request, $id_kontrak)
    {
        $kontrak = Kontrak::findorFail($id_kontrak);
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
        $kontrak->putus_kontrak = $request->putus_kontrak;
        
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
    public function reminder() //filter kontrak h-30 hari 
    {
            $data['customers'] = Customer::all();
            $data['kontraks'] = DB::table('kontrak')
            ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
            ->select('kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan',
            'kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan',
            'kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran',
            'kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing')
            ->whereRaw('akhir_periode < NOW() + INTERVAL 60 DAY') 
            ->get();
            return view('admin/kontrak/reminder', $data);
    }

    public function insertmou($id_kontrak){
        $kontrak = Kontrak::findOrFail($id_kontrak);
 
        return view('admin/mou/insertmou')->with('kontrak',$kontrak);
    }
}
