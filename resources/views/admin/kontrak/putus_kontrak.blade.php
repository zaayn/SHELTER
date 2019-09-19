@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Edit Kontrak</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/admin/kontrak')}}"></i>Kontrak</a></li>
                    <li class="active">Sebab Putus Kontrak</li>
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

                  <form action="{{route('update.putus', $kontrak->id_kontrak)}}" method="post">
                    {{ csrf_field() }}
                    

                    <div class="form-group">
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Sebab Putus Kontrak</label>
                	        <input type="text" class="form-control" name="putus_kontrak" required>
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
