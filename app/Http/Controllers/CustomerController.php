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
//test
class CustomerController extends Controller
{
    public function index()
    {  
        $data['customers'] = customer::all();
        $data['no'] = 1;
        return view('admin/customer/customer', $data);
    }
    public function insert()
    {
        $data['bisnis_units'] = bisnis_unit::all();
        $data['areas'] = area::all();
        $data['wilayahs'] = wilayah::all();
        $data['users'] = DB::table('users')->where('rule', 'officer_crm')->get();
        return view('/admin/customer/insert_customer',$data);
    }
    public function store(Request $request)
    {
      $this->validate($request,[
         'kode_customer'    =>['required', 'string','unique:customer']
        ,'nama_perusahaan'  =>['required', 'string']
        ,'jenis_usaha'      =>['required', 'string']
        ,'alamat'=>['required', 'string']
        ,'provinsi'=>['required', 'string']
        ,'kabupaten'=>['required', 'string']
        ,'telpon'=>['required', 'string']
        ,'fax'=>['required', 'string']
        ,'cp'=>['required', 'string']
      ]);

      $customer = new customer;
      $customer->kode_customer      = $request->kode_customer;
      $customer->nama_perusahaan    = $request->nama_perusahaan;
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
         'kode_customer'    =>['required', 'string']
        ,'nama_perusahaan'  =>['required', 'string']
        ,'jenis_usaha'      =>['required', 'string']
        ,'alamat'=>['required', 'string']
        ,'provinsi'=>['required', 'string']
        ,'kabupaten'=>['required', 'string']
        ,'telpon'=>['required', 'string']
        ,'fax'=>['required', 'string']
        ,'cp'=>['required', 'string']
      ]);

      $customer->kode_customer      = $request->kode_customer;
      $customer->nama_perusahaan    = $request->nama_perusahaan;
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
      

      if ($customer->save()){
        return redirect('/admin/customer')->with('success', 'item telah berhasil diupdate');
      }
      else{
        return redirect('admin/customer')->with('error', 'item gagal diupdate');
      }
    }
}
