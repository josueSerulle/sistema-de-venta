<?php
    class ControladorProductos
    {
        /*======================================================================================================
        Mostrar Productos
        ======================================================================================================*/
        static public function ctrMostrasProductos($item,$valor,$orden)
        {
            $tablas = "productos";
            $respuesta = ModeloProductos::mdlMostrarProductos($tablas,$item,$valor,$orden);
            return $respuesta;
        }
        /*======================================================================================================
        Crear Productos
        ======================================================================================================*/
        static public function ctrCrearProduto()
        {
            if(isset($_POST["nuevoDescripcion"]))
            {
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["nuevoDescripcion"]) &&
               preg_match('/^[0-9]+$/',$_POST["nuevoStock"]) &&
               preg_match('/^[0-9.]+$/',$_POST["nuevoPrecioCompra"]) &&
               preg_match('/^[0-9.]+$/',$_POST["nuevoPrecioVenta"]))
                {
                    /*=====================================================================================================
                    Metodo para guardar la foto
                    =====================================================================================================*/
                    $ruta = "vistas/imagenes/productos/default/anonymous.png";
                    if(isset($_FILES["nuevaImagen"]["tmp_name"]) && !empty($_FILES["nuevaImagen"]["tmp_name"]))
                    {
                        list($ancho,$alto) = getimagesize($_FILES["nuevaImagen"]["tmp_name"]);
                        $nuevoAncho = 500;
                        $nuevoLargo = 500;
                        /*=====================================================================================================
                        Metodo para crear el directorio de la foto
                        =====================================================================================================*/
                        $directorio = "vistas/imagenes/productos/".$_POST["nuevoCodigo"];
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
                        if($_FILES["nuevaImagen"]["type"] == "image/jpeg")
                        {
                            /*=====================================================================================================
                            Guardamo la imagen en el directorio JPG
                            =====================================================================================================*/
                            $random = mt_rand(1,999);
                            $ruta  = "vistas/imagenes/productos/".$_POST["nuevoCodigo"]."/".$random.".jpg";
                            $origen = imagecreatefromjpeg($_FILES["nuevaImagen"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho,$nuevoLargo);
                            imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoLargo,$ancho,$alto);
                            imagejpeg($destino,$ruta);
                        }
                        if($_FILES["nuevaImagen"]["type"] == "image/png")
                        {
                            /*=====================================================================================================
                            Guardamo la imagen en el directorio PNG
                            =====================================================================================================*/
                            $random = mt_rand(1,999);
                            $ruta  = "vistas/imagenes/productos/".$_POST["nuevoCodigo"]."/".$random.".png";
                            $origen = imagecreatefrompng($_FILES["nuevaImagen"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho,$nuevoLargo);
                            imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoLargo,$ancho,$alto);
                            imagepng($destino,$ruta);
                        }
                    }
                    $datos = array("id_Categoria" => $_POST["nuevoCategoria"],
                                   "codigo" => $_POST["nuevoCodigo"],
                                   "descripcion" => $_POST["nuevoDescripcion"],
                                   "imagen" => $ruta,
                                   "stock" => $_POST["nuevoStock"],
                                   "precio_compra" => $_POST["nuevoPrecioCompra"],
                                   "precio_venta" => $_POST["nuevoPrecioVenta"]);
                    $respuesta = ModeloProductos::mdlCrearProducto("productos",$datos);
                    if($respuesta == "ok")
                    {
                        echo '<script>
                            swal({
                                icon: "success",
                                title: "¡El Producto ha sido guardado correctamente!",
                                Button: true,
                                Button:{text: "Cerrar"},
                                closeModal: false
                            }).then((result) => {
                                if(result)
                                {
                                    window.location = "producto";
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
                                title: "¡El Producto no puede tener campos vacio o Caracteres especiales!",
                                Button: true,
                                Button:{text: "Cerrar"},
                                closeModal: false
                            }).then((result) => {
                                if(result)
                                {
                                    window.location = "producto";
                                }
                            });
                        </script>';
                }
            }
        }
        /*======================================================================================================
        Editar Productos
        ======================================================================================================*/
        static public function ctrEditarProduto()
        {
            if(isset($_POST["editarDescripcion"]))
            {
                if(preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/',$_POST["editarDescripcion"]) &&
               preg_match('/^[0-9]+$/',$_POST["editarStock"]) &&
               preg_match('/^[0-9.]+$/',$_POST["editarPrecioCompra"]) &&
               preg_match('/^[0-9.]+$/',$_POST["editarPrecioVenta"]))
                {
                    /*=====================================================================================================
                    Metodo para guardar la foto
                    =====================================================================================================*/
                    $ruta = $_POST["imagenActual"];
                    if(isset($_FILES["editarImagen"]["tmp_name"]) && !empty($_FILES["editarImagen"]["tmp_name"]))
                    {
                        list($ancho,$alto) = getimagesize($_FILES["editarImagen"]["tmp_name"]);
                        $nuevoAncho = 500;
                        $nuevoLargo = 500;
                        /*=====================================================================================================
                        Metodo para crear el directorio de la foto
                        =====================================================================================================*/
                        $directorio = "vistas/imagenes/productos/".$_POST["editarCodigo"];
                        /*=====================================================================================================
                        Preguntar si existe la foto
                        =====================================================================================================*/
                        if(!empty($_POST["imagenActual"]) && $_POST["imagenActual"] != "vistas/imagenes/productos/default/anonymous.png")
                            unlink($_POST["imagenActual"]);
                        else
                            mkdir($directorio, 0755);
                        /*=====================================================================================================
                        De Acuerdo al tipo de imagenes aplicamos las funciones de PHP
                        =====================================================================================================*/
                        if($_FILES["editarImagen"]["type"] == "image/jpeg")
                        {
                            /*=====================================================================================================
                            Guardamo la imagen en el directorio JPG
                            =====================================================================================================*/
                            $random = mt_rand(1,999);
                            $ruta  = "vistas/imagenes/productos/".$_POST["editarCodigo"]."/".$random.".jpg";
                            $origen = imagecreatefromjpeg($_FILES["editarImagen"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho,$nuevoLargo);
                            imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoLargo,$ancho,$alto);
                            imagejpeg($destino,$ruta);
                        }
                        if($_FILES["editarImagen"]["type"] == "image/png")
                        {
                            /*=====================================================================================================
                            Guardamo la imagen en el directorio PNG
                            =====================================================================================================*/
                            $random = mt_rand(1,999);
                            $ruta  = "vistas/imagenes/productos/".$_POST["editarCodigo"]."/".$random.".png";
                            $origen = imagecreatefrompng($_FILES["editarImagen"]["tmp_name"]);
                            $destino = imagecreatetruecolor($nuevoAncho,$nuevoLargo);
                            imagecopyresized($destino,$origen,0,0,0,0,$nuevoAncho,$nuevoLargo,$ancho,$alto);
                            imagepng($destino,$ruta);
                        }
                    }
                    $datos = array("id_Categoria" => $_POST["editarCategoria"],
                                   "codigo" => $_POST["editarCodigo"],
                                   "descripcion" => $_POST["editarDescripcion"],
                                   "imagen" => $ruta,
                                   "stock" => $_POST["editarStock"],
                                   "precio_compra" => $_POST["editarPrecioCompra"],
                                   "precio_venta" => $_POST["editarPrecioVenta"]);
                    $respuesta = ModeloProductos::mdlEditarProducto("productos",$datos);
                    if($respuesta == "ok")
                    {
                        echo '<script>
                            swal({
                                icon: "success",
                                title: "¡El Producto ha sido editado correctamente!",
                                Button: true,
                                Button:{text: "Cerrar"},
                                closeModal: false
                            }).then((result) => {
                                if(result)
                                {
                                    window.location = "producto";
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
                                title: "¡El Producto no puede tener campos vacio o Caracteres especiales!",
                                Button: true,
                                Button:{text: "Cerrar"},
                                closeModal: false
                            }).then((result) => {
                                if(result)
                                {
                                    window.location = "producto";
                                }
                            });
                        </script>';
                }
            }
        }
        /*======================================================================================================
        Editar Productos
        ======================================================================================================*/
        static public function ctrEliminarProduto()
        {
            if(isset($_GET["id"]))
            {
                if($_GET["imagen"] != "" && $_GET["imagen"] != "vistas/imagenes/productos/default/anonymous.png")
                {
                    unlink($_GET["imagen"]);
                    rmdir("vistas/imagenes/productos/".$_GET["codigo"]);
                }
                $respuesta = ModeloProductos::mdlEliminarProductos("productos",$_GET["id"]);

                if($respuesta == "ok")
                {
                    echo '<script>
                            swal({
                                icon: "success",
                                title: "¡El Producto ha sido eliminado correctamente!",
                                Button: true,
                                Button:{text: "Cerrar"},
                                closeModal: false
                            }).then((result) => {
                                if(result)
                                {
                                    window.location = "producto";
                                }
                            });
                        </script>';
                }
            }
        }
        /*======================================================================================================
        Mostrar suma Venta
        ======================================================================================================*/
        static public function ctrMostrarSumaVenta()
        {
            $respuesta = ModeloProductos::mdlMostrarSumaVenta("productos");
            return $respuesta;
        }
    }