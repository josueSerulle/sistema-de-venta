 /*===============================================
  =       Validar cedula Cliente        =
  ===============================================*/
function validarCedula(cedula){
    var contador = 1 /*contador*/,ultimoDIgito = 0,suma = 0;
    var linea = "";

    //bulce de busqueda y multiplicar
    cedula.split('').forEach(element => {
        if(element != '-')
        {
            if(contador % 2 == 0)
                linea += (Number(element * 2));
            else if(contador != 11)
                linea += element;
            contador++;
            if(contador == 12)
                ultimoDIgito = Number(element);
        }
    });

    //bucle de suma
    linea.split('').forEach(element => {
        suma += Number(element);
    });

    return (suma + ultimoDIgito) % 10 == 0? true : false;
}

$("#nuevoDocumento").change(function (){
    if(!validarCedula($(this).val()))
    {
        swal({
            icon: "error",
            title: "¡Cedula invalida!",
            Button: true,
            Button:{text: "Cerrar"},
        });
        $(this).val("");
    }   
});
$("#editarDocumento").change(function (){
    if(!validarCedula($(this).val()))
    {
        swal({
            icon: "error",
            title: "¡Cedula invalida!",
            Button: true,
            Button:{text: "Cerrar"},
        });
        $(this).val("");
    }   
});
/*===============================================
  =       Editar cliente        =
  ===============================================*/
$(document).on("click",".btnEditarCliente",function(){
    var idCliente = $(this).attr("idCliente");
    var datos = new FormData();
    datos.append("idCliente",idCliente);

    $.ajax({
        url:"ajax/cliente.ajax.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta)
        {
            $("#idCliente").val(respuesta["id"]);
            $("#editarCliente").val(respuesta["nombre"]);
            $("#editarDocumento").val(respuesta["documento"]);
            $("#editarEmail").val(respuesta["email"]);
            $("#editarTelefono").val(respuesta["telefono"]);
            $("#editarDireccion").val(respuesta["direccion"]);
            $("#editarfecha").val(respuesta["fecha_Nacimiento"]);
        }
    });
});
/*===============================================
  =       Eliminar cliente         =
  ===============================================*/
$(document).on("click",".btnEliminar",function(){
    var idCliente = $(this).attr("idCliente");
    swal({
        title: '¿Quieres eliminar Cliente?',
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
                text: "Si, Borrar Cliente!",
                value: true,
                visible: true,
                className: "",
                closeModal: true,
            }
        }
    }).then((result)=>{
        if(result)
        {
            window.location = "index.php?ruta=cliente&idCliente="+idCliente;
        }
    });
});