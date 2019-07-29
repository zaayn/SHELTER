@extends('layouts_users.app_manager_crm')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Visit</h1>
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
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            <div style="overflow-x:auto;">
                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped">
                                <thead>
                                    <th>ID Visit</th>
                                    <th>Nama Customer</th>
                                    <th>SPV_PIC</th>
                                    <th>Tanggal</th>
                                    <th>Waktu In</th>
                                    <th>Waktu Out</th>
                                    <th>PIC Visit</th>
                                    <th>Kegiatan</th>
                                </thead>
                                <tbody>
                                @foreach($visits as $visit)
                                <tr>
                                    <td>{{ $visit->visit_id  }}</td>
                                    <td>{{ $visit->nama_customer }}</td>
                                    <td>{{ $visit->spv_pic }}</td>
                                    <td>{{ $visit->tanggal_visit }}</td>
                                    <td>{{ $visit->waktu_in }}</td>
                                    <td>{{ $visit->waktu_out }}</td>
                                    <td>{{ $visit->pic_meeted }}</td>
                                    <td>{{ $visit->kegiatan }}</td>
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
