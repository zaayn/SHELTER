@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Insert Call</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/admin/call')}}"></i>Call</a></li>
                    <li class="active">Insert Call</li>
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

                <form action="{{route('store.call')}}" method="post">
                    {{ csrf_field() }}
                    

                    <div class="form-group">
                        <div class="form-group col-md-12">
                            <label>Nama Customer :</label>
                            <div>
                                <input list="browsers" class="form-control" name="kode_customer">
                                <datalist id="browsers">
                                @foreach($customers as $customer) 
                                    <option value="{{ $customer->kode_customer }}">{{ $customer->kode_customer }} - {{ $customer->nama_perusahaan }} - {{ $customer->bisnis_unit->nama_bisnis_unit }} - {{ $customer->area->nama_area }}</option>
                                @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label>SPV PIC :</label>
                            <div>
                                <input list="mybrowsers" class="form-control" name="spv_pic">
                                <datalist id="mybrowsers">
                                @foreach($users as $users)
                                    <option value="{{ $users->nama_depan }}">{{ $users->nama_depan }} - {{ $users->area->nama_area }}</option>
                                @endforeach
                                </datalist>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal</label>
                	        <input type="date" class="form-control" name="tanggal_call" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Waktu Call</label>
                	        <input type="time" class="form-control" name="jam_call" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Pembicaraan</label>
                	        <input type="text" class="form-control" name="pembicaraan" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">PIC Call</label>
                	        <input type="text" class="form-control" name="pic_called" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Hal Menonjol</label>
                	        <input type="text" class="form-control" name="hal_menonjol" required>
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
