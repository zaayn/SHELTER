@extends('layouts_users.app_manager_crm')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Daftar Customer</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('manager_crm/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('filter.kontrak.crm')}}">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-2">Bisnis Unit</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="bu_id">
                                        <option value="">--- SELECT BISNIS UNIT ---</option>
                                    @foreach($bisnis_units as $bisnis_unit)
                                        <option value="{{ $bisnis_unit->bu_id }}">{{ $bisnis_unit->nama_bisnis_unit }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                                <div class="form-group">
                                        <label class="control-label col-md-2">Wilayah</label>
                                        <div class="col-md-6">
                                            <select class="form-control" name="wilayah_id">
                                                <option value="">--- SELECT WILAYAH ---</option>
                                            @foreach($wilayahs as $wilayah)
                                                <option value="{{ $wilayah->wilayah_id }}">{{ $wilayah->nama_wilayah }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-1 col-md-offset-2">
                                        <a href="{{asset('/manager_crm/kontrak')}}">
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
                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">                                <thead>
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
                                        <td>{{ $customer->nama_area}}</td>
                                        <td>{{ $customer->wilayah->nama_wilayah}}</td>
                                        <td>{{ $customer->nama_depan}}</td>
                                        
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection