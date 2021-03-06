<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Area;

class AreaController extends Controller
{
    public function insert()
    {
      return view('/admin/area/insert_area');
    }
    public function index()
    {  
        $data['areas'] = Area::all();
        $data['no'] = 1;
        return view('admin/area/area', $data);
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'nama_area'=>['required', 'string']
      ]);

      $area = new Area;
      $area->area_id   = $request->area_id;
      $area->nama_area = $request->nama_area;
      

      if ($area->save()){
        return redirect('/superadmin/insert_area')->with('success', 'item berhasil ditambahkan');
      }
      else{
        return redirect('/superadmin/insert_area')->with('error', 'item gagal ditambahkan');
      }
    }
    public function delete($area_id){
        $area = Area::findOrFail($area_id)->delete();
        return redirect()->route('index.area')->with('success', 'delete sukses');
    }
    public function edit($bu_id){
        $area = Area::findOrFail($bu_id);
        return view('admin/area/edit_area')->with('area', $area);
    }
    public function update(Request $request, $id){
        $area = Area::findorFail($id);
        $this->validate($request,[
          'nama_area'=>['required', 'string']
        ]);
        $area->nama_area = $request->nama_area;
  
        if ($area->save())
          return redirect()->route('index.area')->with(['success'=>'edit sukses']);
    }
}
