@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Daftar Customer</h1>
                <ol class="breadcrumb">
                    <li><a href={{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Customer</li>
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
                    {{-- ----------  -------------- button download ------------------------ --}}
                    <div style="float:right; margin-bottom:10px;">
                        <a href="{{asset('/admin/insert_customer')}}" class="btn btn-primary btn-sm">Insert Customer</a>
                        <a href="{{asset('/admin/customer/exportExcel')}}" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="{{asset('/admin/customer/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>
                    {{-- ---- end  ------ --}}  
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                           
                            @include('admin.shared.components.alert')
                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">
                                <thead>
                                
                                    <th>No</th>
                                    <th>Kode Customer</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Jenis Usaha</th>
                                    <th>Bisnis Unit</th>
                                    <th>Alamat</th>
                                    <th>Provinsi</th>
                                    <th>Kabupaten</th>
                                    <th>telpon</th>
                                    <th>cp</th>
                                    <th>Area</th>
                                    <th>Wilayah</th>
                                    <th>Area Supervisor</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @foreach($customers as $customer)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $customer->kode_customer }}</td>
                                        <td>{{ $customer->nama_perusahaan }}</td>
                                        <td>{{ $customer->jenis_usaha }}</td>
                                        <td>{{ $customer->bisnis_unit->nama_bisnis_unit }}</td>
                                        <td>{{ $customer->alamat }}</td>
                                        <td>{{ $customer->provinsi }}</td>
                                        <td>{{ $customer->kabupaten }}</td>
                                        <td>{{ $customer->telpon }}</td>
                                        <td>{{ $customer->cp }}</td>
                                        {{-- <td>{{ $customer->nama_area}}</td> --}}
                                        {{-- <td>{{ $customer->wilayah->nama_wilayah}}</td> --}}
                                        <td>{{ $customer->nama_area}}</td>
                                        <td>{{ $customer->wilayah->nama_wilayah}}</td>
                                        <td>{{ $customer->nama_depan}}</td>
                                        <td>
                                            <a href="{{route('edit.customer',$customer->kode_customer)}}" class="btn btn-info btn-sm">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <a href="{{route('delete.customer',$customer->kode_customer)}}" class="btn btn-danger btn-sm">
                                                <span class="fa fa-trash"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection