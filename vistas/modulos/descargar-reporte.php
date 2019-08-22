<?php
    require_once "../../controladores/ventas.controlador.php";
    require_once "../../modelos/ventas.modelo.php";
    require_once "../../controladores/clientes.controlador.php";
    require_once "../../modelos/clientes.modelo.php";
    require_once "../../controladores/usuario.controlador.php";
    require_once "../../modelos/usuario.modelo.php";

    $reporte = new ControladorVenta();
    $reporte-> ctrDescargarReporte();
