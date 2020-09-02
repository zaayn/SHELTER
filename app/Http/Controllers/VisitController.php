<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use App\Exports\VisitOfficerExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Visit;
use Validator;
use PDF;
use App\Customer;
use App\Bisnis_unit;
use App\Area;
use App\User;

class VisitController extends Controller
{
    public function index()
    {
        $data['no'] = 1;
        // $data['areas'] = Area::all();
        // $data['bisnis_units'] = Bisnis_unit::all();
        $visit = Visit::whereHas('customer', function($query){
          $query->where('nama_depan', Auth::user()->nama_depan);
        });
        $data['visits'] = $visit->get();

        return view('officer/visit', $data);
    }
    public function filter(Request $request)
    {
      $data['no'] = 1;
      $data['areas'] = Area::all();
      $data['bisnis_units'] = Bisnis_unit::all();
      
      if($request->bu_id || $request->area_id){
        $visits = Visit::whereHas('customer', function($query) use($request){
          if($request->bu_id)
            $query->where('bu_id',$request->bu_id);

          if($request->area_id)
            $query->where('area_id',$request->area_id);
        });
      }
      $data['visits'] = $visits->get();
      return view('officer/visit', $data);
    }
    public function insert()
    {
        $data['bisnis_units'] = Bisnis_unit::all();
        // $data['customers'] = Customer::where('status', 'Aktif')->get();
        $data['customers'] = Customer::where('nama_depan', Auth::user()->nama_depan)->get();
        $data['users'] = User::where('rule', 'officer_crm')->get();

      return view('officer/insertvisit',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tanggal_visit' => 'required|date',
            'waktu_in' => 'required',
            'waktu_out' => 'required',
            'pic_meeted' => 'required',
            'kegiatan' =>'required',
        ]);

        $visit = new Visit;
        $visit->visit_id = $request->visit_id;
        $visit->kode_customer = $request->kode_customer;
        $visit->tanggal_visit = $request->tanggal_visit;
        $visit->waktu_in = $request->waktu_in;
        $visit->waktu_out = $request->waktu_out;
        $visit->pic_meeted = $request->pic_meeted;
        $visit->kegiatan = $request->kegiatan;

        if ($visit->save()){
            return redirect('/officer_crm/insertvisit')->with('success', 'item berhasil ditambahkan');
        }
        else{
            return redirect('/officer_crm/insertvisit')->with('error', 'item gagal ditambahkan');
        }
    }

    public function edit($visit_id)
    {
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();
        $data['users'] = User::where('rule', 'officer_crm')->get();
        $where = array('visit_id' => $visit_id);
        $visit  = Visit::where($where)->first();
 
        return view('officer/editvisit',$data)->with('visit', $visit);
    }

    public function update(Request $request, $visit_id)
    {
        $visit = visit::findorFail($visit_id);
        $request->validate([
            'tanggal_visit' => 'required|date',
            'waktu_in' => 'required',
            'waktu_out' => 'required',
            'pic_meeted' => 'required',
            'kegiatan' =>'required',
        ]);

        $visit->kode_customer = $request->kode_customer;
        $visit->tanggal_visit = $request->tanggal_visit;
        $visit->waktu_in = $request->waktu_in;
        $visit->waktu_out = $request->waktu_out;
        $visit->pic_meeted = $request->pic_meeted;
        $visit->kegiatan = $request->kegiatan;
        
        if ($visit->save())
          return redirect()->route('index.visit.officer')->with(['success'=>'edit sukses']);
    }

    public function destroy($visit_id)
    {
        $visit = Visit::where('visit_id',$visit_id)->delete();
        return redirect()->route('index.visit.officer')->with('success', 'delete sukses');
    }
    public function exportPDF(){
        $visit = Visit::whereHas('customer', function($query){
          $query->where('nama_depan', Auth::user()->nama_depan);
        })->get();
        $pdf = PDF::loadview('officer/pdfvisit',['visit'=>$visit]);
        $pdf->setPaper('A4','landscape');
    	return $pdf->download('Laporan-Visit-Officer-CRM.pdf');
    }
    public function exportExcel()
	  {
		return Excel::download(new VisitOfficerExport, 'Laporan-Visit-CRM-Officer.xlsx');
    }
}
