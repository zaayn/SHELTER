@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Edit Customer</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/admin/customer')}}"></i>Customer</a></li>
                    <li class="active">Edit Customer</li>
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

                <form action="{{route('update.customer', $customer->kode_customer)}}" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Nama Perusahaan</label>
                	        <input type="text" disabled="disabled" class="form-control" name="nama_perusahaan" value="{{ $customer->nama_perusahaan }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Jenis Usaha</label>
                            <input type="text" class="form-control" name="jenis_usaha" value="{{ $customer->jenis_usaha }}" required>
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
                                    <select class="form-control" name="jenis_perusahaan" value="{{ $customer->jenis_perusahaan }}">
                                        <option value="pma">PMA</option>
                                        <option value="pmn">PMN</option>
                                    </select>
                                </div>
                            </div>
                        <div class="form-group col-md-12">
                            <label>Asal Negara :</label>
                            <div><input type="text" class="form-control"  name="negara" value="{{ $customer->negara }}" required></div>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Alamat</label>
                	        <input type="text" class="form-control" name="alamat" value="{{ $customer->alamat }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Provinsi</label>
                	        <input type="text" class="form-control" name="provinsi" value="{{ $customer->provinsi }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Kabupaten/Kota</label>
                	        <input type="text" class="form-control" name="kabupaten" value="{{ $customer->kabupaten }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Telepon</label>
                	        <input type="text" class="form-control" name="telpon" value="{{ $customer->telpon }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Fax</label>
                	        <input type="text" class="form-control" name="fax" value="{{ $customer->fax }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Kontak Person</label>
                	        <input type="text" class="form-control" name="cp" value="{{ $customer->cp }}" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Area :</label>
                            <div>
                                <select class="form-control" name="nama_area" value="{{ $customer->nama_area }}>
                                @foreach($areas as $area)
                                    <option value="{{ $area->nama_area }}">{{ $area->nama_area }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Wilayah :</label>
                            <div>
                                <select class="form-control" name="wilayah_id" value="{{ $customer->wilayah_id }}>
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
                                    <option value="{{ $users->nama_depan }}">{{ $users->nama_depan }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Status :</label>
                            <div>
                                <select class="form-control" name="status">
                                    <option value="Aktif">Aktif</option>
                                    <option value="Non_aktif">Non Aktif</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-lg btn-info btn-block ">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection
