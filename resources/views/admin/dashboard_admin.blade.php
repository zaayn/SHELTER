@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1> Dashboard Admin</h1>
                <ol class="breadcrumb">
                    <li><i class="fa fa-dashboard"></i> Home</li>
                    
                </ol>
                
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="row">
    <a href="{{asset('/admin/customer')}}">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Customer</span>
                <span class="info-box-number">{{$customer}}</span>
            </div>
            </div>
        </div>
    </a>
    <a href="{{asset('/admin/reminder')}}">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-bookmark"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Kontrak H-60</span>
                <span class="info-box-number">{{$kontrak}}</span>
            </div>
            </div>
        </div>
    </a>
    <a href="{{asset('/admin/mou')}}">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Data MoU</span>
                <span class="info-box-number">{{$datamou}}</span>
            </div>
            </div>
        </div>
    </a>
    <a href="{{asset('/admin/keluhan/keluhan_belum_ditangani')}}">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-flag"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Keluhan belum ditangani</span>
                <span class="info-box-number">{{$keluhans}}</span>
            </div>
            </div>
        </div>
    </a>

</div>
<div class="row">
    <div class="col-md-9">
        <div class="panel panel-default" id="chart">
            <div class="panel-heading"><h3>Client Aktif per Area</h3></div>
                <div class="panel-body">
                    <div style="overflow-x:auto;">
                    <style>
                    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
                    </style>
                    <center><div id="clientChart" style="width:750px; height:550px;"></div></center>
                </div>
            </div>          
        </div>
    </div>
    <div class="col-md-3" id="lastseen">
        <div class="panel panel-default">
            <div class="panel-heading"><h3>User Terakhir Login :</h3></div>
            <div class="panel-body">
                <table>
                    
                    
                    @foreach($lastUser as $last)
                    
                    <h5><strong>{{$last->username}}</strong> - {{\Carbon\Carbon::parse($last->current_login_at)->diffForHumans()}}</h5>
                    
                    @endforeach
                    
                </table>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <div class="panel-heading"><h3>Reminder Closing Rekontrak</h3></div>
                        <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                        @include('admin.shared.components.alert')
                        <!-- table reminder -->
                        <div style="overflow-x:auto;">
                        <table id="mydatatables" class="table table-responsive table-hover table-light table-striped">
                            <thead>
                                <th>No</th>
                                <th>Nomor Kontrak</th>
                                <th>Closing/MoU</th>
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
                                <td>{{ $no++ }}</td>
                                <td>{{ $kontrak->nomor_kontrak }}</td>
                                <td>@if($kontrak->closing == 'Aktif')
                                    <a onclick="return confirm('Apakah anda yakin akan menutup kontrak ini ?')" href="{{route('putus.kontrak',$kontrak->id_kontrak)}}" class="btn btn-warning btn-sm" data-toggle="tooltip" data-placement="right" title="Close"><span class="fa fa-ban"></span></a>
                                    @endif
                                    @if($kontrak->datamou_flag == 0)
                                        <a href="{{route('insertmou.kontrak',$kontrak->id_kontrak)}}" class="btn btn-default btn-sm"data-toggle="tooltip" data-placement="right" title="Tambah MoU"><span class="fa fa-plus"></span></a>    
                                    @endif</td>
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
        <!-- table keluhan -->
<div class="row">
        <div class="col-md-12">
            <div class="panel block">
                <div class="panel-body"> 
                    <div class="panel-heading"><h3>Daftar Keluhan yang Belum Ditangani</h3></div>
                    <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                        @include('admin.shared.components.alert')
                        <div style="overflow-x:auto;">    
                        <table id="mydatatables3" class="table table-collapse table-hover table-light table-striped">
                                <thead>
                                    <th>No</th>
                                    <th>Nama Customer</th>
                                    <th>Departemen</th>
                                    <th>Tanggal</th>
                                    <th>Topik Permasalahan</th>
                                    <th>Saran Penyelesaian</th>
                                    <th>Time Target</th>
                                    <th>Confirm Closed PIC</th>
                                    <th>Case</th>
                                    <th>Actual Case</th>
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
                                    <td>
                                        <a href="{{route('edit.keluhan',$keluhan->id_keluhan)}}" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span></a>
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('destroy.keluhan',$keluhan->id_keluhan)}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                        <a onclick="return confirm('Apakah anda yakin keluhan ini sudah ditangani?')" href="{{route('reset.keluhan',$keluhan->id_keluhan)}}" class="btn btn-warning btn-sm"><span class="fa fa-check"></span></a>
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

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script>
var analytics = {!!json_encode($cat)!!};

google.charts.load('current', {'packages':['corechart']});

google.charts.setOnLoadCallback(drawChart);

function drawChart()
{
 var data = google.visualization.arrayToDataTable(analytics);
 var options = {
  
 };
 var chart = new google.visualization.PieChart(document.getElementById('clientChart'));
 chart.draw(data, options);
}
        </script>
@endsection