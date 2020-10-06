@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Tipe Customer</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Daftar Tipe Customer</li>
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
                            <table class="mydatatables table table-collapse table-hover table-light table-striped cell-border table-responsive">
                                <thead>
                                    <th>Nomor</th>
                                    <th>Nama Perusahaan</th>
                                    <th>jumlah bulan</th>
                                    <th>Customer Type</th>
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                @foreach ($customers as $customer)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $customer->nama_perusahaan }}</td>
                                    <td>{{ $customer->month_kontrak }}</td>
                                    <td>{{ $customer->customer_type }}</td>
                                    <td>
                                        <a href="{{route('profile.customer',$customer->kode_customer)}}" class="btn btn-info btn-sm">
                                            Profile Customer
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