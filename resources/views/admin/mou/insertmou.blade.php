@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Insert Data MoU</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/admin/mou')}}"></i>MoU</a></li>
                    <li class="active">Insert MoU</li>
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
    
                <form action="{{route('store.datamou', $kontrak->id_kontrak)}}" method="post">
                    {{ csrf_field() }}
                    

                    <div class="form-group">
                        <div class="form-group col-md-12">
                            <label>Kontrak Perusahaan</label>
                            <input type="text" class="form-control" name="nomor_kontrak" value="{{ $kontrak->nomor_kontrak }}" disabled required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">HC</label>
                	        <input type="text" class="form-control" name="hc" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Invoice</label>
                	        <input type="text" class="form-control" name="invoice" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">MF</label>
                	        <input type="text" class="form-control" name="mf" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">MF (%)</label>
                	        <input type="text" class="form-control" name="mf_persen" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">BPJS Ketenagakerjaan</label>
                	        <input type="text" class="form-control" name="bpjs_tk_persen" placeholder="Ket %">
                        </div>
                        <div class="form-group col-md-12">
                	        <input type="text" class="form-control" name="bpjs_tenagakerja" placeholder="Nominal">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">BPJS Kesehatan</label>
                	        <input type="text" class="form-control" name="bpjs_kes_persen" placeholder="Ket %">
                        </div>
                        <div class="form-group col-md-12">
                	        <input type="text" class="form-control" name="bpjs_kesehatan" placeholder="Nominal">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Jiwasraya</label>
                	        <input type="text" class="form-control" name="jiwasraya" placeholder="Opsional">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Ramamusa</label>
                	        <input type="text" class="form-control" name="ramamusa" placeholder="Opsional">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">THR</label>
                	        <input type="text" class="form-control" name="ditagihkan" placeholder="ditagihkan (Opsional)">
                        </div>
                        <div class="form-group col-md-12">
                	        <input type="text" class="form-control" name="diprovisasikan" placeholder="diprovisasikan (Opsional)">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Overheadcost</label>
                	        <input type="text" class="form-control" name="overheadcost" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Training</label>
                	        <input type="text" class="form-control" name="training" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal Invoice</label>
                	        <input type="text" class="form-control" name="tanggal_invoice" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Time of Payment</label>
                	        <input type="text" class="form-control" name="time_of_payment" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Cut of Date</label>
                	        <input type="text" class="form-control" name="cut_of_date" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Kaporlap</label>
                	        <select class="form-control" name="kaporlap">
                                <option value="YA" selected="selected">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Devices</label>
                	        <select class="form-control" name="devices">
                                <option value="YA" selected="selected">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Chemical</label>
                	        <select class="form-control" name="chemical">
                                <option value="YA" selected="selected">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Pendaftaran MoU</label>
                	        <select class="form-control" name="pendaftaran_mou">
                                <option value="YA" selected="selected">YA</option>
                                <option value="TIDAK">TIDAK</option>
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
