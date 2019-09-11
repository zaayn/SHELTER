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
                    <div style="float:right; margin-bottom:10px;">
                        <a href="/officer_crm/mou/exportPDF" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            <div style="overflow-x:auto;">
                            
                                <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">                                <thead>
                                    <th>No. MoU</th>
                                    <th>ID Kontrak</th>
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
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                @foreach ($datamous as $datamou)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $datamou->id_kontrak }}</td>
                                    <td>Rp {{ number_format($datamou->hc, 2, ',','.') }}</td>
                                    <td>Rp {{ number_format($datamou->invoice, 2, ',','.') }}</td>
                                    <td>{{ $datamou->mf }}</td>
                                    <td>{{ $datamou->mf_persen }}</td>
                                    <td>{{ $datamou->bpjs_tk_persen}}</td>
                                    <td>{{ $datamou->bpjs_tenagakerja }}</td>
                                    <td>{{ $datamou->bpjs_kes_persen}}</td>
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
                                    <a href="{{route('edit.datamou',$datamou->no_mou)}}" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span></a>
                                    <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('destroy.datamou',$datamou->no_mou)}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a></td>
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