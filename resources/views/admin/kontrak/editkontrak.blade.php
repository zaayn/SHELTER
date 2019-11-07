@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Edit Kontrak</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/admin/kontrak')}}"></i>Kontrak</a></li>
                    <li class="active">Edit Kontrak</li>
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
                  @if ($errors->any())
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                        </ul>
                      </div>
                  @endif

                  <br>

                  <form action="{{route('update.kontrak', $kontrak->id_kontrak)}}" method="post">
                    {{ csrf_field() }}
                    

                    <div class="form-group">
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Nomor Kontrak</label>
                	        <input type="text" class="form-control" name="nomor_kontrak" value="{{$kontrak->nomor_kontrak}}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Kode Customer</label>
                	        <input type="text" class="form-control" name="kode_customer" value="{{ $kontrak->kode_customer }}" required>
                        </div>

                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Periode Kontrak</label>
                	        <input type="date" class="form-control" name="periode_kontrak" value="{{ $kontrak->periode_kontrak }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Akhir Periode</label>
                	        <input type="date" class="form-control" name="akhir_periode" value="{{ $kontrak->akhir_periode }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Surat Pemberitahuan</label>
                          <select class ="form-control" name="srt_pemberitahuan" value="{{ $kontrak->srt_pemberitahuan }}" required>
                            <option value="Sudah Dikirim">Sudah dikirim</option>
                            <option value="Belum Dikirim">Belum dikirim</option>
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal Surat Pemberitahuan</label>
                	        <input type="date" class="form-control" name="tgl_srt_pemberitahuan" value="{{ $kontrak->tgl_srt_pemberitahuan }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Surat Penawaran</label>
                	        <select class ="form-control" name="srt_penawaran" value="{{ $kontrak->srt_penawaran }}" required>
                            <option value="Sudah Dikirim">Sudah dikirim</option>
                            <option value="Belum Dikirim">Belum dikirim</option>
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal Surat Penawaran</label>
                	        <input type="date" class="form-control" name="tgl_srt_penawaran" value="{{ $kontrak->tgl_srt_penawaran }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Dealing</label>
                	        <select class ="form-control" name="dealing" value="{{ $kontrak->dealing }}" required>
                            <option value="Sudah Deal">Sudah deal</option>
                            <option value="Belum Deal">Belum deal</option>
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal Dealing</label>
                	        <input type="date" class="form-control" name="tgl_dealing" value="{{ $kontrak->tgl_dealing }}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Posisi Pks</label>
                	        <select class ="form-control" name="posisi_pks" value="{{ $kontrak->posisi_pks }}" required>
                            <option value="di Shelter">di Shelter</option>
                            <option value="di Client">di Client</option>
                          </select>
                        </div>


                        <div class="form-group col-md-12">

                	        <label class="font-weight-bold">Via</label>
                	        <select class ="form-control" name="via" value="{{ $kontrak->via }}" required>
                            <option value="-">-</option>
                            <option value="Langsung">Langsung</option>
                            <option value="Email">Email</option>
                            <option value="Post Kurir">Post Kurir</option>
                          </select>
                        </div>
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-lg btn-info btn-block ">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
              </div>
            </div>
          </div>
        </div>
@endsection
