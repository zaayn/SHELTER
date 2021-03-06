@extends('layouts_users.app_manager_crm')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan MoU</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('manager_crm/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                    {{-- ----------  -------------- filter ------------------------ --}}
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('filter.mou.manager')}}">
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
                                        <a href="{{asset('/manager_crm/mou')}}">
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
                        <a href="/manager_crm/mou/exportExcel" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="/manager_crm/mou/exportPDF" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div> 
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            <div style="overflow-x:auto;">
                                <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">                                <thead>
                                    <th>No. </th>
                                    <th>Nomor Kontrak</th>
                                    <th>HC</th>
                                    <th>Invoice</th>
                                    <th>MF</th>
                                    <th>MF (%)</th>
                                    <th>Ket. % BPJS Ketenagakerjaan</th>
                                    <th>Nominal BPJS Ketenagakerjaan</th>
                                    <th>Ket. % BPJS Kesehatan</th>
                                    <th>Nominal BPJS Kesehatan</th>
                                    <th>Jiwasraya</th>
                                    <th>Ramamusa</th>
                                    <th>Ditagihkan</th>
                                    <th>Diprovisasikan</th>
                                    <th>Overheadcost</th>
                                    <th>Training</th>
                                    <th>Tanggal Invoice</th>
                                    <th>Time of Payment</th>
                                    <th>Cut of Date</th>
                                    <th>Kaporlap</th>
                                    <th>Devices</th>
                                    <th>Chemical</th>
                                    <th>Pendaftaran MoU</th>
                                </thead>
                                <tbody>
                                @foreach ($datamous as $datamou)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $datamou->nomor_kontrak }}</td>
                                    <td>{{ $datamou->hc }}</td>
                                    <td>{{ 'Rp'.number_format($datamou->invoice, 2, ',','.') }}</td>
                                    <td>{{ 'Rp'.number_format($datamou->mf, 2, ',','.') }}</td>
                                    <td>{{ $datamou->mf_persen ?$datamou->mf_persen.'%':'' }} </td>
                                    <td>{{ $datamou->bpjs_tk_persen ?$datamou->bpjs_tk_persen.'%':''}}</td>
                                    <td>{{ $datamou->bpjs_tenagakerja ?'Rp'.number_format($datamou->bpjs_tenagakerja, 2, ',','.'):'' }}</td>
                                    <td>{{ $datamou->bpjs_kes_persen ?$datamou->bpjs_kes_persen.'%':'' }}</td>
                                    <td>{{ $datamou->bpjs_kesehatan ?'Rp'.number_format($datamou->bpjs_kesehatan, 2, ',','.'):'' }}</td>
                                    <td>{{ $datamou->jiwasraya ?number_format($datamou->jiwasraya, 2, ',','.'):'' }}</td>
                                    <td>{{ $datamou->ramamusa ?number_format($datamou->ramamusa, 2, ',','.'):'' }}</td>
                                    <td>{{ $datamou->ditagihkan }}</td>
                                    <td>{{ $datamou->diprovisasikan }}</td>
                                    <td>{{ $datamou->overheadcost }}</td>
                                    <td>{{ $datamou->training }}</td>
                                    <td>{{ $datamou->tanggal_invoice }}</td>
                                    <td>{{ $datamou->time_of_payment }}</td>
                                    <td>{{ $datamou->cut_of_date }}</td>
                                    <td>{{ $datamou->kaporlap }}</td>
                                    <td>{{ $datamou->devices }}</td>
                                    <td>{{ $datamou->chemical }}</td>
                                    <td>{{ $datamou->pendaftaran_mou }}</td>
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