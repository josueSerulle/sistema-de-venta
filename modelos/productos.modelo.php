<?php
    require_once "conexion.php";
    
    class ModeloProductos
    {
        /*======================================================================================================
        Mostrar Productos
        ======================================================================================================*/
        static public function mdlMostrarProductos($tablas,$item,$valor,$orden)
        {
            if($item != null)
            {
                $stmt = conexion::conectar()->prepare("SELECT * FROM $tablas WHERE $item = :$item ORDER BY id Asc");
                $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetch();
            }
            else if($orden == "id")
            {
                $stmt = conexion::conectar()->prepare("SELECT * FROM $tablas ORDER BY id ASC");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            else if($orden == "idReciente")
            {
                $stmt = conexion::conectar()->prepare("SELECT * FROM $tablas ORDER BY id DESC");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            else
            {
                $stmt = conexion::conectar()->prepare("SELECT * FROM $tablas ORDER BY $orden DESC");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            $stmt->close();
            $stmt = null;
        }
        /*======================================================================================================
        Crear Productos
        ======================================================================================================*/
        static public function mdlCrearProducto($tabla,$datos)
        {
            $stmt = conexion::conectar()->prepare("INSERT INTO $tabla (id_categoria, codigo, descripcion, imagen, stock, precio_compra, precio_venta, ventas) 
            VALUES (:id_categoria,:codigo,:descripcion,:imagen,:stock,:precio_compra,:precio_venta,0)");
            $stmt->bindParam(":id_categoria",$datos["id_Categoria"],PDO::PARAM_INT);
            $stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
            $stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
            $stmt->bindParam(":imagen",$datos["imagen"],PDO::PARAM_STR);
            $stmt->bindParam(":stock",$datos["stock"],PDO::PARAM_STR);
            $stmt->bindParam(":precio_compra",$datos["precio_compra"],PDO::PARAM_STR);
            $stmt->bindParam(":precio_venta",$datos["precio_venta"],PDO::PARAM_STR);

            if($stmt->execute())
                return "ok";
            else
                return "error";
            $stmt->close();
            $stmt = null;
        }
        /*======================================================================================================
        Editar Productos
        ======================================================================================================*/
        static public function mdlEditarProducto($tabla,$datos)
        {
            $stmt = conexion::conectar()->prepare("UPDATE $tabla SET id_categoria = :id_categoria,descripcion = :descripcion, 
            imagen = :imagen, stock = :stock, precio_compra = :precio_compra, precio_venta = :precio_venta, ventas = 0 WHERE codigo = :codigo");
            $stmt->bindParam(":id_categoria",$datos["id_Categoria"],PDO::PARAM_INT);
            $stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
            $stmt->bindParam(":descripcion",$datos["descripcion"],PDO::PARAM_STR);
            $stmt->bindParam(":imagen",$datos["imagen"],PDO::PARAM_STR);
            $stmt->bindParam(":stock",$datos["stock"],PDO::PARAM_STR);
            $stmt->bindParam(":precio_compra",$datos["precio_compra"],PDO::PARAM_STR);
            $stmt->bindParam(":precio_venta",$datos["precio_venta"],PDO::PARAM_STR);

            if($stmt->execute())
                return "ok";
            else
                return "error";
            $stmt->close();
            $stmt = null;
        }
        /*=====================================================================================================
        Metodo para Actualizar el producto
        =====================================================================================================*/
        static public function MdlActualizarProdcuto($tabla, $item1, $valor1, $valor2)
        {
            $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET $item1 = :$item1 WHERE id = :id");

            $stmt -> bindParam(":".$item1,$valor1,PDO::PARAM_STR);
            $stmt -> bindParam(":id",$valor2,PDO::PARAM_STR);

            if($stmt -> execute())
                return "ok";
            else
                return "error";
            
            $stmt-> close();
            $stmt = null;
        }
        /*======================================================================================================
        Eliminar Productos
        ======================================================================================================*/
        static public function mdlEliminarProductos($tabla,$dato)
        {
            $stmt = conexion::conectar()->prepare("DELETE FROM $tabla WHERE id = :id");
            $stmt->bindParam(":id",$dato,PDO::PARAM_STR);
            
            if($stmt->execute())
                return "ok";
            else
                return "error";
            $stmt->close();
            $stmt = null;
        }
        /*======================================================================================================
        Mostrar suma de la venta
        ======================================================================================================*/
        static public function mdlMostrarSumaVenta($tabla)
        {
            $stmt = conexion::conectar()->prepare("SELECT SUM(ventas) as total FROM $tabla");
            $stmt->execute();
            return $stmt->fetch();
            $stmt = close();
            $stmt = null;
        }
    }