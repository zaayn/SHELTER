@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Kontrak</h1>
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
                    {{-- ----------  -------------- filter ------------------------ --}}
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('filter.kontrak')}}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-2">Nama Perusahaan</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="kode_customer">
                                        <option>ALL</option>
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->kode_customer }}">{{ $customer->kode_customer }} - {{$customer->nama_perusahaan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-2">
                                    <a href="{{asset('/admin/kontrak')}}">
                                        <button type="button" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button>
                                    </a>    
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
                                </div>
                            </div>
                        </form>
                                            {{-- ---- end filter ------ --}}   
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            <div style="overflow-x:auto;">
                            <table id="mydatatables" class="table table-responsive table-hover table-light table-striped">
                                <thead>
                                    <th>Nomor Kontrak</th>
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
                                    <th>Closing</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                @foreach($kontraks as $kontrak)
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
                                    <td>
                                        <a href="{{route('edit.kontrak',$kontrak->id_kontrak)}}" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span></a>
                                        <a href="{{route('destroy.kontrak',$kontrak->id_kontrak)}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                    </td>
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
