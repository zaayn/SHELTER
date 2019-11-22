$(document).ready(function(){
    $('#mydatatables2').DataTable({
        "sScrollX": "100%",
        "sScrollXInner": "100%",    
        show: true,
        // dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
      });
})
$(document).ready(function() {
  // Setup - add a text input to each footer cell
  $('#mydatatables thead tr').clone(true).appendTo( '#mydatatables thead' );
  $('#mydatatables thead tr:eq(1) th').each( function (i) {
    
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
  } );

  var table = $('#mydatatables').DataTable( {
      orderCellsTop: true,
      fixedHeader: true,
      paging: true,
      searching: true,
      "sScrollX": "100%",
      "sScrollXInner": "100%",    
      show: true,
      // dom: 'Bfrtip',
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
  } );
} );
$(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#mydatatables3 thead tr').clone(true).appendTo( '#mydatatables3 thead' );
    $('#mydatatables3 thead tr:eq(1) th').each( function (i) {
      
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
    } );
  
    var table = $('#mydatatables3').DataTable( {
        orderCellsTop: true,
        fixedHeader: true,
        paging: true,
        searching: true,
        "sScrollX": "100%",
        "sScrollXInner": "100%",    
        show: true,
        // dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    } );
  } );

$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })