@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Insert Customer</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="wilayah"></i>Customer</a></li>
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
                      <label>Kode Customer :</label>
                      <div><input type="text" class="form-control"  name="kode_customer" required></div>
                    </div>
                    <div class="form-group">
                      <label>Nama Perusahaan :</label>
                      <div><input type="text" class="form-control"  name="nama_perusahaan" required></div>
                    </div>
                    <div class="form-group">
                      <label>Jenis Usaha :</label>
                      <div><input type="text" class="form-control"  name="jenis_usaha" required></div>
                    </div>
                   <div class="form-group">
                        <label>Bisnis Unit :</label>
                        <div>
                            <select class="form-control" name="bu_id">
                            @foreach($bisnis_units as $bisnis_unit)
                                <option value="{{ $bisnis_unit->bu_id }}">{{ $bisnis_unit->nama_bisnis_unit }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                      <label>Alamat :</label>
                      <div><input type="text" class="form-control"  name="alamat" required></div>
                    </div>
                    <div class="form-group">
                      <label>Provinsi :</label>
                      <div><input type="text" class="form-control"  name="provinsi" required></div>
                    </div>
                    <div class="form-group">
                      <label>Kabupaten :</label>
                      <div><input type="text" class="form-control"  name="kabupaten" required></div>
                    </div>
                    <div class="form-group">
                      <label>Telpon :</label>
                      <div><input type="text" class="form-control"  name="telpon" required></div>
                    </div>
                    <div class="form-group">
                      <label>Fax :</label>
                      <div><input type="text" class="form-control"  name="fax" required></div>
                    </div>
                    <div class="form-group">
                      <label>Kontak Person :</label>
                      <div><input type="text" class="form-control"  name="cp" required></div>
                    </div>
                    <div class="form-group">
                        <label>Area :</label>
                        <div>
                            <select class="form-control" name="nama_area">
                            @foreach($areas as $area)
                                <option value="{{ $area->nama_area }}">{{ $area->nama_area }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Wilayah :</label>
                        <div>
                            <select class="form-control" name="wilayah_id">
                            @foreach($wilayahs as $wilayah)
                                <option value="{{ $wilayah->wilayah_id }}">{{ $wilayah->nama_wilayah }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Area Supervisor :</label>
                        <div>
                            <select class="form-control" name="nama_depan">
                            @foreach($users as $users)
                                <option value="{{ $users->nama_depan }}">{{ $users->nama_depan }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary ">Submit</button>
                    <a href="user" class="btn btn-secondary"> Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection
