@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Insert Customer</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/admin/customer')}}"></i>Customer</a></li>
                    <li class="active">Insert Customer</li>
                </ol>
            </div>
        </div>
    </div>
</div>
@endsection
                
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                  @include('admin.shared.components.alert')
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                      </div>
                  @endif
                  <br>

                <form action="{{route('store.customer')}}" method="post">
                    {{ csrf_field() }} 
                  <div class="form-group">
                    
                    <div class="form-group col-md-12">
                      <label>Nama Perusahaan :</label>
                      <div><input type="text" class="form-control"  name="nama_perusahaan" required></div>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Jenis Usaha :</label>
                      <div><input type="text" class="form-control"  name="jenis_usaha" required></div>
                    </div>
                   <div class="form-group col-md-12">
                        <label>Bisnis Unit :</label>
                        <div>
                            <select class="form-control" name="bu_id">
                            @foreach($bisnis_units as $bisnis_unit)
                                <option value="{{ $bisnis_unit->bu_id }}">{{ $bisnis_unit->nama_bisnis_unit }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Jenis Perusahaan :</label>
                      <div>
                          <select class="form-control" name="jenis_perusahaan">
                              <option value="PMA">PMA</option>
                              <option value="PMN">PMN</option>
                          </select>
                      </div>
                  </div>
                  <div class="form-group col-md-12">
                      <label>Asal Negara :</label>
                      <div><input type="text" class="form-control"  name="negara" required></div>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Alamat :</label>
                      <div><input type="text" class="form-control"  name="alamat" required></div>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Provinsi :</label>
                      <div><input type="text" class="form-control"  name="provinsi" required></div>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Kabupaten/Kota :</label>
                      <div><input type="text" class="form-control"  name="kabupaten" required></div>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Telpon :</label>
                      <div><input type="text" class="form-control"  name="telpon" required></div>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Fax :</label>
                      <div><input type="text" class="form-control"  name="fax" required></div>
                    </div>
                    <div class="form-group col-md-12">
                      <label>Kontak Person :</label>
                      <div><input type="text" class="form-control"  name="cp" required></div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Area :</label>
                        <div>
                            <select class="form-control" name="nama_area">
                            @foreach($areas as $area)
                                <option value="{{ $area->nama_area }}">{{ $area->nama_area }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Wilayah :</label>
                        <div>
                            <select class="form-control" name="wilayah_id">
                            @foreach($wilayahs as $wilayah)
                                <option value="{{ $wilayah->wilayah_id }}">{{ $wilayah->nama_wilayah }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Area Supervisor :</label>
                        <div>
                            <select class="form-control" name="nama_depan">
                            @foreach($users as $users)
                                <option value="{{ $users->nama_depan }}">{{ $users->nama_depan }} - {{ $users->nama_wilayah }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group col-md-12">
                        <label>Status :</label>
                        <div>
                            <select class="form-control" name="status">
                                <option value="aktif">Aktif</option>
                                <option value="non_aktif" selected="selected">Non Aktif</option>
                            </select>
                        </div>
                    </div>
                      <div class="form-group col-md-12">
                        <button type="submit" class="btn btn-primary ">Submit</button>
                        <a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{asset('/admin/customer')}}" class="btn btn-secondary"> Cancel</a>
                      </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection
