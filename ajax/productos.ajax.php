<?php
    require_once "../controladores/productos.controlador.php";
    require_once "../controladores/categoria.controlador.php";

    require_once "../modelos/categoria.modelo.php";
    require_once "../modelos/productos.modelo.php";

    class AjaxProductos
    {
        /*======================================================================================================
        Generar Codigo del producto
        ======================================================================================================*/
        public $idCategoria;
        public function ajaxCrearCodigoProductos()
        {
            $respuestas = ControladorProductos::ctrMostrasProductos("id_categoria",$this->idCategoria,null);
            echo json_encode($respuestas);
        }
        /*======================================================================================================
        Editar el producto
        ======================================================================================================*/
        public $idProducto;
        public $traerProductos;
        public $nombreProductos;
        public function AjaxEditarProductos()
        {
            if($this->traerProductos == "ok")
                $respuestas = ControladorProductos::ctrMostrasProductos(null,null,"id");
            else if($this->nombreProductos != "")
                $respuestas = ControladorProductos::ctrMostrasProductos("descripcion",$this->nombreProductos,null);
            else
                $respuestas = ControladorProductos::ctrMostrasProductos("id",$this->idProducto,null);
            echo json_encode($respuestas);
        }
    }
    /*======================================================================================================
    Generar Codigo del Producto
    ======================================================================================================*/
    if(isset($_POST["idCategoria"]))
    {
        $CodigoProducto = new AjaxProductos();
        $CodigoProducto-> idCategoria = $_POST["idCategoria"];
        $CodigoProducto->ajaxCrearCodigoProductos(); 
    }
    /*======================================================================================================
    Editar el producto
    ======================================================================================================*/
    if(isset($_POST["idProducto"]))
    {
        $editarProducto = new AjaxProductos();
        $editarProducto->idProducto = $_POST["idProducto"];
        $editarProducto->AjaxEditarProductos(); 
    }
    /*======================================================================================================
    Editar el producto
    ======================================================================================================*/
    if(isset($_POST["traerProducto"]))
    {
        $editarProducto = new AjaxProductos();
        $editarProducto->traerProductos = $_POST["traerProducto"];
        $editarProducto->AjaxEditarProductos(); 
    }
    /*======================================================================================================
    Editar el producto
    ======================================================================================================*/
    if(isset($_POST["nombreProducto"]))
    {
        $editarProducto = new AjaxProductos();
        $editarProducto->nombreProductos = $_POST["nombreProducto"];
        $editarProducto->AjaxEditarProductos(); 
    }