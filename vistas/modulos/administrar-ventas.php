<?php
    if($_SESSION["perfil"] == "Especial")
    {
      echo '<script>
        window.location = "inicio";
      </script>';
      return;
    }
  ?>
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Ventas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Ventas</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <a href="crear-venta" title="crear venta" alt="crear venta">
            <button class="btn btn-primary">Agregar Ventas</button>
          </a>
          <button type="button" class="btn btn-default pull-right" id="daterange-btn">
            <span>
              <i class="fa fa-calendar"></i>
              Rango de fecha
              <i class="fa fa-caret-down"></i>
            </span>
          </button>
        </div>
        <div class="box-body">
          <table  class="table table-bordered table-striped dt-responsive tablas">
             <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Codigo Factura</th>
                <th>Cliente</th>
                <th>Vendedor</th>
                <th>Forma de Pago</th>
                <th>Neto</th>
                <th>Total</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
             </thead>
             <tbody>
               <?php
                  if(isset($_GET["fechaInical"]))
                  {
                    $fehcaInical = $_GET["fechaInical"];
                    $fechaFinal = $_GET["fechaFinal"];
                  }
                  else
                  {
                    $fehcaInical = null;
                    $fechaFinal = null;
                  }
                  $venta = ControladorVenta::ctrRangoFecha($fehcaInical,$fechaFinal);
                  
                  foreach($venta as $key => $valor)
                  {
                    echo '<tr>
                              <td>'.($key + 1).'</td>
                              <td>'.$valor["codigo"].'</td>';
                              $cliente = ControladorCliente::ctrMostrarCliente("id",$valor["id_cliente"]);
                              echo '<td>'.$cliente["nombre"].'</td>';
                              $vendedor = ControladorUsuario::ctrMostrarUsuarios("id",$valor["id_vendedor"]);
                              echo '<td>'.$vendedor["Nombre"].'</td>
                              <td>'.$valor["metodo_Pago"].'</td>
                              <td>$'.number_format($valor["neto"],2).'</td>
                              <td>$'.number_format($valor["total"],2).'</td>
                              <td>'.$valor["fecha"].'</td>
                              <td>
                                  <div class="btn-group">
                                    <button class="btn btn-info btnImprimirFactura" codigoVenta="'.$valor["codigo"].'"><i class="fa fa-print"></i></button>';
                                    if($_SESSION["perfil"] == "Administrador")
                                    {
                                      echo '<button class="btn btn-warning btnEditarVenta" idVenta="'.$valor["id"].'"><i class="fa fa-pencil"></i></button>
                                      <button class="btn btn-danger btnEliminarVenta" idVenta="'.$valor["id"].'"><i class="fa fa-times"></i></button>';
                                    }
                              echo '</div>
                            </td>
                          </tr>';
                  }
               ?>
             </tbody>
          </table>
          <?php
            $eliminarVenta = new ControladorVenta();
            $eliminarVenta->ctrEliminarVenta();
          ?>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->