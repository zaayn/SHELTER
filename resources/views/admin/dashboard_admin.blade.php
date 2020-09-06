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
                <span class="info-box-number">{{$kontraks}}</span>
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
    <a href="{{route('keluhan.belum.ditangani')}}">
        <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-flag"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Keluhan belum</span>
                <span class="info-box-text">ditangani</span>
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