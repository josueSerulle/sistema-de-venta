<?php
    require_once "../../../controladores/ventas.controlador.php";
    require_once "../../../modelos/ventas.modelo.php";
    
    require_once "../../../controladores/clientes.controlador.php";
    require_once "../../../modelos/clientes.modelo.php";
    
    require_once "../../../controladores/usuario.controlador.php";
    require_once "../../../modelos/usuario.modelo.php";

    require_once "../../../controladores/productos.controlador.php";
    require_once "../../../modelos/productos.modelo.php";
    
class ImprimirFactura
{
    public $codigo;
    public function traerImpresionFactura()
    {
        // traer informacion de la venta
        $respuestaVenta = ControladorVenta::ctrMostrarVenta("codigo",$this->codigo,null);
        $fecha = substr($respuestaVenta["fecha"],0,-8);
        $productos = json_decode($respuestaVenta["producto"],true);
        $neto = number_format($respuestaVenta["neto"],2);
        $impuesto = number_format($respuestaVenta["impuesto"],2);
        $total = number_format($respuestaVenta["total"],2);
       
        //traer la informacion del cliente
        $respuestaCliente = ControladorCliente::ctrMostrarCliente("id",$respuestaVenta["id_cliente"]);
        //traer la informacion del vendedor
        $respuestaVendedor = ControladorUsuario::ctrMostrarUsuarios("id",$respuestaVenta["id_vendedor"]);
//Requerimos la clase TCPDF
require_once("tcpdf_include.php");
$pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
$pdf->startPageGroup();
$pdf->AddPage();
//----------------------------------------------------------------------------------------------------------
$bloque1 = <<<EOF
    <table>
        <tr>
            <td style="width:150px"><img src="images/logo-negro-bloque.png" /></td>
            <td style="background-color: white; width: 140px">
                <div style="font-size:8.5px; text-align:right; line-height:15px">
                    NIT: 71.769.963-9
                    <br />
                    Direccion: calle 448 92-11
                </div>
            </td>
            <td style="background-color:white; width:140px">
                <div style="font-size:8.5px; text-align:right; line-height:15px">
                    Telefono: (809) 598-1643
                    <br />
                    ventas@inventarysystem.com
                </div>
            </td>
            <td style="background-color:white; width:110px; text-align:center; color:red">
                <br /><br />
                FACTURA N.
                <br />
                $this->codigo
            </td>
        </tr>
    </table>
EOF;
$pdf->writeHTML($bloque1,false,false,false,false,"");
// //----------------------------------------------------------------------------------------------------------
$bloque2 = <<<EOF
        <table>
            <tr>
                <td style="width:540px">
                    <img src="images/back.jpg" />
                </td>
            </tr>
        </table>
        <table style="font-size:10px; padding:5px 10px">
            <tr>
                <td style="border:1px solid #666; background-color:white; width:390px">
                    Cliente: $respuestaCliente[nombre]
                </td>
                <td style="border:1px solid #666; background-color:white; width:150px; text-align:right">
                    Fecha: $fecha
                </td>
            </tr>
            <tr>
                <td style="border:1px solid #666; background-color:white; width:540px; text-align:left">
                    Vendedor: $respuestaVendedor[Nombre]
                </td>
            </tr>
            <tr>
                <td stye="border-button:1px solid #666; background-color:white; width:540px;">
                </td>
            </tr>
        </table>
EOF;
$pdf->writeHTML($bloque2,false,false,false,false,"");
//----------------------------------------------------------------------------------------------------------
$bloque3 = <<<EOF
    <table style="font-size:15px; paddinig:5px 10px;">
        <tr>
            <td style="border:1px solid #666; background-color:white; width:260px; text-align:center">
                Producto
            </td>
            <td style="border:1px solid #666; background-color:white; width:80px; text-align:center">
                Cantidad
            </td>
            <td style="border:1px solid #666; background-color:white; width:100px; text-align:center">
                Valor Unit.
            </td>
            <td style="border:1px solid #666; background-color:white; width:100px; text-align:center">
                Valor Total
            </td>
        </tr>
    </table>
EOF;
$pdf->writeHTML($bloque3,false,false,false,false,"");
//----------------------------------------------------------------------------------------------------------
foreach($productos as $key => $valor)
{
$respuestaproductos = ControladorProductos::ctrMostrasProductos("descripcion",$productos[0]["descripcion"],"id");
$valorUnitario = number_format($respuestaproductos["precio_venta"],2);
$precioTotal = number_format($valor["total"],2);
$bloque4 = <<<EOF
    <table style="font-size:13px; padding5px 10px">
        <tr>
            <td style="border:1px solid #666; color:#333; background-color:white; width:260px; text-align:center">
                $valor[descripcion]
            </td>
            <td style="border:1px solid #666; color:#333; background-color:white; width:80px; text-align:center">
                $valor[cantidad]
            </td>
            <td style="border:1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                $valorUnitario
            </td>
            <td style="border:1px solid #666; color:#333; background-color:white; width:100px; text-align:center">
                $precioTotal    
            </td>
        </tr>
    </table>
EOF;
$pdf->writeHTML($bloque4,false,false,false,false,"");
}
//----------------------------------------------------------
$bloque5 = <<<EOF
    <table style="font-size:15px; padding5px 10px">
        <tr>
            <td style="color:#333; background-color:white; width:340px; text-align:center"></td>
            <td style="border-bottom:1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>
            <td style="border-bottom:1px solid #666; color:#333; background-color:white; width:100px; text-align:center"></td>
        </tr>
        <tr>
            <td style="border-right:1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
            <td style="border:1px solid #666; background-color:white; width:100px; text-align:center">
                Neto
            </td>
            <td style="border:1px solid #666; background-color:white; width:100px; text-align:center">
                $neto
            </td>
        </tr>
        <tr>
            <td style="border-right:1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
            <td style="border:1px solid #666; background-color:white; width:100px; text-align:center">
                Impuesto
            </td>
            <td style="border:1px solid #666; background-color:white; width:100px; text-align:center">
                $impuesto
            </td>
        </tr>
        <tr>
            <td style="border-right:1px solid #666; color:#333; background-color:white; width:340px; text-align:center"></td>
            <td style="border:1px solid #666; background-color:white; width:100px; text-align:center">
                Total
            </td>
            <td style="border:1px solid #666; background-color:white; width:100px; text-align:center">
                $total
            </td>
        </tr>
    </table>
EOF;
$pdf->writeHTML($bloque5,false,false,false,false,"");
//----------------------------------------------------------
//salida del archivo
$pdf->Output("factura.pdf");
}
}
/*======================================================================================================
traer factura
======================================================================================================*/
$factura = new ImprimirFactura();
$factura->codigo = $_GET["codigo"];
$factura->traerImpresionFactura();
?>