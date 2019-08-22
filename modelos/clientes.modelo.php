<?php
    require_once "conexion.php";

    class ModeloCliente
    {
        /*======================================================================================================
        Crear Cliente
        ======================================================================================================*/
        static public function mdlCrearCliente($tabla,$datos)
        {
            $stmt = conexion::conectar()->prepare("INSERT INTO $tabla (nombre,documento,email,telefono,direccion,fecha_Nacimiento,compras) 
            VALUES (:nombre,:documento,:email,:telefono,:direccion,:fecha_Nacimiento,0)");
            $stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
            $stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
            $stmt->bindParam(":email",$datos["email"],PDO::PARAM_STR);
            $stmt->bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
            $stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
            $stmt->bindParam(":fecha_Nacimiento",$datos["fecha"],PDO::PARAM_STR);

            if($stmt->execute())
                return "ok";
            else
                return "error";
            $stmt->close();
            $stmt = null;
        }
        /*======================================================================================================
        Mostrar Cliente
        ======================================================================================================*/
        static public function mdlMostrarCliente($tabla,$item,$valor)
        {
            if($item != null)
            {
                $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
                $stmt->bindParam(":".$item, $valor,PDO::PARAM_STR);
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
        Editar Cliente
        ======================================================================================================*/
        static public function mdlEditarCliente($tabla,$datos)
        {
            $stmt = conexion::conectar()->prepare("UPDATE $tabla SET nombre = :nombre, documento = :documento, email = :email
            ,telefono = :telefono, direccion = :direccion, fecha_Nacimiento = :fecha_Nacimiento WHERE id = :id");
            $stmt->bindParam(":id",$datos["id"],PDO::PARAM_STR);
            $stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
            $stmt->bindParam(":documento",$datos["documento"],PDO::PARAM_STR);
            $stmt->bindParam(":email",$datos["email"],PDO::PARAM_STR);
            $stmt->bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
            $stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
            $stmt->bindParam(":fecha_Nacimiento",$datos["fecha"],PDO::PARAM_STR);

            if($stmt->execute())
                return "ok";
            else
                return "error";
            $stmt->close();
            $stmt = null;
        }
        /*=====================================================================================================
        Metodo para Actualizar el cliente
        =====================================================================================================*/
        static public function MdlActualizarCliente($tabla, $item1, $valor1, $valor2)
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
        /*=====================================================================================================
        Eliminar Cliente
        =====================================================================================================*/
        static public function mdlEliminarCliente($tabla,$item,$datos)
        {
            $stmt = conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");
            $stmt->bindParam(":".$item,$datos,PDO::PARAM_STR);
            if($stmt->execute())
                return "ok";
            else
                return "error";
            $stmt->close();
            $stmt = null;
        }
    }