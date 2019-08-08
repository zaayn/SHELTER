@extends('layouts_users.app_manager_crm')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1> Dashboard Manager CRM</h1>
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
    <div class="col-md-9">
        <div class="panel block">
            <div class="panel-body">
                <h2>Daftar Laporan yang tersedia</h2>
                {{----------- box -----------}}
                <a href="{{asset('/manager_crm/manager_customer')}}">
                    <div class="col-md-6">
                        <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan Customer</span>
                                <span class="info-box-number">{{$customers}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/manager_crm/manager_kontrak')}}">
                    <div class="col-md-6">
                        <div class="info-box bg-blue">
                        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan kontrak</span>
                                <span class="info-box-number">{{$kontrak}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/manager_crm/manager_visit')}}">
                    <div class="col-md-6">
                        <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan Visit</span>
                                <span class="info-box-number">{{$visits}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/manager_crm/manager_call')}}">
                    <div class="col-md-6">
                        <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan call</span>
                                <span class="info-box-number">{{$calls}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/manager_crm/manager_keluhan')}}">
                    <div class="col-md-6">
                        <div class="info-box bg-purple">
                        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan Keluhan</span>
                                <span class="info-box-number">{{$keluhan}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/manager_crm/manager_mou')}}">
                    <div class="col-md-6">
                        <div class="info-box bg-orange">
                        <span class="info-box-icon"><i class="fa fa-table"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan data MOU</span>
                                <span class="info-box-number">{{$datamous}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                {{----------- end box -----------}}
                </div>
            </div>
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
    

@endsection