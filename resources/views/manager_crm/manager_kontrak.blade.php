@extends('layouts_users.app_manager_crm')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Kontrak</h1>
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
                            <table id="mydatatables" class="table table-responsive table-hover table-light table-striped">
                                <thead>
                                    <th style="width:10%">ID Kontrak</th>
                                    <th style="width:75%">Kode Customer</th>
                                    <th style="width:75%">Nama Perusahaan</th>
                                    <th style="width:15%">Periode Kontrak</th>
                                    <th style="width:10%">Akhir Periode</th>
                                    <th style="width:75%">Surat Pemberitahuan</th>
                                    <th style="width:10%">Tgl_Surat Pemberitahuan</th>
                                    <th style="width:75%">Surat Penawaran</th>
                                    <th style="width:15%">Tgl_Surat Penawaran</th>
                                    <th style="width:75%">Dealing</th>
                                    <th style="width:10%">Tgl_Dealing</th>
                                    <th style="width:75%">Posisi Pks</th>
                                    <th style="width:15%">Closing</th>
                                </thead>
                                <tbody>
                                @foreach($kontrak as $ko)
                                <tr>
                                    <td>{{ $ko->id_kontrak }}</td>
                                    <td>{{ $ko->kode_customer }}</td>
                                    <td>{{ $ko->nama_perusahaan }}</td>
                                    <td>{{ $ko->periode_kontrak }}</td>
                                    <td>{{ $ko->akhir_periode }}</td>
                                    <td>{{ $ko->srt_pemberitahuan }}</td>
                                    <td>{{ $ko->tgl_srt_pemberitahuan }}</td>
                                    <td>{{ $ko->srt_penawaran }}</td>
                                    <td>{{ $ko->tgl_srt_penawaran }}</td>
                                    <td>{{ $ko->dealing }}</td>
                                    <td>{{ $ko->tgl_dealing }}</td>
                                    <td>{{ $ko->posisi_pks }}</td>
                                    <td>{{ $ko->closing }}</td>
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
