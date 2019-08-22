<?php

    require_once "conexion.php";

    class ModeloUsuarios
    {
        /*=====================================================================================================
        Metodo para Mostrar de usario
        =====================================================================================================*/
        static public function mdlMostrarUsuarios($tabla,$item,$valor)
        {
            try
            {
                if($item != null)
                {
                    $stmt = Conexion::conectar() -> prepare("select * from $tabla where $item = :$item"); 
                    //requisito de la escritura PDO para poder proteger la base de datos
                    // el valor para comparar se pone : y el nombre de la columna
                    //los : se significan valor proximo hacer enlasado
                    $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR); //solo parametro tipo string
                    $stmt->execute();// ejecutar el qry
                    return $stmt->fetch(); //solo devuelve una sola fila
                }
                else
                {
                    $stmt = Conexion::conectar() -> prepare("select * from $tabla");
                    $stmt->execute();// ejecutar el qry
                    return $stmt->fetchAll(); //devuelve todo las filas
                }
                $stmt-> close();
                $stmt = null;
            }
            catch(PDOException $ex)
            {
                echo '<br /> <div class="alert alert-danger">'.$ex.'</div>';
                $stmt-> close();
                $stmt = null;
            } 
        }
        /*=====================================================================================================
        Metodo para Ingresar de usario
        =====================================================================================================*/
        static public function MdlIngresarUsuarios($tabla,$datos)
        {
            $stmt = Conexion::conectar() -> prepare("INSERT INTO $tabla(nombre,usuario,password,perfil, foto) VALUES (:nombre, :usuario, :password, :perfil, :foto)");
            $stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
            $stmt -> bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
            $stmt -> bindParam(":password",$datos["password"],PDO::PARAM_STR);
            $stmt -> bindParam(":perfil",$datos["perfil"],PDO::PARAM_STR);
            $stmt -> bindParam(":foto",$datos["foto"],PDO::PARAM_STR);

            if($stmt->execute())
                return "ok";
            else
                return "error";
            $stmt ->close();
            $stmt = null;
        }
        /*=====================================================================================================
        Metodo para Editar de usario
        =====================================================================================================*/
        static public function MdlEditarUsuarios($tabla,$datos)
        {
            $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET nombre = :nombre, usuario = :usuario, 
            password = :password, perfil = :perfil, foto = :foto WHERE usuario = :usuario");
            
            $stmt -> bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
            $stmt -> bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
            $stmt -> bindParam(":password",$datos["password"],PDO::PARAM_STR);
            $stmt -> bindParam(":perfil",$datos["perfil"],PDO::PARAM_STR);
            $stmt -> bindParam(":foto",$datos["foto"],PDO::PARAM_STR);

            if($stmt->execute())
                return "ok";
            else
                return "error";
            $stmt ->close();
            $stmt = null;
        }
        /*=====================================================================================================
        Metodo para Actualizar el usario
        =====================================================================================================*/
        static public function MdlActualizarUsuario($tabla,$item1,$valor1,$item2,$valor2)
        {
            $stmt = Conexion::conectar() -> prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

            $stmt -> bindParam(":".$item1,$valor1,PDO::PARAM_STR);
            $stmt -> bindParam(":".$item2,$valor2,PDO::PARAM_STR);

            if($stmt -> execute())
                return "ok";
            else
                return "error";
            
            $stmt-> close();
            $stmt = null;
        }
        /*=====================================================================================================
        Metodo para Borrar el usario
        =====================================================================================================*/
        static public function mdlBorrarUsuario($tabla,$datos)
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