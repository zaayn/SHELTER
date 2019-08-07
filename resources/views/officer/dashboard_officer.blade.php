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
                <div class="col-md-2" style="float:right;">
                    <div class="panel panel-info">
                    
                    <div class="panel-heading">last user login:  and {{Auth::user()->last_login_at}}</div>
                  
                    </div>
                </div>
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
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                {{-- <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                </div> --}} 
                <h2>Customer</h2>
                {{----------- box -----------}}
                hallo
                {{----------- end box -----------}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection