@extends('layouts_users.app_superadmin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Insert Area</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/superadmin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/superadmin/area')}}"></i>Area</a></li>
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

                <form action="{{route('store.area')}}" method="post">
                    {{ csrf_field() }}
                    

                    <div class="form-group">
                      <label>Nama Area :</label>
                      <div>          
                        <input type="text" class="form-control"  name="nama_area">
                      </div>
                    </div>

                    <button type="submit" class="btn btn-primary ">Submit</button>
                    <a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{asset('/superadmin/area')}}" class="btn btn-secondary"> Cancel</a>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection
