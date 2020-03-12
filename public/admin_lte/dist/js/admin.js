$(document).ready(function() {
    //standart datatable
    $('#mydatatables').DataTable({
        "sScrollX": "100%",
        "sScrollXInner": "100%",    
        show: true,
        // dom: 'Bfrtip',
        buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
      });

      //standart datatable 2
    $('#mydatatables2').DataTable({
      "sScrollX": "100%",
      "sScrollXInner": "100%",    
      show: true,
      // dom: 'Bfrtip',
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
    });

    // advance datatable
    // $('#mydatatables3 thead tr').clone(true).appendTo( '#mydatatables3 thead' );
    // $('#mydatatables3 thead tr:eq(1) th').each( function (i) {
        
    //   var title = $(this).text();
    //   $(this).html( '<input type="text" placeholder="Search '+title+'" />' );

    //   $( 'input', this ).on( 'keyup change', function () {
    //       if ( table.column(i).search() !== this.value ) {
    //           table
    //               .column(i)
    //               .search( this.value )
    //               .draw();
    //       }
    //   } );
    // });

  // var table = $('#mydatatables3').DataTable( {
  //     orderCellsTop: true,
  //     fixedHeader: true,
  //     paging: true,
  //     searching: true,
  //     "sScrollX": "100%",
  //     "sScrollXInner": "100%",    
  //     show: true,
  //     // dom: 'Bfrtip',
  //     buttons: ['copy', 'csv', 'excel', 'pdf', 'print']
  // } );
} );


$(function () {
    $('[data-toggle="tooltip"]').tooltip()
  })

$(document).ready(function(){
    $('#timepicker').timepicker().on('show.timepicker', function(e) {
    console.log('The time is ' + e.time.value);
    console.log('The hour is ' + e.time.hours);
    console.log('The minute is ' + e.time.minutes);
    console.log('The meridian is ' + e.time.meridian);
  });
})