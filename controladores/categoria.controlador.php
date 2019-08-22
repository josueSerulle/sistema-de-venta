<?php
    class ContrladorCategorias
    {
        /*======================================================================================================
        Crear Categoria
        ======================================================================================================*/
        static public function  ctrCrearCategoria()
        {
            if(isset($_POST["nuevaCategoria"]))
            {
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevaCategoria"]))
                {
                    $tabla = "categoria";
                    $datos = $_POST["nuevaCategoria"];

                    $respuesta = ModeloCategoria::mdlINgresarCategoria($tabla,$datos);

                    if($respuesta == "ok")
                    {
                        echo '<script>
                            swal({
                                icon: "success",
                                title: "¡La Categoria ha sido Registrada!",
                                Button: true,
                                Button:{text: "Cerrar"},
                                closeModal: false
                            }).then((result) => {
                            if(result)
                            {
                                window.location = "categorias";
                            }
                        });
                        </script>';    
                    }
                }
                else
                {
                    echo '<script>
                    swal({
                        icon: "error",
                        title: "¡La Categoria no puede ir vacio o llevar caracteres especiales!",
                        Button: true,
                        Button:{text: "Cerrar"},
                        closeModal: false
                    }).then((result) => {
                        if(result)
                        {
                            window.location = "categorias";
                        }
                    });
                    </script>';
                }
            }
        }
        /*======================================================================================================
        Mostrar Categoria 
        ======================================================================================================*/
        static public function ctrMostrarCategoria($item,$valor)
        {
            $tabla = "categoria";
            $respuesta = ModeloCategoria::mdlMostrarCategoria($tabla,$item,$valor);
            return $respuesta;
        }
        /*======================================================================================================
        Editar Categoria 
        ======================================================================================================*/
        static public function ctreditarCategoria()
        {
            if(isset($_POST["editarCategoria"]))
            {
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarCategoria"]))
                {
                    $tabla = "categoria";
                    $datos = array("id" => $_POST["editarIdCategoria"],
                                    "categoria" => $_POST["editarCategoria"]);

                    $respuesta = ModeloCategoria::mdlEditarCategoria($tabla,$datos);

                    if($respuesta == "ok")
                    {
                        echo '<script>
                            swal({
                                icon: "success",
                                title: "¡La Categoria ha sido Modificada!",
                                Button: true,
                                Button:{text: "Cerrar"},
                                closeModal: false
                            }).then((result) => {
                            if(result)
                            {
                                window.location = "categorias";
                            }
                        });
                        </script>';    
                    }
                }
                else
                {
                    echo '<script>
                    swal({
                        icon: "error",
                        title: "¡La Categoria no puede ir vacio o llevar caracteres especiales!",
                        Button: true,
                        Button:{text: "Cerrar"},
                        closeModal: false
                    }).then((result) => {
                        if(result)
                        {
                            window.location = "categorias";
                        }
                    });
                    </script>';
                }
            }
        }
        /*======================================================================================================
        Borrar Categoria 
        ======================================================================================================*/
        static public function ctrBorrarCategoria()
        {
            if(isset($_GET["idCategoria"]))
            {
                $tabla = "categoria";
                $datos = $_GET["idCategoria"];
                $respuesta = ModeloCategoria::mdlBorrarCategoria($tabla,$datos);

                if($respuesta == "ok")
                {
                    echo '<script>
                        swal({
                            icon: "success",
                            title: "¡La Categoria ha sido borrado correctamente!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "categorias";
                            }
                        });
                    </script>';  
                }
            }
        }
    }