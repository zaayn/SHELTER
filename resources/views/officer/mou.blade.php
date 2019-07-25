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
                                    <th style="width:75%">ID Kontrak</th>
                                    <th style="width:75%">HC</th>
                                    <th style="width:15%">Invoice</th>
                                    <th style="width:10%">MF</th>
                                    <th style="width:75%">MF (%)</th>
                                    <th style="width:10%">BPJS Ketenagakerjaan</th>
                                    <th style="width:75%">BPJS Kesehatan</th>
                                    <th style="width:75%">Jiwasraya</th>
                                    <th style="width:15%">Ramamusa</th>
                                    <th style="width:10%">Ditagihkan</th>
                                    <th style="width:75%">Diprovisasikan</th>
                                    <th style="width:10%">Overheadcost</th>
                                    <th style="width:75%">Tanggal Invoice</th>
                                    <th style="width:75%">Time of Payment</th>
                                    <th style="width:15%">Cut of Date</th>
                                    <th style="width:10%">Kaporlap</th>
                                    <th style="width:75%">Devices</th>
                                    <th style="width:75%">Pendaftaran MoU</th>
                                    <th style="width:15%">Aksi</th>
                                </thead>
                                <tbody>
                                @foreach ($datamous as $datamou)
                                <tr>
                                    <td>{{ $datamou->no_mou }}</td>
                                    <td>{{ $datamou->id_kontrak }}</td>
                                    <td>{{ $datamou->hc }}</td>
                                    <td>{{ $datamou->invoice }}</td>
                                    <td>{{ $datamou->mf }}</td>
                                    <td>{{ $datamou->mf_persen }}</td>
                                    <td>{{ $datamou->bpjs_tenagakerja }}</td>
                                    <td>{{ $datamou->bpjs_kesehatan }}</td>
                                    <td>{{ $datamou->jiwasraya }}</td>
                                    <td>{{ $datamou->ramamusa }}</td>
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
                                    <td>
                                    <a href="{{route('edit.datamou',$datamou->no_mou)}}" class="btn btn-info btn-sm">Ubah</a>
                                    <a href="{{route('destroy.datamou',$datamou->no_mou)}}" class="btn btn-danger btn-sm">Hapus</a></td>
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
