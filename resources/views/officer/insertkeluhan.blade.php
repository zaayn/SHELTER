@extends('layouts_users.app_officer')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Insert Keluhan</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="area"></i>Area</a></li>
                    <li class="active">Insert Area</li>
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

                <form action="{{route('store.keluhan.officer')}}" method="post">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <div class="form-group col-md-12">
                            <label>Nama Perusahaan</label>
                            <select class="form-control select2" name="kode_customer">
                                <option></option>
                                @foreach($customers as $customer)
                                <option value="{{ $customer->kode_customer }}">{{ $customer->kode_customer }} - {{ $customer->nama_perusahaan }} - {{$customer->bisnis_unit->nama_bisnis_unit}} - {{$customer->area->nama_area}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Departemen Tertuju</label>
                            <div>
                                {{--<select class="form-control" name="departemen">
                                @foreach($users as $users)
                                    <option value="{{ $users->nama_depan }}">{{ $users->nama_depan }} - {{ $users->nama_area }}</option>
                                @endforeach
                                </select>--}}
                                <input type="text" class="form-control" name="departemen" required>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal</label>
                	        <input type="date" class="form-control" name="tanggal_keluhan" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Topik Permasalahan</label>
                	        <input type="text" class="form-control" name="topik_masalah" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Saran Penyelesaian</label>
                	        <input type="text" class="form-control" name="saran_penyelesaian" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Time Target</label>
                	        <input type="date" class="form-control" name="time_target" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Confirm Closed PIC</label>
                	        <input type="date" class="form-control" name="confirm_pic" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Case</label>
                	        <input type="text" class="form-control" name="case" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Actual Closed</label>
                	        <input type="date" class="form-control" name="actual_case" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Uraian Penyelesaian</label>
                	        {{--<select class ="form-control" name="uraian_penyelesaian" required>
                            <option value="Telepon">Telepon</option>
                            <option value="BBM">BBM</option>
                            <option value="Email">Email</option>
                            <option value="Meeting">Meeting</option>
                            <option value="Other">Other</option>
                          </select>--}}
                          <input type="text" class="form-control" name="uraian_penyelesaian" required>
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
@section('js')
<script>
    $(document).ready(function() {
    //select2
    $(".select2").select2({
        placeholder:"Pilih Customer",
        allowClear:true
    })
});
</script>
@endsection
