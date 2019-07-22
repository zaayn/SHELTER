<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Call;
use Validator;

class callController extends Controller
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
        return view('officer/call', $data);
    }

    public function insert()
    {
      return view('officer/insertcall');
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
            return redirect('/insertcall')->with('success', 'item berhasil ditambahkan');
        }
        else{
            return redirect('/insertcall')->with('error', 'item gagal ditambahkan');
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
        $where = array('call_id' => $call_id);
        $call  = Call::where($where)->first();
 
        return view('officer/editcall');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $call_id)
    {
        $this->validate($request,[
            'nama_customer'=>['required', 'string'],
            'spv_pic'=>['required', 'string'],
            'tanggal_call'=>['required', 'date'],
            'jam_call'=>['required', 'time'],
            'pembicaraan'=>['required', 'string'],
            'pic_called'=>['required', 'string'],
            'hal_menonjol'=>['required', 'string']
          ]);
        $call   =   Call::findorFail(['call_id' => $callId],
                    ['nama_customer' => $request->nama_customer, 
                    'spv_pic' => $request->spv_pic,
                    'tanggal_call' => $request->tanggal_call, 
                    'jam_call' => $request->jam_call,
                    'pembicaraan' => $request->pembicaraan, 
                    'pic_called' => $request->pic_called,
                    'hal_menonjol' => $request->hal_menonjol
                    ]);
  
        if ($call->save())
          return redirect()->route('call.index')->with(['success'=>'edit sukses']);
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
        return redirect()->route('call.index')->with('success', 'delete sukses');
    }
}
