<?php
    class ControladorCliente
    {
        /*======================================================================================================
        Crear Cliente
        ======================================================================================================*/
        static public function ctrCrearCliente()
        {
            if(isset($_POST["nuevoCliente"]))
            {
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoCliente"]) &&
                   preg_match('/^[\-0-9]+$/',$_POST["nuevoDocumento"]) &&
                   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["nuevoEmail"]) &&
                   preg_match('/^[()\-0-9 ]+$/',$_POST["nuevoTelefono"]) &&
                   preg_match('/^[#\.\-\/0-9a-zA-z ]+$/',$_POST["nuevoDireccion"]) &&
                   preg_match('/^[\/0-9]+$/',$_POST["nuevofecha"]))
                {
                    $datos = array("nombre" => $_POST["nuevoCliente"],
                                    "documento" => $_POST["nuevoDocumento"],
                                    "email" => $_POST["nuevoEmail"],
                                    "telefono" => $_POST["nuevoTelefono"],
                                    "direccion" => $_POST["nuevoDireccion"],
                                    "fecha" => $_POST["nuevofecha"]);
                    $respuesta = ModeloCliente::mdlCrearCliente("cliente",$datos);
                    
                    if($respuesta == "ok")
                    {
                        echo '<script>
                                swal({
                                    icon: "success",
                                    title: "¡El cliente ha sido Registrada!",
                                    Button: true,
                                    Button:{text: "Cerrar"},
                                    closeModal: false
                                    }).then((result) => {
                                    if(result)
                                    {
                                        window.location = "cliente";
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
                            title: "¡El cliente no puede ir vacio o llevar caracteres especiales!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "cliente";
                            }
                        });
                    </script>';
                }
            }
        }
        /*======================================================================================================
        Mostrar Cliente
        ======================================================================================================*/
        static public function ctrMostrarCliente($item,$valor)
        {
            $respuesta = ModeloCliente::mdlMostrarCliente("cliente",$item,$valor);
            return $respuesta;
        }
        /*======================================================================================================
        Crear Cliente
        ======================================================================================================*/
        static public function ctrEditarCliente()
        {
            if(isset($_POST["editarCliente"]))
            {
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarCliente"]) &&
                   preg_match('/^[\-0-9]+$/',$_POST["editarDocumento"]) &&
                   preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["editarEmail"]) &&
                   preg_match('/^[()\-0-9 ]+$/',$_POST["editarTelefono"]) &&
                   preg_match('/^[#\.\-\/0-9a-zA-z ]+$/',$_POST["editarDireccion"]) &&
                   preg_match('/^[\/0-9]+$/',$_POST["editarfecha"]))
                {
                    $datos = array("id" => $_POST["idCliente"],
                                   "nombre" => $_POST["editarCliente"],
                                   "documento" => $_POST["editarDocumento"],
                                   "email" => $_POST["editarEmail"],
                                   "telefono" => $_POST["editarTelefono"],
                                   "direccion" => $_POST["editarDireccion"],
                                   "fecha" => $_POST["editarfecha"]);
                    $respuesta = ModeloCliente::mdlEditarCliente("cliente",$datos);

                    if($respuesta == "ok")
                    {
                        echo '<script>
                                swal({
                                    icon: "success",
                                    title: "¡El cliente ha sido Modificado Correctamente!",
                                    Button: true,
                                    Button:{text: "Cerrar"},
                                    closeModal: false
                                    }).then((result) => {
                                    if(result)
                                    {
                                        window.location = "cliente";
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
                            title: "¡El cliente no puede ir vacio o llevar caracteres especiales!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "cliente";
                            }
                        });
                    </script>';
                }
            }
        }
        /*======================================================================================================
        Eliminar Cliente
        ======================================================================================================*/
        static public function ctrEliminarCliente()
        {
            if(isset($_GET["idCliente"]))
            {
                $respuesta = ModeloCliente::mdlEliminarCliente("cliente","id",$_GET["idCliente"]);

                if($respuesta == "ok")
                {
                    echo '<script>
                        swal({
                            icon: "success",
                            title: "¡El cliente ha sido eliminado!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "cliente";
                            }
                        });
                    </script>';
                }
            }
        }
    }