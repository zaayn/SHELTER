<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use App\Exports\KeluhanOfficerExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Keluhan;
use App\User;
use PDF;
use App\Customer;
use App\Bisnis_unit;
use App\Area;

class KeluhanController extends Controller
{
    public function index()
    {
        $data['no'] = 1;
        // $data['areas'] = Area::all();
        // $data['bisnis_units'] = Bisnis_unit::all();
        $keluhan = Keluhan::whereHas('customer', function($query){
          $query->where('nama_depan', Auth::user()->nama_depan);
        });
        $data['keluhans'] = $keluhan->get();
        
        return view('officer/keluhan', $data);
    }
    public function filter(Request $request)
    {
      $data['no'] = 1;
      $data['areas'] = Area::all();
      $data['bisnis_units'] = Bisnis_unit::all();
      
      if($request->bu_id || $request->area_id){
        $keluhans = Keluhan::whereHas('customer', function($query) use($request){
          if($request->bu_id)
            $query->where('bu_id',$request->bu_id);

          if($request->area_id)
            $query->where('area_id',$request->area_id);
        });
      }

      if($request->status)
        if(@$keluhans)
          $keluhans = $keluhans->where('status', $request->status);
        else
          $keluhans = Keluhan::where('status', $request->status);

      $data['keluhans'] = $keluhans->get();
       
      return view('officer/keluhan', $data);
    }
    public function insert()
    {
        $data['bisnis_units'] = Bisnis_unit::all();
        // $data['customers'] = Customer::where('status','Aktif')->get();
        $data['customers'] = Customer::where('nama_depan', Auth::user()->nama_depan)->get();
        $data['users'] = User::where('rule', 'officer_crm')->get();
        
        return view('officer/insertkeluhan',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'departemen' => 'required',
            'tanggal_keluhan' => 'required|date',
            'topik_masalah' => 'required',
            'saran_penyelesaian' => 'required',
            'time_target' => 'required',
            'confirm_pic' => 'required',
            'case' =>'required',
            'actual_case' => 'required',
            'uraian_penyelesaian' => 'required',
            'status' =>'required',
        ]);

        $keluhan = new keluhan;
        $keluhan->id_keluhan = $request->id_keluhan;
        $keluhan->kode_customer = $request->kode_customer;
        $keluhan->departemen = $request->departemen;
        $keluhan->tanggal_keluhan = $request->tanggal_keluhan;
        $keluhan->topik_masalah = $request->topik_masalah;
        $keluhan->saran_penyelesaian = $request->saran_penyelesaian;
        $keluhan->time_target = $request->time_target;
        $keluhan->confirm_pic = $request->confirm_pic;
        $keluhan->case = $request->case;
        $keluhan->actual_case = $request->actual_case;
        $keluhan->uraian_penyelesaian = $request->uraian_penyelesaian;
        $keluhan->status = $request->status;

            if ($keluhan->save()){
                return redirect('/officer_crm/insertkeluhan')->with('success', 'item berhasil ditambahkan');
            }
            else{
                return redirect('/officer_crm/insertkeluhan')->with('error', 'item gagal ditambahkan');
            }   
    }

    public function edit($id_keluhan)
    {
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();
        $data['users'] = User::where('rule', 'officer_crm')->get();
        $where = array('id_keluhan' => $id_keluhan);
        $keluhan  = Keluhan::where($where)->first();

        return view('officer/editkeluhan',$data)->with('keluhan', $keluhan);      
    }

    public function update(Request $request, $id_keluhan)
    {
        $keluhan = Keluhan::findorFail($id_keluhan);
        $request->validate([
            'departemen' => 'required',
            'tanggal_keluhan' => 'required|date',
            'topik_masalah' => 'required',
            'saran_penyelesaian' => 'required',
            'time_target' => 'required',
            'confirm_pic' => 'required',
            'case' =>'required',
            'actual_case' => 'required',
            'uraian_penyelesaian' => 'required',
            'status' =>'required',
        ]);

        $keluhan->kode_customer = $request->kode_customer;
        $keluhan->departemen = $request->departemen;
        $keluhan->topik_masalah = $request->topik_masalah;
        $keluhan->saran_penyelesaian = $request->saran_penyelesaian;
        $keluhan->time_target = $request->time_target;
        $keluhan->confirm_pic = $request->confirm_pic;
        $keluhan->case = $request->case;
        $keluhan->actual_case = $request->actual_case;
        $keluhan->uraian_penyelesaian = $request->uraian_penyelesaian;
        $keluhan->status = $request->status;
        
        if ($keluhan->save())
          return redirect()->route('index.keluhan.officer')->with(['success'=>'edit sukses']);
    }

    public function destroy($id_keluhan)
    {
        $keluhan = Keluhan::where('id_keluhan',$id_keluhan)->delete();
        return redirect()->route('index.keluhan.officer')->with('success', 'delete sukses');
    }
    public function exportPDF(){
      $keluhan = Keluhan::whereHas('customer', function($query){
        $query->where('nama_depan', Auth::user()->nama_depan);
      })->get();
      $pdf = PDF::loadview('officer/pdfkeluhan',['keluhan'=>$keluhan]);
      $pdf->setPaper('A4','landscape');
      return $pdf->download('Laporan-Keluhan-CRM.pdf');
    }
    public function exportExcel()
	  {
		return Excel::download(new KeluhanOfficerExport, 'Laporan-Keluhan-CRM-Officer.xlsx');
    }
}
