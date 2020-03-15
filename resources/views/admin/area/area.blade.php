@extends('layouts_users.app_superadmin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Daftar Area</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/superadmin/area')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Area</li>
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
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')

                            <table class="mydatatables table table-collapse table-hover table-light table-striped cell-border table-responsive">
                                <thead>
                                    <th style="width:10%">No</th>
                                    <th style="width:75%">Nama Area Unit</th>
                                    <th style="width:15%">aksi</th>
                                </thead>
                                <tbody>


                                    @foreach($areas as $area)
                                    <tr>
                                        <td>{{ $no++ }}</td>
                                        <td>{{ $area->nama_area }}</td>
                                        <td>
                                            <a  href="{{route('edit.area',$area->area_id)}}" class="btn btn-info btn-sm">
                                                <span class="fa fa-pencil">Edit</span>
                                            </a>
                                            <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('delete.area',$area->area_id)}}" class="btn btn-danger btn-sm">
                                                <span class="fa fa-trash">Delete</span>
                                            </a>
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
