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
                          <input type="text" class="form-control" id="nuevoVendedor" name="nuevoVendedor" value="Usuario Administrador" readonly />
                        </div>
                      </div>
                      <!-- /Entrada del vendedor -->
                      <!-- Entrada del Codigo Venta -->
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-key"></i></span>
                          <input type="text" class="form-control" id="nuevocodigoVenta" name="nuevocodigoVenta" value="1000470748" readonly />
                        </div>
                      </div>
                      <!-- /Entrada del Codigo Venta -->
                      <!-- Entrada del Cliente -->
                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-users"></i></span>
                          <select class="form-control" id="seleccionarCliente" name="seleccionarCliente" required>
                            <option value="">Seleccionar Cliente</option>
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
                        <!-- Descripcion del producto -->
                        <div class="col-xs-6" style="padding-right:0px">
                          <div class="input-group">
                            <span class="input-group-addon">
                              <button type="button" class="btn btn-danger btn-xs">
                                <i Class="fa fa-times"></i>
                              </button>
                            </span>
                            <input type="text" class="form-control" id="agregarProducto" name="agregarProducto" placeholder="Descripcion del producto" required />
                          </div>
                        </div>
                        <!-- /Descripcion del producto -->
                        <!-- Cantidad del producto -->
                        <div class="col-xs-3">
                          <input type="number" class="form-control" id="nuevoCantidadProducto" name="nuevoCantidadProducto" min="1" placeholder="0" required />
                        </div>
                        <!-- /Cantidad del producto -->
                        <!-- Precio del producto -->
                        <div class="col-xs-3" style="padding-left:0px">
                          <div class="input-group">
                            <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                            <input type="number" min="1" class="form-control" id="nuevoPrecioProducto" name="nuevoPrecioProducto" placeholder="000000" readonly required />
                          </div>
                        </div>
                        <!-- /Precio del producto -->
                      </div>
                      <!-- /Entrada del Producto -->
                      <!-- Boton para agregar Producto -->
                      <button type="button" class="btn btn-default hidden-lg">Agregar Productos</button>
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
                                <td style="width:50%">
                                  <div class="input-group">
                                    <input type="number" class="form-control" min="0" id="nuevoImpuestoVenta" name="nuevoImpuestoVenta" placeholder="0" required />
                                    <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                                  </div>
                                </td>
                                <td style="width:50%">
                                    <div class="input-group">
                                      <span class="input-group-addon"><i class="ion ion-social-usd"></i></span>
                                      <input type="number" class="form-control" min="1" id="nuevoTotalVenta" name="nuevoTotalVenta" placeholder="0000" readonly required />
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
                              <option value="efectivo">efectivo</option>
                              <option value="tarjetaCredito">Tarjeta Credito</option>
                              <option value="tarjetaDebito">Tarjeta Debito</option>
                            </select>
                          </div>
                        </div>
                        <div class="col-xs-6" style="padding-left:0px">
                          <div class="input-group">
                            <input type="text" class="form-control" id="nuevoCodigoTransaccion" name="nuevoCodigoTransaccion" placeholder="codigo Transaccion" required />
                            <span class="input-group-addon"> <i class="fa fa-lock"></i> </span>
                          </div>
                        </div>
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
                  <table class="table table-bordered table-striped dt-responsive tablas">
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
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td><img src="vistas/imagenes/productos/default/anonymous.png" class="img-thumbmail previsualizar" width="40px"/></td>
                        <td>00123</td>
                        <td>Lorem Ipsum dolor sit aret</td>
                        <td>20</td>
                        <td>
                          <div class="btn-group">
                            <button type="button" class="btn btn-primary">Agregar</button>
                          </div>
                        </td>
                      </tr>
                    </tbody>
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