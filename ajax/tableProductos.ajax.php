<?php
    require_once "../controladores/productos.controlador.php";
    require_once "../controladores/categoria.controlador.php";
  
    require_once "../modelos/categoria.modelo.php";
    require_once "../modelos/productos.modelo.php";
    
    class AjaxTableProductos
    {
        /*======================================================================================================
        Mostrar tablas de productos Productos
        ======================================================================================================*/
        public function mostrarTablaProductos()
        {
            $respuesta = ControladorProductos::ctrMostrasProductos(null,null,"id");
            $datoJson = '{
                "data": [';
            foreach($respuesta as $key => $valor)
            {
                // Imagen
                if($valor["imagen"] != null)
                    $img = "<img src='".$valor["imagen"]."' class='img-thumbnail' width='40px' />";
                else
                    $img = "<img src='vistas/imagenes/productos/default/anonymous.png' class='img-thumbnail' width='40px'/>";
                
                // Botones
                if(isset($_GET["perfilOculto"]) && $_GET["perfilOculto"] == "Especial")
                    $botones  =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$valor["id"]."' data-toggle='modal' data-target='#modalEditarProductos'><i class='fa fa-pencil'></i></button></div>";
                else
                    $botones  =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$valor["id"]."' data-toggle='modal' data-target='#modalEditarProductos'><i class='fa fa-pencil'></i></button> <button class='btn btn-danger btnEliminarProducto' idProducto='".$valor["id"]."' codigo='".$valor["codigo"]."' imagen='".$valor["imagen"]."'><i class='fa fa-times'></i></button></div>";

                // Categoria
                $categoria = ContrladorCategorias::ctrMostrarCategoria("id",$valor["id_categoria"]);

                // Stock
                if($valor["stock"] <= 10)
                    $stock = "<button class='btn btn-danger'>".$valor["stock"]."</button>";
                else if($valor["stock"] > 10 && $valor["stock"] < 20)
                    $stock = "<button class='btn btn-warning'>".$valor["stock"]."</button>";
                else
                    $stock = "<button class='btn btn-success'>".$valor["stock"]."</button>"; 
                // Datos Json
                $datoJson .='[
                    "'.($key+1).'",
                    "'.$img.'",
                    "'.$valor["codigo"].'",
                    "'.$valor["descripcion"].'",
                    "'.$categoria["categoria"].'",
                    "'.$stock.'",
                    "'.$valor["precio_compra"].'",
                    "'.$valor["precio_venta"].'",
                    "'.$valor["ventas"].'",
                    "'.$valor["fecha"].'",
                    "'.$botones.'"
                ],';
            }
            $datoJson = substr($datoJson,0,-1);
            $datoJson .= ']
            }';
            echo $datoJson;
        }
    }
    /*======================================================================================================
    Mostrar Tablas de Productos
    ======================================================================================================*/
    $activarProducto = new AjaxTableProductos();
    $activarProducto -> mostrarTablaProductos();