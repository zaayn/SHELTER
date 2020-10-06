@extends('layouts_users.app_admin')

@section('content_header')
<div class="row">
    <div class="col-md-12">
        <div class="panel block">
            <div class="panel-body">
                <h1>Kontrak yang Sudah Habis</h1>
                <ol class="breadcrumb">
                    <li><a href="{{asset('/admin/home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                    <li class="active">Kontrak habis</li>
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

                            <div style="float:right; margin-bottom:10px;">
                                {{-- <a href="{{asset('/admin/insertkontrak')}}" class="btn btn-primary btn-sm">Insert Kontrak</a> 
                                <a href="{{asset('/admin/kontrak/exportPDF')}}" class="btn btn-default btn-sm" target="_blank">Download PDF</a> --}}
                            </div> 
                            <hr style="border: solid #ddd; border-width: 1px 0 0; clear: both; margin: 22px 0 21px; height: 0;">
                            @include('admin.shared.components.alert')
                            
                            <table class="mydatatables table table-responsive table-hover table-light table-striped">
                                <thead>
                                    <th>No.</th>
                                    <th>Nomor Kontrak</th>
                                    <th>Status Rekontrak</th>
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
                                    <th>Aksi</th>
                                </thead>
                                <tbody>
                                    @php
                                        $i=0;
                                        $a=1;
                                        
                                    @endphp
                                @foreach($kontraks as $kontrak)
                                <tr>
                                    <td>{{ $a++ }}</td>
                                    
                                    <td>{{ $kontrak->nomor_kontrak}}</td>
                                    @if($kontrak->closing == "Closed")
                                    <td>Tidak direkontrak</td>
                                    @else
                                    <td>Sudah direkontrak</td>
                                    @endif
                                    <td>{{ $kontrak->nama_perusahaan }}</td>
                                    <td>{{ $kontrak->periode_kontrak }}</td>
                                    <td>{{ $kontrak->akhir_periode }}</td>
                                    <td>{{ $kontrak->srt_pemberitahuan }}</td>
                                    <td>{{ $kontrak->tgl_srt_pemberitahuan }}</td>
                                    <td>{{ $kontrak->srt_penawaran }}</td>
                                    <td>{{ $kontrak->tgl_srt_penawaran }}</td>
                                    <td>{{ $kontrak->dealing }}</td>
                                    <td>{{ $kontrak->tgl_dealing }}</td>
                                    <td>{{ $kontrak->posisi_pks }}</td>
                                    <td>
                                        <a href="{{route('edit.kontrak',$kontrak->id_kontrak)}}" class="btn btn-info btn-sm"><span class="fa fa-pencil"></span></a>
                                        <a onclick="return confirm('Apakah anda yakin akan menghapus data ini ?')" href="{{route('destroy.kontrak',$kontrak->id_kontrak)}}" class="btn btn-danger btn-sm"><span class="fa fa-trash"></span></a>
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
