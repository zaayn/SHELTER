@extends('layouts_users.app_admin')

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
                        <a href="{{asset('/admin/insertkeluhan')}}" class="btn btn-primary btn-sm">Insert Keluhan</a>
                        <a href="{{asset('/admin/keluhan/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>    
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
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
                                    <th>Aksi</th>
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
                                    <td><a href="{{route('edit.keluhan',$keluhan->id_keluhan)}}" class="btn btn-info btn-sm">Ubah</a>
                                    <a href="{{route('destroy.keluhan',$keluhan->id_keluhan)}}" class="btn btn-danger btn-sm">Hapus</a></td>
                                </tr>
                                @endforeach 
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
