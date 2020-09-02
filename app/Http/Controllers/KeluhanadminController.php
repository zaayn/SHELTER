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
use App\Bisnis_unit;
use App\Area;
use App\User;


class KeluhanadminController extends Controller
{
    public function index()
    {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = Keluhan::all();
        return view('admin/keluhan/keluhan', $data);
    }
    public function filter(Request $request)
    {
      $data['no'] = 1;
      $data['areas'] = Area::all();
      $data['bisnis_units'] = Bisnis_unit::all();
      
      if($request->bu_id || $request->area_id || $request->from || $request->to){
        $keluhans = Keluhan::whereHas('customer', function($query) use($request){
          if($request->bu_id)
            $query->where('bu_id',$request->bu_id);

          if($request->area_id)
            $query->where('area_id',$request->area_id);
          
          if($request->from || $request->to)
            $query->whereBetween('tanggal_keluhan',[$request->from, $request->to]);
        });
      }

      if($request->status)
        if(@$keluhans)
          $keluhans = $keluhans->where('status', $request->status);
        else
          $keluhans = Keluhan::where('status', $request->status);

      $data['keluhans'] = $keluhans->get();
       
      return view('admin/keluhan/keluhan', $data);
    }
    public function keluhan_belum_ditangani()
    {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['keluhans'] = Keluhan::where('status','Belum ditangani')->get();

        return view('admin/keluhan/keluhan_belum_ditangani', $data);
    }

    // public function insert()
    // {
    //     $data['bisnis_units'] = Bisnis_unit::all();
    //     $data['customers'] = Customer::where('status','Aktif')->get();
    //     $data['users'] = User::where('rule', 'officer_crm')->get();
    //   return view('admin/keluhan/insertkeluhan',$data);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         'departemen' => 'required',
    //         'tanggal_keluhan' => 'required|date',
    //         'topik_masalah' => 'required',
    //         'saran_penyelesaian' => 'required',
    //         'time_target' => 'required',
    //         'case' =>'required',
    //         'uraian_penyelesaian' => 'required',
    //         'status' =>'required',
    //     ]);

    //     $keluhan = new Keluhan;
    //     $keluhan->id_keluhan = $request->id_keluhan;
    //     $keluhan->kode_customer = $request->kode_customer;
    //     $keluhan->departemen = $request->departemen;
    //     $keluhan->tanggal_keluhan = $request->tanggal_keluhan;
    //     $keluhan->topik_masalah = $request->topik_masalah;
    //     $keluhan->saran_penyelesaian = $request->saran_penyelesaian;
    //     $keluhan->time_target = $request->time_target;
    //     $keluhan->confirm_pic = $request->confirm_pic;
    //     $keluhan->case = $request->case;
    //     $keluhan->actual_case = $request->actual_case;
    //     $keluhan->uraian_penyelesaian = $request->uraian_penyelesaian;
    //     $keluhan->status = $request->status;

    //     if ($keluhan->save()){
    //         return redirect('/admin/insertkeluhan')->with('success', 'item berhasil ditambahkan');
    //     }
    //     else{
    //         return redirect('/admin/insertkeluhan')->with('error', 'item gagal ditambahkan');
    //     }
    // }

    // public function edit($id_keluhan)
    // {
    //     $data['bisnis_units'] = Bisnis_unit::all();
    //     $data['customers'] = Customer::all();
    //     $data['users'] = User::where('rule', 'officer_crm')->get();
    //     $where = array('id_keluhan' => $id_keluhan);
    //     $keluhan  = Keluhan::where($where)->first();
 
    //     return view('admin/keluhan/editkeluhan',$data)->with('keluhan', $keluhan);
    // }

    // public function update(Request $request, $id_keluhan)
    // {
    //     $keluhan = Keluhan::findorFail($id_keluhan);
    //     $request->validate([
    //         'departemen' => 'required',
    //         'tanggal_keluhan' => 'required|date',
    //         'topik_masalah' => 'required',
    //         'saran_penyelesaian' => 'required',
    //         'time_target' => 'required',
    //         'case' =>'required',
    //         'uraian_penyelesaian' => 'required',
    //         'status' =>'required',
    //     ]);

    //     $keluhan->kode_customer = $request->kode_customer;
    //     $keluhan->departemen = $request->departemen;
    //     $keluhan->topik_masalah = $request->topik_masalah;
    //     $keluhan->saran_penyelesaian = $request->saran_penyelesaian;
    //     $keluhan->time_target = $request->time_target;
    //     $keluhan->confirm_pic = $request->confirm_pic;
    //     $keluhan->case = $request->case;
    //     $keluhan->actual_case = $request->actual_case;
    //     $keluhan->uraian_penyelesaian = $request->uraian_penyelesaian;
    //     $keluhan->status = $request->status;
        
    //     if ($keluhan->save())
    //       return redirect()->route('index.keluhan')->with(['success'=>'edit sukses']);
    // }

    // public function destroy($id_keluhan)
    // {
    //     $keluhan = Keluhan::where('id_keluhan',$id_keluhan)->delete();
    //     return redirect()->route('index.keluhan')->with('success', 'delete sukses');
    // }
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
      $keluhan = Keluhan::findOrFail($id);
      // dd($customer->status);
      if($keluhan->status == "Belum ditangani")
      {
        $keluhan->status = 'Sudah ditangani';
      }
     
      if ($keluhan->save())
          return redirect()->route('index.keluhan')->with(['success'=>'keluhan sukses ditangani']);
    }
}
