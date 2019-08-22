<?php
    require_once "../controladores/clientes.controlador.php";
    require_once "../modelos/clientes.modelo.php";

    class AjaxCliente
    {
        /*=====================================================================================================
        Editar Usuario
        =====================================================================================================*/
        public $idCliente;
        public function ajaxEditarCliente()
        {
            $respuesta = ControladorCliente::ctrMostrarCliente("id",$this->idCliente);
            echo json_encode($respuesta);
        } 
    }
    /*=====================================================================================================
    Editar Usuario
    =====================================================================================================*/
    if(isset($_POST["idCliente"]))
    {
        $editarCliente = new AjaxCliente();
        $editarCliente->idCliente = $_POST["idCliente"];
        $editarCliente->ajaxEditarCliente(); 
    }