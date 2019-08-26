@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Edit Visit</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/admin/visit')}}"></i>Visit</a></li>
                    <li class="active">Edit Visit</li>
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

                <form action="{{route('update.visit', $visit->visit_id)}}" method="post">
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
                	        <input type="date" class="form-control" name="tanggal_visit" value="{{ $visit->tanggal_visit }}" equired>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Waktu In</label>
                	        <input type="time" class="form-control" name="waktu_in" value="{{ $visit->waktu_in }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Waktu Out</label>
                	        <input type="time" class="form-control" name="waktu_out" value="{{ $visit->waktu_out }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">PIC Visit</label>
                	        <input type="text" class="form-control" name="pic_meeted" value="{{ $visit->pic_meeted }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Kegiatan</label>
                	        <input type="text" class="form-control" name="kegiatan" value="{{ $visit->kegiatan }}" required>
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
