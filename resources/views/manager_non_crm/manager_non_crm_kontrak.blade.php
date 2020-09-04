@extends('layouts_users.app_manager_non_crm')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Laporan Kontrak</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('manager_non_crm/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
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
                    <form class="form-horizontal" id="form-filter" method="POST" action="{{route('filter.kontrak.noncrm')}}">
                            @csrf
                            <div class="form-group">
                                <label class="control-label col-md-2">Bisnis Unit</label>
                                <div class="col-md-6">
                                    <select class="form-control" name="bu_id">
                                        <option value="">--- SELECT BISNIS UNIT ---</option>
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
                                    <div class="col-md-1 col-md-offset-2">
                                        <a href="{{asset('/manager_non_crm/kontrak')}}">
                                            <button type="button" class="btn btn-primary btn-sm"><i class="fa fa-refresh"></i> Reset</button>
                                        </a>    
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-primary btn-sm" id="btn-filter"><i class="fa fa-filter"></i> Filter</button>
                                    </div>
                                </div>
                            </form>
                        {{-- ---- end filter ------ --}} 
                    <div style="float:right; margin-bottom:10px;">
                        <a href="{{asset('/manager_non_crm/kontrak/reminder')}}" class="btn btn-danger btn-sm">Kontrak H-60</a> 
                        <a href="{{asset('/manager_non_crm/kontrak/habis')}}" class="btn btn-warning btn-sm">Kontrak Habis</a>      
                        <a href="{{asset('/manager_non_crm/kontrak/exportExcel')}}" class="btn btn-default btn-sm" target="_blank">Download Excel</a>
                        <a href="{{asset('/manager_non_crm/kontrak/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a>
                    </div>
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            <div style="overflow-x:auto;">
                                <table class="mydatatables table table-collapse table-hover table-light table-striped cell-border table-responsive">                                <thead>
                                    <th>No. </th>
                                    <th>Nomor kontrak</th>
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
                                    <th>Closing</th>
                                </thead>
                                <tbody>
                                @foreach($kontraks as $ko)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $ko->nomor_kontrak }}</td>
                                    <td>{{ $ko->kode_customer }}</td>
                                    <td>{{ $ko->customer->nama_perusahaan }}</td>
                                    <td>{{ $ko->periode_kontrak }}</td>
                                    <td>{{ $ko->akhir_periode }}</td>
                                    <td>{{ $ko->srt_pemberitahuan }}</td>
                                    <td>{{ $ko->tgl_srt_pemberitahuan }}</td>
                                    <td>{{ $ko->srt_penawaran }}</td>
                                    <td>{{ $ko->tgl_srt_penawaran }}</td>
                                    <td>{{ $ko->dealing }}</td>
                                    <td>{{ $ko->tgl_dealing }}</td>
                                    <td>{{ $ko->posisi_pks }}</td>
                                    <td>{{ $ko->closing }}</td>
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
