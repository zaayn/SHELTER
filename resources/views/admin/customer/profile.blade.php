@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Profil Customer</h1>
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
                            <select class="form-control select2" name="kode_customer">
                                <option></option>
                                @foreach($customers_all as $customer)
                                    <option value="{{ $customer->kode_customer }}">{{ $customer->kode_customer }} - {{$customer->nama_perusahaan}}</option>
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
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <div class="panel-heading"><h3>Data Customer</h3></div>
                <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                    @include('admin.shared.components.alert')
                    <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">
                    <thead>
                        <th>No</th>
                        <th>Kode Customer</th>
                        <th>Nama Perusahaan</th>
                        <th>Jenis Usaha</th>
                        <th>Bisnis Unit</th>
                        <th>Jenis Perusahaan</th>
                        <th>Asal Negara</th>
                        <th>Alamat</th>
                        <th>Provinsi</th>
                        <th>Kabupaten/Kota</th>
                        <th>Telpon</th>
                        <th>CP</th>
                        <th>Area</th>
                        <th>Area Supervisor</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                    @foreach($customers as $customer)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $customer->kode_customer }}</td>
                        <td>{{ $customer->nama_perusahaan }}</td>
                        <td>{{ $customer->jenis_usaha }}</td>
                        <td>{{ $customer->bisnis_unit->nama_bisnis_unit }}</td>
                        <td>{{ $customer->jenis_perusahaan }}</td>
                        <td>{{ $customer->negara }}</td>
                        <td>{{ $customer->alamat }}</td>
                        <td>{{ $customer->provinsi }}</td>
                        <td>{{ $customer->kabupaten }}</td>
                        <td>{{ $customer->telpon }}</td>
                        <td>{{ $customer->cp }}</td>
                        <td>{{ $customer->area->nama_area}}</td>
                        <td>{{ $customer->nama_depan}}</td>
                        <td>{{ $customer->status}}</td>
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
                    <div class="panel-heading"><h3>Data Kontrak Customer</h3></div>
                    <table id="mydatatables2" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">
                    <thead>
                        <th>Nomor </th>
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
                    </thead>
                    <tbody>
                    @foreach($kontraks as $kontrak)
                    <tr>
                        <td>{{ $urut++  }}</td>
                        <td>{{ $kontrak->nomor_kontrak }}</td>
                        <td>{{ $kontrak->kode_customer }}</td>
                        <td>{{ $kontrak->customer->nama_perusahaan }}</td>
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
            <div class="panel-heading"><h3>Mou Perusahaan</h3></div>
                <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                    @include('admin.shared.components.alert')
                        <div style="overflow-x:auto;">
                        <table id="mydatatables3" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">
                        <thead>
                            <th>No. MoU</th>
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
                        <?php?>
                        <tr>
                            <td>{{ $id++ }}</td>
                            <td>{{ $datamou->kontrak->nomor_kontrak }}</td>
                            <td>{{ $datamou->hc }}</td>
                            <td>{{ 'Rp '.number_format($datamou->invoice, 2, ',','.') }}</td>
                            <td>{{ 'Rp '.number_format($datamou->mf, 2, ',','.') }}</td>
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
@section('js')
<script>
    $(document).ready(function() {
    //select2
    $(".select2").select2({
        placeholder:"Pilih Customer",
        allowClear:true
  })
});
</script>
@endsection