<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use App\Visit;
use Validator;
use PDF;
use Excel;
use App\Exports\VisitExport;
use App\Customer;
use App\Bisnis_unit;
use App\Wilayah;

class VisitadminController extends Controller
{
    public function index()
    {
        $data['no'] = 1;
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['visits'] = DB::table('visit')
        ->join('customer', 'visit.kode_customer', '=', 'customer.kode_customer')
        ->get();

        return view('/admin/visit/visit', $data);
    }

    public function insert()
    {
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
      return view('admin/visit/insertvisit',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'spv_pic' => 'required',
            'tanggal_visit' => 'required|date',
            'waktu_in' => 'required',
            'waktu_out' => 'required',
            'pic_meeted' => 'required',
            'kegiatan' =>'required',
        ]);

        $visit = new visit;
        $visit->visit_id = $request->visit_id;
        $visit->kode_customer = $request->kode_customer;
        $visit->spv_pic = $request->spv_pic;
        $visit->tanggal_visit = $request->tanggal_visit;
        $visit->waktu_in = $request->waktu_in;
        $visit->waktu_out = $request->waktu_out;
        $visit->pic_meeted = $request->pic_meeted;
        $visit->kegiatan = $request->kegiatan;

        if ($visit->save()){
            return redirect('/admin/insertvisit')->with('success', 'item berhasil ditambahkan');
        }
        else{
            return redirect('/admin/insertvisit')->with('error', 'item gagal ditambahkan');
        }
    }

    public function edit($visit_id)
    {
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
        $where = array('visit_id' => $visit_id);
        $visit  = visit::where($where)->first();
 
        return view('admin/visit/editvisit',$data)->with('visit', $visit);
    }

    public function update(Request $request, $visit_id)
    {
        $visit = Visit::findorFail($visit_id);
        $request->validate([
            'spv_pic' => 'required',
            'tanggal_visit' => 'required|date',
            'waktu_in' => 'required',
            'waktu_out' => 'required',
            'pic_meeted' => 'required',
            'kegiatan' =>'required',
        ]);

        $visit->kode_customer = $request->kode_customer;
        $visit->spv_pic = $request->spv_pic;
        $visit->tanggal_visit = $request->tanggal_visit;
        $visit->waktu_in = $request->waktu_in;
        $visit->waktu_out = $request->waktu_out;
        $visit->pic_meeted = $request->pic_meeted;
        $visit->kegiatan = $request->kegiatan;
        
        if ($visit->save())
          return redirect()->route('index.visit')->with(['success'=>'edit sukses']);
    }

    public function destroy($visit_id)
    {
        $visit = Visit::where('visit_id',$visit_id)->delete();
        return redirect()->route('index.visit')->with('success', 'delete sukses');
    }
    public function exportPDF(){
		$visit = Visit::all();
        $pdf = PDF::loadview('admin/visit/pdfvisit',['visit'=>$visit]);
        $pdf->setPaper('A4','landscape');
    	return $pdf->download('Laporan-Visit-CRM.pdf');
    }
    public function exportExcel(){
        return Excel::download(new VisitExport, 'Laporan-Visit-CRM.xlsx');
    }
    public function filter(Request $request)
    {
      if($request->bu_id && $request->wilayah_id)
      {
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['visits'] = DB::table('visit')
        ->join('customer', 'visit.kode_customer', '=', 'customer.kode_customer')
        ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
        ->get();

        return view('admin/visit/visit', $data);
      }
      elseif($request->bu_id)
      {
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['visits'] = DB::table('visit')
        ->join('customer', 'visit.kode_customer', '=', 'customer.kode_customer')
        ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->get();

        return view('admin/visit/visit', $data);
      }
      elseif($request->wilayah_id)
      {
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['visits'] = DB::table('visit')
        ->join('customer', 'visit.kode_customer', '=', 'customer.kode_customer')
        ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
        ->get();

        return view('admin/visit/visit', $data);
      }
    }
}
