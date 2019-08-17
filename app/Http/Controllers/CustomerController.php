<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Customer;
use App\bisnis_unit;
use App\area;
use App\wilayah;
use App\User;
use PDF;
use Excel;
use App\Exports\CustomerExport;


//test
class CustomerController extends Controller
{
    public function index()
    {  
      $data['customers'] = DB::table('customer')
      ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
      ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
      ->select('customer.kode_customer','customer.nama_perusahaan','customer.jenis_usaha','nama_bisnis_unit','customer.alamat','customer.provinsi','customer.kabupaten','customer.telpon','customer.cp','customer.nama_area','wilayah.nama_wilayah','customer.nama_depan','status')
      ->get();
        $data['no'] = 1;
        return view('admin/customer/customer', $data);
    }
    public function filter(Request $request)
    {
      $data['customers'] = DB::table('customer')
        ->join('wilayah', 'customer.wilayah_id', '=', 'wilayah.wilayah_id')
        ->join('bisnis_unit', 'customer.bu_id', '=', 'bisnis_unit.bu_id')
        ->select('customer.kode_customer','customer.nama_perusahaan','customer.jenis_usaha','nama_bisnis_unit','customer.alamat','customer.provinsi','customer.kabupaten','customer.telpon','customer.cp','customer.nama_area','wilayah.nama_wilayah','customer.nama_depan','status')
        ->where('customer.status', '=', $request->status)->get();  
        $data['no'] = 1;
        return view('admin/customer/customer', $data);
    }
    public function insert()
    {
        $data['bisnis_units'] = bisnis_unit::all();
        $data['areas'] = area::all();
        $data['wilayahs'] = wilayah::all();
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
        $numb = 0;
          $code = DB::table('customer')->select('kode_customer')->get();

                $no = DB::select('call store_p_cust(?)',[$ret]);
                $noo = $no[0]->jml;
  
   
              //dd($code);
              foreach($code as $cd){
                //dd($cd);
               
                  if($code->isEmpty() || Customer::find($cd->kode_customer) == null){
                    //$numb = sprintf("%03s", $numb);
                    
                    return $ret. sprintf("%03s", $numb);
                  }
                  elseif(Customer::find($cd->kode_customer)){
                    //$numb = sprintf("%03s", ++$noo);
                    return $ret. sprintf("%03s", ++$noo);
                  }
                
                else return $ret. "001";
                //dd($numb);
                
              }
             
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'nama_perusahaan'  =>['required', 'string']
        ,'jenis_usaha'      =>['required', 'string']
        ,'alamat'=>['required', 'string']
        ,'provinsi'=>['required', 'string']
        ,'kabupaten'=>['required', 'string']
        ,'telpon'=>['required', 'string']
        ,'fax'=>['required', 'string']
        ,'cp'=>['required', 'string']
      ]);

      
      $customer = new customer;
      
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
      

      if ($customer->save()){
        return redirect('/admin/insert_customer')->with('success', 'item berhasil ditambahkan');
      }
      else{
        return redirect('admin/insert_customer')->with('error', 'item gagal ditambahkan');
      }
    }
    public function delete($kode_customer){
      $customer = customer::findOrFail($kode_customer)->delete();
      return redirect()->route('index.customer')->with('success', 'delete sukses');
    }
    public function edit($kode_customer){
        $data['bisnis_units'] = bisnis_unit::all();
        $data['areas'] = area::all();
        $data['wilayahs'] = wilayah::all();
        $data['users'] = DB::table('users')->where('rule', 'officer_crm')->get();
        $customer = customer::findOrFail($kode_customer);
        return view('admin/customer/edit_customer',$data)->with('customer', $customer);
    }

    public function update(Request $request, $id){
      $customer = customer::findOrFail($id);
      $this->validate($request,[
        'jenis_usaha'      =>['required', 'string']
        ,'alamat'=>['required', 'string']
        ,'provinsi'=>['required', 'string']
        ,'kabupaten'=>['required', 'string']
        ,'telpon'=>['required', 'string']
        ,'fax'=>['required', 'string']
        ,'cp'=>['required', 'string']
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
      $customer = customer::findOrFail($id);
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
      $data['customers'] = DB::table('customer')
      ->select('customer.nama_perusahaan','kontrak.periode_kontrak','kontrak.akhir_periode')
      ->join('kontrak', 'customer.kode_customer', '=', 'kontrak.kode_customer')
      ->distinct()
      ->get();
             //dd($data['customers']);

             $customer = DB::table('customer')->select('kode_customer')->get();
      
             foreach($customer as $cust){
               //dd($cust);
               $periode_awal = DB::select('call store_p_awal(?)',[$cust->kode_customer]);
               $periode_akhir = DB::select('call store_p_akhir(?)',[$cust->kode_customer]);
               //dd($periode_awal[0]->prd);
             }

      foreach ($data['customers'] as $customer)
      {
          $to = \Carbon\Carbon::createFromFormat('Y-m-d',$customer->periode_kontrak);
          $from = \Carbon\Carbon::createFromFormat('Y-m-d',$customer->akhir_periode);
          $diff_in_days = $to->diffInMonths($from);
          $data['lama'] =+ $diff_in_days;

          //$awal = DB::select('')
        
         //dd($data['lama']);
        if($data['lama'] < 24)
        {
            $data['lama'] = "Silver";
        }
        if($data['lama'] >= 24 && $data['lama'] < 60)
        {
           $data['lama'] = "Gold";
        }
        if($data['lama'] >= 60)
        {
            $data['lama'] = "Platinum";
        }
      }
      return view('/admin/cust_type',$data);
      
    }
}