<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\Bisnis_unit;
use App\Area;
use App\Wilayah;
use App\User;
use PDF;
use Excel;
use App\datamou;
use App\Exports\CustomerExport;


//test
class CustomerController extends Controller
{
    public function index()
    {  
      $data['wilayahs'] = Wilayah::all();
      $data['customers'] = DB::table('customer')
      ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
      ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
      ->select('customer.kode_customer','customer.nama_perusahaan','customer.jenis_usaha','nama_bisnis_unit','customer.alamat','customer.provinsi','customer.kabupaten','customer.telpon','customer.cp','customer.nama_area','wilayah.nama_wilayah','customer.nama_depan','status','jenis_perusahaan','negara')
      ->get();
        $data['no'] = 1;
        return view('admin/customer/customer', $data);
    }
    public function filter(Request $request)
    {
      if($request->status && $request->wilayah_id)
      {
        $data['wilayahs'] = Wilayah::all();
        $data['customers'] = DB::table('customer')
        ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('customer.kode_customer','customer.nama_perusahaan','customer.jenis_usaha','nama_bisnis_unit','customer.alamat','customer.provinsi','customer.kabupaten','customer.telpon','customer.cp','customer.nama_area','wilayah.nama_wilayah','customer.nama_depan','status','jenis_perusahaan','negara')
        ->where('customer.status', '=', $request->status)
        ->where('wilayah.wilayah_id', '=', $request->wilayah_id)->get();  
        $data['no'] = 1;
        return view('admin/customer/customer', $data);
      }
      if($request->wilayah_id)
      {
        $data['wilayahs'] = Wilayah::all();
        $data['customers'] = DB::table('customer')
        ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('customer.kode_customer','customer.nama_perusahaan','customer.jenis_usaha','nama_bisnis_unit','customer.alamat','customer.provinsi','customer.kabupaten','customer.telpon','customer.cp','customer.nama_area','wilayah.nama_wilayah','customer.nama_depan','status','jenis_perusahaan','negara')
        ->where('wilayah.wilayah_id', '=', $request->wilayah_id)->get();  
        $data['no'] = 1;
        return view('admin/customer/customer', $data);
      }
      
    }
    public function insert()
    {
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['areas'] = Area::all();
        $data['wilayahs'] = Wilayah::all();
        $data['users'] = DB::table('users')
        ->join('wilayah', 'users.wilayah_id', '=', 'wilayah.wilayah_id')
        ->select('wilayah.wilayah_id','users.nama_depan','wilayah.nama_wilayah')
        ->where('rule', 'officer_crm')->get();
        return view('/admin/customer/insert_customer',$data);
    }
    // public function __construct(Request $request){
    //   $this->request = $request;
    // }
    public function customerCode($str, $as_space = array('-'))
    {

        $str = str_replace($as_space, ' ', trim($str));
        $ret = '';
        foreach (explode(' ', $str) as $word) {
            $ret .= strtoupper($word[0]);
        }
        $numb = 1;
          $code = DB::table('customer')->select('kode_customer')->get();
          if($code->isEmpty())
          {
            return $ret. sprintf("%03s", $numb);
          }

            $no = DB::select('call store_p_cust(?)',[$ret]);
            $noo = $no[0]->jml;

              foreach($code as $cd){
                  if(Customer::find($cd->kode_customer) == null)
                  {
                    return $ret. sprintf("%03s", $numb);
                  }
                  if(Customer::find($cd->kode_customer)){
                    return $ret. sprintf("%03s", ++$noo);
                  }
                  //else return $ret. "001";                
              }
    }
    public function store(Request $request)
    {
      $code = DB::table('customer')->select('kode_customer')->get();
      //dd($code);
      
      $this->validate($request,[
        'nama_perusahaan'  =>['required', 'string']
        ,'jenis_usaha'      =>['required', 'string']
        ,'alamat'=>['required', 'string']
        ,'provinsi'=>['required', 'string']
        ,'kabupaten'=>['required', 'string']
        ,'telpon'=>['required', 'string']
        ,'fax'=>['required', 'string']
        ,'cp'=>['required', 'string']
        ,'negara'=>['required', 'string']
      ]);

      
      $customer = new Customer;
      
      $customer->nama_perusahaan    = $request->nama_perusahaan;
      $customer->kode_customer      = $this->customerCode($request->nama_perusahaan);
      $customer->jenis_usaha        = $request->jenis_usaha;
      $customer->bu_id              = $request->bu_id;
      $customer->alamat             = $request->alamat;
      $customer->provinsi           = $request->provinsi;
      $customer->kabupaten          = $request->kabupaten;
      $customer->telpon             = $request->telpon;
      $customer->fax                = $request->fax;
      $customer->cp                 = $request->cp;
      $customer->nama_area          = $request->nama_area;
      $customer->wilayah_id         = $request->wilayah_id;
      $customer->nama_depan         = $request->nama_depan;
      $customer->status             = $request->status;
      $customer->jenis_perusahaan   = $request->jenis_perusahaan;
      $customer->negara             = $request->negara;
      

      if ($customer->save()){
        return redirect('/admin/insert_customer')->with('success', 'item berhasil ditambahkan');
      }
      else{
        return redirect('admin/insert_customer')->with('error', 'item gagal ditambahkan');
      }
    }
    public function delete($kode_customer){
      $customer = Customer::findOrFail($kode_customer)->delete();
      return redirect()->route('index.customer')->with('success', 'delete sukses');
    }
    public function edit($kode_customer){
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['areas'] = Area::all();
        $data['wilayahs'] = Wilayah::all();
        $data['users'] = DB::table('users')->where('rule', 'officer_crm')->get();
        $customer = Customer::findOrFail($kode_customer);
        return view('admin/customer/edit_customer',$data)->with('customer', $customer);
    }

