<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\datamou;

class KontrakController extends Controller
{
    public function index()
    {
        $data['datamous'] = Kontrak::orderBy('no_mou','desc');
        return view('officer/mou', $data);
    }

    public function insert()
    {
      return view('officer/insertmou');
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
            'no_mou' => 'required',
            'id_kontrak' => 'required',
            'hc' => 'required|date',
            'invoice' => 'required',
            'mf' => 'required',
            'mf_persen' => 'required',
            // 'bpjs_tenagakerja' =>'required',
            // 'bpjs_kesehatan' => 'required',
            // 'jiwasraya' => 'required',
            // 'ramamusa' =>'required',
            // 'ditagihkan' => 'required',
            // 'diprovisasikan' =>'required',
            'overheadcost' => 'required',
            'training' => 'required',
            'tanggal_invoice' =>'required',
            'time_of_payment' => 'required',
            'cut_of_date' => 'required',
            'kaporlap' =>'required',
            'devices' => 'required',
            'chemical' =>'required',
            'pendaftaran_mou' => 'required'
        ]);

        $datamou = new datamou;
        $datamou->no_mou = $request->no_mou;
        $datamou->id_kontrak = $request->id_kontrak;
        $datamou->hc = $request->hc;
        $datamou->invoice = $request->invoice;
        $datamou->mf = $request->mf;
        $datamou->mf_persen = $request->mf_persen;
        $datamou->bpjs_tenagakerja = $request->bpjs_tenagakerja;
        $datamou->bpjs_kesehatan = $request->bpjs_kesehatan;
        $datamou->jiwasraya = $request->jiwasraya;
        $datamou->ramamusa = $request->ramamusa;
        $datamou->ditagihkan = $request->ditagihkan;
        $datamou->diprovisasikan = $request->diprovisasikan;
        $datamou->overheadcost = $request->overheadcost;
        $datamou->training = $request->training;
        $datamou->tanggal_invoice = $request->tanggal_invoice;
        $datamou->time_of_payment = $request->time_of_payment;
        $datamou->cut_of_date = $request->cut_of_date;
        $datamou->kaporlap = $request->kaporlap;
        $datamou->devices = $request->devices;
        $datamou->chemical = $request->chemical;
        $datamou->pendaftaran_mou = $request->pendaftaran_mou;

        if ($kontrak->save()){
            return redirect('/insertmou')->with('success', 'item berhasil ditambahkan');
        }
        else{
            return redirect('/insertmou')->with('error', 'item gagal ditambahkan');
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
    public function edit($no_mou)
    {
        $where = array('no_mou' => $no_mou);
        $datamou  = datamou::where($where)->first();
 
        return view('officer/editmou');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $no_mou)
    {
        $datamou = datamou::findorFail($no_mou);
        $request->validate([
            'no_mou' => 'required',
            'id_kontrak' => 'required',
            'hc' => 'required|date',
            'invoice' => 'required',
            'mf' => 'required',
            'mf_persen' => 'required',
            // 'bpjs_tenagakerja' =>'required',
            // 'bpjs_kesehatan' => 'required',
            // 'jiwasraya' => 'required',
            // 'ramamusa' =>'required',
            // 'ditagihkan' => 'required',
            // 'diprovisasikan' =>'required',
            'overheadcost' => 'required',
            'training' => 'required',
            'tanggal_invoice' =>'required',
            'time_of_payment' => 'required',
            'cut_of_date' => 'required',
            'kaporlap' =>'required',
            'devices' => 'required',
            'chemical' =>'required',
            'pendaftaran_mou' => 'required'
        ]);

        $datamou->hc = $request->hc;
        $datamou->invoice = $request->invoice;
        $datamou->mf = $request->mf;
        $datamou->mf_persen = $request->mf_persen;
        $datamou->bpjs_tenagakerja = $request->bpjs_tenagakerja;
        $datamou->bpjs_kesehatan = $request->bpjs_kesehatan;
        $datamou->jiwasraya = $request->jiwasraya;
        $datamou->ramamusa = $request->ramamusa;
        $datamou->ditagihkan = $request->ditagihkan;
        $datamou->diprovisasikan = $request->diprovisasikan;
        $datamou->overheadcost = $request->overheadcost;
        $datamou->training = $request->training;
        $datamou->tanggal_invoice = $request->tanggal_invoice;
        $datamou->time_of_payment = $request->time_of_payment;
        $datamou->cut_of_date = $request->cut_of_date;
        $datamou->kaporlap = $request->kaporlap;
        $datamou->devices = $request->devices;
        $datamou->chemical = $request->chemical;
        $datamou->pendaftaran_mou = $request->pendaftaran_mou;
        
        if ($kontrak->save())
          return redirect()->route('mou.index')->with(['success'=>'edit sukses']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($no_mou)
    {
        $kontrak = Kontrak::where('id_kontrak',$id_kontrak)->delete();
        return redirect()->route('mou.index')->with('success', 'delete sukses');
    }
}
