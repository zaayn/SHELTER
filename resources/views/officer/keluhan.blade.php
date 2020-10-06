@extends('layouts_users.app_officer')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Keluhan</h1>
                <ol class="breadcrumb">
                    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Daftar Laporan</li>
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
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('keluhan.filter')}}">
                            @csrf
                            <div class="form-group">
                                    <label class="control-label col-md-2">Status</label>
                                    <div class="col-md-6">
                                        <select class="form-control" name="status">
                                            <option value="">--- SELECT STATUS ---</option>
                                            <option value="Belum ditangani">Belum ditangani</option>
                                            <option value="Sudah ditangani">Sudah ditangani</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Tanggal</label>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="from">
                                </div>
                                <div class="col-md-3">
                                    <input type="date" class="form-control" name="to">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-md-1 col-md-offset-2">
                                    <a href="{{asset('/admin/keluhan')}}">
                                        <button type="button" class="btn btn-primary"><i class="fa fa-refresh"></i> Reset</button>
                                    </a>    
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" class="btn btn-primary" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
                                </div>
                            </div>
                        </form>
{{-- ---- end filter ------ --}}
                    <div style="float:right; margin-bottom:10px;">
                        <a href="{{asset('/officer_crm/insertkeluhan')}}" class="btn btn-primary btn-sm">Insert Keluhan</a>
                        <a href="{{asset('/officer_crm/keluhan/exportExcel')}}" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="{{asset('/officer_crm/keluhan/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>        
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            <div style="overflow-x:auto;">
                            
                                <table class="mydatatables table table-collapse table-hover table-light table-striped cell-border table-responsive">                                <thead>
                                    <th>No.</th>
                                    <th>Penginput</th>
                                    <th>Nama Customer</th>
                                    <th>Departemen Tertuju</th>
                                    <th>Tanggal</th>
                                    <th>Topik Permasalahan</th>
                                    <th>Saran Penyelesaian</th>
                                    <th>Time Target (Tgl)</th>
                                    <th>Confirm closed PIC</th>
                                    <th>Case</th>
                                    <th>Actual Closed</th>
                                    <th>Uraian Penyelesaian</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                @foreach($keluhans as $keluhan)
                                <tr>
                                    <td>{{ $no++  }}</td>
                                    <td>{{ $keluhan->customer->nama_depan }}</td>
                                    <td>{{ $keluhan->customer->nama_perusahaan }}</td>
                                    <td>{{ $keluhan->departemen }}</td>
                                    <td>{{ $keluhan->tanggal_keluhan }}</td>
                                    <td>{{ $keluhan->topik_masalah }}</td>
                                    <td>{{ $keluhan->saran_penyelesaian }}</td>
                                    <td>{{ $keluhan->time_target }}</td>
                                    <td>{{ $keluhan->confirm_pic }}</td>
                                    <td>{{ $keluhan->case }}</td>
                                    <td>{{ $keluhan->actual_case }}</td>
                                    <td>{{ $keluhan->uraian_penyelesaian }}</td>
                                    <td>{{ $keluhan->status }}</td>
                                    <td>
                                        <a href="{{route('edit.keluhan.officer',$keluhan->id_keluhan)}}" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span></a>
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('destroy.keluhan.officer',$keluhan->id_keluhan)}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
                                    </td>
                                </tr>
                                @endforeach 
                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
@endsection
@section('js')
<script>  
    $(document).ready(function() {

    $('.mydatatables thead tr').clone(true).appendTo( '.mydatatables thead' );
    $('.mydatatables thead tr:eq(1) th').each( function (i) {
        
      var title = $(this).text();
      $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

      $( 'input', this ).on( 'keyup change', function () {
          if ( table.column(i).search() !== this.value ) {
              table
                  .column(i)
                  .search( this.value )
                  .draw();
          }
      } );
    });

  var table = $('.mydatatables').DataTable( {
      orderCellsTop: true,
      fixedHeader: true,
      paging: true,
      searching: true,
      "sScrollX": "100%",
      "sScrollXInner": "100%",    
      show: true,
      // dom: 'Bfrtip',
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });
});
    </script>
@endsection
