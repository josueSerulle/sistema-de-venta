/*=====================================================================
Variable Local Storage
 =====================================================================*/
if(localStorage.getItem("capturarRango") != null)
    $("#daterange-btn span").html(localStorage.getItem("capturarRango"));
else
    $("#datetange-btn span").html('<i class="fa fa-calendar"></i>Rango de fecha');
 /*=====================================================================
Cargar la tabla dinamica de productos
 =====================================================================*/
$(".tablasVenta").DataTable( {
    "ajax": "ajax/tableVenta.ajax.php",
    "deferRender": true,
    "retrive": true,
    "processing": true,
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
Agregar Producto a la venta desde la tabla
 =====================================================================*/
$(document).on("click","button.agregarProducto",function(){
    var idProducto = $(this).attr("idProducto");
    $(this).removeClass("btn-primary agregarProducto");
    $(this).addClass("btn-default");
    var datos = new FormData();
    datos.append("idProducto",idProducto);

    $.ajax({
        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            var descripcion = respuesta["descripcion"];
            var stock = respuesta["stock"];
            var precio = respuesta["precio_venta"];
            /*=====================================================================
            Evitar Agregar Pruducto Cuando el stock esta en cero
            =====================================================================*/
            if(stock == 0)
            {
                swal({
                    icon: "error",
                    title: "¡No hay stock disponible!",
                    Button: true,
                    Button:{text: "Cerrar"},
                });
                $("button.recuperarBoton[idProducto ="+idProducto+"]").addClass("btn-primary agregarProducto");
                return;
            }
            $(".nuevoProducto").append(
                '<div class="row" style="padding: 5px 15px">'+
                          '<!-- Descripcion del producto -->'+
                          '<div class="col-xs-6" style="padding-right:0px">'+
                            '<div class="input-group">'+
                              '<span class="input-group-addon">'+
                                '<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto="'+idProducto+'">'+
                                  '<i Class="fa fa-times"></i>'+
                                '</button>'+
                              '</span>'+
                              '<input type="text" class="form-control nuevaDescripcionProducto" name="nuevaDescripcionProducto" idProducto="'+idProducto+'" value="'+descripcion+'" readonly required />'+
                            '</div>'+
                          '</div>'+
                          '<!-- /Descripcion del producto -->'+
                          '<!-- Cantidad del producto -->'+
                          '<div class="col-xs-3 ingresoCantidad">'+
                            '<input type="number" class="form-control nuevoCantidadProducto" name="nuevoCantidadProducto" min="1" stock="'+stock+'" nuevoStock="'+Number(stock-1)+'" value="1" placeholder="1" required />'+
                          '</div>'+
                          '<!-- /Cantidad del producto -->'+
                          '<!-- Precio del producto -->'+
                          '<div class="col-xs-3 ingresoPresio" style="padding-left:0px">'+
                            '<div class="input-group">'+
                              '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                              '<input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" precioReal = "'+precio+'" value="'+precio+'" readonly required />'+
                            '</div>'+
                          '</div>'+
                          '<!-- /Precio del producto -->'+
                        '</div>'
            );
            //sumar todos los precios
            sumarTotalPrecio();
            //total con impuesto
            agregarImpuesto();
            //agregar lista de producto
            listarProductos();
            //poner formato al precio de los productos
            $(".nuevoPrecioProducto").number(true,2);
        }
    });
});
/*=====================================================================
Cuando este navegando en la tabla
=====================================================================*/
$(".tablasVenta").on("draw.dt",function(){
    if(localStorage.getItem("quitarProducto") != null)
    {
        var listaIdProductos = JSON.parse(localStorage.getItem("quitarProducto"));
        for(var i = 0; i < listaIdProductos.length; i++)
        {
            $("button.recuperarBoton[idProducto ="+listaIdProductos[i]["idProducto"]+"]").removeClass("btn-default");
            $("button.recuperarBoton[idProducto ="+listaIdProductos[i]["idProducto"]+"]").addClass("btn-primary agregarProducto");
        }
    }
});

/*=====================================================================
Remover Producto de la venta
=====================================================================*/
var idQuitarProducto = [];
localStorage.removeItem("quitarProducto");
 $(document).on("click","button.quitarProducto",function(){
    $(this).parent().parent().parent().parent().remove();
    var idProducto = $(this).attr("idProducto");
    /*=====================================================================
    Remover Producto de la venta
    =====================================================================*/
    if(localStorage.getItem("quitarProducto") == null)
        idQuitarProducto = [];
    else
        idQuitarProducto.concat(localStorage.getItem("quitarProducto"));
    idQuitarProducto.push({"idProducto": idProducto});
    localStorage.setItem("quitarProducto",JSON.stringify(idQuitarProducto));
    $("button.recuperarBoton[idProducto ="+idProducto+"]").removeClass("btn-default");
    $("button.recuperarBoton[idProducto ="+idProducto+"]").addClass("btn-primary agregarProducto");
    
    if($(".nuevoProducto").children().length == 0){
        $("#nuevoTotalVenta").val(0);
        $("#totalVenta").val(0);
        $("#nuevoImpuestoVenta").val(0)
        $("#nuevoTotalVenta").attr("total",0);
    }
    else{
        //sumar todos los precios
        sumarTotalPrecio();
        //total con impuesto
        agregarImpuesto();
        //agregar lista de producto
        listarProductos();
    }
 });

 var numProducto = 0;
/*=====================================================================
Agregar Producto desde los despositivos movil
=====================================================================*/
$(".btnAgregarProducto").click(function(){
    numProducto++;
    var datos = new FormData();
    datos.append("traerProducto","ok");

    $.ajax({
        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            $(".nuevoProducto").append(
                '<div class="row" style="padding: 5px 15px">'+
                    '<!-- Descripcion del producto -->'+
                    '<div class="col-xs-6" style="padding-right:0px">'+
                        '<div class="input-group">'+
                            '<span class="input-group-addon">'+
                            '<button type="button" class="btn btn-danger btn-xs quitarProducto" idProducto>'+
                                '<i Class="fa fa-times"></i>'+
                            '</button>'+
                            '</span>'+
                            '<select class="form-control nuevaDescripcionProducto" id="producto'+numProducto+'" idProducto name="nuevaDescripcionProducto" required>'+
                                '<option>Seleccione el producto</option>'+
                            '</select>'+
                        '</div>'+
                    '</div>'+
                    '<!-- /Descripcion del producto -->'+
                    '<!-- Cantidad del producto -->'+
                    '<div class="col-xs-3 ingresoCantidad">'+
                        '<input type="number" class="form-control nuevoCantidadProducto" name="nuevoCantidadProducto" min="1" stock  nuevoStock value="1" placeholder="1" required />'+
                    '</div>'+
                    '<!-- /Cantidad del producto -->'+
                    '<!-- Precio del producto -->'+
                    '<div class="col-xs-3 ingresoPresio" style="padding-left:0px">'+
                        '<div class="input-group">'+
                            '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                            '<input type="text" class="form-control nuevoPrecioProducto" name="nuevoPrecioProducto" precioReal readonly required />'+
                        '</div>'+
                    '</div>'+
                    '<!-- /Precio del producto -->'+
                '</div>');

            //AgregarProducto al select
            respuesta.forEach(funcionForEach);
            function funcionForEach(item,index){
                if(item.stock != 0)
                {
                    $("#producto"+numProducto).append(
                        '<option idProducto="'+item.id+'" value="'+item.descripcion+'">'+item.descripcion+'</option>'
                    );
                }
            }
            //sumar todos los precios
            sumarTotalPrecio();
            //total con impuesto
            agregarImpuesto();
            //poner formato al precio de los productos
            $(".nuevoPrecioProducto").number(true,2);
        }
    });
});

