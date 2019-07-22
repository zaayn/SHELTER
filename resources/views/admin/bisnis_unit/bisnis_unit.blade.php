@extends('layouts_users.app_superadmin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Daftar Bisnis Unit</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Bisnis Unit</li>
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
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')

                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border">
                                <thead>
                                    <th style="width:10%">No</th>
                                    <th style="width:75%">Nama Bisnis Unit</th>
                                    <th style="width:15%">aksi</th>
                                </thead>
                                <tbody>


                                    @foreach($bisnis_units as $bisnis_unit)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $bisnis_unit->nama_bisnis_unit }}</td>
                                        <td>
                                            <a href="{{route('edit.bisnis_unit',$bisnis_unit->bu_id)}}" class="btn btn-info btn-sm">
                                                <span class="fa fa-pencil">Edit</span>
                                            </a>
                                            <a href="{{route('delete.bisnis_unit',$bisnis_unit->bu_id)}}" class="btn btn-danger btn-sm">
                                                <span class="fa fa-trash">Delete</span>
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
