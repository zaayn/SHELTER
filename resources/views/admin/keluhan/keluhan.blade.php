@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Keluhan</h1>
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
            <div class="panel block">
                <div class="panel-body">
                {{-- ----------  -------------- filter ------------------------ --}}
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('filter.keluhan')}}">
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
                                    <label class="control-label col-md-2">Area</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="area_id">
                                            <option value="">--- SELECT AREA ---</option>
                                        @foreach($areas as $area)
                                            <option value="{{ $area->area_id }}">{{ $area->nama_area }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-2">
                                    <a href="{{asset('/admin/keluhan')}}">
                                        <button type="button" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button>
                                    </a>    
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
                                </div>
                            </div>
                        </form>
{{-- ---- end filter ------ --}}
                    <div style="float:right; margin-bottom:10px;">
                        <a href="{{asset('/admin/insertkeluhan')}}" class="btn btn-primary btn-sm">Insert Keluhan</a>
                        <a href="{{asset('/admin/keluhan/exportExcel')}}" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="{{asset('/admin/keluhan/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>    
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">
                                <thead>
                                    <th>No</th>
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
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                @foreach($keluhans as $keluhan)
                                <tr>
                                    <td>{{ $no++  }}</td>
                                    <td>{{ $keluhan->nama_perusahaan }}</td>
                                    <td>{{ $keluhan->departemen }}</td>
                                    <td>{{ $keluhan->tanggal_keluhan }}</td>
                                    <td>{{ $keluhan->topik_masalah }}</td>
                                    <td>{{ $keluhan->saran_penyelesaian }}</td>
                                    <td>{{ $keluhan->time_target }}</td>
                                    <td>{{ $keluhan->confirm_pic }}</td>
                                    <td>{{ $keluhan->case }}</td>
                                    <td>{{ $keluhan->actual_case }}</td>
                                    <td>{{ $keluhan->uraian_penyelesaian }}</td>
                                    <td>{{ $keluhan->status }}</td>
                                    <td><a href="{{route('edit.keluhan',$keluhan->id_keluhan)}}" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span></a>
                                    <a onclick="return confirm('Apakah anda yakin akan menghapus data ini?')" href="{{route('destroy.keluhan',$keluhan->id_keluhan)}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                    @if($keluhan->status == 'Belum ditangani')
                                    <a onclick="return confirm('Apakah anda yakin keluhan ini sudah ditangani?')" href="{{route('reset.keluhan',$keluhan->id_keluhan)}}" class="btn btn-warning btn-sm">Tangani</a>
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
