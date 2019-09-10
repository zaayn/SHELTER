@extends('layouts_users.app_direktur')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1> Dashboard Direktur</h1>
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
                <a href="{{asset('/direktur/customer')}}">
                    <div class="col-md-4">
                        <div class="info-box bg-red">
                        <span class="info-box-icon"><i class="fa fa-table"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan Customer</span>
                                <span class="info-box-number">{{$customers}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/direktur/kontrak')}}">
                    <div class="col-md-4">
                        <div class="info-box bg-blue">
                        <span class="info-box-icon"><i class="fa fa-table"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan kontrak</span>
                                <span class="info-box-number">{{$kontrak}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/direktur/visit')}}">
                    <div class="col-md-4">
                        <div class="info-box bg-green">
                        <span class="info-box-icon"><i class="fa fa-table"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan Visit</span>
                                <span class="info-box-number">{{$visits}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/direktur/call')}}">
                    <div class="col-md-4">
                        <div class="info-box bg-yellow">
                        <span class="info-box-icon"><i class="fa fa-table"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan call</span>
                                <span class="info-box-number">{{$calls}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/direktur/keluhan')}}">
                    <div class="col-md-4">
                        <div class="info-box bg-purple">
                        <span class="info-box-icon"><i class="fa fa-table"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Laporan Keluhan</span>
                                <span class="info-box-number">{{$keluhan}}</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="{{asset('/direktur/mou')}}">
                        <div class="col-md-4">
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
        
    </div>
</div>
@endsection