/*=====================================================================
Seleccionar producto
=====================================================================*/
$(document).on("change","select.nuevaDescripcionProducto",function(){
    var nombreProducto = $(this).val();
    var datos = new FormData();
    var nuevoPrecioProducto = $(this).parent().parent().parent().children(".ingresoPresio").children().children(".nuevoPrecioProducto");
    var nuevoIngresoProducto = $(this).parent().parent().parent().children(".ingresoCantidad").children(".nuevoCantidadProducto");
    datos.append("nombreProducto",nombreProducto);
    
    $.ajax({
        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){

            $(nuevoIngresoProducto).attr("stock",respuesta["stock"]);
            $(nuevoIngresoProducto).attr("nuevoStock",Number(respuesta["stock"])-1);
            $(nuevoPrecioProducto).val(respuesta["precio_venta"]);
            $(nuevoPrecioProducto).attr("precioReal",respuesta["precio_venta"]);
            //agregar lista de producto
            listarProductos();
        }
    });
});
/*=====================================================================
Modificar la cantidad
=====================================================================*/
$(document).on("change","input.nuevoCantidadProducto",function(){
    var precio = $(this).parent().parent().children(".ingresoPresio").children().children(".nuevoPrecioProducto");
    var nuevoStock = Number($(this).attr("stock")) - Number($(this).val());
    $(this).attr("nuevoStock",nuevoStock);
    if(Number($(this).val()) > Number($(this).attr("stock")))
    {
        $(this).val(1);
        swal({
            icon: "error",
            title: "¡La cantidad supera al stock!",
            text: "¡Solo hay "+$(this).attr("stock")+" unidades disponibles!",
            Button: true,
            Button:{text: "¡Cerrar!"},
        });
    }
    var precioFinal = $(this).val() * $(precio).attr("precioReal");
    precio.val(precioFinal);
    //sumar todos los precios
    sumarTotalPrecio();
    //total con impuesto
    agregarImpuesto();
    //agregar lista de producto
    listarProductos();
});

