@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Tipe Customer</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Daftar Tipe Customer</li>
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
                
                        <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">
                                <thead>
                                    <th>Nomor</th>
                                    <th>Nama Perusahaan</th>
                                    <th>jumlah bulan</th>
                                    <th>Customer Type</th>
                                </thead>
                                <tbody>
                                @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $customer->nama_perusahaan }}</td>
                                    <td>{{ $customer->month_kontrak }}</td>
                                    <td>{{ $customer->customer_type }}</td>
                                </tr> 
                                @endforeach
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection