@extends('layouts_users.app_officer')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Insert Visit</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/officer_crm/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/officer_crm/visit')}}"></i>Visit</a></li>
                    <li class="active">Insert Visit</li>
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

                <form action="{{route('store.visit.officer')}}" method="post">
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
                	        <label class="font-weight-bold">Tanggal</label>
                	        <input type="date" class="form-control" name="tanggal_visit" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Waktu In</label>
                	        <input type="time" class="form-control timepicker" name="waktu_in" placeholder="klik disini" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Waktu Out</label>
                	        <input type="time" class="form-control timepicker" name="waktu_out" placeholder="klik disini" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">PIC Visit</label>
                	        <input type="text" class="form-control" name="pic_meeted" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Kegiatan</label>
                	        <textarea class="form-control" name="kegiatan" required></textarea>
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
    //   time picker
    $(document).ready(function() {
        $(".timepicker").flatpickr({
            enableTime: true,
            noCalendar: true,
            dateFormat: "H:i",
            time_24hr: true
        });
        $(".select2").select2({
        placeholder:"Pilih Customer",
        allowClear: true
        })
    });
    </script>
@endsection
