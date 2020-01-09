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
                          <label>Nama Perusahaan</label>
                          <select class="form-control select2" name="kode_customer">
                            @foreach($customers as $customer)
                              <option value="{{ $customer->kode_customer }}">{{ $customer->kode_customer }} - {{ $customer->nama_perusahaan }} - {{$customer->bisnis_unit->nama_bisnis_unit}} - {{$customer->area->nama_area}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Departemen</label>
                            <div>
                                {{--<select class="form-control" name="spv_pic">
                                @foreach($users as $users)
                                    <option value="{{ $users->nama_depan }}">{{ $users->nama_depan }} - {{ $users->nama_area }}</option>
                                @endforeach
                                </select>--}}
                                <input type="text" class="form-control" name="departemen" value="{{ $keluhan->departemen }}" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal</label>
                	        <input type="date" class="form-control" name="tanggal_keluhan" value="{{ $keluhan->tanggal_keluhan }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Topik Permasalahan</label>
                	        <input type="text" class="form-control" name="topik_masalah" value="{{ $keluhan->topik_masalah }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Saran Penyelesaian</label>
                	        <input type="text" class="form-control" name="saran_penyelesaian" value="{{ $keluhan->saran_penyelesaian }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Time Target</label>
                	        <input type="date" class="form-control" name="time_target" value="{{ $keluhan->time_target }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Confirm Closed PIC</label>
                	        <input type="date" class="form-control" name="confirm_pic" value="{{ $keluhan->confirm_pic }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Case</label>
                	        <input type="text" class="form-control" name="case" value="{{ $keluhan->case }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Actual Case</label>
                	        <input type="date" class="form-control" name="actual_case" value="{{ $keluhan->actual_case }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Uraian Penyelesaian</label>
                          <input type="text" class="form-control" name="uraian_penyelesaian" value="{{ $keluhan->uraian_penyelesaian }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Status</label>
                	        <select class ="form-control" name="status" value="{{$keluhan->status}}" required>
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
@section('js')
<script>
    $(document).ready(function() {
    //select2
    $(".select2").select2({
        theme:"classic",
  })
});
</script>
@endsection
