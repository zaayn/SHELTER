@extends('layouts_users.app_manager_crm')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Keluhan</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('manager_crm/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                        <a href="/manager_crm/keluhan/exportExcel" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="/manager_crm/keluhan/exportPDF" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div> 
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            <div style="overflow-x:auto;">
                                <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">                                <thead>
                                    <th style="width:10%">ID Keluhan</th>
                                    <th style="width:75%">Nama Customer</th>
                                    <th style="width:15%">SPV_PIC</th>
                                    <th style="width:10%">Tanggal</th>
                                    <th style="width:75%">Waktu Keluhan</th>
                                    <th style="width:10%">Keluhan</th>
                                    <th style="width:75%">PIC Keluhan</th>
                                    <th style="width:15%">Waktu Follow</th>
                                    <th style="width:75%">Follow Up</th>
                                    <th style="width:10%">Closing Case</th>
                                    <th style="width:75%">Via</th>
                                    <th style="width:15%">Status</th>
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
