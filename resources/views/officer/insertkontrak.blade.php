@extends('layouts_users.app_officer')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Insert Kontrak</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="area"></i>Area</a></li>
                    <li class="active">Insert Area</li>
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

                <form action="{{route('store.kontrak.officer')}}" method="post">
                    {{ csrf_field() }}
                  
                    <div class="form-group">
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Nomor Kontrak</label>
                	        <input type="text" class="form-control" name="id_kontrak" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Nama Perusahaan :</label>
                            <div>
                                <select class="form-control" name="kode_customer">
                                    <option>Pilih Perusahaan</option>
                                @foreach($customers as $customer)
                                    <option value="{{ $customer->kode_customer }}">{{ $customer->kode_customer }} - {{ $customer->nama_perusahaan }}</option>
                                @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Periode Kontrak</label>
                	        <input type="date" class="form-control" name="periode_kontrak" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Akhir Periode</label>
                	        <input type="date" class="form-control" name="akhir_periode" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Surat Pemberitahuan</label>
                          <select class ="form-control" name="srt_pemberitahuan" required>
                            <option value="Sudah Dikirim">Sudah dikirim</option>
                            <option value="Belum Dikirim">Belum dikirim</option>
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal Surat Pemberitahuan</label>
                	        <input type="date" class="form-control" name="tgl_srt_pemberitahuan" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Surat Penawaran</label>
                	        <select class ="form-control" name="srt_penawaran" required>
                            <option value="Sudah Dikirim">Sudah dikirim</option>
                            <option value="Belum Dikirim">Belum dikirim</option>
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal Surat Penawaran</label>
                	        <input type="date" class="form-control" name="tgl_srt_penawaran" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Dealing</label>
                	        <select class ="form-control" name="dealing" required>
                            <option value="Sudah Deal">Sudah deal</option>
                            <option value="Belum Deal">Belum deal</option>
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal Dealing</label>
                	        <input type="date" class="form-control" name="tgl_dealing" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Posisi Pks</label>
                	        <select class ="form-control" name="posisi_pks" required>
                            <option value="di Shelter">di Shelter</option>
                            <option value="di Client">di Client</option>
                          </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Closing</label>
                	        <input type="text" class="form-control" name="closing" required>
                        </div>

                        

                        <div class="form-group col-md-12">

                	        <label class="font-weight-bold">Via</label>
                	        <select class ="form-control" name="via" required>
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
