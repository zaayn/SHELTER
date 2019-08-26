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


class KeluhanadminController extends Controller
{
    public function index()
    {
        $data['keluhans'] = Keluhan::all();
        return view('admin/keluhan/keluhan', $data);
    }

    public function insert()
    {
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
      return view('admin/keluhan/insertkeluhan',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function store(Request $request)
    {
        $request->validate([
            'nama_customer' => 'required',
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
        $keluhan->nama_customer = $request->nama_customer;
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id_keluhan)
    {
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
        $where = array('id_keluhan' => $id_keluhan);
        $keluhan  = Keluhan::where($where)->first();
 
        return view('admin/keluhan/editkeluhan',$data)->with('keluhan', $keluhan);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id_keluhan)
    {
        $keluhan = keluhan::findorFail($id_keluhan);
        $request->validate([
            'nama_customer' => 'required',
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

        $keluhan->nama_customer = $request->nama_customer;
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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
}
