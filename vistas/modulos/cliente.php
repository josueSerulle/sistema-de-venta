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
        Administrar cliente
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar cliente</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCliente">
            Agregar cliente
          </button>
        </div>
        <div class="box-body">
          <table  class="table table-bordered table-striped dt-responsive tablas">
             <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Nombre</th>
                <th>Documento ID</th>
                <th>Email</th>
                <th>Telefonos</th>
                <th>Direccion</th>
                <th>Fecha Nacimientos</th>
                <th>Total de Compra</th>
                <th>Ultima Compra</th>
                <th>Ingreso al sistema</th>
                <th>Acciones</th>
              </tr>
             </thead>
             <tbody>
              <?php
                $respuesta = ControladorCliente::ctrMostrarCliente(null,null);
                foreach($respuesta as $key => $valor)
                {
                  echo '<tr>
                    <td>'.($key + 1).'</td>
                    <td>'.$valor["nombre"].'</td>
                    <td>'.$valor["documento"].'</td>
                    <td>'.$valor["email"].'</td>
                    <td>'.$valor["telefono"].'</td>
                    <td>'.$valor["direccion"].'</td>
                    <td>'.$valor["fecha_Nacimiento"].'</td>
                    <td>'.$valor["compras"].'</td>
                    <td>'.$valor["ultima_Compra"].'</td>
                    <td>'.$valor["fecha"].'</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarCliente" data-toggle="modal" data-target="#modalEditarCliente" idCliente="'.$valor["id"].'"><i class="fa fa-pencil"></i></button>';
                        if($_SESSION["perfil"] == "Administrador")
                          echo '<button class="btn btn-danger btnEliminar" idCliente="'.$valor["id"].'"><i class="fa fa-times"></i></button>';
                      echo '</div>
                    </td>
                  </tr>';
                }
              ?>
             </tbody>
          </table>
        </div>
        <!-- /.box-body -->
      </div>
      <!-- /.box -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <!--Modal-->
  <div id="modalAgregarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <!--======================================================================================================
    Modal Ingresar Cliente
  ======================================================================================================-->
    <div class="modal-content">
      <form role="form" method="post">
        <!--======================================================================================================
        Cabeza del Modal
        ======================================================================================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Cliente</h4>
        </div>
        <!--======================================================================================================
        Cuerpo del Modal
        ======================================================================================================-->
        <div class="modal-body">
          <div class="box-body">
            <!--Entrada para el nombre-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoCliente" placeholder="Ingresar nombre" required />    
              </div> 
            </div>
            <!--/Entrada para el nombre-->
          </div>
          <!--Entrada para el Documento ID-->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text"  class="form-control input-lg" id="nuevoDocumento" name="nuevoDocumento" placeholder="Ingresar Documento" data-inputMask = "'mask': '999-9999999-9'" data-mask required />    
              </div> 
            </div>
            <!--/Entrada para el Documento ID-->
             <!--Entrada para el email-->
             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" name="nuevoEmail" placeholder="Ingresar email" required />    
              </div> 
            </div>
            <!--/Entrada para el email-->
            <!--Entrada para el telefono-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text"  class="form-control input-lg" id="nuevoTelefono" name="nuevoTelefono" placeholder="Ingresar Telefono" data-inputMask = "'mask': '(999) 999-9999'" data-mask required />    
              </div> 
            </div>
            <!--/Entrada para el telefono-->
            <!--Entrada para la direccion-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoDireccion" placeholder="Ingresar direccion" required />    
              </div> 
            </div>
            <!--/Entrada para la direccion-->
            <!--Entrada para la fecha de nacimiento-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control input-lg datepick" id="nuevofecha" name="nuevofecha" placeholder="Ingresar fecha de nacimiento" required />    
              </div> 
            </div>
            <!--/Entrada para la fecha de nacimiento-->
        </div>
        <!--======================================================================================================
        Pie del Modal
        ======================================================================================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pll-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Cliente</button>
        </div>
      </form>
    </div> 
    <?php
      $crearCliente = new ControladorCliente();
      $crearCliente-> ctrCrearCliente();
    ?>
  </div>
</div>
<!--/Modal-->
  <!--Modal-->
  <div id="modalEditarCliente" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <!--======================================================================================================
    Modal Editar Cliente
  ======================================================================================================-->
    <div class="modal-content">
      <form role="form" method="post">
        <!--======================================================================================================
        Cabeza del Modal
        ======================================================================================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Cliente</h4>
        </div>
        <!--======================================================================================================
        Cuerpo del Modal
        ======================================================================================================-->
        <div class="modal-body">
          <div class="box-body">
            <!--Entrada para el nombre-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-user"></i></span>
                <input type="text" class="form-control input-lg" id="editarCliente" name="editarCliente" required />
                <input type="hidden" id="idCliente" name="idCliente" />    
              </div> 
            </div>
            <!--/Entrada para el nombre-->
          </div>
          <!--Entrada para el Documento ID-->
          <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text"  class="form-control input-lg" id="editarDocumento" name="editarDocumento" data-inputMask = "'mask': '999-9999999-9'" data-mask required />    
              </div> 
            </div>
            <!--/Entrada para el Documento ID-->
             <!--Entrada para el email-->
             <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-envelope"></i></span>
                <input type="email" class="form-control input-lg" id="editarEmail" name="editarEmail" required />    
              </div> 
            </div>
            <!--/Entrada para el email-->
            <!--Entrada para el telefono-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-phone"></i></span>
                <input type="text"  class="form-control input-lg" id="editarTelefono" name="editarTelefono" data-inputMask = "'mask': '(999) 999-9999'" data-mask required />    
              </div> 
            </div>
            <!--/Entrada para el telefono-->
            <!--Entrada para la direccion-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-map-marker"></i></span>
                <input type="text" class="form-control input-lg" id="editarDireccion" name="editarDireccion" required />    
              </div> 
            </div>
            <!--/Entrada para la direccion-->
            <!--Entrada para la fecha de nacimiento-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                <input type="text" class="form-control input-lg" id="editarfecha" name="editarfecha" data-inputMask="'alias': 'yyyy/mm/dd'" data-mask required />    
              </div> 
            </div>
            <!--/Entrada para la fecha de nacimiento-->
        </div>
        <!--======================================================================================================
        Pie del Modal
        ======================================================================================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pll-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>
      </form>
    </div> 
    <?php
      $editarCliente = new ControladorCliente();
      $editarCliente->ctrEditarCliente();
    ?>
  </div>
</div>
<!--/Modal-->
<?php
  $eliminarCliente = new ControladorCliente();
  $eliminarCliente->ctrEliminarCliente();
?>