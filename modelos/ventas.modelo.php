<?php
    require_once "conexion.php";

    class ModeloVenta
    {
        /*======================================================================================================
        Mostrar Venta
        ======================================================================================================*/
        static public function mdlMostrarVenta($tabla,$item,$valor,$filtro)
        {
            if($item != null)
            {
               $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item ORDER by fecha DESC");
               $stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
               $stmt->execute();
               return $stmt->fetch();
            }
            else if($filtro != null)
            {
                $stmt = conexion::conectar()->prepare("SELECT MAX(codigo) as codigo FROM $tabla");
                $stmt->execute();
                return $stmt->fetch();
            }
            else
            {
                $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla ORDER by fecha DESC");
                $stmt->execute();
                return $stmt->fetchAll();
            }
            $stmt->close();
            $stmt = null;
        }
        /*======================================================================================================
        Registro de Venta
        ======================================================================================================*/
        static public function mdlCrearVenta($tabla,$datos)
        {
            $stmt = conexion::conectar()->prepare("INSERT INTO $tabla(codigo, id_cliente, id_vendedor, producto, impuesto, neto, total, metodo_Pago) 
            VALUES (:codigo, :id_cliente, :id_vendedor, :producto, :impuesto, :neto, :total, :metodo_Pago)");

            $stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
            $stmt->bindParam(":id_cliente",$datos["id_cliente"],PDO::PARAM_STR);
            $stmt->bindParam(":id_vendedor",$datos["id_vendedor"],PDO::PARAM_STR);
            $stmt->bindParam(":producto",$datos["productos"],PDO::PARAM_STR);
            $stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
            $stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
            $stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
            $stmt->bindParam(":metodo_Pago",$datos["metodo_pago"],PDO::PARAM_STR);

            if($stmt->execute())
                return "ok";
            else
                return "error";

            $stmt->close();
            $stmt = null;
        }
        /*======================================================================================================
        Editar de Venta
        ======================================================================================================*/
        static public function mdlEditarVenta($tabla,$datos)
        {
            $stmt = conexion::conectar()->prepare("UPDATE $tabla set id_cliente = :id_cliente, id_vendedor = :id_vendedor, producto = :producto
            , impuesto = :impuesto, neto = :neto, total = :total, metodo_Pago = :metodo_Pago WHERE codigo = :codigo");

            $stmt->bindParam(":codigo",$datos["codigo"],PDO::PARAM_STR);
            $stmt->bindParam(":id_cliente",$datos["id_cliente"],PDO::PARAM_STR);
            $stmt->bindParam(":id_vendedor",$datos["id_vendedor"],PDO::PARAM_STR);
            $stmt->bindParam(":producto",$datos["productos"],PDO::PARAM_STR);
            $stmt->bindParam(":impuesto",$datos["impuesto"],PDO::PARAM_STR);
            $stmt->bindParam(":neto",$datos["neto"],PDO::PARAM_STR);
            $stmt->bindParam(":total",$datos["total"],PDO::PARAM_STR);
            $stmt->bindParam(":metodo_Pago",$datos["metodo_pago"],PDO::PARAM_STR);

            if($stmt->execute())
                return "ok";
            else
                return "error";

            $stmt->close();
            $stmt = null;
        }
        /*======================================================================================================
        Eliminar Venta
        ======================================================================================================*/
        static public function mdlEliminarVenta($tabla,$dato)
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
        Rango de Fecha
        ======================================================================================================*/
        static public function mdlRangoFecha($tabla,$fechaInical,$fechaFinal)
        {
            if($fechaFinal == null)
                $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla ORDER by fecha DESC");
            else if($fechaInical == $fechaFinal)
                $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha like '%$fechaInical%' ");
            else
            {
                $fechaActual = new DateTime();
                $fechaActual->add(new DateInterval("P1D"));
                $fechaMasDia = $fechaActual->format("Y-m-d");

                $fechaFinal2 = new DateTime($fechaFinal);
                $fechaFinal2->add(new DateInterval("P1D"));
                $fechaMasDia2 = $fechaFinal2->format("Y-m-d");

                if($fechaMasDia2 == $fechaMasDia)
                    $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInical' AND '$fechaMasDia2'");
                else
                    $stmt = conexion::conectar()->prepare("SELECT * FROM $tabla WHERE fecha BETWEEN '$fechaInical' AND '$fechaFinal'");
            }
            $stmt->execute();
            return $stmt->fetchAll();
            $stmt->close();
            $stmt = null;
        }
        /*======================================================================================================
        Suma total de Venta
        ======================================================================================================*/
        static public function mdlSumaTotalVenta($tabla)
        {
            $stmt = conexion::conectar()->prepare("SELECT SUM(neto) as total FROM $tabla");
            $stmt->execute();
            return $stmt->fetch();
            $stmt->close();
            $stmt = null;
        }
    }