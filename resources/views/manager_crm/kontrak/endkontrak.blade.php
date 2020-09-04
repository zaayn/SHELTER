@extends('layouts_users.app_manager_crm')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Kontrak yang Sudah Habis</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/manager_crm/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Kontrak habis</li>
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

                            <div style="float:right; margin-bottom:10px;">
                                {{-- <a href="{{asset('/manager_crm/insertkontrak')}}" class="btn btn-primary btn-sm">Insert Kontrak</a> 
                                <a href="{{asset('/manager_crm/kontrak/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a> --}}
                            </div> 
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            
                            <table id="mydatatables" class="table table-responsive table-hover table-light table-striped">
                                <thead>
                                    <th>No.</th>
                                    <th>Nomor Kontrak</th>
                                    <th>Nama Perusahaan</th>
                                    <th>Periode Kontrak</th>
                                    <th>Akhir Periode</th>
                                    <th>Surat Pemberitahuan</th>
                                    <th>Tgl_Surat Pemberitahuan</th>
                                    <th>Surat Penawaran</th>
                                    <th>Tgl_Surat Penawaran</th>
                                    <th>Dealing</th>
                                    <th>Tgl_Dealing</th>
                                    <th>Posisi Pks</th>
                                    <th>Closing</th>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                        $a=1;
                                        
                                    @endphp
                                @foreach($kontraks as $kontrak)
                                <tr>
                                    <td>{{ $a++ }}</td>
                                    
                                    <td>{{ $kontrak->nomor_kontrak}}</td>
                                    <td>{{ $kontrak->nama_perusahaan }}</td>
                                    <td>{{ $kontrak->periode_kontrak }}</td>
                                    <td>{{ $kontrak->akhir_periode }}</td>
                                    <td>{{ $kontrak->srt_pemberitahuan }}</td>
                                    <td>{{ $kontrak->tgl_srt_pemberitahuan }}</td>
                                    <td>{{ $kontrak->srt_penawaran }}</td>
                                    <td>{{ $kontrak->tgl_srt_penawaran }}</td>
                                    <td>{{ $kontrak->dealing }}</td>
                                    <td>{{ $kontrak->tgl_dealing }}</td>
                                    <td>{{ $kontrak->posisi_pks }}</td>
                                    <td>{{ $kontrak->closing }}</td>
                                </tr>
                                @endforeach  
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
@endsection
