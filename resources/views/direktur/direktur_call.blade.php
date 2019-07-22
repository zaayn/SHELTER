@extends('layouts_users.app_direktur')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Call</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
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
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            <div style="overflow-x:auto;">
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
                                </thead>
                                <tbody>
                                @foreach($calls as $call)
                                <tr>
                                    <td>{{ $call->call_id  }}</td>
                                    <td>{{ $call->nama_customer }}</td>
                                    <td>{{ $call->spv_pic }}</td>
                                    <td>{{ $call->tanggal_call }}</td>
                                    <td>{{ $call->jam_call }}</td>
                                    <td>{{ $call->pembicaraan }}</td>
                                    <td>{{ $call->pic_called }}</td>
                                    <td>{{ $call->hal_menonjol }}</td>
                                </tr>
                                @endforeach    
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection