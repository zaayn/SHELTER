@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Call</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('filter.call')}}">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-2">Bisnis Unit</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="bu_id">
                                        <option value="">--- Select bisnis unit ---</option>                                                
                                    @foreach($bisnis_units as $bisnis_unit)
                                        <option value="{{ $bisnis_unit->bu_id }}">{{ $bisnis_unit->nama_bisnis_unit }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Area</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="area_id">
                                        <option value="">--- SELECT AREA ---</option>
                                    @foreach($areas as $area)
                                        <option value="{{ $area->area_id }}">{{ $area->nama_area }}</option>
                                    @endforeach
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
                                    <a href="/admin/call">
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
                        <a href="{{asset('/admin/call/exportExcel')}}" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="{{asset('/admin/call/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                           
                            <table class=" mydatatables table table-collapse table-hover table-light table-striped cell-border table-responsive">
                                <thead>
                                    <th>No.</th>
                                    <th>Penginput</th>
                                    <th>Nama Customer</th>
                                    <th>Tanggal</th>
                                    <th>Waktu Call</th>
                                    <th>Pembicaraan</th>
                                    <th>PIC Call</th>
                                    <th>Hal Menonjol</th>
                                </thead>
                                <tbody>
                                @foreach($calls as $call)
                                <tr>
                                    <td>{{ $no++  }}</td>
                                    <td>{{ $call->customer->nama_depan }}</td>
                                    <td>{{ $call->customer->nama_perusahaan }}</td>
                                    <td>{{ $call->tanggal_call }}</td>
                                    <td>{{ $call->jam_call }}</td>
                                    <td>{{ $call->pembicaraan }}</td>
                                    <td>{{ $call->pic_called }}</td>
                                    <td>{{ $call->hal_menonjol }}</td>
                                    
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