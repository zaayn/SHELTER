@extends('layouts_users.app_officer')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Visit</h1>
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
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('visit.filter')}}">
                            @csrf
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
                                    <a href="/admin/visit">
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
                        <a href="{{asset('/officer_crm/insertvisit')}}" class="btn btn-primary btn-sm">Insert Visit</a>
                        <a href="{{asset('/officer_crm/visit/exportExcel')}}" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="{{asset('/officer_crm/visit/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')                        
                            <table class="mydatatables table table-collapse table-hover table-light table-striped cell-border table-responsive">
                                <thead>
                                    <th>No.</th>
                                    <th>Penginput</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal</th>
                                    <th>Waktu In</th>
                                    <th>Waktu Out</th>
                                    <th>PIC Visit</th>
                                    <th>Kegiatan</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                @foreach($visits as $visit)
                                <tr>
                                    <td>{{ $no++  }}</td>
                                    <td>{{ $visit->customer->nama_depan }}</td>
                                    <td>{{ $visit->customer->nama_perusahaan }}</td>
                                    <td>{{ $visit->tanggal_visit }}</td>
                                    <td>{{ $visit->waktu_in }}</td>
                                    <td>{{ $visit->waktu_out }}</td>
                                    <td>{{ $visit->pic_meeted }}</td>
                                    <td>{{ $visit->kegiatan }}</td>
                                    <td>
                                        <a href="{{route('edit.visit.officer',$visit->visit_id)}}" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span></a>
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('destroy.visit.officer',$visit->visit_id)}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
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
