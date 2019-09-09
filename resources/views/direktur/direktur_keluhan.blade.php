@extends('layouts_users.app_direktur')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Keluhan</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('direktur/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                        <a href="{{asset('/direktur/keluhan/exportExcel')}}" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="{{asset('/direktur/keluhan/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            <div style="overflow-x:auto;">
                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped">
                                <thead>
                                    <th>ID Keluhan</th>
                                    <th>Nama Customer</th>
                                    <th>SPV_PIC</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Keluhan</th>
                                    <th>Keluhan</th>
                                    <th>PIC Keluhan</th>
                                    <th>Waktu Follow</th>
                                    <th>Follow Up</th>
                                    <th>Closing Case</th>
                                    <th>Via</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                @foreach($keluhan as $ke)
                                <tr>
                                    <td>{{ $no++  }}</td>
                                    <td>{{ $ke->nama_perusahaan }}</td>
                                    <td>{{ $ke->spv_pic }}</td>
                                    <td>{{ $ke->tanggal_keluhan }}</td>
                                    <td>{{ $ke->jam_keluhan }}</td>
                                    <td>{{ $ke->keluhan }}</td>
                                    <td>{{ $ke->pic }}</td>
                                    <td>{{ $ke->jam_follow }}</td>
                                    <td>{{ $ke->follow_up }}</td>
                                    <td>{{ $ke->closing_case }}</td>
                                    <td>{{ $ke->via }}</td>
                                    <td>{{ $ke->status }}</td>
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
