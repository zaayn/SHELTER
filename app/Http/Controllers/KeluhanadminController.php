<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use App\Keluhan;
use PDF;
use Excel;
use App\Exports\KeluhanExport;
use App\Customer;
use App\bisnis_unit;


class KeluhanadminController extends Controller
{
    public function index()
    {
        $data['keluhans'] = DB::table('keluhan')
        ->join('customer', 'keluhan.kode_customer', '=', 'customer.kode_customer')
        ->select('id_keluhan','customer.kode_customer','customer.nama_perusahaan','keluhan.kode_customer','spv_pic','tanggal_keluhan','jam_keluhan','keluhan','pic','jam_follow','follow_up','closing_case','via','keluhan.status')
        ->get();
        return view('admin/keluhan/keluhan', $data);
    }

    public function insert()
    {
        $data['bisnis_units'] = bisnis_unit::all();
        $data['customers'] = customer::all();
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
      return view('admin/keluhan/insertkeluhan',$data);
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
            return redirect('/admin/insertkeluhan')->with('success', 'item berhasil ditambahkan');
        }
        else{
            return redirect('/admin/insertkeluhan')->with('error', 'item gagal ditambahkan');
        }
    }

    public function edit($id_keluhan)
    {
        $data['bisnis_units'] = bisnis_unit::all();
        $data['customers'] = customer::all();
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
        $where = array('id_keluhan' => $id_keluhan);
        $keluhan  = Keluhan::where($where)->first();
 
        return view('admin/keluhan/editkeluhan',$data)->with('keluhan', $keluhan);
    }

    public function update(Request $request, $id_keluhan)
    {
        $keluhan = keluhan::findorFail($id_keluhan);
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
          return redirect()->route('index.keluhan')->with(['success'=>'edit sukses']);
    }

    public function destroy($id_keluhan)
    {
        $keluhan = Keluhan::where('id_keluhan',$id_keluhan)->delete();
        return redirect()->route('index.keluhan')->with('success', 'delete sukses');
    }
    public function exportPDF(){
        $keluhan = Keluhan::all();
      $pdf = PDF::loadview('admin/keluhan/pdfkeluhan',['keluhan'=>$keluhan]);
      $pdf->setPaper('A4','landscape');
      return $pdf->download('Laporan-Keluhan-CRM.pdf');
    }
    public function exportExcel(){
        return Excel::download(new KeluhanExport, 'Laporan-Keluhan-CRM.xlsx');
    }
    public function aktivasi($id){
      $keluhan = keluhan::findOrFail($id);
      // dd($customer->status);
      if($keluhan->status == "Belum ditangani")
      {
        $keluhan->status = 'Sudah ditangani';
      }
     
      if ($keluhan->save())
          return redirect()->route('index.keluhan')->with(['success'=>'keluhan sukses ditangani']);
    }
}
