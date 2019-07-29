@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Data Customer</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Daftar Laporan Data Customer</li>
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
                            {{-- <a href="/kontrak/exportExcel" class="btn btn-success btn-sm" target="_blank">EXPORT EXCEL</a> --}}
                            {{-- <a href="/insertkontrak" class="btn btn-primary btn-sm">Input Kontrak</a> --}}
                            <table id="mydatatables" class="table table-responsive table-hover table-light table-striped">
                                <thead>
                                    <td>Nomor</td>
                                    <td>Nama Perusahaan</td>
                                    <td>Bisnis Unit</td>
                                    <td>Wilayah</td>
                                    <td>Alamat Perusahaan</td>
                                    {{--    
                                        <td>PIC</td>
                                        <td>CP</td>
                                        <td>Email</td> 
                                    --}}
                                    <td>Jenis Usaha</td>
                                    <td>Periode Kontrak</td>
                                    {{-- <td>Customer Type</td> --}}
                                    <td>Nomor Kontrak</td> 
                                    <th>HC</th>
                                    <th>Invoice</th>
                                    <th>MF</th>
                                    <th>MF (%)</th>
                                    <th>BPJS Ketenagakerjaan</th>
                                    <th>BPJS Kesehatan</th>
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
                                    <td>{{ $datamou->nama_perusahaan }}</td>
                                    <td>{{ $datamou->nama_bisnis_unit }}</td>
                                    <td>{{ $datamou->provinsi }}</td>
                                    <td>{{ $datamou->alamat }}</td>
                                    <td>{{ $datamou->jenis_usaha }}</td>
                                    <td>{{ $datamou->periode_kontrak }}</td>
                                    {{-- <td>{{ $customer_type }}</td> --}}
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