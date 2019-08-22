<?php
    require_once "conexion.php";

    class ModeloCategoria
    {
        /*======================================================================================================
        Ingresar Categoria 
        ======================================================================================================*/
        static public function mdlINgresarCategoria($tabla,$datos)
        {
            $stmt = conexion::conectar()->prepare("INSERT INTO $tabla(categoria) VALUES (:categoria)");

            $stmt->bindParam(":categoria",$datos,PDO::PARAM_STR);

            if($stmt->execute())
                return "ok";
            else
                return "error";
            
            $stmt->close();
            $stmt = null;
        }
        /*======================================================================================================
        Mostrar Categoria 
        ======================================================================================================*/
        static public function mdlMostrarCategoria($tabla,$item,$valor)
        {
            if($item != null)
            {
                $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                $stmt -> bindParam(":".$item,$valor,PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
            }
            else
            {
                $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            $stmt->close();
            $stmt = null;
        }
        /*======================================================================================================
        Editar Categoria 
        ======================================================================================================*/
        static public function mdlEditarCategoria($tabla,$datos)
        {
            $stmt = conexion::conectar()->prepare("UPDATE $tabla SET categoria = :categoria WHERE id = :id");
            $stmt->bindParam(":categoria",$datos["categoria"],PDO::PARAM_STR);
            $stmt->bindParam(":id",$datos["id"],PDO::PARAM_STR);

            if($stmt->execute())
                return "ok";
            else
                return "error";
            $stmt->close();
            $stmt = null;
        }
        /*======================================================================================================
        Borrar Categoria 
        ======================================================================================================*/
        static public function mdlBorrarCategoria($tabla,$datos)
        {
            $stmt = conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id",$datos,PDO::PARAM_STR);

            if($stmt->execute())
                return "ok";
            else
                return "error";
            $stmt->close();
            $stmt = null;
        }
    }