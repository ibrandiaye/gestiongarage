/*
 Template Name: Zoter - Bootstrap 4 Admin Dashboard
 Author: Mannatthemes
 Website: www.mannatthemes.com
 File: Datatable js
 */

$(document).ready(function() {
   // $('#example1').DataTable();
   table = $('#example1').DataTable( {
    lengthChange: false,
    dom: 'Bfrtip',
    buttons: ['copy', 'excel', 'pdf' ]} );
   // table.buttons().container().appendTo( $('.col-sm-6:eq(0)', table.table().container() ) )
    //Buttons examples

} );
