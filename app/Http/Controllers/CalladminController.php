<?php

namespace App\Http\Controllers;
//namespace App\Http\Controllers\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use App\Call;
use PDF;
use Validator;
use App\Exports\CallExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Customer;
use App\Bisnis_unit;
use App\Area;
use App\User;

class CalladminController extends Controller
{
    public function index()
    {
        $data['no'] = 1;
        $data['areas'] = Area::all();
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['calls'] = Call::all();

        return view('admin/call/call', $data);
    }
    public function filter(Request $request)
    {
      $data['no'] = 1;
      $data['areas'] = Area::all();
      $data['bisnis_units'] = Bisnis_unit::all();

      if($request->bu_id || $request->area_id || $request->from || $request->to){
        $calls = Call::whereHas('customer', function($query) use($request){
          if($request->bu_id)
            $query->where('bu_id',$request->bu_id);

          if($request->area_id)
            $query->where('area_id',$request->area_id);
          
          if($request->from || $request->to)
            $query->whereBetween('tanggal_call',[$request->from, $request->to]);

        });
      }
      $data['calls'] = $calls->get();
      return view('admin/call/call', $data);
    }

    // public function insert()
    // {
    //     $data['bisnis_units'] = Bisnis_unit::all();
    //     $data['customers'] = Customer::where('status', 'Aktif')->get();
    //     $data['users'] = User::where('rule','officer_crm')->get();
        
    //   return view('admin/call/insertcall',$data);
    // }

    // public function store(Request $request)
    // {
    //     $request->validate([
    //         // 'spv_pic' => 'required',
    //         'tanggal_call' => 'required|date',
    //         'jam_call' => 'required',
    //         'pembicaraan' => 'required',
    //         'pic_called' => 'required',
    //         'hal_menonjol' =>'required',
    //     ]);

    //     $call = new call;
    //     $call->call_id          = $request->call_id;
    //     $call->kode_customer    = $request->kode_customer;
    //     // $call->spv_pic          = $request->spv_pic;
    //     $call->tanggal_call     = $request->tanggal_call;
    //     $call->jam_call         = $request->jam_call;
    //     $call->pembicaraan      = $request->pembicaraan;
    //     $call->pic_called       = $request->pic_called;
    //     $call->hal_menonjol     = $request->hal_menonjol;

    //     if ($call->save()){
    //         return redirect('/admin/insertcall')->with('success', 'item berhasil ditambahkan');
    //     }
    //     else{
    //         return redirect('/admin/insertcall')->with('error', 'item gagal ditambahkan');
    //     }
    // }

    // public function edit($call_id)
    // {
    //     $data['bisnis_units'] = Bisnis_unit::all();
    //     $data['customers'] = Customer::all();
    //     $data['users'] = User::where('rule', 'officer_crm')->get();
    //     $call = Call::findOrFail($call_id);
 
    //     return view('admin/call/editcall',$data)->with('call', $call);
    // }

    // public function update(Request $request, $id)
    // {
    //     $call   =   Call::findorFail($id);
    //     $this->validate($request,[
    //         // 'spv_pic'=>['required', 'string'],
    //         'tanggal_call'=>['required', 'date'],
    //         'jam_call'=>['required'],
    //         'pembicaraan'=>['required', 'string'],
    //         'pic_called'=>['required', 'string'],
    //         'hal_menonjol'=>['required', 'string']
    //       ]);
        
    //     $call->kode_customer    = $request->kode_customer;
    //     // $call->spv_pic          = $request->spv_pic;
    //     $call->tanggal_call     = $request->tanggal_call;
    //     $call->jam_call         = $request->jam_call;
    //     $call->pembicaraan      = $request->pembicaraan;
    //     $call->pic_called       = $request->pic_called;
    //     $call->hal_menonjol     = $request->hal_menonjol;
  
    //     if ($call->save())
    //       return redirect()->route('index.call')->with(['success'=>'edit sukses']);
    // }

    // public function destroy($call_id)
    // {
    //     $call = Call::where('call_id',$call_id)->delete();
    //     return redirect()->route('index.call')->with('success', 'delete sukses');
    // }
    public function exportPDF(){
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
    public function exportExcel()
	  {
		  return Excel::download(new CallExport, 'Laporan-Call-CRM.xlsx');
    }
}
