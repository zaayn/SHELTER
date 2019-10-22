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
                                    <th>ID Keluhan</th>
                                    <th>Nama Customer</th>
                                    <th>Departemen Tertuju</th>
                                    <th>Tanggal</th>
                                    <th>Topik Permasalahan</th>
                                    <th>Saran Penyelesaian</th>
                                    <th>Time Target (Tgl)</th>
                                    <th>Confirm closed PIC</th>
                                    <th>Case</th>
                                    <th>Actual Closed</th>
                                    <th>Uraian Penyelesaian</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                @foreach($keluhan as $ke)
                                <tr>
                                    <td>{{ $no++  }}</td>
                                    <td>{{ $ke->nama_perusahaan }}</td>
                                    <td>{{ $ke->departemen }}</td>
                                    <td>{{ $ke->tanggal_keluhan }}</td>
                                    <td>{{ $ke->topik_masalah }}</td>
                                    <td>{{ $ke->saran_penyelesaian }}</td>
                                    <td>{{ $ke->time_target }}</td>
                                    <td>{{ $ke->confirm_pic }}</td>
                                    <td>{{ $ke->case }}</td>
                                    <td>{{ $ke->actual_case }}</td>
                                    <td>{{ $ke->uraian_penyelesaian }}</td>
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
