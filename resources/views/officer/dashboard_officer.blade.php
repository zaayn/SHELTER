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
                <a href="#">
                    <div class="col-md-4">
                        <div class="info-box bg-red col-md-4">
                        <span class="info-box-icon"><i class="fa fa-table"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Customer</span>
                                <span class="info-box-number">41,410</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="col-md-4">
                        <div class="info-box bg-blue col-md-4">
                        <span class="info-box-icon"><i class="fa fa-table"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Customer</span>
                                <span class="info-box-number">41,410</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="col-md-4">
                        <div class="info-box bg-green col-md-4">
                        <span class="info-box-icon"><i class="fa fa-table"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Customer</span>
                                <span class="info-box-number">41,410</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="col-md-4">
                        <div class="info-box bg-yellow col-md-4">
                        <span class="info-box-icon"><i class="fa fa-table"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Customer</span>
                                <span class="info-box-number">41,410</span>
                            </div>     
                        </div>
                    </div>
                </a>
                <a href="#">
                    <div class="col-md-4">
                        <div class="info-box bg-purple col-md-4">
                        <span class="info-box-icon"><i class="fa fa-table"></i></span>
                            <div class="info-box-content">
                                <span class="info-box-text">Customer</span>
                                <span class="info-box-number">41,410</span>
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