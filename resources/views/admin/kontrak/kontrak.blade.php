@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Kontrak</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
            <div class="panel block" id="myForm">
                <div class="panel-body">
                    
                    {{-- ----------  -------------- filter ------------------------ --}}
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('filter.kontrak')}}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-2">Bisnis Unit</label>
                            <div class="col-md-6">
                                <select class="form-control" name="bu_id">
                                    <option value="">--- SELECT BISNIS UNIT ---</option>
                                @foreach($bisnis_units as $bisnis_unit)
                                    <option value="{{ $bisnis_unit->bu_id }}">{{ $bisnis_unit->nama_bisnis_unit }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>
                            <div class="form-group">
                                    <label class="control-label col-md-2">Wilayah</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="wilayah_id">
                                            <option value="">--- SELECT WILAYAH ---</option>
                                        @foreach($wilayahs as $wilayah)
                                            <option value="{{ $wilayah->wilayah_id }}">{{ $wilayah->nama_wilayah }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-2">
                                    <a href="{{asset('/admin/kontrak')}}">
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Reset</button>
                                    </a>    
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-sm" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
                                </div>
                            </div>
                        </form>
                                            {{-- ---- end filter ------ --}} 

                            <div style="float:right; margin-bottom:10px;">
                                <a href="{{asset('/admin/insertkontrak')}}" class="btn btn-primary btn-sm">Insert Kontrak</a> 
                                <a href="{{asset('/admin/kontrak/exportExcel')}}" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                                <a href="{{asset('/admin/kontrak/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                            </div> 
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            
                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">
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
                                    <th>Status</th>
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
                                        <a href="{{route('edit.kontrak',$kontrak->id_kontrak)}}" class="btn btn-info btn-sm" data-toggle="tooltip" data-placement="right" title="Edit"><span class="fa fa-pencil"></span></a>
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('destroy.kontrak',$kontrak->id_kontrak)}}" class="btn btn-danger btn-sm" data-toggle="tooltip" data-placement="right" title="Delete"><span class="fa fa-trash"></span></a>
                                        @if($kontrak->closing == 'Aktif')
                                        <a onclick="return confirm('Apakah anda yakin akan menutup kontrak ini ?')" href="{{route('putus.kontrak',$kontrak->id_kontrak)}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="right" title="Close"><span class="fa fa-ban"></span></a>
                                        @endif
                                        @if(!isset($kontrak->datamou))
                                            <a href="{{route('insertmou.kontrak',$kontrak->id_kontrak)}}" class="btn btn-default btn-sm" data-toggle="tooltip" data-placement="right" title="Tambah MoU"><span class="fa fa-plus"></span></a>
                                        @else
                                            {{-- <a href="{{route('insertmou.kontrak',$kontrak->id_kontrak)}}" class="btn btn-default btn-sm">Lihat MoU</span></a> --}}
                                            <a href="{{route('index.datamou')}}" class="btn btn-default btn-sm"data-toggle="tooltip" data-placement="right" title="MoU"><span class="fa fa-eye"></span></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection

