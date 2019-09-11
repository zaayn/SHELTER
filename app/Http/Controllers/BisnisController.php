<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Bisnis_unit;

class BisnisController extends Controller
{
    public function insert()
    {
      return view('/admin/bisnis_unit/insert_bisnis_unit');
    }
    public function index()
    {  
        $data['bisnis_units'] = Bisnis_unit::all();
        $data['no'] = 1;
        return view('admin/bisnis_unit/bisnis_unit', $data);
    }
    public function store(Request $request)
    {
      $this->validate($request,[
        'nama_bisnis_unit'=>['required', 'string']
      ]);

      $bisnis_unit = new Bisnis_unit;
      $bisnis_unit->bu_id             = $request->bu_id;
      $bisnis_unit->nama_bisnis_unit  = $request->nama_bisnis_unit;
      

      if ($bisnis_unit->save()){
        return redirect('/superadmin/insert_bisnis_unit')->with('success', 'item berhasil ditambahkan');
      }
      else{
        return redirect('/superadmin/insert_bisnis_unit')->with('error', 'item gagal ditambahkan');
      }
    }
    public function delete($bu_id){
        $bisnis_unit = Bisnis_unit::findOrFail($bu_id)->delete();
        return redirect()->route('index.bisnis_unit')->with('success', 'delete sukses');
    }
    public function edit($bu_id){
        $bisnis_unit = Bisnis_unit::findOrFail($bu_id);
        return view('admin/bisnis_unit/edit_bisnis_unit')->with('bisnis_unit', $bisnis_unit);
    }
    public function update(Request $request, $id){
        $bisnis_unit = Bisnis_unit::findorFail($id);
        $this->validate($request,[
          'nama_bisnis_unit'=>['required', 'string']
        ]);
        $bisnis_unit->nama_bisnis_unit = $request->nama_bisnis_unit;
  
        if ($bisnis_unit->save())
          return redirect()->route('index.bisnis_unit')->with(['success'=>'edit sukses']);
    }
}
