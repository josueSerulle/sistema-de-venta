<?php
    require_once "../controladores/usuario.controlador.php";
    require_once "../modelos/usuario.modelo.php";

    class AjaxUsuario
    {
        /*=====================================================================================================
        Editar Usuario
        =====================================================================================================*/
        public $idUsuario;

        public function ajaxEditarUsuario()
        {
            $item = "id";
            $valor = $this->idUsuario;
            $respuesta = ControladorUsuario::ctrMostrarUsuarios($item, $valor);
            echo json_encode($respuesta);
        }
        /*=====================================================================================================
        Activar o Desactivar Usuario
        =====================================================================================================*/
        public $activarId;
        public $activarEstado;

        public function ajaxActivarUsuario()
        {
            $tabla = "usuarios";
            $item1 = "estado";
            $valor1 = $this->activarEstado;
            $item2 = "id";
            $valor2 = $this->activarId;
            $respuesta = ModeloUsuarios::MdlActualizarUsuario($tabla,$item1,$valor1,$item2,$valor2);
        } 
        /*===============================================
        =       No Repetir usuario         =
        ===============================================
        */
        public $validarUsuario;
        public function ajaxRepetirUsuario()
        {
            $item = "usuario";
            $valor = $this->validarUsuario;
            $respuesta = ControladorUsuario::ctrMostrarUsuarios($item,$valor);
            echo json_encode($respuesta);
        }
    }
    /*=====================================================================================================
    Editar Usuario
    =====================================================================================================*/
    if(isset($_POST["idUsuario"]))
    {
        $editar = new AjaxUsuario();
        $editar -> idUsuario = $_POST["idUsuario"];
        $editar -> ajaxEditarUsuario();
    }  
    /*=====================================================================================================
    Activar o Desactivar Usuario
    =====================================================================================================*/
    if(isset($_POST["activarId"]) && isset($_POST["activarEstado"]))
    {
        $activar = new AjaxUsuario();
        $activar -> activarId = $_POST["activarId"];
        $activar -> activarEstado = $_POST["activarEstado"];
        $activar -> ajaxActivarUsuario();
    }
    /*===============================================
        =       No Repetir usuario         =
        ===============================================
    */
    if(isset($_POST["validarUsuario"]))
    {
        $repetirUsuario = new AjaxUsuario();
        $repetirUsuario -> validarUsuario = $_POST["validarUsuario"];
        $repetirUsuario -> ajaxRepetirUsuario();
    }