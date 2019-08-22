/*===============================================
  =       Subiendo la foto del usuraio          =
  ===============================================
*/

$(".nuevaFoto").change(function(){
    var imagen = this.files[0];
    //console.log("imagen ",imagen);

    if(imagen["type"] != "image/jpeg" && imagen["type"] != "image/png")
    {
        $(".nuevaFoto").val("");
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
        $(".nuevaFoto").val("");
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
  =       Editar usuario         =
  ===============================================
*/

$(document).on("click",".btnEditarUsuario",function(){
    var idUsuario = $(this).attr("idUsuario");
    var datos = new FormData();
    datos.append("idUsuario",idUsuario);

    $.ajax({
        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta)
        {
            $("#editarNombre").val(respuesta["Nombre"]);
            $("#EditarUsuario").val(respuesta["usuario"]);
            $("#editarPerfil").html(respuesta["perfil"]);
            $("#passwordActual").val(respuesta["password"]);
            $("#editarPerfil").val(respuesta["perfil"]);
            $("#fotoActual").val(respuesta["foto"]);
            
            if(respuesta["foto"] != "")
            {
                $(".previsualizar").attr("src",respuesta["foto"]);
            }
        }
    });
});
/*===============================================
  =       Activar/Desactivar usuario         =
  ===============================================
*/
$(document).on("click",".btnActivar",function(){
    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();
    datos.append("activarId",idUsuario);
    datos.append("activarEstado",estadoUsuario);

    $.ajax({
        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        success: function(respuesta){
            window.location = "usuarios";
        }
    });

    if(estadoUsuario == 0)
    {
        $(this).removeClass("btn-success");
        $(this).addClass("btn-danger");
        $(this).html("Desactivado");
        $(this).attr("idUsuario",1);
    }
    else
    {
        $(this).addClass("btn-success");
        $(this).removeClass("btn-danger");
        $(this).html("Activado");
        $(this).attr("idUsuario",0);
    }
});
/*===============================================
  =       No Repetir usuario         =
  ===============================================
*/

$("#nuevoUsuario").change(function(){
    $(".alert").remove();
    
    var usuario = $(this).val();
    var datos = new FormData();
    datos.append("validarUsuario",usuario);
    $.ajax({
        url:"ajax/usuarios.ajax.php",
        method: "POST",
        data: datos, 
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta)
        {
            if(respuesta)
            {
                $("#nuevoUsuario").parent().after('<div class= "alert alert-warning">Este usuario ya existe</div>');
                $("#nuevoUsuario").val("");
            }
        }
    });
});
/*===============================================
  =       Eliminar usuario         =
  ===============================================
*/
$(document).on("click",".btnEliminar",function(){
    var idUsuario = $(this).attr("idUsuario");
    var fotoUsuario = $(this).attr("fotoUsuario");
    var usuario = $(this).attr("usuario");
    swal({
        title: '¿Quieres eliminar usuario?',
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
                text: "Si, Borrar Usuario!",
                value: true,
                visible: true,
                className: "",
                closeModal: true,
            }
        }
    }).then((result)=>{
        if(result)
        {
            window.location = "index.php?ruta=usuarios&idUsuario="+idUsuario+"&usuario="+usuario+"&fotoUsuario="+fotoUsuario;
        }
    });
});