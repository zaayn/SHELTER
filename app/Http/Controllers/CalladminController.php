<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\DB;
use App\Call;
use PDF;
use Validator;
use App\Exports\CallExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Customer;
use App\bisnis_unit;

class CalladminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $data['calls'] = call::orderBy('call_id','desc');
        $data['calls'] = call::all();
        return view('admin/call/call', $data);
        
    }

    public function insert()
    {
        $data['bisnis_units'] = bisnis_unit::all();
        $data['customers'] = customer::all();
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
      return view('admin/call/insertcall',$data);
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
            'tanggal_call' => 'required|date',
            'jam_call' => 'required',
            'pembicaraan' => 'required',
            'pic_called' => 'required',
            'hal_menonjol' =>'required',
        ]);

        $call = new call;
        $call->call_id          = $request->call_id;
        $call->nama_customer    = $request->nama_customer;
        $call->spv_pic          = $request->spv_pic;
        $call->tanggal_call     = $request->tanggal_call;
        $call->jam_call         = $request->jam_call;
        $call->pembicaraan      = $request->pembicaraan;
        $call->pic_called       = $request->pic_called;
        $call->hal_menonjol     = $request->hal_menonjol;

        if ($call->save()){
            return redirect('/admin/insertcall')->with('success', 'item berhasil ditambahkan');
        }
        else{
            return redirect('/admin/insertcall')->with('error', 'item gagal ditambahkan');
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
    public function edit($call_id)
    {
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
        $call = Call::findOrFail($call_id);
 
        return view('admin/call/editcall',$data)->with('call', $call);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $call   =   Call::findorFail($id);
        $this->validate($request,[
            'nama_customer'=>['required', 'string'],
            'spv_pic'=>['required', 'string'],
            'tanggal_call'=>['required', 'date'],
            'jam_call'=>['required'],
            'pembicaraan'=>['required', 'string'],
            'pic_called'=>['required', 'string'],
            'hal_menonjol'=>['required', 'string']
          ]);
        
        $call->nama_customer    = $request->nama_customer;
        $call->spv_pic          = $request->spv_pic;
        $call->tanggal_call     = $request->tanggal_call;
        $call->jam_call         = $request->jam_call;
        $call->pembicaraan      = $request->pembicaraan;
        $call->pic_called       = $request->pic_called;
        $call->hal_menonjol     = $request->hal_menonjol;
  
        if ($call->save())
          return redirect()->route('index.call')->with(['success'=>'edit sukses']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($call_id)
    {
        $call = Call::where('call_id',$call_id)->delete();
        return redirect()->route('index.call')->with('success', 'delete sukses');
    }
    public function exportPDF()
	{
		$call = Call::all();
        $pdf = PDF::loadview('admin/call/pdfcall',['call'=>$call]);
        $pdf->setPaper('A4','landscape');
    	return $pdf->download('Laporan-Call-CRM.pdf');
    }
    public function monthFilter(Request $request){
        $month = $request->get('month');
        $year = $request->get('year');
            
        $call = Call::whereYear('tanggal_call', '=', $year)
                  ->whereMonth('tanggal_call', '=', $month)
                  ->get();
            
            
            return view('admin.call.call', ['call' => $call]);

    }
    public function customerCode($str, $as_space = array('-'))
    {
        $str = str_replace($as_space, ' ', trim($str));
        $ret = '';
        foreach (explode(' ', $str) as $word) {
            $ret .= strtoupper($word[0]);
        }
        return $ret;

    }
    //$phrase = 'Stack-Overflow Questions IT Tags Users Meta Example';
    // initialism($phrase);

    public function exportExcel()
	{
		return Excel::download(new CallExport, 'Laporan-Call-CRM.xlsx');
    }
}
