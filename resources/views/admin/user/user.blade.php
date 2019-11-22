@extends('layouts_users.app_superadmin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Daftar User</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/superadmin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                                    <th>Aksi</th>
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
                                        <td>{{ $user->nama_area }}</td>
                                        <td>{{ $user->nama_wilayah }}</td>
                                        <td>{{ $user->rule }}</td>
                                        <td>
                                            <a href="{{route('edit.user',$user->email)}}" class="btn btn-info btn-sm">
                                                <span class="fa fa-pencil"></span>
                                            </a>
                                            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('delete.user',$user->email)}}" class="btn btn-danger btn-sm">
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