<?php
    require_once "../controladores/categoria.controlador.php";
    require_once "../modelos/categoria.modelo.php";

    class AjaxCategoria
    {
        /*===============================================
        =       No Repetir Categorias         =
        ===============================================
        */
        public $validarCategoria;
        public function ajaxRepetirCategoria()
        {
            $item = "categoria";
            $valor = $this->validarCategoria;
            $respuesta = ContrladorCategorias::ctrMostrarCategoria($item,$valor);
            echo json_encode($respuesta);
        }
         /*===============================================
        =       Editar Categoria Categorias         =
        ===============================================*/
        public $idCategoria;
        public function ajaxEditarCategoria()
        {
            $item = "id";
            $valor = $this->idCategoria;
            $respuesta = ContrladorCategorias::ctrMostrarCategoria($item,$valor);
            echo json_encode($respuesta);
        }
    }
    /*===============================================
    =       No Repetir Categorias         =
    ===============================================
    */
    if(isset($_POST["validarCategoria"]))
    {
        $repetirCategoria = new AjaxCategoria();
        $repetirCategoria->validarCategoria = $_POST["validarCategoria"];
        $repetirCategoria-> ajaxRepetirCategoria(); 
    }
    /*===============================================
    =       Editar Categoria Categorias         =
    ===============================================*/
    if(isset($_POST["idCategoria"]))
    {
        $editarCategoria = new AjaxCategoria();
        $editarCategoria ->idCategoria = $_POST["idCategoria"];
        $editarCategoria->ajaxEditarCategoria();
    }