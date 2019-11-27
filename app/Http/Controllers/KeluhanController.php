<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
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
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->get();
        return view('officer/keluhan', $data);
        
    }

    public function insert()
    {
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::where('status','Aktif')->get();
        $data['users'] = DB::table('users')
        ->join('area','users.area_id','=','area.area_id')
        ->where('rule', 'officer_crm')
        ->get();
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
        $data['users'] = DB::table('users')
        ->join('area','users.area_id','=','area.area_id')
        ->where('rule', 'officer_crm')
        ->get();
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
    $keluhan = Keluhan::all();
      $pdf = PDF::loadview('officer/pdfkeluhan',['keluhan'=>$keluhan]);
      $pdf->setPaper('A4','landscape');
      return $pdf->download('Laporan-Keluhan-CRM.pdf');
    }
    public function filter(Request $request)
    {
      if($request->bu_id && $request->area_id)
      {
        $data['no'] = 1;
        $data['areas'] = area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('area.area_id','area.nama_area','id_keluhan','customer.kode_customer','customer.nama_perusahaan','keluhan.kode_customer','departemen','tanggal_keluhan',
        'topik_masalah','saran_penyelesaian','time_target','confirm_pic','case','actual_case','uraian_penyelesaian',
        'keluhan.status','bisnis_unit.bu_id','bisnis_unit.nama_bisnis_unit')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->where('area.area_id', '=', $request->area_id)
        ->get();

        return view('officer/keluhan', $data);
        
      }
      elseif($request->bu_id)
      {
        $data['no'] = 1;
        $data['areas'] = area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('area.area_id','area.nama_area','id_keluhan','customer.kode_customer','customer.nama_perusahaan','keluhan.kode_customer','departemen','tanggal_keluhan',
        'topik_masalah','saran_penyelesaian','time_target','confirm_pic','case','actual_case','uraian_penyelesaian',
        'keluhan.status','bisnis_unit.bu_id','bisnis_unit.nama_bisnis_unit')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->get();

        return view('officer/keluhan', $data);
        
      }
      elseif($request->area_id)
      {
        $data['no'] = 1;
        $data['areas'] = area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('area.area_id','area.nama_area','id_keluhan','customer.kode_customer','customer.nama_perusahaan','keluhan.kode_customer','departemen','tanggal_keluhan',
        'topik_masalah','saran_penyelesaian','time_target','confirm_pic','case','actual_case','uraian_penyelesaian',
        'keluhan.status','bisnis_unit.bu_id','bisnis_unit.nama_bisnis_unit')
        ->where('area.area_id', '=', $request->area_id)
        ->get();

        return view('officer/keluhan', $data);
        
      }
    }
}
