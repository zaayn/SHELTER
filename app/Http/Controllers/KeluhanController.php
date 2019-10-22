<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use App\Keluhan;
use PDF;
use App\Customer;
use App\Bisnis_unit;
use App\Wilayah;

class KeluhanController extends Controller
{
    public function index()
    {
      $data['no'] = 1;
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->select('id_keluhan','customer.kode_customer','customer.nama_perusahaan','keluhan.kode_customer','spv_pic','tanggal_keluhan','jam_keluhan','keluhan','pic','jam_follow','follow_up','closing_case','via','keluhan.status')
        ->get();
        return view('officer/keluhan', $data);
        
    }

    public function insert()
    {
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::where('status','Aktif')->get();
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
        return view('officer/insertkeluhan',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'spv_pic' => 'required',
            'tanggal_keluhan' => 'required|date',
            'jam_keluhan' => 'required',
            'keluhan' => 'required',
            'pic' => 'required',
            'jam_follow' => 'required',
            'follow_up' =>'required',
            'closing_case' => 'required',
            'via' => 'required',
            'status' =>'required',
        ]);

        $keluhan = new keluhan;
        $keluhan->id_keluhan = $request->id_keluhan;
        $keluhan->kode_customer = $request->kode_customer;
        $keluhan->spv_pic = $request->spv_pic;
        $keluhan->tanggal_keluhan = $request->tanggal_keluhan;
        $keluhan->jam_keluhan = $request->jam_keluhan;
        $keluhan->keluhan = $request->keluhan;
        $keluhan->pic = $request->pic;
        $keluhan->jam_follow = $request->jam_follow;
        $keluhan->follow_up = $request->follow_up;
        $keluhan->closing_case = $request->closing_case;
        $keluhan->via = $request->via;
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
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
        $where = array('id_keluhan' => $id_keluhan);
        $keluhan  = Keluhan::where($where)->first();

        return view('officer/editkeluhan',$data)->with('keluhan', $keluhan);      
    }

    public function update(Request $request, $id_keluhan)
    {
        $keluhan = Keluhan::findorFail($id_keluhan);
        $request->validate([
            'spv_pic' => 'required',
            'tanggal_keluhan' => 'required|date',
            'jam_keluhan' => 'required',
            'keluhan' => 'required',
            'pic' => 'required',
            'jam_follow' => 'required',
            'follow_up' =>'required',
            'closing_case' => 'required',
            'via' => 'required',
            'status' =>'required',
        ]);

        $keluhan->kode_customer = $request->kode_customer;
        $keluhan->spv_pic = $request->spv_pic;
        $keluhan->jam_keluhan = $request->jam_keluhan;
        $keluhan->keluhan = $request->keluhan;
        $keluhan->pic = $request->pic;
        $keluhan->jam_follow = $request->jam_follow;
        $keluhan->follow_up = $request->follow_up;
        $keluhan->closing_case = $request->closing_case;
        $keluhan->via = $request->via;
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
      if($request->bu_id && $request->wilayah_id)
      {
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('wilayah.wilayah_id','wilayah.nama_wilayah','id_keluhan','customer.kode_customer','customer.nama_perusahaan','keluhan.kode_customer','spv_pic','tanggal_keluhan',
        'jam_keluhan','keluhan','pic','jam_follow','follow_up','closing_case','via',
        'keluhan.status','bisnis_unit.bu_id','bisnis_unit.nama_bisnis_unit')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
        ->get();

        return view('officer/keluhan', $data);
        
      }
      elseif($request->bu_id)
      {
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('wilayah.wilayah_id','wilayah.nama_wilayah','id_keluhan','customer.kode_customer','customer.nama_perusahaan','keluhan.kode_customer','spv_pic','tanggal_keluhan',
        'jam_keluhan','keluhan','pic','jam_follow','follow_up','closing_case','via',
        'keluhan.status','bisnis_unit.bu_id','bisnis_unit.nama_bisnis_unit')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->get();

        return view('officer/keluhan', $data);
        
      }
      elseif($request->wilayah_id)
      {
        $data['wilayahs'] = Wilayah::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->join('wilayah','wilayah.wilayah_id','=','customer.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('wilayah.wilayah_id','wilayah.nama_wilayah','id_keluhan','customer.kode_customer','customer.nama_perusahaan','keluhan.kode_customer','spv_pic','tanggal_keluhan',
        'jam_keluhan','keluhan','pic','jam_follow','follow_up','closing_case','via',
        'keluhan.status','bisnis_unit.bu_id','bisnis_unit.nama_bisnis_unit')
        ->where('wilayah.wilayah_id', '=', $request->wilayah_id)
        ->get();

        return view('officer/keluhan', $data);
        
      }
    }
}
