@extends('layouts_users.app_officer')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan MoU</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Daftar Laporan MoU</li>
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
                            <a href="/kontrak/exportExcel" class="btn btn-success btn-sm" target="_blank">EXPORT EXCEL</a>
                            <a href="/insertkontrak" class="btn btn-primary btn-sm">Input Kontrak</a>
                            <table id="mydatatables" class="table table-responsive table-hover table-light table-striped">
                                <thead>
                                    <th style="width:10%">No. MoU</th>
                                    <th style="width:75%">Jumlah HC</th>
                                    <th style="width:75%">Nilai Invoice</th>
                                    <th style="width:15%">Invoice</th>
                                    <th style="width:10%">Rekontrak</th>
                                    <th style="width:75%">Putus Kontrak</th>
                                    <th style="width:10%">No. MoU</th>
                                    <th style="width:75%">Kode Customer</th>
                                    <th style="width:75%">Jumlah HC</th>
                                    <th style="width:15%">Invoice</th>
                                    <th style="width:10%">Rekontrak</th>
                                    <th style="width:75%">Putus Kontrak</th>
                                    <th style="width:10%">No. MoU</th>
                                    <th style="width:75%">Kode Customer</th>
                                    <th style="width:75%">Jumlah HC</th>
                                    <th style="width:15%">Invoice</th>
                                    <th style="width:10%">Rekontrak</th>
                                    <th style="width:75%">Putus Kontrak</th>
                                    <th style="width:15%">Aksi</th>
                                </thead>
                                <tbody>
                                @foreach ($kontraks as $kontrak)
                                <tr>
                                    <td>{{ $kontrak->id_kontrak }}</td>
                                    <td>{{ $kontrak->kode_customer }}</td>
                                    <td>{{ $kontrak->nama_perusahaan }}</td>
                                    <td>{{ $kontrak->periode_kontrak }}</td>
                                    <td>{{ $kontrak->akhir_periode }}</td>
                                    <td>{{ $kontrak->srt_pemberitahuan }}</td>
                                    <td>{{ $kontrak->tgl_srt_pemberitahuan }}</td>
                                    <td>{{ $kontrak->srt_penawaran }}</td>
                                    <td>{{ $kontrak->tgl_srt_penawaran }}</td>
                                    <td>{{ $kontrak->dealing }}</td>
                                    <td>{{ $kontrak->tgl_dealing }}</td>
                                    <td>{{ $kontrak->posisi_pks }}</td>
                                    <td>{{ $kontrak->closing }}</td>
                                    <td>{{ $kontrak->via }}</td>
                                    <td>
                                    <a href="{{route('edit.kontrak',$kontrak->id_kontrak)}}" class="btn btn-info btn-sm">Ubah</a>
                                    <a href="{{route('destroy.kontrak',$kontrak->id_kontrak)}}" class="btn btn-danger btn-sm">Hapus</a></td>
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
