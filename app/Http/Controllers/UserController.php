<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Area;
use App\User;


class UserController extends Controller
{
    public function insert()
    {
        $data['areas'] = Area::all();
        return view('admin/user/insert_user',$data);
    }
    public function filter(Request $request)
    {   
        if($request->rule)
        {
            $data['areas'] = Area::all();
            $data['no'] = 1;
            $data['users'] = DB::table('users')
            ->join('area', 'users.area_id', '=', 'area.area_id')
            ->where('users.rule', '=', $request->rule)
            ->get();
                return view('admin/user/user', $data);
        }
        else {
            $data['users'] = User::all();
            $data['areas'] = Area::all();
            $data['no'] = 1;
            return view('admin/user/user', $data);
        }

    }
    public function index(Request $request)
    {   
        // $data['users'] = user::all();
        $data['areas'] = Area::all();
        $data['no'] = 1;
        $data['users'] = DB::table('users')
        ->join('area', 'users.area_id', '=', 'area.area_id')->get();
        return view('admin/user/user', $data);

    }

    public function store(Request $request)
    {
      $this->validate($request,[
        'username'      =>['required', 'string'],
        'nama_depan'    =>['required', 'string'],
        'nama_belakang' =>['required', 'string'],
        'password'      =>['required', 'string'],
        'email'         =>['required', 'string','unique:users'],
        'no_hp'         =>['required', 'string'],
        'username'      =>['required', 'string']
      ]);

      $users = new user;
      $users->username       = $request->username;
      $users->nama_depan     = $request->nama_depan;
      $users->nama_belakang  = $request->nama_belakang;
      $users->password       = $request->password;
      $users->email          = $request->email;
      $users->area_id        = $request->area_id;
      $users->no_hp          = $request->no_hp;
      $users->rule           = $request->rule;

      if ($users->save()){
        return redirect('/superadmin/insert_user')->with('success', 'item berhasil ditambahkan');
      }
      else{
        return redirect('/superadmin/insert_user')->with('error', 'item gagal ditambahkan');
      }
    }
    public function update(Request $request, $id){
        $user = User::findorFail($id);
        $this->validate($request,[
            'username'      =>['required', 'string'],
            'nama_depan'    =>['required', 'string'],
            'nama_belakang' =>['required', 'string'],
            'password'      =>['required', 'string'],
            'email'         =>['required', 'string'],
            'no_hp'         =>['required', 'string'],
            'username'      =>['required', 'string']
        ]);
            $user->username       = $request->username;
            $user->nama_depan     = $request->nama_depan;
            $user->nama_belakang  = $request->nama_belakang;
            $user->password       = $request->password;
            $user->email          = $request->email;
            $user->area_id        = $request->area_id;
            $user->no_hp          = $request->no_hp;
            $user->rule           = $request->rule;
  
        if ($user->save())
          return redirect()->route('index.user')->with(['success'=>'edit sukses']);
    }
    public function delete($email){
        $user = User::findOrFail($email)->delete();
        return redirect()->route('index.user')->with('success', 'delete sukses');
    }
    public function edit($email){
        
        $user = User::findOrFail($email);
        $data['areas'] = Area::all();
        return view('admin/user/edit_user',$data)->with('user', $user);
    }
    
}
