@extends('layouts_users.app_superadmin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Insert Wilayah</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="wilayah"></i>Wilayah</a></li>
                    <li class="active">Insert Wilayah</li>
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
                  <div>
                    <ul class="nav nav-tabs">
                      <li class="nav-item">
                          <a class="nav-link" style="border:1px solid #ccc" href="{{asset('/superadmin/insert_area')}}">Insert Area</a>
                      </li>
                      <li class="nav-item">
                          <a class="nav-link active_tab1" style="border:1px solid #ccc" href="{{asset('/superadmin/insert_wilayah')}}">Insert Wilayah</a>
                      </li>
                    </ul>
                  </div>
                  <br>

                <form action="{{route('store.wilayah')}}" method="post">
                    {{ csrf_field() }} 
                    <div class="form-group">
                        <label>Nama Area :</label>
                        <div>
                            <select class="form-control" name="area_id">
                                <option>Pilih Area</option>
                            @foreach($areas as $area)
                                <option value="{{ $area->area_id }}">{{ $area->nama_area }}</option>
                            @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                      <label>Nama Wilayah :</label>
                      <div>          
                        <input type="text" class="form-control"  name="nama_wilayah">
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary ">Submit</button>
                    <a href="area" class="btn btn-secondary"> Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection
