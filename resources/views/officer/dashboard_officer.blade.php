@extends('layouts_users.app_officer')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Dashboard Officer CRM</h1>
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
        <a href="{{asset('/officer_crm/call')}}">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-aqua"><i class="fa fa-users"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">laporan Call</span>
                    <span class="info-box-number">{{$calls}}</span>
                </div>
                </div>
            </div>
        </a>
        <a href="{{asset('/officer_crm/visit')}}">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-green"><i class="fa fa-bookmark"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Laporan Visit</span>
                    <span class="info-box-number">{{$visits}}</span>
                </div>
                </div>
            </div>
        </a>
        <a href="{{asset('/officer_crm/keluhan')}}">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-red"><i class="fa fa-book"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Laporan Keluhan</span>
                    <span class="info-box-number">{{$keluhans}}</span>
                </div>
                </div>
            </div>
        </a>
        <a href="{{asset('/officer_crm/kontrak')}}">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                <span class="info-box-icon bg-yellow"><i class="fa fa-flag"></i></span>
                <div class="info-box-content">
                    <span class="info-box-text">Laporan KOntrak</span>
                    <span class="info-box-number">{{$kontraks}}</span>
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