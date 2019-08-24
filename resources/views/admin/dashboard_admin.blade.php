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
    <a href="{{asset('/admin/kontrak')}}">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-bookmark"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Closing Kontrak</span>
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
    <a href="{{asset('/admin/data_customer')}}">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-flag"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Data Customer</span>
                <span class="info-box-number">{{$datamou}}</span>
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
            <div class="panel-heading">
                <h6>User Terakhir Login :</h6>
                <h5>{{$lastUser->username}}</h5>
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
                        
                        <table id="mydatatables" class="table table-responsive table-hover table-light table-striped">
                            <thead>
                                <th>Nomor Kontrak</th>
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
                                <td>{{ $kontrak->id_kontrak }}</td>
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