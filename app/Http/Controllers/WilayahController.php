<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use App\Wilayah;
use App\Area;

class WilayahController extends Controller
{
  public function filter(Request $request)
    {
      if($request->area_id)
      {
        $data['areas'] = Area::all();
        $data['no'] = 1;
        $data['wilayahs'] = DB::table('wilayah')
            ->join('area', 'wilayah.area_id', '=', 'area.area_id')
            ->select('area.area_id','wilayah.wilayah_id','area.nama_area', 'nama_wilayah')
            ->where('area.area_id', '=', $request->area_id)
            ->get();
            // dd($request);
            return view('admin/wilayah/wilayah', $data);
      }
      else {
        $data['areas'] = Area::all();
        $data['no'] = 1;
        return view('admin/wilayah/wilayah', $data);
      }
    }

  public function insert()
    {
        $data['areas'] = Area::all();
        return view('/admin/wilayah/insert_wilayah',$data);
    }
    public function index()
    {   
        $data['areas'] = Area::all();
        $data['wilayahs'] = Wilayah::all();
        $data['no'] = 1;
        return view('admin/wilayah/wilayah', $data);
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'nama_wilayah'=>['required', 'string']
      ]);

      $wilayah = new Wilayah;
      $wilayah->area_id   = $request->area_id;
      $wilayah->nama_wilayah = $request->nama_wilayah;
      

      if ($wilayah->save()){
        return redirect('/superadmin/insert_wilayah')->with('success', 'item berhasil ditambahkan');
      }
      else{
        return redirect('superadmin/insert_wilayah')->with('error', 'item gagal ditambahkan');
      }
    }
    public function delete($wilayah_id){
        $wilayah = Wilayah::findOrFail($wilayah_id)->delete();
        return redirect()->route('index.wilayah')->with('success', 'delete sukses');
    }
    public function edit($wilayah_id){
        $wilayah = Wilayah::findOrFail($wilayah_id);
        return view('admin/wilayah/edit_wilayah')->with('wilayah', $wilayah);
    }
    public function update(Request $request, $id){
        $wilayah = Wilayah::findorFail($id);
        $this->validate($request,[
          'nama_wilayah'=>['required', 'string']
        ]);
        $wilayah->nama_wilayah = $request->nama_wilayah;
  
        if ($wilayah->save())
          return redirect()->route('index.wilayah')->with(['success'=>'edit sukses']);
    }
}
