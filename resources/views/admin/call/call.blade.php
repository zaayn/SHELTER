@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Call</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Daftar Laporan</li>
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
                    <div style="float:right; margin-bottom:10px;">
                        <a href="{{asset('/admin/insertcall')}}" class="btn btn-primary btn-sm">Insert Call</a>
                        <a href="{{asset('/admin/call/exportExcel')}}" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="{{asset('/admin/call/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                           
                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped">
                                <thead>
                                    <th>ID Call</th>
                                    <th>Nama Customer</th>
                                    <th>SPV_PIC</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Call</th>
                                    <th>Pembicaraan</th>
                                    <th>PIC Call</th>
                                    <th>Hal Menonjol</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                @foreach($calls as $call)
                                <tr>
                                    <td>{{ $call->call_id  }}</td>
                                    <td>{{ $call->nama_perusahaan }}</td>
                                    <td>{{ $call->spv_pic }}</td>
                                    <td>{{ $call->tanggal_call }}</td>
                                    <td>{{ $call->jam_call }}</td>
                                    <td>{{ $call->pembicaraan }}</td>
                                    <td>{{ $call->pic_called }}</td>
                                    <td>{{ $call->hal_menonjol }}</td>
                                    <td>
                                        <a href="{{route('edit.call',$call->call_id)}}" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span></a>
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('destroy.call',$call->call_id)}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
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