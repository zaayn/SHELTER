@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Daftar Customer</h1>
                <ol class="breadcrumb">
                    <li><a href={{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Customer</li>
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
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('filter.profile')}}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-2">Nama Perusahaan</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="kode_customer">
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->kode_customer }}" selected>{{ $customer->kode_customer }} - {{$customer->nama_perusahaan}}</option>
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
                    <a href="{{asset('/admin/profile')}}" class="btn btn-info btn-sm"><span class="fa fa-back"> Kembali</span></a>
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                           
                            @include('admin.shared.components.alert')
                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped  table-responsive">
                                    <tr>
                                        <th>No</th>
                                        <td>{{ $no++ }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Customer</th>
                                        <td>{{ $customer->kode_customer }}</td>
                                    </tr>
                                        <th>Nama Perusahaan</th>
                                        <td>{{ $customer->nama_perusahaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Usaha</th>
                                        <td>{{ $customer->jenis_usaha }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bisnis Unit</th>
                                        <td>{{ $customer->nama_bisnis_unit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Perusahaan</th>
                                        <td>{{ $customer->jenis_perusahaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Asal Negara</th>
                                        <td>{{ $customer->negara }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $customer->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td>{{ $customer->provinsi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten/Kota</th>
                                        <td>{{ $customer->kabupaten }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telpon</th>
                                        <td>{{ $customer->telpon }}</td>
                                    </tr>
                                    <tr>
                                        <th>CP</th>
                                        <td>{{ $customer->cp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Area</th>
                                        <td>{{ $customer->nama_area}}</td>
                                    </tr>
                                    <tr>
                                        <th>Wilayah</th>
                                        <td>{{ $customer->nama_wilayah}}</td>
                                    </tr>
                                    <tr>
                                        <th>Area Supervisor</th>
                                        <td>{{ $customer->nama_depan}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $customer->status}}</td>
                                    </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <table id="mydatatables2" class="table table-responsive table-hover table-light table-striped">
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
                            <a href="{{route('edit.kontrak',$kontrak->id_kontrak)}}" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span></a>
                            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('destroy.kontrak',$kontrak->id_kontrak)}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                            <a onclick="return confirm('Apakah anda yakin akan menutup kontrak ini ?')" href="{{route('closed.kontrak',$kontrak->id_kontrak)}}" class="btn btn-warning btn-sm">Closed</a>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table> 
            </div>
        </div>
    </div>
</div>

<div class="row">
        <div class="col-md-12">
            <div class="panel block">
                <div class="panel-body">
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            <table id="mydatatables2" class="table table-responsive table-hover table-light table-striped">
                                <thead>
                                    <th>No. MoU</th>
                                    <th>Nomor Kontrak</th>
                                    <th>HC</th>
                                    <th>Invoice</th>
                                    <th>MF</th>
                                    <th>MF (%)</th>
                                    <th>Ket. % BPJS Ketenagakerjaan<th>
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
                                    <td>{{ $datamou->no_mou }}</td>
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
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('destroy.datamou',$datamou->no_mou)}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
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