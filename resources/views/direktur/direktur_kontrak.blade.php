@extends('layouts_users.app_direktur')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Kontrak</h1>
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
                        <a href="{{asset('/direktur/kontrak/exportExcel')}}" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="{{asset('/direktur/kontrak/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            <div style="overflow-x:auto;">
                            <table id="mydatatables" class="table table-responsive table-hover table-light table-striped">
                                <thead>
                                    <th>ID Kontrak</th>
                                    <th>Kode Customer</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Periode Kontrak</th>
                                    <th>Akhir Periode</th>
                                    <th>Surat Pemberitahuan</th>
                                    <th>Tgl_Surat Pemberitahuan</th>
                                    <th>Surat Penawaran</th>
                                    <th>Tgl_Surat Penawaran</th>
                                    <th>Dealing</th>
                                    <th>Tgl_Dealing</th>
                                    <th>Posisi Pks</th>
                                    <th>Status</th>
                                </thead>
                                <tbody>
                                @foreach($kontrak as $ko)
                                <tr>
                                    <td>{{ $no++ }}</td>
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
