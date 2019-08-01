@extends('layouts_users.app_superadmin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Edit Area</h1>
                <ol class="breadcrumb">
                    <li><a href{{asset('/superadmin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/superadmin/area')}}"></i> area</a></li>
                    <li class="active">Edit Area</li>
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
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                  <form action="{{route('update.area', $area->area_id)}}" method="post">
                      @csrf
                      @method('put')
                      <div class="form-group">
                        <label>Nama Bisnis Unit:</label>
                        <div>
                          <input type="text" class="form-control" name="nama_area" value="{{ $area->nama_area}}">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary ">Update</button>
                      <a href="/area" class="btn btn-secondary"> Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
@endsection
