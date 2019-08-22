/*=====================================================================
Variable Local Storage
 =====================================================================*/
 if(localStorage.getItem("capturarRango2") != null)
 $("#daterange-btn2 span").html(localStorage.getItem("capturarRango2"));
else
 $("#datetange-btn2 span").html('<i class="fa fa-calendar"></i>Rango de fecha');
 /*=====================================================================
Rango de Fecha
=====================================================================*/
//Date range as a button
$('#daterange-btn2').daterangepicker(
    {
      ranges   : {
        'Hoy'       : [moment(), moment()],
        'Ayer'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Ultimos 7 Dias' : [moment().subtract(6, 'days'), moment()],
        'Ultimos 30 Dias': [moment().subtract(29, 'days'), moment()],
        'Este Mes'  : [moment().startOf('month'), moment().endOf('month')],
        'Ultimo Mes'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
      },
      startDate: moment(),
      endDate  : moment()
    },
    function (start, end) {
      $('#daterange-btn2 span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      var fechaInicial = start.format('YYYY-MM-DD');
      var fechaFinal = end.format('YYYY-MM-DD');
      console.log("fecha Inicial: ",fechaInicial);
      console.log("fecha Final: ",fechaFinal);
      var capturaRango = $("#daterange-btn2 span").html();
      localStorage.setItem("capturarRango2",capturaRango);
      window.location = "index.php?ruta=reporte-venta&fechaInical="+ fechaInicial +"&fechaFinal="+ fechaFinal;
    }
  );
/*=====================================================================
Cancelar Rango de Fecha
=====================================================================*/
$(".opensright .ranges .range_inputs .cancelBtn").on("click",function(){
    localStorage.removeItem("capturarRango2");
    localStorage.clear();
    window.location = "reporte-venta";
});
/*=====================================================================
Capturar hoy
=====================================================================*/
$(".opensright .ranges li").on("click",function(){
    var textoHoy = $(this).attr("data-range-key");
    if(textoHoy == "Hoy")
    {
        var d = new Date();
        var dia = d.getDate();
        var mes = d.getMonth()+1;
        var anio = d.getFullYear();
        if(mes < 10 && dia < 10)
        {
            var fechaInicial = anio + "-0" + mes + "-0" + dia;
            var fechaFinal = anio + "-0" + mes + "-0" + dia;
        }
        else if(dia < 10)
        {
            var fechaInicial = anio + "-" + mes + "-0" + dia;
            var fechaFinal = anio + "-" + mes + "-0" + dia;
        }
        else if (mes < 10)
        {
            var fechaInicial = anio + "-0" + mes + "-" + dia;
            var fechaFinal = anio + "-0" + mes + "-" + dia;
        }
        else
        {
            var fechaInicial = anio + "-" + mes + "-" + dia;
            var fechaFinal = anio + "-" + mes + "-" + dia;
        }
        localStorage.setItem("capturarRango2","Hoy");
        window.location = "index.php?ruta=reporte-venta&fechaInical="+ fechaInicial +"&fechaFinal="+ fechaFinal;
    }
});