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
                {{-- ----------  -------------- filter ------------------------ --}}
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('filter.profile')}}">
                        @csrf
                        <div class="form-group">
                            <label class="control-label col-md-2">Nama Perusahaan</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="kode_customer">
                                        @foreach($customers as $customer)
                                            <option value="{{ $customer->kode_customer }}">{{ $customer->kode_customer }} - {{$customer->nama_perusahaan}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-2">
                                    <a href="{{asset('/admin/kontrak')}}">
                                        <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Reset</button>
                                    </a>    
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary btn-sm" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
                                </div>
                            </div>
                        </form>
{{-- ---- end filter ------ --}}
 
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                           
                            @include('admin.shared.components.alert')
                            <!-- <table id="mydatatables" class="table table-collapse table-hover table-light table-striped  table-responsive">
                                    <tr>
                                        <th>No</th>
                                        <td>{{ $no++ }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kode Customer</th>
                                        <td>{{ $customer->kode_customer }}</td>
                                    </tr>
                                        <th>Nama Perusahaan</th>
                                        <td>{{ $customer->nama_perusahaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Usaha</th>
                                        <td>{{ $customer->jenis_usaha }}</td>
                                    </tr>
                                    <tr>
                                        <th>Bisnis Unit</th>
                                        <td>{{ $customer->nama_bisnis_unit }}</td>
                                    </tr>
                                    <tr>
                                        <th>Jenis Perusahaan</th>
                                        <td>{{ $customer->jenis_perusahaan }}</td>
                                    </tr>
                                    <tr>
                                        <th>Asal Negara</th>
                                        <td>{{ $customer->negara }}</td>
                                    </tr>
                                    <tr>
                                        <th>Alamat</th>
                                        <td>{{ $customer->alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Provinsi</th>
                                        <td>{{ $customer->provinsi }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kabupaten/Kota</th>
                                        <td>{{ $customer->kabupaten }}</td>
                                    </tr>
                                    <tr>
                                        <th>Telpon</th>
                                        <td>{{ $customer->telpon }}</td>
                                    </tr>
                                    <tr>
                                        <th>CP</th>
                                        <td>{{ $customer->cp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Area</th>
                                        <td>{{ $customer->nama_area}}</td>
                                    </tr>
                                    <tr>
                                        <th>Area</th>
                                        <td>{{ $customer->nama_wilayah}}</td>
                                    </tr>
                                    <tr>
                                        <th>Area Supervisor</th>
                                        <td>{{ $customer->nama_depan}}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>{{ $customer->status}}</td>
                                    </tr>
                            </table> -->
                        </div>
                    </div>
                </div>
            </div>
@endsection