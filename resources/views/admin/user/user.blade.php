@extends('layouts_users.app_superadmin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Daftar User</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">User</li>
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
                    <form class="form-horizontal" id="form-filter" method="GET" action="{{route('index.user')}}">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-2">User</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="rule">
                                        <option value="null">All</option>
                                        <option value="admin">Admin</option>
                                        <option value="officer">Officer CRM</option>
                                        <option value="manager_crm">Manager CRM</option>
                                        <option value="manager_non_crm">Manager Non CRM</option>
                                        <option value="direktur">Direktur CRM</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-2">
                                    <button type="button" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
                                </div>
                            </div>
                        </form>
{{-- ---- end filter ------ --}}  
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')

                            <table id="mydatatables" class="table table-collapse table-hover table-light table-striped cell-border table-responsive">
                                <thead>
                                    <th>No</th>
                                    <th>Username</th>
                                    <th>Nama Depan</th>
                                    <th>Nama Belakang</th>
                                    <th>Email</th>
                                    <th>Nomor HP</th>
                                    <th>Area/Cabang</th>
                                    <th>Wilayah Supervisi</th>
                                    <th>Role</th>
                                    <th>aksi</th>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $user->username }}</td>
                                        <td>{{ $user->nama_depan }}</td>
                                        <td>{{ $user->nama_belakang }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->no_hp }}</td>
                                        <td>{{ $user->wilayah->area->nama_area }}</td>
                                        <td>{{ $user->wilayah->nama_wilayah }}</td>
                                        <td>{{ $user->rule }}</td>
                                        <td>
                                            <a href="{{route('edit.user',$user->email)}}" class="btn btn-info btn-sm">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <a href="{{route('delete.user',$user->email)}}" class="btn btn-danger btn-sm">
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