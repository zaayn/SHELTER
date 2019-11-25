@extends('layouts_users.app_superadmin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1> Dashboard Super admin</h1>
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
    
    <a href="{{asset('/superadmin/user')}}">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="fa fa-user"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">User</span>
                <span class="info-box-number">{{$users}}</span>
            </div>
            </div>
        </div>
    </a>
    <a href="{{asset('/superadmin/bisnis_unit')}}">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-blue"><i class="fa fa-envelope-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Bisnis Unit</span>
                <span class="info-box-number">{{$bisnis_unit}}</span>
            </div>
            </div>
        </div>
    </a>
    <a href="{{asset('/superadmin/area')}}">
        <div class="col-md-4 col-sm-6 col-xs-12">
            <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-envelope-o"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Area</span>
                <span class="info-box-number">{{$area}}</span>
            </div>
            </div>
        </div>
    </a>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="nav-tabs-custom">
            <!-- Tabs within a box -->
                <ul class="nav nav-tabs pull-right">
                    <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
                    <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
                    <li class="pull-left header"><i class="fa fa-inbox"></i>Customer</li>
                </ul>
                <div class="tab-content no-padding">
                <!-- Morris chart - Sales -->
                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
                    <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
                </div>
                
            </div>
    <!-- /.box -->
    </div>
    
</div>

@endsection