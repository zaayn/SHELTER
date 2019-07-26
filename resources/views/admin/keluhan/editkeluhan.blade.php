@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Edit Keluhan</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="area"></i>Keluhan</a></li>
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
                	        <label class="font-weight-bold">Nama Customer</label>
                	        <input type="text" class="form-control" name="nama_customer" value="{{ $keluhan->nama_customer }}" required>
                        </div>
                        <div class="form-group col-md-12">

                	        <label class="font-weight-bold">SPV/PIC</label>
                	        <input type="text" class="form-control" name="spv_pic" value="{{ $keluhan->spv_pic }}" required>
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
                	        <input type="text" class="form-control" name="status" value="{{ $keluhan->status }}" required>
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
