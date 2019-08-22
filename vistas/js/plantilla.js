 /*=====================================================================
 sidebar menu
 =====================================================================*/
 $('.sidebar-menu').tree()
 $('.tablas').DataTable({
     "language":{
         "sProcessing": "Procesando...",
         "sLengthMenu": "Mostrar_MENU_registros",
         "sZeroRecords": "No encontraron resultados",
         "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
         "sInfoEmpty": "Mostrar registros del 0 al 10 de un total de 0",
         "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
         "sInfoPostFix": "",
         "sSearch": "Buscando: ",
         "sUrl": "",
         "sInfoThousands": "Cargando....",
         "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Ultimo",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
         },
         "oAria":{
             "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
             "sSortDescending": ": Activar para ordenar la columna de manera descendente"
         }
     }
 });
/*=====================================================================
 iCheck for checkbox and radio inputs
 =====================================================================*/
 $('input[type="checkbox"].minimal, input[type="radio"].minimal').iCheck({
    checkboxClass: 'icheckbox_minimal-blue',
    radioClass   : 'iradio_minimal-blue'
  });
/*=============================================
 //input Mask
=============================================*/
//Datemask dd/mm/yyyy
$('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' });
//Datemask2 mm/dd/yyyy
$('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' });
//Money Euro
$('[data-mask]').inputmask();
/*=============================================
 //date picker
=============================================*/
$('.datepick').datepicker({
        format: "yyyy/mm/dd",
        autoclose: true
});