    public function update(Request $request, $id){
      $customer = Customer::findOrFail($id);
      $this->validate($request,[
        'jenis_usaha'      =>['required', 'string']
        ,'alamat'=>['required', 'string']
        ,'provinsi'=>['required', 'string']
        ,'kabupaten'=>['required', 'string']
        ,'telpon'=>['required', 'string']
        ,'fax'=>['required', 'string']
        ,'cp'=>['required', 'string']
        ,'negara'=>['required', 'string']
      ]);

      //$customer->kode_customer      = $request->kode_customer;
      //$customer->nama_perusahaan    = $request->nama_perusahaan;
      $customer->jenis_usaha        = $request->jenis_usaha;
      $customer->bu_id              = $request->bu_id;
      $customer->alamat             = $request->alamat;
      $customer->provinsi           = $request->provinsi;
      $customer->kabupaten          = $request->kabupaten;
      $customer->telpon             = $request->telpon;
      $customer->fax                = $request->fax;
      $customer->cp                 = $request->cp;
      $customer->nama_area          = $request->nama_area;
      $customer->wilayah_id         = $request->wilayah_id;
      $customer->nama_depan         = $request->nama_depan;
      $customer->status             = $request->status;
      $customer->jenis_perusahaan   = $request->jenis_perusahaan;
      $customer->negara             = $request->negara;
      

      if ($customer->save()){
        return redirect('/admin/customer')->with('success', 'item telah berhasil diupdate');
      }
      else{
        return redirect('admin/customer')->with('error', 'item gagal diupdate');
      }
    }

    public function exportPDF(){
        $customer = Customer::all();
        $pdf = PDF::loadview('admin/customer/pdfcustomer',['customer'=>$customer]);
        $pdf->setPaper('A4','landscape');
        return $pdf->download('Laporan-Customer-CRM.pdf');
    }
    public function exportExcel(){
		    return Excel::download(new CustomerExport, 'Laporan-Customer-CRM.xlsx');
    }
    public function aktivasi($id)
    {
      $customer = Customer::findOrFail($id);
      // dd($customer->status);
      if($customer->status == "aktif")
      {
        $customer->status = 'non_aktif';
      }
      elseif($customer->status == "non_aktif")
      {
        $customer->status = 'aktif';
      }
      if ($customer->save())
          return redirect()->route('index.customer')->with(['success'=>'reset aktifasi sukses']);
    }
    public function cust_type()
    {
      $data['no'] = 1;
      $data['customers'] = Customer::all();

      return view('/admin/cust_type', $data);
      
    }
    public function profile()
    {  
      $data['customers'] = Customer::all();
        $data['no'] = 1;
        return view('admin/customer/profile', $data);
    }
    public function filter_profile(Request $request)
    {  
      $data['datamous'] = Datamou::all();
      $data['customers'] = DB::table('customer')
      ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
      ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
      ->select('customer.kode_customer','customer.nama_perusahaan','customer.jenis_usaha','nama_bisnis_unit','customer.alamat','customer.provinsi','customer.kabupaten','customer.telpon','customer.cp','customer.nama_area','wilayah.nama_wilayah','customer.nama_depan','status','jenis_perusahaan','negara')
      ->where('customer.kode_customer', '=', $request->kode_customer)->get();  
      $data['kontraks'] = DB::table('kontrak')
      ->join('customer', 'customer.kode_customer', '=', 'kontrak.kode_customer')
      ->select('kontrak.id_kontrak','customer.kode_customer','customer.nama_perusahaan','kontrak.periode_kontrak','kontrak.akhir_periode','kontrak.srt_pemberitahuan','kontrak.tgl_srt_pemberitahuan','kontrak.srt_penawaran','kontrak.tgl_srt_penawaran','kontrak.dealing','kontrak.tgl_dealing','kontrak.posisi_pks','kontrak.closing')
      ->where('customer.kode_customer', '=', $request->kode_customer)->get();
      $data['no'] = 1;
      return view('admin/customer/profile2', $data);
    }

}