/*=====================================================================
Sumar todos los precios
=====================================================================*/
function sumarTotalPrecio(){
    var precioItem = $(".nuevoPrecioProducto");
    var arraySumaPrecio = [];

    for(var i = 0; i < precioItem.length; i++){
        arraySumaPrecio.push(Number($(precioItem[i]).val()));
    }
    function sumaArrayPrecio(total,numero){
        return total + numero;
    }

    var sumaTotalPrecio = arraySumaPrecio.reduce(sumaArrayPrecio);
    $("#nuevoTotalVenta").val(sumaTotalPrecio);
    $("#totalVenta").val(sumaTotalPrecio);
    $("#nuevoTotalVenta").attr("total",sumaTotalPrecio);
}

/*=====================================================================
Sumar los impuestos
=====================================================================*/
function agregarImpuesto(){
    var impuesto = $("#nuevoImpuestoVenta").val();
    var precioTotal = $("#nuevoTotalVenta").attr("total");
    var precioImpuesto = Number(precioTotal * impuesto / 100);
    var totalConImpuesto = Number(precioImpuesto) + Number(precioTotal);
    $("#nuevoPrecioImpuesto").val(precioImpuesto);
    $("#nuevoPrecioNeto").val(precioTotal);
    $("#nuevoTotalVenta").val(totalConImpuesto);
    $("#totalVenta").val(totalConImpuesto);
    $("#sumaTotalPrecio").val(totalConImpuesto);
}
/*=====================================================================
Cuando Cambia el impuesto
=====================================================================*/
$("#nuevoImpuestoVenta").change(function(){
    agregarImpuesto();
    listarProductos();
});

/*=====================================================================
Cuando Cambia el impuesto
=====================================================================*/
$("#nuevoTotalVenta").number(true,2);

/*=====================================================================
Seleccionar Metodo de Pago
=====================================================================*/
$("#nuevoMetodoPago").change(function(){
    var metodo = $(this).val();
    if(metodo == "Efectivo")
    {
        $(this).parent().parent().removeClass("col-xs-6");
        $(this).parent().parent().addClass("col-xs-4");
        $(this).parent().parent().parent().children(".cajaMetodoPago").html(
            '<div class="col-xs-4">'+
                '<div class="input-group">'+
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                    '<input type="text" class="form-control" id="nuevoValorEfectivo" name="nuevoValorEfectivo" placeholder="000000" required />'+
                '</div>'+
            '</div>'+
            '<div class="col-xs-4" id="capturarCambioEfectivo" style="padding-left:0px">'+
                '<div class="input-group">'+
                    '<span class="input-group-addon"><i class="ion ion-social-usd"></i></span>'+
                    '<input type="text" class="form-control" id="nuevoCambioEfectivo" name="nuevoCambioEfectivo" placeholder="000000" readonly required />'+
                '</div>'+
            '</div>'
        );
        //Agregar formato al precio
        $("#nuevoValorEfectivo").number(true,2);
        $("#nuevoCambioEfectivo").number(true,2);
        //listar metodo en la entrada
        listarMetodos();
    }
    else
    {
        $(this).parent().parent().removeClass("col-xs-6");
        $(this).parent().parent().addClass("col-xs-4");
        $(this).parent().parent().parent().children(".cajaMetodoPago").html(
            '<div class="col-xs-6" style="padding-left:0px">'+
                '<div class="input-group">'+
                    '<input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="codigo Transaccion" required />'+
                    '<span class="input-group-addon"> <i class="fa fa-lock"></i> </span>'+
                '</div>'+
            '</div>'
        );
    }
});

/*=====================================================================
Cambio en efectivo
=====================================================================*/
$(document).on("change","input#nuevoValorEfectivo", function(){
    var efectivo = $(this).val();
    if( Number(efectivo) > Number($("#nuevoTotalVenta").val()))
    {
        var cambio = Number(efectivo) - Number($("#nuevoTotalVenta").val());
        var nuevoCambioEfectivo = $(this).parent().parent().parent().children("#capturarCambioEfectivo").children().children("#nuevoCambioEfectivo");
        nuevoCambioEfectivo.val(cambio);
    }
    else
    {
        swal({
            icon: "error",
            title: "¡La cantidad es menor al valor total de la Compra!",
            Button: true,
            Button:{text: "¡Cerrar!"},
        });
        $(this).val(0);
        $(this).attr("placeholder","000000");
    }
});

/*=====================================================================
Cambio transaccion
=====================================================================*/
$(document).on("change","input#nuevoCodigoTransaccion", function(){
    //listar metodo en la entrada
    listarMetodos();
});

/*=====================================================================
listar todos los productos
=====================================================================*/
function listarProductos(){
    var listaProductos = [];
	var descripcion = $(".nuevaDescripcionProducto");
	var cantidad = $(".nuevoCantidadProducto");
	var precio = $(".nuevoPrecioProducto");

	for(var i = 0; i < descripcion.length; i++){
		listaProductos.push({ "id" : $(descripcion[i]).attr("idProducto"), 
							  "descripcion" : $(descripcion[i]).val(),
							  "cantidad" : $(cantidad[i]).val(),
							  "stock" : $(cantidad[i]).attr("nuevoStock"),
							  "precio" : $(precio[i]).attr("precioReal"),
							  "total" : $(precio[i]).val()});
    }
	$("#listaProductos").val(JSON.stringify(listaProductos)); 
}

/*=====================================================================
listar metodo de pago
=====================================================================*/
function listarMetodos(){
    var listaMetodo = "";
    if($("#nuevoMetodoPago").val() == "Efectivo")
        $("#listaMetodoPago").val("Efectivo");
    else
        $("#listaMetodoPago").val($("#nuevoMetodoPago").val()+ "-" + $("#nuevoCodigoTransaccion").val());
}

/*=====================================================================
Boton Editar Venta
=====================================================================*/
$(document).on("click",".btnEditarVenta",function(){
    var idVenta = $(this).attr("idVenta");
    window.location = "index.php?ruta=editar-venta&idVenta="+idVenta;
});
/*=====================================================================
Funcion para desactivar los botones agregar 
=====================================================================*/
function quitarAgregarProducto()
{
    var idProducto = $(".quitarProducto");
    var botonesTabla = $(".tablasVenta tbody button.agregarProducto");
    for(var i = 0; i < idProducto.length; i++)
    {
        var boton = $(idProducto[i]).attr("idProducto");
        for(var j = 0; j < botonesTabla.length; j++)
        {
            if($(botonesTabla[j]).attr("idProducto") == boton)
            {
                $(botonesTabla[j]).removeClass("btn-primary agregarProducto");
                $(botonesTabla[j]).addClass("btn-default");
            }
        }
    }
}
/*=====================================================================
Cuando este navegando en la tabla
=====================================================================*/
$(".tablasVenta").on("draw.dt",function(){
    quitarAgregarProducto();
});
/*=====================================================================
Borrar Venta
=====================================================================*/
$(document).on("click",".btnEliminarVenta",function(){
    var idVenta = $(this).attr("idVenta");
    swal({
        title: '¿Quieres eliminar la venta?',
        text: '!Si no lo esta puede cancelar la accion¡',
        icon: 'warning',
        buttons:{
            cancel:{
                text: "Cancelar",
                value: null,
                visible: true,
                className: "",
                closeModal: true,
            },
            confirm:{
                text: "Si, Borrar Venta!",
                value: true,
                visible: true,
                className: "",
                closeModal: true,
            }
        }
    }).then((result)=>{
        if(result)
        {
            window.location = "index.php?ruta=administrar-ventas&idVenta="+idVenta;
        }
    });
});
/*=====================================================================
IMprimir Factura
=====================================================================*/
$(document).on("click",".btnImprimirFactura",function(){
    var codigoVenta = $(this).attr("codigoVenta");
    window.open("extenciones/tcpdf/pdf/factura.php?codigo="+codigoVenta,"_blank");
});

/*=====================================================================
Rango de Fecha
=====================================================================*/
//Date range as a button
$('#daterange-btn').daterangepicker(
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
      $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
      var fechaInicial = start.format('YYYY-MM-DD');
      var fechaFinal = end.format('YYYY-MM-DD');
      console.log("fecha Inicial: ",fechaInicial);
      console.log("fecha Final: ",fechaFinal);
      var capturaRango = $("#daterange-btn span").html();
      localStorage.setItem("capturarRango",capturaRango);
      window.location = "index.php?ruta=administrar-ventas&fechaInical="+ fechaInicial +"&fechaFinal="+ fechaFinal;
    }
  );
/*=====================================================================
Cancelar Rango de Fecha
=====================================================================*/
$(".opensleft .ranges .range_inputs .cancelBtn").on("click",function(){
    localStorage.removeItem("capturarRango");
    localStorage.clear();
    window.location = "administrar-ventas";
});
/*=====================================================================
Capturar hoy
=====================================================================*/
$(".opensleft .ranges li").on("click",function(){
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
        localStorage.setItem("capturarRango","Hoy");
        window.location = "index.php?ruta=administrar-ventas&fechaInical="+ fechaInicial +"&fechaFinal="+ fechaFinal;
    }
});