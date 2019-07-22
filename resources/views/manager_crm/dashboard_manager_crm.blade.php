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
                <h2>Daftar Laporan yang tersedia</h2>
                {{----------- box -----------}}
                <a href="{{asset('/manager_crm/manager_customer')}}">
                    <div class="col-md-4">
                        <div class="info-box bg-red col-md-4">
                        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan Customer</span>
                                <span class="info-box-number">{{$customers}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/manager_crm/manager_kontrak')}}">
                    <div class="col-md-4">
                        <div class="info-box bg-blue col-md-4">
                        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan kontrak</span>
                                <span class="info-box-number">{{$kontrak}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/manager_crm/manager_visit')}}">
                    <div class="col-md-4">
                        <div class="info-box bg-green col-md-4">
                        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan Visit</span>
                                <span class="info-box-number">{{$visits}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/manager_crm/manager_call')}}">
                    <div class="col-md-4">
                        <div class="info-box bg-yellow col-md-4">
                        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan call</span>
                                <span class="info-box-number">{{$calls}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/manager_crm/manager_keluhan')}}">
                    <div class="col-md-4">
                        <div class="info-box bg-purple col-md-4">
                        <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan Keluhan</span>
                                <span class="info-box-number">{{$keluhan}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="#">
                        <div class="col-md-4">
                            <div class="info-box bg-orange col-md-4">
                            <span class="info-box-icon"><i class="fa fa-envelope-o"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Laporan data MOU</span>
                                    <span class="info-box-number">40000</span>
                                </div>     
                            </div>
                        </div>
                    </a>
                {{----------- end box -----------}}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection