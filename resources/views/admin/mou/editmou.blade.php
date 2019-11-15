@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Form Ubah Data MoU</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/admin/mou')}}"></i>MoU</a></li>
                    <li class="active">Edit MoU</li>
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

                <form action="{{route('update.datamou', $datamou->no_mou)}}" method="post">
                    {{ csrf_field() }}
                    

                    <div class="form-group">
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">id Kontrak</label>
                	        <input type="text" class="form-control" name="id_kontrak" value="{{$datamou->id_kontrak}}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">HC</label>
                	        <input type="text" class="form-control" name="hc" value="{{$datamou->hc}}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Invoice</label>
                	        <input type="text" class="form-control" name="invoice" value="{{$datamou->invoice}}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">MF</label>
                	        <input type="text" class="form-control" name="mf" value="{{$datamou->mf}}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">MF (%)</label>
                	        <input type="text" class="form-control" name="mf_persen" value="{{$datamou->mf_persen}}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Ket % BPJS Ketenagakerjaan</label>
                	        <input type="text" class="form-control" name="bpjs_tk_persen" value="{{$datamou->bpjs_tk_persen}}" placeholder="Opsional">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Nominal BPJS Ketenagakerjaan</label>
                	        <input type="text" class="form-control" name="bpjs_tenagakerja" value="{{$datamou->bpjs_tenagakerja}}" placeholder="Opsional">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Ket % BPJS Kesehatan</label>
                	        <input type="text" class="form-control" name="bpjs_kes_persen" value="{{$datamou->bpjs_kes_persen}}" placeholder="Opsional">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Nominal BPJS Kesehatan</label>
                	        <input type="text" class="form-control" name="bpjs_kesehatan" value="{{$datamou->bpjs_kesehatan}}" placeholder="Opsional">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Jiwasraya</label>
                	        <input type="text" class="form-control" name="jiwasraya" value="{{$datamou->jiwasraya}}" placeholder="Opsional">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Ramamusa</label>
                	        <input type="text" class="form-control" name="ramamusa" value="{{$datamou->ramamusa}}" placeholder="Opsional">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">THR Ditagihkan</label>
                	        <input type="text" class="form-control" name="ditagihkan" value="{{$datamou->ditagihkan}}" laceholder="Opsional">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">THR Diprovisasikan</label>
                	        <input type="text" class="form-control" name="diprovisasikan" value="{{$datamou->diprovisasikan}}" placeholder="Opsional">
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Overheadcost</label>
                	        <input type="text" class="form-control" name="overheadcost" value="{{$datamou->overheadcost}}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Training</label>
                	        <input type="text" class="form-control" name="training" value="{{$datamou->training}}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Tanggal Invoice</label>
                	        <input type="text" class="form-control" name="tanggal_invoice" value="{{$datamou->tanggal_invoice}}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Time of Payment</label>
                	        <input type="text" class="form-control" name="time_of_payment" value="{{$datamou->time_of_payment}}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Cut of Date</label>
                	        <input type="text" class="form-control" name="cut_of_date" value="{{$datamou->cut_of_date}}" required>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Kaporlap</label>
                	        <select class="form-control" name="kaporlap" value="{{$datamou->kaporlap}}" required>
                                <option value="YA" selected="selected">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Devices</label>
                	        <select class="form-control" name="devices" value="{{$datamou->devices}}" required>
                                <option value="YA" selected="selected">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Chemical</label>
                	        <select class="form-control" name="chemical" value="{{$datamou->chemical}}" required>
                                <option value="YA" selected="selected">YA</option>
                                <option value="TIDAK">TIDAK</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                	        <label class="font-weight-bold">Pendaftaran MoU</label>
                	        <select class="form-control" name="pendaftaran_mou" value="{{$datamou->pendaftaran_mou}}" required>
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
