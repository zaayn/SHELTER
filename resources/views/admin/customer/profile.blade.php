@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                @foreach ($customers as $customer)
                    <h1>{{ $customer->nama_perusahaan}}</h1>   
                @endforeach
                
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li><a href="{{asset('/admin/customer')}}"></i>Customer</a></li>
                    <li class="active">
                        @foreach ($customers as $customer)
                        {{$customer->nama_perusahaan}} 
                        @endforeach
                    </li>
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
                <ol class="breadcrumb">
                    <h2>A. Profil Customer</h2>
                </ol>
                <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                @foreach ($customers as $customer)
                    <table style="width:100%">
                        <tr>
                            <td style="width:20%">Kode Customer</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->kode_customer}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Nama Customer</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->nama_perusahaan}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Jenis Usaha</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->jenis_usaha}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Bisnis Unit</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->bisnis_unit->nama_bisnis_unit}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Alamat Customer</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->alamat}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Provinsi</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->provinsi}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Kabupaten</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->kabupaten}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Nomor Telephon</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->telpon}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">nomor Fax</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->fax}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Contact Person</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->cp}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Nama Area</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->area->nama_area}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Nama Supervisor</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->nama_depan}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Status</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->status}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Lama Kontrak</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->month_kontrak}} Bulan</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Jenis Perusahaan</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->jenis_perusahaan}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Negara</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->negara}}</td>
                        </tr>
                        <tr>
                            <td style="width:20%">Sebab Putus Kontrak</td>
                            <td style="width:2%">:</td>
                            <td>{{$customer->putus_kontrak}}</td>
                        </tr>
                    </table>
                @endforeach
                <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                <ol class="breadcrumb">
                    <h2>B. Riwayat Kontrak</h2>
                </ol>
                <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                <table class="mydatatables table table-collapse table-hover table-light table-striped cell-border table-responsive">
                    <thead>
                        <th>Nomor </th>
                        <th>Nomor Kontrak</th>
                        <th>Penginput</th>
                        <th>Kode Customer</th>
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
                        <th>Status</th>
                    </thead>
                    <tbody>
                    @foreach($kontraks as $kontrak)
                    <tr>
                        <td>{{ $no++  }}</td>
                        <td>{{ $kontrak->nomor_kontrak }}</td>
                        <td>{{ $kontrak->customer->nama_depan }}</td>
                        <td>{{ $kontrak->kode_customer }}</td>
                        <td>{{ $kontrak->customer->nama_perusahaan }}</td>
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
@section('js')
<script>  
    $(document).ready(function() {
    
        $('.mydatatables2').DataTable({
            orderCellsTop: true,
            fixedHeader: true,
            paging: true,
            searching: true,
            "sScrollX": "100%",
            "sScrollXInner": "100%",    
            show: true,
            // dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
          });
    
        $('.mydatatables thead tr').clone(true).appendTo( '.mydatatables thead' );
        $('.mydatatables thead tr:eq(1) th').each( function (i) {
            
          var title = $(this).text();
          $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    
          $( 'input', this ).on( 'keyup change', function () {
              if ( table.column(i).search() !== this.value ) {
                  table.column(i).search( this.value ).draw();
              }
          } );
        });
    
      var table = $('.mydatatables').DataTable( 
        {
            orderCellsTop: true,
            fixedHeader: true,
            paging: true,
            searching: true,
            "sScrollX": "100%",
            "sScrollXInner": "100%",    
            show: true,
            // dom: 'Bfrtip',
            buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
    
        });
    
    });
    </script>
@endsection