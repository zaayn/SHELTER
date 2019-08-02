@extends('layouts_users.app_superadmin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Edit Wilayah</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/superadmin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('superadmin/wilayah')}}"></i> wilayah</a></li>
                    <li class="active">Edit wilayah</li>
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
                  <form action="{{route('update.wilayah', $wilayah->wilayah_id)}}" method="post">
                      @csrf
                      @method('put')
                      <div class="form-group">
                        <label>Nama Area:</label>
                        <div>
                          <input type="text" class="form-control" name="area_id" value="{{ $wilayah->area->nama_area}}"disabled>
                        </div>
                      </div>
                      <div class="form-group">
                        <label>Nama wilayah:</label>
                        <div>
                          <input type="text" class="form-control" name="nama_wilayah" value="{{ $wilayah->nama_wilayah}}">
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary ">Update</button>
                      <a onclick="return confirm('Perubahan anda belum disimpan. Tetap tinggalkan halaman ini ?')" href="{{('/superadmin/wilayah')}}" class="btn btn-secondary"> Cancel</a>
                  </form>
                </div>
              </div>
            </div>
          </div>
@endsection
