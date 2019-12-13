<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Foundation\Auth\User;
use App\Call;
use PDF;
use Validator;
use App\Exports\CallExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Customer;
use App\Bisnis_unit;
use App\Area;

class callController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['calls'] = DB::table('call')
        ->join('customer', 'call.kode_customer', '=', 'customer.kode_customer')
        ->select('customer.kode_customer','call.kode_customer','call_id','customer.nama_perusahaan','spv_pic','tanggal_call','jam_call','pembicaraan','pic_called','hal_menonjol')
        ->get();
        return view('officer/call', $data);
        
    }
    public function insert()
    {
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::where('status', 'Aktif')->get();
        $data['users'] = DB::table('users')
        ->join('area','users.area_id','=','area.area_id')
        ->where('rule', 'officer_crm')->get();
      return view('officer/insertcall',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'spv_pic' => 'required',
            'tanggal_call' => 'required|date',
            'jam_call' => 'required',
            'pembicaraan' => 'required',
            'pic_called' => 'required',
            'hal_menonjol' =>'required',
        ]);

        $call = new call;
        $call->call_id          = $request->call_id;
        $call->kode_customer    = $request->kode_customer;
        $call->spv_pic          = $request->spv_pic;
        $call->tanggal_call     = $request->tanggal_call;
        $call->jam_call         = $request->jam_call;
        $call->pembicaraan      = $request->pembicaraan;
        $call->pic_called       = $request->pic_called;
        $call->hal_menonjol     = $request->hal_menonjol;

        if ($call->save()){
            return redirect('/officer_crm/insertcall')->with('success', 'item berhasil ditambahkan');
        }
        else{
            return redirect('/officer_crm/insertcall')->with('error', 'item gagal ditambahkan');
        }
    }

    public function edit($call_id)
    {
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['customers'] = Customer::all();
        $data['users'] = DB::table('users')
        ->join('area','users.area_id','=','area.area_id')
        ->where('rule', 'officer_crm')->get();
        $call = Call::findOrFail($call_id);
 
        return view('officer/editcall',$data)->with('call', $call);
    }

    public function update(Request $request, $id)
    {
        $call   =   Call::findorFail($id);
        $this->validate($request,[
            'spv_pic'=>['required', 'string'],
            'tanggal_call'=>['required', 'date'],
            'jam_call'=>['required'],
            'pembicaraan'=>['required', 'string'],
            'pic_called'=>['required', 'string'],
            'hal_menonjol'=>['required', 'string']
          ]);
        
        $call->kode_customer    = $request->kode_customer;
        $call->spv_pic          = $request->spv_pic;
        $call->tanggal_call     = $request->tanggal_call;
        $call->jam_call         = $request->jam_call;
        $call->pembicaraan      = $request->pembicaraan;
        $call->pic_called       = $request->pic_called;
        $call->hal_menonjol     = $request->hal_menonjol;
  
        if ($call->save())
          return redirect()->route('index.call.officer')->with(['success'=>'edit sukses']);
    }

    public function destroy($call_id)
    {
        $call = Call::where('call_id',$call_id)->delete();
        return redirect()->route('index.call.officer')->with('success', 'delete sukses');
    }
    public function exportPDF()
	{
		$call = Call::all();
        $pdf = PDF::loadview('officer/pdfcall',['call'=>$call]);
        $pdf->setPaper('A4','landscape');
    	return $pdf->download('Laporan-Call-CRM.pdf');
    }
    public function monthFilter(Request $request){
        $month = $request->get('month');
        $year = $request->get('year');
            
        $call = Call::whereYear('tanggal_call', '=', $year)
                  ->whereMonth('tanggal_call', '=', $month)
                  ->get();
            
            
            return view('officer.call', ['call' => $call]);

    }

    public function exportExcel()
	{
		return Excel::download(new CallExport, 'Laporan-Call-CRM.xlsx');
    }
    public function filter(Request $request)
    {
      if($request->bu_id && $request->area_id)
      {
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['calls'] = Call::all();
        $data['calls'] = DB::table('call')
        ->join('customer', 'call.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('area.area_id','bisnis_unit.bu_id','customer.kode_customer','call.kode_customer','call_id','customer.nama_perusahaan','spv_pic','tanggal_call','jam_call',
        'pembicaraan','pic_called','hal_menonjol','bisnis_unit.nama_bisnis_unit')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->where('area.area_id', '=', $request->area_id)
        ->get();

        return view('officer/call', $data);
      }
      elseif ($request->bu_id) {
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['calls'] = Call::all();
        $data['calls'] = DB::table('call')
        ->join('customer', 'call.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('area.area_id','bisnis_unit.bu_id','customer.kode_customer','call.kode_customer','call_id','customer.nama_perusahaan','spv_pic','tanggal_call','jam_call',
        'pembicaraan','pic_called','hal_menonjol','bisnis_unit.nama_bisnis_unit')
        ->where('bisnis_unit.bu_id', '=', $request->bu_id)
        ->get();
        return view('officer/call', $data);

      } 
      elseif ($request->area_id) {
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['calls'] = Call::all();
        $data['calls'] = DB::table('call')
        ->join('customer', 'call.kode_customer', '=', 'customer.kode_customer')
        ->join('area','area.area_id','=','customer.area_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('area.area_id','bisnis_unit.bu_id','customer.kode_customer','call.kode_customer','call_id','customer.nama_perusahaan','spv_pic','tanggal_call','jam_call',
        'pembicaraan','pic_called','hal_menonjol','bisnis_unit.nama_bisnis_unit')
        ->where('area.area_id', '=', $request->area_id)
        ->get();
        return view('officer/call', $data);

      } 
    }
}
