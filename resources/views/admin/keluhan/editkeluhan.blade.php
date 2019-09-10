@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Edit Keluhan</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/admin/keluhan')}}"></i>Keluhan</a></li>
                    <li class="active">Edit Keluhan</li>
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

                <form action="{{route('update.keluhan', $keluhan->id_keluhan)}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-group col-md-12">
                            <label>Nama Customer :</label>
                            <div>
                                <select class="form-control" name="kode_customer">
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->kode_customer }}">{{ $customer->kode_customer }} - {{ $customer->nama_perusahaan }} - {{ $customer->bisnis_unit->nama_bisnis_unit }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>SPV PIC :</label>
                            <div>
                                <select class="form-control" name="spv_pic">
                                @foreach($users as $users)
                                    <option value="{{ $users->nama_depan }}">{{ $users->nama_depan }} - {{ $users->nama_wilayah }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal</label>
                	        <input type="date" class="form-control" name="tanggal_keluhan" value="{{ $keluhan->tanggal_keluhan }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Waktu Keluhan</label>
                	        <input type="time" class="form-control" name="jam_keluhan" value="{{ $keluhan->jam_keluhan }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Keluhan</label>
                	        <input type="text" class="form-control" name="keluhan" value="{{ $keluhan->keluhan }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">PIC</label>
                	        <input type="text" class="form-control" name="pic" value="{{ $keluhan->pic }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Waktu Follow</label>
                	        <input type="time" class="form-control" name="jam_follow" value="{{ $keluhan->jam_follow }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Follow Up</label>
                	        <input type="text" class="form-control" name="follow_up" value="{{ $keluhan->follow_up }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Closing Case</label>
                	        <input type="text" class="form-control" name="closing_case" value="{{ $keluhan->closing_case }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Via</label>
                	        <select class ="form-control" name="via" value="{{ $keluhan->via }}" required>
                            <option value="Telepon">Telepon</option>
                            <option value="BBM">BBM</option>
                            <option value="Email">Email</option>
                            <option value="Meeting">Meeting</option>
                            <option value="Other">Other</option>
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Status</label>
                	        <select class ="form-control" name="status" required>
                            <option value="Belum ditangani">Belum ditangani</option>
                            <option value="Sudah ditangani">Sudah ditangani</option>
                            </select>
                        </div>
                        <div class="col-md-12">
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
