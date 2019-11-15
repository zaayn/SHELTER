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
                    {{-- ----------  -------------- filter ------------------------ --}}
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('filter.kontrak.crm')}}">
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
                                        <a href="{{asset('/manager_crm/kontrak')}}">
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
                        <a href="/manager_crm/visit/exportExcel" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="/manager_crm/visit/exportPDF" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div> 
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            <div style="overflow-x:auto;">
                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">
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
                                    <td>{{ $no++  }}</td>
                                    <td>{{ $visit->nama_perusahaan }}</td>
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
