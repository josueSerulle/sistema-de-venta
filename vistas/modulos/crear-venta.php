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
        Crear Ventas
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Crear Ventas</li>
      </ol>
    </section>
    <!-- Main content -->
    <section class="content">
      <!-- main div -->
      <div class="row">
        <!--El Formulario de venta-->
        <div class="col-lg-5 col-xs-12">
          <!-- box -->
          <div class="box box-success">
            <!-- box header -->
            <div class="box-header with-border">
              <!-- formulario -->
              <form role="form" method="post">
                <!-- box body -->
                <div class="box-body">
                    <div class="box">
                      <!-- Entrada del vendedor -->
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-user"></i></span>
                          <input type="text" class="form-control" id="nuevoVendedor" value="<?php echo $_SESSION["nombre"] ?>" readonly />
                          <input type="hidden" name="idVendedor" value="<?php echo $_SESSION["id"] ?>" />
                        </div>
                      </div>
                      <!-- /Entrada del vendedor -->
                      <!-- Entrada del Codigo Venta -->
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key"></i></span>
                          <?php
                            $venta = ControladorVenta::ctrMostrarVenta(null,null,1);
                            if($venta["codigo"] == null)
                              echo '<input type="text" class="form-control" id="nuevocodigoVenta" name="nuevocodigoVenta" value="10001" readonly />';
                            else
                              echo '<input type="text" class="form-control" id="nuevocodigoVenta" name="nuevocodigoVenta" value="'.($venta["codigo"]+1).'" readonly />';
                          ?>
                        </div>
                      </div>
                      <!-- /Entrada del Codigo Venta -->
                      <!-- Entrada del Cliente -->
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-users"></i></span>
                          <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                            <option value="">Seleccionar Cliente</option>
                            <?php
                              $cliente = ControladorCliente::ctrMostrarCliente(null,null);
                              foreach($cliente as $key => $valor)
                              {
                                  echo '<option value="'.$valor["id"].'">'.$valor["nombre"].'</option>';
                              }
                            ?>
                          </select>
                          <span class="input-group-addon"> 
                            <button class="btn btn-primary btn-xs" data-toggle="modal" data-target="#modalAgregarCliente">
                              Agregar cliente
                            </button>
                          </span>
                        </div>
                      </div>
                      <!-- /Entrada del Cliente -->
                      <!-- Entrada del Producto -->
                      <div class="form-group row nuevoProducto">
                      </div>
                      <!-- listas de producto -->
                      <input type="hidden" id="listaProductos" name="listaProductos" />
                      <!-- /Entrada del Producto -->
                      <!-- Boton para agregar Producto -->
                      <button type="button" class="btn btn-default hidden-lg btnAgregarProducto">Agregar Productos</button>
                      <!-- /Boton para agregar Producto -->
                      <hr />
                      <!-- Entrada de impuesto y total -->
                      <div class="row">
                        <div class="col-xs-8 pull-right">
                          <table class="table">
                            <thead>
                              <tr>
                                <th>Impuestos</th>
                                <th>Total</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td style="width:40%">
                                  <div class="input-group">
                                    <input type="number" class="form-control input-lg" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required />
                                    <input type="hidden" id="nuevoPrecioImpuesto" name="nuevoPrecioImpuesto" required />
                                    <input type="hidden" id="nuevoPrecioNeto" name="nuevoPrecioNeto" required />
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                  </div>
                                </td>
                                <td style="width:50%">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                      <input type="text" class="form-control input-lg" min="1" id="nuevoTotalVenta" name="nuevoTotalVenta" total placeholder="0000" readonly required />
                                      <input type="hidden" name="totalVenta" id="totalVenta" />
                                    </div>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                        </div>
                      </div>
                      <!-- /Entrada de impuesto y total -->
                      <hr />                   
                      <!-- Metodo de pago -->
                      <div class="form-group row">
                        <div class="col-xs-6" style="padding-rigth:0px">
                          <div class="input-group">
                            <select class="form-control" id="nuevoMetodoPago" name="nuevoMetodoPago" required>
                              <option value="">Seleccione Metodo de Pago</option>
                              <option value="Efectivo">efectivo</option>
                              <option value="TC">Tarjeta Credito</option>
                              <option value="TD">Tarjeta Debito</option>
                            </select>
                          </div>
                        </div>
                        <div class="cajaMetodoPago"></div>
                        <input type="hidden" name="listaMetodoPago" id="listaMetodoPago" />
                      </div>
                      <!-- /Metodo de pago -->
                    </div>
                </div>
                <!-- /box body -->
                <!-- box footer -->
                <div class="box-footer">
                  <button type="submit" class="btn btn-primary pull-right">Guardar Ventas</button>
                </div>
                <!-- /box footer -->
              </form>
              <!-- /formulario -->
              <?php
                $crearventa = new ControladorVenta();
                $crearventa->ctrCrearVenta();
              ?>
            </div>
            <!-- /box header -->
          </div>
          <!-- /box -->
        </div>
        <!--/El Formulario de venta-->
        <!-- La tabla de productos -->
        <div class="col-lg-7 hidden-md hidden-sm hidden-xs">
            <div class="box box-warning">
              <!-- header box -->
              <div class="box-header with-border">
                <!-- box body -->
                <div class="box-body">
                  <table class="table table-bordered table-striped dt-responsive tablasVenta">
                    <thead>
                      <tr>
                        <th style="width:10px">#</th>
                        <th>Imagen</th>
                        <th>Codigo</th>
                        <th>Descripcion</th>
                        <th>Stock</th>
                        <th>Acciones</th>
                      </tr>
                    </thead>
                  </table>
                </div>
                <!-- /box body -->
              </div>
              <!-- header box -->
            </div>
        </div>
        <!-- /La tabla de productos -->
      </div>
      <!-- /main div -->
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