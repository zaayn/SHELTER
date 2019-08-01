@extends('layouts_users.app_superadmin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Daftar Wilayah</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/superadmin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Wilayah</li>
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
                    {{-- ----------  -------------- filter ------------------------ --}}
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('filter.wilayah')}}">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-2">Area</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="area_id">
                                        <option>ALL</option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->area_id }}">{{$area->nama_area}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-2">
                                    <a href="/admin/wilayah">
                                        <button type="button" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button>
                                    </a>    
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
                                </div>
                            </div>
                        </form>
{{-- ---- end filter ------ --}}   
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')

                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped">
                                <thead>
                                    <th style="width:10%">No</th>
                                    <th style="width:40%">wilayah</th>
                                    <th style="width:10%">aksi</th>
                                </thead>
                                <tbody>
                                    @foreach($wilayahs as $wilayah)
                                    <tr>
                                        <td>{{ $no++}}</td>
                                        <td>{{ $wilayah->nama_wilayah }}</td>
                                        <td>
                                            <a href="{{route('edit.wilayah',$wilayah->wilayah_id)}}" class="btn btn-info btn-sm">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <a href="{{route('delete.wilayah',$wilayah->wilayah_id)}}" class="btn btn-danger btn-sm">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection