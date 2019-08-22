/*=====================================================================
Cargar la tabla dinamica de productos
 =====================================================================*/
var perfilOculto = $("#perfilOculto").val();
console.log("Perfil: ",perfilOculto);
$(".tablasProductos").DataTable( {
    "ajax": "ajax/tableProductos.ajax.php?perfilOculto="+perfilOculto,
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
Generando Codigo del productos
=====================================================================*/
$("#nuevoCategoria").change(function(){
    var idCategoria = $(this).val();
    var datos = new FormData();
    datos.append("idCategoria",idCategoria);
    $.ajax({
        url:"ajax/productos.ajax.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            var codigo;
            if(!respuesta)
                codigo = idCategoria + "01";
            else if(Number(respuesta["codigo"].substr(1,respuesta["codigo"].lenght)) < 9)
                codigo = idCategoria + "0" + (Number(respuesta["codigo"].substr(1,respuesta["codigo"].lenght)) + 1)
            else
                codigo = idCategoria + (Number(respuesta["codigo"].substr(1,respuesta["codigo"].lenght)) + 1);
            $("#nuevoCodigo").val(codigo);  
        }     
    });
});

/*=====================================================================
Generando Precio de Compra
=====================================================================*/
$("#nuevoPrecioCompra,#editarPrecioCompra").change(function(){
    if($(".porcentaje").prop("checked")) {
        var valorProcentaje = $(".nuevoPorcentaje").val();
        var porcentaje = Number(($("#nuevoPrecioCompra").val() * valorProcentaje / 100)) + Number($("#nuevoPrecioCompra").val());
        var editarPorcentaje = Number(($("#editarPrecioCompra").val() * valorProcentaje / 100)) + Number($("#editarPrecioCompra").val());

        $("#nuevoPrecioVenta").val(porcentaje);
        $("#nuevoPrecioVenta").prop("readonly",true);

        $("#editarPrecioVenta").val(editarPorcentaje);
        $("#editarPrecioVenta").prop("readonly",true);
    }
});
$(".nuevoPorcentaje").change(function(){
    if($(".porcentaje").prop("checked")) {
        var valorProcentaje = $(this).val();
        var porcentaje = Number(($("#nuevoPrecioCompra").val() * valorProcentaje / 100)) + Number($("#nuevoPrecioCompra").val());
        var editarPorcentaje = Number(($("#editarPrecioCompra").val() * valorProcentaje / 100)) + Number($("#editarPrecioCompra").val());
        
        $("#nuevoPrecioVenta").val(porcentaje);
        $("#nuevoPrecioVenta").prop("readonly",true);

        $("#editarPrecioVenta").val(editarPorcentaje);
        $("#editarPrecioVenta").prop("readonly",true);
    }
});
$(".porcentaje").on("ifUnchecked", function(){
    $("#nuevoPrecioVenta").prop("readonly",false);
    $("#editarPrecioVenta").prop("readonly",false);
});
$(".porcentaje").on("ifChecked", function(){
    $("#nuevoPrecioVenta").prop("readonly",true);
    $("#editarPrecioVenta").prop("readonly",true);
});
/*===============================================
  =       Subiendo la foto del Producto         =
  ===============================================*/
$(".nuevaImagen").change(function(){
    var imagen = this.files[0];
    //console.log("imagen ",imagen);

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
    {
        $(".nuevaImagen").val("");
        swal({
            icon: "error",
            title: "¡La imagen tiene que ser JPG o PNG!",
            Button: true,
            Button:{text: "Cerrar"},
            closeModal: false
        });
    }
    else if(imagen["size"] > 2000000)
    {
        $(".nuevaImagen").val("");
        swal({
            icon: "error",
            title: "¡La imagen no puede ser mayor de 2 MB!",
            Button: true,
            Button:{text: "Cerrar"},
            closeModal: false
        });
    }
    else
    {
        datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load",function (event){
            var rutaImagen = event.target.result;
            $(".previsualizar").attr("src",rutaImagen);
        });
    }
});
/*===============================================
  =       Editar el Producto         =
===============================================*/
  $(document).on("click","button.btnEditarProducto", function(){
    var idProducto = $(this).attr("idProducto");
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
            var datos = new FormData();
            datos.append("idCategoria",respuesta["id_categoria"]);
            $.ajax({
                url:"ajax/categoria.ajax.php",
                method: "POST",
                data: datos, 
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta){
                    $("#editarCategoria").val(respuesta["id"]);
                    $("#editarCategoria").html(respuesta["categoria"]);
                }     
            });
            $("#editarCodigo").val(respuesta["codigo"]);
            $("#editarDescripcion").val(respuesta["descripcion"]);
            $("#editarStock").val(respuesta["stock"]);
            $("#editarPrecioCompra").val(respuesta["precio_compra"]);
            $("#editarPrecioVenta").val(respuesta["precio_venta"]);
            if(respuesta["imagen"] != 0){
                $("#imagenActual").val(respuesta["imagen"]);
                $(".previsualizar").attr("src",respuesta["imagen"]);
            }
            
        }     
    });
});
/*===============================================
  =       Editar el Producto         =
===============================================*/
$(document).on("click","button.btnEliminarProducto",function(){
    var id = $(this).attr("idProducto");
    var codigo = $(this).attr("codigo");
    var imagen = $(this).attr("imagen");
    swal({
        title: '¿Quieres eliminar el Producto?',
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
                text: "Si, Borrar Producto!",
                value: true,
                visible: true,
                className: "",
                closeModal: true,
            }
        }
    }).then((result)=>{
        if(result)
        {
            window.location = "index.php?ruta=producto&id="+id+"&codigo="+codigo+"&imagen="+imagen;
        }
    });
});