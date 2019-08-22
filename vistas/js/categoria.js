/*===============================================
  =       No Repetir Categoria         =
  ===============================================
*/
$("#nuevaCategoria").change(function (){
    $(".alert").remove();

    var categoria = $(this).val();
    var datos = new FormData();
    datos.append("validarCategoria",categoria);

    $.ajax({
        url:"ajax/categoria.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            if(respuesta)
            {
                $("#nuevaCategoria").parent().after('<div class= "alert alert-warning">Esta Categoria ya existe</div>');   
                $("#nuevaCategoria").val("");
            }
        }
    });
});
/*===============================================
  =       Editar Categoria         =
  ===============================================
*/
$(document).on("click",".btnEditarCategoria",function(){
    var idCategoria = $(this).attr("idCategoria");
    var datos = new FormData();
    datos.append("idCategoria",idCategoria);

    $.ajax({
        url:"ajax/categoria.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta){
            $("#editarCategoria").val(respuesta["categoria"]);
            $("#editarIdCategoria").val(respuesta["id"]);
        }
    });
});
/*===============================================
  =       Eliminar Categoria         =
  ===============================================
*/
$(document).on("click",".btnEliminarCategoria", function(){
    var idCategoria = $(this).attr("idCategoria");
    swal({
        title: '¿Quieres eliminar Categoria?',
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
                text: "Si, Borrar Categoria!",
                value: true,
                visible: true,
                className: "",
                closeModal: true,
            }
        }
    }).then((result)=>{
        if(result)
        {
            window.location = "index.php?ruta=categorias&idCategoria="+idCategoria;
        }
    }); 
});