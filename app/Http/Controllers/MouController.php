<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use App\datamou;
use App\Kontrak;
use App\Customer;

class MouController extends Controller
{
    public function index()
    {
        $data['datamous'] = datamou::all();
        return view('admin/mou/mou', $data);
    }

    public function insert()
    {
        $data['kontraks'] = DB::table('kontrak')
        ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
        ->select('kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan','kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan','kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran','kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing')
        ->get();
        $data['customers'] = customer::all();
        return view('admin/mou/insertmou',$data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_kontrak'            => 'required|unique:datamou',
            'hc'                    => 'required|integer',
            'invoice'               => 'required|integer',
            'mf'                    => 'required|integer',
            'mf_persen'             => 'required|integer',
             //'bpjs_tenagakerja'   =>'nullable',
            // 'bpjs_kesehatan'     => 'required',
            // 'jiwasraya'          => 'required',
            // 'ramamusa'           =>'required',
            // 'ditagihkan'         => 'required',
            // 'diprovisasikan'     =>'required',
            'overheadcost'          => 'required',
            'training'              => 'required',
            'tanggal_invoice'       =>'required',
            'time_of_payment'       => 'required',
            'cut_of_date'           => 'required',
            'kaporlap'              =>'required',
            'devices'               => 'required',
            'chemical'              =>'required',
            'pendaftaran_mou'       => 'required',
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

        if ($datamou->save()){
            return redirect('/admin/insertmou')->with('success', 'item berhasil ditambahkan');
        }
        else{
            return redirect('/admin/insertmou')->with('error', 'item gagal ditambahkan');
        }
    }

    public function edit($no_mou)
    {
        $where = array('no_mou' => $no_mou);
        $datamou  = datamou::where($where)->first();
 
        return view('admin/mou/editmou')->with('datamou', $datamou);
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
        $datamou = datamou::findorFail($id);
        $request->validate([
            'id_kontrak' => 'required',
            'hc' => 'required',
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
            'pendaftaran_mou' => 'required',
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
        
        if ($datamou->save())
          return redirect()->route('index.datamou')->with(['success'=>'edit sukses']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($no_mou)
    {
        $datamou = datamou::where('no_mou',$no_mou)->delete();
        return redirect()->route('index.datamou')->with('success', 'delete sukses');
    }
}
