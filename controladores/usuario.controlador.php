<?php
    class ControladorUsuario
    {
        /*=====================================================================================================
        Metodo para Ingreso de usario
        =====================================================================================================*/
        static public function ctrIngresoUsuario()
        {
            if(isset($_POST["ingUsuario"]))
            {
                if(preg_match('/^[a-zA-Z0-9]+$/',$_POST["ingUsuario"]) && preg_match('/^[a-zA-Z0-9]+$/',$_POST["ingPassword"])) 
                {
                    $tabla = "usuarios";
                    $item = "usuario";
                    $valor = $_POST["ingUsuario"];

                    $repuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla,$item,$valor);
                    $encrypt = crypt($_POST["ingPassword"],'$2a$07$usesomesillystringforsalt$');
                    if($repuesta["usuario"] == $_POST["ingUsuario"] && $repuesta["password"] == $encrypt)
                    {
                        if($repuesta["estado"] != 0)
                        {
                            $_SESSION["iniciarSesion"] = "ok";
                            $_SESSION["id"] = $repuesta["id"];
                            $_SESSION["nombre"] = $repuesta["Nombre"];
                            $_SESSION["pass"] = $repuesta["password"];
                            $_SESSION["perfil"] = $repuesta["perfil"];
                            $_SESSION["foto"] = $repuesta["foto"];
                            /*=====================================================================================================
                            Fecha del ultimo login
                            =====================================================================================================*/
                            date_default_timezone_set("America/Santo_Domingo");
                            $fechaActual = date('Y-m-d')." ".date('H:i:s');
                            $ultimoLogin = ModeloUsuarios:: MdlActualizarUsuario($tabla,"ultimo_login",$fechaActual,"id",$repuesta["id"]);

                            if($ultimoLogin == "ok")
                            {
                                echo '<script>
                                    window.location = "inicio";
                                </script>';
                            }
                        }
                        else
                        {
                            echo '<br /> <div class="alert alert-danger">El usuario no esta Activado</div>';    
                        }
                    }
                    else
                    {
                        echo '<br /> <div class="alert alert-danger">Error,Vuelve al intentarlo</div>';
                    }
                }
            }
        }
        /*=====================================================================================================
        Metodo para Crear de usario
        =====================================================================================================*/
        static public function ctrCrearUsuario()
        {
            $ruta = "";
            if(isset($_POST["nuevoUsuario"]))
            {
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoNombre"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoUsuario"]) &&
                    preg_match('/^[a-zA-Z0-9]+$/',$_POST["nuevoPassword"]))
                {
                    /*=====================================================================================================
                    Metodo para guardar la foto
                    =====================================================================================================*/
                    if(isset($_FILES["nuevaFoto"]["tmp_name"]))
                    {
                        list($ancho,$alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
                        $nuevoAncho = 500;
                        $nuevoLargo = 500;
                        /*=====================================================================================================
                        Metodo para crear el directorio de la foto
                        =====================================================================================================*/
                        $directorio = "vistas/imagenes/usuario/".$_POST["nuevoUsuario"];
                        mkdir($directorio, 0755);
                        /*=====================================================================================================
                        De Acuerdo al tipo de imagenes aplicamos las funciones de PHP
                        =====================================================================================================*/
                        if($_FILES["nuevaFoto"]["type"] == "image/jpeg")
                        {
                            /*=====================================================================================================
                            Guardamo la imagen en el directorio JPG
                            =====================================================================================================*/
                            $random = mt_rand(1,999);
                            $ruta  = "vistas/imagenes/usuario/".$_POST["nuevoUsuario"]."/".$random.".jpg";
                            $origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho,$nuevoLargo);
                            imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoLargo,$ancho,$alto);
                            imagejpeg($destino,$ruta);
                        }
                        if($_FILES["nuevaFoto"]["type"] == "image/png")
                        {
                            /*=====================================================================================================
                            Guardamo la imagen en el directorio PNG
                            =====================================================================================================*/
                            $random = mt_rand(1,999);
                            $ruta  = "vistas/imagenes/usuario/".$_POST["nuevoUsuario"]."/".$random.".png";
                            $origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho,$nuevoLargo);
                            imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoLargo,$ancho,$alto);
                            imagepng($destino,$ruta);
                        }
                    }
                    $tabla = "usuarios";
                    $encrypt = crypt($_POST["nuevoPassword"],'$2a$07$usesomesillystringforsalt$');
                    $datos = array("nombre"=>$_POST["nuevoNombre"],
                                    "usuario"=>$_POST["nuevoUsuario"],
                                    "password"=>$encrypt,
                                    "perfil"=>$_POST["nuevoPerfil"],
                                    "foto" => $ruta);
                    $repuesta = ModeloUsuarios::MdlIngresarUsuarios($tabla,$datos);
                    if($repuesta == "ok")
                    {
                        echo '<script>
                        swal({
                            icon: "success",
                            title: "¡El usuario ha sido Registrado!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "usuarios";
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
                            title: "¡El usuario no puede ir vacio o llevar caracteres especiales!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "usuarios";
                            }
                        });
                    </script>';
                }
            }
        }

        /*=====================================================================================================
        Metodo para Mostrar usario
        =====================================================================================================*/
        static public function ctrMostrarUsuarios($item,$valor)
        {
            $tabla = "usuarios";
            $repuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla,$item,$valor);
            return $repuesta;
        }
        /*=====================================================================================================
        Metodo para Editar usario
        =====================================================================================================*/
        static public function ctrEditarUsuario()
        {
            if(isset($_POST["EditarUsuario"]))
            {
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarNombre"]))
                {
                    /*=====================================================================================================
                    Metodo para guardar la foto
                    =====================================================================================================*/
                    $ruta = $_POST["fotoActual"];
                    if(isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"]))
                    {
                        list($ancho,$alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
                        $nuevoAncho = 500;
                        $nuevoLargo = 500;
                        /*=====================================================================================================
                        Metodo para crear el directorio de la foto
                        =====================================================================================================*/
                        $directorio = "vistas/imagenes/usuario/".$_POST["EditarUsuario"];
                        /*=====================================================================================================
                        Preguntar si existe la fotoe
                        =====================================================================================================*/
                        if(!empty($_POST["fotoActual"]))
                            unlink($_POST["fotoActual"]);
                        else
                            mkdir($directorio, 0755);
                        /*=====================================================================================================
                        De Acuerdo al tipo de imagenes aplicamos las funciones de PHP
                        =====================================================================================================*/
                        if($_FILES["editarFoto"]["type"] == "image/jpeg")
                        {
                            /*=====================================================================================================
                            Guardamo la imagen en el directorio JPG
                            =====================================================================================================*/
                            $random = mt_rand(1,999);
                            $ruta  = "vistas/imagenes/usuario/".$_POST["EditarUsuario"]."/".$random.".jpg";
                            $origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho,$nuevoLargo);
                            imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoLargo,$ancho,$alto);
                            imagejpeg($destino,$ruta);
                        }
                        if($_FILES["editarFoto"]["type"] == "image/png")
                        {
                            /*=====================================================================================================
                            Guardamo la imagen en el directorio PNG
                            =====================================================================================================*/
                            $random = mt_rand(1,999);
                            $ruta  = "vistas/imagenes/usuario/".$_POST["EditarUsuario"]."/".$random.".png";
                            $origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho,$nuevoLargo);
                            imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoLargo,$ancho,$alto);
                            imagepng($destino,$ruta);
                        }
                    }
                    $tabla = "usuarios";
                    if($_POST["editarPassword"] != "")
                    {
                        if(preg_match('/^[a-zA-Z0-9]+$/',$_POST["editarPassword"]))
                        {
                            $encrypt = crypt($_POST["editarPassword"],'$2a$07$usesomesillystringforsalt$');
                        }
                        else
                        {
                            echo '<script>
                                    swal({
                                        icon: "error",
                                        title: "¡La contraseña no ir vacia o puede llevar caracteres especiales!",
                                        Button: true,
                                        Button:{text: "Cerrar"},
                                        closeModal: false
                                    }).then((result) => {
                                        if(result)
                                        {
                                            window.location = "usuarios";
                                        }
                                    });
                                </script>';
                        }
                    }
                    else
                    {
                        $encrypt = $_POST["passwordActual"];
                    }
                    $datos = array("nombre"=>$_POST["editarNombre"],
                                "usuario"=>$_POST["EditarUsuario"],
                                "password"=>$encrypt,
                                "perfil"=>$_POST["editarPerfil"],
                                "foto" => $ruta);
                    $repuesta = ModeloUsuarios::MdlEditarUsuarios($tabla,$datos);
                    if($repuesta == "ok")
                    {
                        echo '<script>
                        swal({
                            icon: "success",
                            title: "¡El usuario ha sido Modificado!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "usuarios";
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
                            title: "¡El nombre del usuario no puede ir vacio o llevar caracteres especiales!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "usuarios";
                            }
                        });
                    </script>';   
                }
            }
        }
        /*=====================================================================================================
        Metodo para Borrar usario
        =====================================================================================================*/
        static public function ctrBorrarUsuario()
        {
            if(isset($_GET["idUsuario"]))
            {
                $tabla = "usuarios";
                $datos = $_GET["idUsuario"];

                if($_GET["fotoUsuario"] != "")
                {
                    unlink($_GET["fotoUsuario"]);
                    rmdir("vistas/imagenes/usuario/".$_GET["usuario"]);
                }

                $repuesta = ModeloUsuarios::mdlBorrarUsuario($tabla,$datos);

                if($repuesta == "ok")
                {
                    echo '<script>
                        swal({
                            icon: "success",
                            title: "¡El usuario ha sido borrado correctamente!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "usuarios";
                            }
                        });
                    </script>';   
                }
            }
        }
    } 