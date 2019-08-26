<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Keluhan;
use PDF;

class KeluhanController extends Controller
{
    public function index()
    {
        //dd(Auth::user()->rule);
        $data['keluhans'] = Keluhan::all();
        // if(Auth::user()->rule == 'admin'){
        //     return view('admin/keluhan/keluhan', $data);
        // }
        // elseif(Auth::user()->rule == 'officer_crm'){
        //     return view('officer/keluhan', $data);
        // }
        return view('officer/keluhan', $data);
        
    }

    public function insert()
    {
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
        return view('officer/insertkeluhan',$data);
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

        
        // if (Auth::user()->rule == 'admin') {
        //     if ($keluhan->save()){
        //         return redirect('/admin/insertkeluhan')->with('success', 'item berhasil ditambahkan');
        //     }
        //     else{
        //         return redirect('/admin/insertkeluhan')->with('error', 'item gagal ditambahkan');
        //     }
        // }
        // elseif (Auth::user()->rule == 'officer_crm') {
            if ($keluhan->save()){
                return redirect('/officer_crm/insertkeluhan')->with('success', 'item berhasil ditambahkan');
            }
            else{
                return redirect('/officer_crm/insertkeluhan')->with('error', 'item gagal ditambahkan');
            }
        //}
            
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
        
        // if(Auth::user()->rule == 'admin'){
        //     return view('admin/keluhan/editkeluhan')->with('keluhan', $keluhan);
        // }
        // if(Auth::user()->rule == 'officer_crm'){
        //     return view('officer/editkeluhan')->with('keluhan', $keluhan);
        // }
        return view('officer/editkeluhan',$data)->with('keluhan', $keluhan);
        
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
          return redirect()->route('index.keluhan.officer')->with(['success'=>'edit sukses']);
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
        return redirect()->route('index.keluhan.officer')->with('success', 'delete sukses');
    }
    public function exportPDF(){
    $keluhan = Keluhan::all();
      $pdf = PDF::loadview('officer/pdfkeluhan',['keluhan'=>$keluhan]);
      $pdf->setPaper('A4','landscape');
      return $pdf->download('Laporan-Keluhan-CRM.pdf');
    }
}
