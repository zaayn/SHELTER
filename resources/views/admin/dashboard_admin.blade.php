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
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                    <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                    <li class="pull-left header"><i class="fa fa-inbox"></i>Client Aktif per Area</li>
                </ul>
                <div class="tab-content no-padding">
                <!-- Morris chart - Sales -->
                
                <div class="panel">
                    <div id="clientChart"></div>
                
                </div>
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                    
                </div>
            </div>
    <!-- /.box -->
    </div>
    <div class="col-md-3">
        <div class="panel block">
            <div class="panel-body">
                <h6>User Terakhir Login :</h6>
                <div class="panel">{{$lastUser->username}}</div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h2>Customer</h2>
                {{----------- box -----------}}
                
                
                {{----------- end box -----------}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
Highcharts.chart('clientChart', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
    },
    title: {
        text: 'Client Aktif per Area'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Client aktif',
        colorByPoint: true,
        data: [{
            name: 'Jawa Barat',
            y: 61.41,
            sliced: true,
            selected: true
        }, {
            name: 'Jawa Tengah',
            y: 11.84
        }, {
            name: 'Jawa Timur',
            y: 10.85
        }, {
            name: 'Bali',
            y: 4.67
        }]
    }]
});
        
       
        </script>
@endsection