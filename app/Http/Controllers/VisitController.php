<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use App\Visit;
use Validator;
use PDF;

class VisitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['visit'] = Visit::orderBy('visit_id','desc');
        $data['visits'] = visit::all();

        return view('officer/visit', $data);
    }

    public function insert()
    {
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
      return view('officer/insertvisit',$data);
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
            'tanggal_visit' => 'required|date',
            'waktu_in' => 'required',
            'waktu_out' => 'required',
            'pic_meeted' => 'required',
            'kegiatan' =>'required',
        ]);

        $visit = new visit;
        $visit->visit_id = $request->visit_id;
        $visit->nama_customer = $request->nama_customer;
        $visit->spv_pic = $request->spv_pic;
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
    public function edit($visit_id)
    {
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
        $where = array('visit_id' => $visit_id);
        $visit  = Visit::where($where)->first();
 
        return view('officer/editvisit',$data)->with('visit', $visit);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $visit_id)
    {
        $visit = visit::findorFail($visit_id);
        $request->validate([
            'nama_customer' => 'required',
            'spv_pic' => 'required',
            'tanggal_visit' => 'required|date',
            'waktu_in' => 'required',
            'waktu_out' => 'required',
            'pic_meeted' => 'required',
            'kegiatan' =>'required',
        ]);

        $visit->nama_customer = $request->nama_customer;
        $visit->spv_pic = $request->spv_pic;
        $visit->tanggal_visit = $request->tanggal_visit;
        $visit->waktu_in = $request->waktu_in;
        $visit->waktu_out = $request->waktu_out;
        $visit->pic_meeted = $request->pic_meeted;
        $visit->kegiatan = $request->kegiatan;
        
        if ($visit->save())
          return redirect()->route('index.visit.officer')->with(['success'=>'edit sukses']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($visit_id)
    {
        $visit = Visit::where('visit_id',$visit_id)->delete();
        return redirect()->route('index.visit.officer')->with('success', 'delete sukses');
    }
    public function exportPDF(){
		$visit = Visit::all();
        $pdf = PDF::loadview('officer/pdfvisit',['visit'=>$visit]);
        $pdf->setPaper('A4','landscape');
    	return $pdf->download('Laporan-Visit-CRM.pdf');
    }
}
