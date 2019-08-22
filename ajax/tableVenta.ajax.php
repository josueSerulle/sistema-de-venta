<?php
    require_once "../controladores/productos.controlador.php";
    require_once "../modelos/productos.modelo.php";
    
    class AjaxTableProductosVentas
    {
        /*======================================================================================================
        Mostrar tablas de productos Productos
        ======================================================================================================*/
        public function mostrarTablaProductosVentas()
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
                $botones  =  " <div class='btn-group'><button type='button' class='btn btn-primary recuperarBoton agregarProducto' idProducto='".$valor["id"]."'>Agregar</button></div>";

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
                    "'.$stock.'",
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
    $activarProducto = new AjaxTableProductosVentas();
    $activarProducto -> mostrarTablaProductosVentas();