@extends('layouts_users.app_officer')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Keluhan</h1>
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
                    <div style="float:right; margin-bottom:10px;">
                        <a href="{{asset('/officer_crm/insertkeluhan')}}" class="btn btn-primary btn-sm">Insert Keluhan</a>
                        <a href="{{asset('/officer_crm/keluhan/exportExcel')}}" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="{{asset('/officer_crm/keluhan/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>        
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            <div style="overflow-x:auto;">
                            
                            <table id="mydatatables" class="table table-responsive table-hover table-light table-striped">
                                <thead>
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
                                    <th style="width:15%">Aksi</th>
                                </thead>
                                <tbody>
                                @foreach($keluhans as $keluhan)
                                <tr>
                                    <td>{{ $keluhan->id_keluhan  }}</td>
                                    <td>{{ $keluhan->nama_customer }}</td>
                                    <td>{{ $keluhan->spv_pic }}</td>
                                    <td>{{ $keluhan->tanggal_keluhan }}</td>
                                    <td>{{ $keluhan->jam_keluhan }}</td>
                                    <td>{{ $keluhan->keluhan }}</td>
                                    <td>{{ $keluhan->pic }}</td>
                                    <td>{{ $keluhan->jam_follow }}</td>
                                    <td>{{ $keluhan->follow_up }}</td>
                                    <td>{{ $keluhan->closing_case }}</td>
                                    <td>{{ $keluhan->via }}</td>
                                    <td>{{ $keluhan->status }}</td>
                                    <td><a href="{{route('edit.keluhan.officer',$keluhan->id_keluhan)}}" class="btn btn-info btn-sm">Ubah</a>
                                    <a href="{{route('destroy.keluhan.officer',$keluhan->id_keluhan)}}" class="btn btn-danger btn-sm">Hapus</a></td>
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
