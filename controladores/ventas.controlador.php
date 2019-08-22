<?php

    class ControladorVenta
    {
        /*======================================================================================================
        Mostrar Venta
        ======================================================================================================*/
        static public function ctrMostrarVenta($item,$valor,$filtro)
        {
            $respuesta = ModeloVenta::mdlMostrarVenta("venta",$item,$valor,$filtro);
            return $respuesta;
        }
        /*======================================================================================================
        Crear Venta
        ======================================================================================================*/
        static public function ctrCrearVenta()
        {
            if(isset($_POST["nuevocodigoVenta"]))
            {
                /*======================================================================================================
                Actualizar las compra del cliente y reducir el stock y aumentar las ventas de los productos
                ======================================================================================================*/
                $listasProductos = json_decode($_POST["listaProductos"],true);
                $totalProductosComprados = array();
                foreach($listasProductos as $key => $valor)
                {
                    array_push($totalProductosComprados,$valor["cantidad"]);
                    $traerProducto = ModeloProductos::mdlMostrarProductos("productos","id",$valor["id"],"id");
                    $venta = $valor["cantidad"] + $traerProducto["ventas"];
                    ModeloProductos::MdlActualizarProdcuto("productos","ventas",$venta,$valor["id"]);
                    ModeloProductos::MdlActualizarProdcuto("productos","stock",$valor["stock"],$valor["id"]);
                    
                }
                $traerCliente = ModeloCliente::mdlMostrarCliente("cliente","id",$_POST["seleccionarCliente"]);
                $valorCompra = array_sum($totalProductosComprados) + $traerCliente["compras"];
                ModeloCliente::MdlActualizarCliente("cliente","compras",$valorCompra,$_POST["seleccionarCliente"]);
                /*=====================================================================================================
                Fecha de la ultima compra
                =====================================================================================================*/
                date_default_timezone_set("America/Santo_Domingo");
                $fechaActual = date('Y-m-d')." ".date('H:i:s');;
                ModeloCliente:: MdlActualizarCliente("cliente","ultima_compra",$fechaActual,$_POST["seleccionarCliente"]);
                /*=====================================================================================================
                Guardar la venta
                =====================================================================================================*/
                $datos = array("id_vendedor"=>$_POST["idVendedor"],
                                "id_cliente"=>$_POST["seleccionarCliente"],
                                "codigo"=>$_POST["nuevocodigoVenta"],
                                "productos"=>$_POST["listaProductos"],
                                "impuesto"=>$_POST["nuevoPrecioImpuesto"],
                                "neto"=>$_POST["nuevoPrecioNeto"],
                                "total"=>$_POST["totalVenta"],
                                "metodo_pago"=>$_POST["listaMetodoPago"]);
                $respuesta = ModeloVenta::mdlCrearVenta("venta",$datos);

                if($respuesta == "ok")
                {
                    echo '<script>
                        swal({
                            icon: "success",
                            title: "¡La venta ha sido realizada exitosamente!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "crear-venta";
                            }
                        });
                        </script>';       
                }
            }
        }
        /*======================================================================================================
        Editar Venta
        ======================================================================================================*/
        static public function ctrEditarVenta()
        {
            if(isset($_POST["editarcodigoVenta"]))
            {
                /*======================================================================================================
                Formatear Tabla de producto y cliente
                ======================================================================================================*/
                $traerVenta = ModeloVenta::mdlMostrarVenta("venta","codigo",$_POST["editarcodigoVenta"],null);
                /*======================================================================================================
                revisar si viene productos editados
                ======================================================================================================*/
                $cambioProducto = false;
                if($_POST["listaProductos"] == "")
                {
                    $listasProductos = $traerVenta["producto"];
                    $cambioProducto = false;
                }
                else
                {
                    $listasProductos = $_POST["listaProductos"];
                    $cambioProducto = true;
                }
                if($cambioProducto)
                {
                    $producto = json_decode($traerVenta["producto"],true);
                    $totalProductosComprados = array();
                    foreach ($producto as $key => $valor) 
                    {
                        array_push($totalProductosComprados, $valor["cantidad"]);	
                        $traerProducto = ModeloProductos::mdlMostrarProductos("productos","id",$valor["id"],"id");
                        $venta = $traerProducto["ventas"] - $valor["cantidad"];
                        ModeloProductos::MdlActualizarProdcuto("productos", "ventas", $venta,$valor["id"]);
                        $nuevoStock = $valor["cantidad"] + $traerProducto["stock"];
                        ModeloProductos::MdlActualizarProdcuto("productos", "stock", $nuevoStock, $valor["id"]);
                    }
                    $traerCliente = ModeloCliente::mdlMostrarCliente("cliente","id",$_POST["seleccionarCliente"]);
                    $valorCompra = $traerCliente["compras"] - array_sum($totalProductosComprados);
                    ModeloCliente::MdlActualizarCliente("cliente","compras",$valorCompra,$_POST["seleccionarCliente"]);
                    /*======================================================================================================
                    Actualizar las compra del cliente y reducir el stock y aumentar las ventas de los productos
                    ======================================================================================================*/
                    $listasProductos_2 = json_decode($listasProductos,true);
                    $totalProductosComprados_2 = array();
                    foreach($listasProductos_2 as $key => $valor)
                    {
                        array_push($totalProductosComprados_2,$valor["cantidad"]);
                        $traerProducto_2 = ModeloProductos::mdlMostrarProductos("productos","id",$valor["id"],"id");
                        $venta_2 = $valor["cantidad"] + $traerProducto_2["ventas"];
                        ModeloProductos::MdlActualizarProdcuto("productos","ventas",$venta_2,$valor["id"]);
                        $nuevoStock = $traerProducto_2["stock"] - $valor["cantidad"];
                        ModeloProductos::MdlActualizarProdcuto("productos","stock",$nuevoStock,$valor["id"]);
                    }
                    $traerCliente_2 = ModeloCliente::mdlMostrarCliente("cliente","id",$_POST["seleccionarCliente"]);
                    $valorCompra_2 = array_sum($totalProductosComprados_2) + $traerCliente_2["compras"];
                    ModeloCliente::MdlActualizarCliente("cliente","compras",$valorCompra_2,$_POST["seleccionarCliente"]);
                    /*=====================================================================================================
                    Fecha de la ultima compra
                    =====================================================================================================*/
                    date_default_timezone_set("America/Santo_Domingo");
                    $fechaActual_2 = date('Y-m-d')." ".date('H:i:s');
                    ModeloCliente:: MdlActualizarCliente("cliente","ultima_compra",$fechaActual_2,$_POST["seleccionarCliente"]);
            }
                /*=====================================================================================================
                Editar la venta
                =====================================================================================================*/
                $datos = array("id_vendedor"=>$_POST["idVendedor"],
                                "id_cliente"=>$_POST["seleccionarCliente"],
                                "codigo"=>$_POST["editarcodigoVenta"],
                                "productos"=>$listasProductos,
                                "impuesto"=>$_POST["nuevoPrecioImpuesto"],
                                "neto"=>$_POST["nuevoPrecioNeto"],
                                "total"=>$_POST["totalVenta"],
                                "metodo_pago"=>$_POST["listaMetodoPago"]);
                $respuesta = ModeloVenta::mdlEditarVenta("venta",$datos);

                if($respuesta == "ok")
                {
                    echo '<script>
                        swal({
                            icon: "success",
                            title: "¡La venta ha sido editada exitosamente!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "crear-venta";
                            }
                        });
                        </script>';       
                }
            }
        }
        /*======================================================================================================
        Eliminar Venta
        ======================================================================================================*/
        static public function ctrEliminarVenta()
        {
            if(isset($_GET["idVenta"]))
            {
                $traerVenta = ModeloVenta::mdlMostrarVenta("venta","id",$_GET["idVenta"],null);
                /*======================================================================================================
                Actualizar Fecha Ultima Compra
                ======================================================================================================*/
                $traerVentas = ModeloVenta::mdlMostrarVenta("venta",null,null,null);
                $guardadFechas = array();
                foreach($traerVentas as $key => $valor)
                {
                    if($valor["id_cliente"] == $traerVenta["id_cliente"])
                    {
                        array_push($guardadFechas,$valor["fecha"]);
                    }
                }
                if(count($guardadFechas) > 1)
                {
                    if($traerVenta["fecha"] < $guardadFechas[count($guardadFechas)-2])
                        $comprasCliente = ModeloCliente::mdlActualizarCliente("cliente", "ultima_compra", $guardadFechas[count($guardadFechas)-2],$traerVenta["id_cliente"]);
                    else
                        $comprasCliente = ModeloCliente::mdlActualizarCliente("cliente", "ultima_compra", $guardadFechas[count($guardadFechas)-1], $traerVenta["id_cliente"]);
                }
                else
                    ModeloCliente::MdlActualizarCliente("cliente","ultima_compra","0000-00-00 00:00:00",$traerVenta["id_cliente"]);
                /*======================================================================================================
                Formatear Tabla de producto
                ======================================================================================================*/
                $producto = json_decode($traerVenta["producto"],true);
                $totalProductosComprados = array();
                foreach ($producto as $key => $valor) 
                {
                    array_push($totalProductosComprados, $valor["cantidad"]);	
                    $traerProducto = ModeloProductos::mdlMostrarProductos("productos","id",$valor["id"],"id");
                    $venta = $traerProducto["ventas"] - $valor["cantidad"];
                    ModeloProductos::MdlActualizarProdcuto("productos", "ventas", $venta,$valor["id"]);
                    $nuevoStock = $valor["cantidad"] + $traerProducto["stock"];
                    ModeloProductos::MdlActualizarProdcuto("productos", "stock", $nuevoStock, $valor["id"]);
                }
                $traerCliente = ModeloCliente::mdlMostrarCliente("cliente","id",$traerVenta["id_cliente"]);
                $valorCompra = $traerCliente["compras"] - array_sum($totalProductosComprados);
                ModeloCliente::MdlActualizarCliente("cliente","compras",$valorCompra,$traerVenta["id_cliente"]);
                /*======================================================================================================
                Eliminar Venta
                ======================================================================================================*/
                $eliminarVenta = ModeloVenta::mdlEliminarVenta("venta",$_GET["idVenta"]);

                if($eliminarVenta == "ok")
                {
                    echo '<script>
                        swal({
                            icon: "success",
                            title: "¡La venta ha sido borrado correctamente!",
                            Button: true,
                            Button:{text: "Cerrar"},
                            closeModal: false
                        }).then((result) => {
                            if(result)
                            {
                                window.location = "administrar-ventas";
                            }
                        });
                    </script>';   
                }
            }
        }
        /*======================================================================================================
        Rango de Fecha
        ======================================================================================================*/
        static public function ctrRangoFecha($fehcaInical,$fechaFinal)
        {
            $respuesta = ModeloVenta::mdlRangoFecha("venta",$fehcaInical,$fechaFinal);
            return $respuesta;
        }
        /*======================================================================================================
        Descargar Excel
        ======================================================================================================*/
        static public function ctrDescargarReporte()
        {
            if(isset($_GET["reporte"]))
            {
                if(isset($_GET["fechaInicial"]) && isset($_GET["fechaFinal"]))
                    $ventas = ModeloVenta::mdlRangoFecha("venta",$_GET["fechaInicial"],$_GET["fechaFinal"]);
                else
                    $ventas = ModeloVenta::mdlMostrarVenta("venta",null,null,null);
                /*======================================================================================================
                Crear el archivo Excel
                ======================================================================================================*/
                $name = $_GET["reporte"].".xls";
                header('Expires: 0');
                header('Cache-control: private');
                header('Content-type: application/vnd.ms-excel;charset=iso-8859-15');
                header('Cache-Control: cache, must-revalidate');
                header('Content-Description: File Transfer');
                header('Last-Modified:'.date('D, d M Y H:i:s'));
                header('Pragma:public');
                header('Content-Disposition:; fileName="'.$name.'"');
                header('Content-Transfer-Encoding: binary');

                echo utf8_decode('<table border="0">
                                    <tr>
                                        <td style="font-weight:bold; border: 1px solid #eee;">CÓDIGO</td>
                                        <td style="font-weight:bold; border: 1px solid #eee;">CLIENTE</td>
                                        <td style="font-weight:bold; border: 1px solid #eee;">VENDEDOR</td>
                                        <td style="font-weight:bold; border: 1px solid #eee;">CANTIDAD</td>
                                        <td style="font-weight:bold; border: 1px solid #eee;">PRODUCTOS</td>
                                        <td style="font-weight:bold; border: 1px solid #eee;">IMPUESTOS</td>
                                        <td style="font-weight:bold; border: 1px solid #eee;">NETO</td>
                                        <td style="font-weight:bold; border: 1px solid #eee;">TOTAL</td>
                                        <td style="font-weight:bold; border: 1px solid #eee;">METODO DE PAGO</td>
                                        <td style="font-weight:bold; border: 1px solid #eee;">FECHA</td>
                                    </tr> ');
                foreach($ventas as $row => $items)
                {
                    $cliente = ControladorCliente::ctrMostrarCliente("id",$items["id_cliente"]);
                    $vendedor = ControladorUsuario::ctrMostrarUsuarios("id",$items["id_vendedor"]);

                    echo utf8_decode('<tr>
                                        <td style="border: 1px solid #eee;">'.$items["codigo"].'</td>
                                        <td style="border: 1px solid #eee;">'.$cliente["nombre"].'</td>
                                        <td style="border: 1px solid #eee;">'.$vendedor["Nombre"].'</td>
                                        <td style="border: 1px solid #eee;">');
                    $producto = json_decode($items["producto"],true);
                    foreach($producto as $key => $valorProductos)
                        echo utf8_decode($valorProductos["cantidad"]."<br />");
                    echo utf8_decode('</td> <td style="border: 1px solid #eee;">');
                    foreach($producto as $key => $valorProductos)
                        echo utf8_decode($valorProductos["descripcion"]."<br />");
                    echo utf8_decode('</td> 
                                    <td style="border: 1px solid #eee;">'.number_format($items["impuesto"],2).'</td>
                                    <td style="border: 1px solid #eee;">'.number_format($items["neto"],2).'</td>
                                    <td style="border: 1px solid #eee;">'.number_format($items["total"],2).'</td>
                                    <td style="border: 1px solid #eee;">'.$items["metodo_Pago"].'</td>
                                    <td style="border: 1px solid #eee;">'.substr($items["impuesto"],0,10).'</td>
                    </tr>');
                }
                echo "</table>";
            }
        }
        /*======================================================================================================
        Suma total de Venta
        ======================================================================================================*/
        static public function ctrSumaTotalVentas()
        {
            $respuesta = ModeloVenta::mdlSumaTotalVenta("venta");
            return $respuesta;
        }
    }