  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Administrar Productos
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Productos</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarProductos">
            Agregar Productos
          </button>
        </div>
        <div class="box-body">
          <table  class="table table-bordered table-striped dt-responsive tablas">
             <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Imagen</th>
                <th>Codigo</th>
                <th>Descripcion</th>
                <th>Categoria</th>
                <th>Stock</th>
                <th>Precio de compra</th>
                <th>Precio de venta</th>
                <th>Agregados</th>
                <th>Acciones</th>
              </tr>
             </thead>
             <tbody>
              <tr>
                <td>1</td>
                <td><img src="vistas/imagenes/productos/default/anonymous.png" class="img-thumbnail" width="40px" /></td>
                <td>0001</td>
                <td>Lorem ipsum dolor sit amet</td>
                <td>Lorem ipsum</td>
                <td>20</td>
                <td>$ 5.00</td>
                <td>$ 10.00</td>
                <td>2019-04-03 10:03:25</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td><img src="vistas/imagenes/productos/default/anonymous.png" class="img-thumbnail" width="40px" /></td>
                <td>0001</td>
                <td>Lorem ipsum dolor sit amet</td>
                <td>Lorem ipsum</td>
                <td>20</td>
                <td>$ 5.00</td>
                <td>$ 10.00</td>
                <td>2019-04-03 10:03:25</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>1</td>
                <td><img src="vistas/imagenes/productos/default/anonymous.png" class="img-thumbnail" width="40px" /></td>
                <td>0001</td>
                <td>Lorem ipsum dolor sit amet</td>
                <td>Lorem ipsum</td>
                <td>20</td>
                <td>$ 5.00</td>
                <td>$ 10.00</td>
                <td>2019-04-03 10:03:25</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning"><i class="fa fa-pencil"></i></button>
                    <button class="btn btn-danger"><i class="fa fa-times"></i></button>
                  </div>
                </td>
              </tr>
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
  <div id="modalAgregarProductos" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--======================================================================================================
        Cabeza del Modal
        ======================================================================================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Produtos</h4>
        </div>
        <!--======================================================================================================
        Cuerpo del Modal
        ======================================================================================================-->
        <div class="modal-body">
          <div class="box-body">
            <!--Entrada para el Codigo-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-code"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoCodigo" placeholder="Ingresar Codigo" required />    
              </div> 
            </div>
            <!--/Entrada para el Codigo-->
            <!--Entrada para la Descripcion-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-product-hunt"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoDescripcion" placeholder="Ingresar Descripcion" required />    
              </div> 
            </div>
            <!--/Entrada para la Descripcion-->
            <!--Entrada para la categoria-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <select name="nuevoCategoria" class="form-control input-lg">
                  <option value="">Seleccionar Categoria</option>
                  <option value="Taladros">Taladros</option>
                  <option value="Andamios">Andamios</option>
                  <option value="Equipos para construcion">Equipos para construcion</option>
                </select>    
              </div>
            </div>
            <!--/Entrada para la categoria-->
            <!--Entrada para el stock-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-check"></i></span>
                <input type="number" class="form-control input-lg" name="nuevoStock" min="0" placeholder="Stock" required />    
              </div> 
            </div>
            <!--/Entrada para el stock-->
            <!--Entrada para el precio compra-->
            <div class="form-group row">
              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-up"></i></span>
                  <input type="number" class="form-control input-lg" name="nuevoPrecioCompra" min="0" placeholder="Precio Compra" required />    
                </div> 
              </div>
            <!--/Entrada para el precio compra-->
            <!--Entrada para el precio venta-->
              <div class="col-xs-6">
                <div class="input-group">
                  <span class="input-group-addon"><i class="fa fa-arrow-down"></i></span>
                  <input type="number" class="form-control input-lg" name="nuevoPrecioVenta" min="0" placeholder="Precio Venta" required />    
                </div>
                <br />
                <!--Checkbox para porcentaje-->
                <div class="col-xs-6">
                  <div class="form-group">
                    <label>
                      <input type="checkbox" class="minimal porcentaje" checked/>
                      Utilizar porcentaje
                    </label>
                </div>
              </div> 
              <div class="col-xs-6" style="padding:0">
                <div class="input-group">
                  <input type="number" class="form-control input-lg nuevoPorcentaje" min="0" value="40" required/>
                  <span class="input-group-addon"><i class="fa fa-percent"></i></span>
                </div>
              </div>
            </div>
            <!--/Entrada para el precio venta-->
            <!--Entrada para subir la foto-->
            <div class="form-group">
              <div class="panel">SUBIR Imagen</div>
              <input type="file" id="nuevaImagen" name="nuevaFoto"/>
              <p class="help-block">Peso maximo de la foto 2 MB</p>
              <img src="vistas/imagenes/productos/default/anonymous.png" class="img-thumbmail" width="100px"/>
            </div>
            <!--/Entrada para subir la foto-->
          </div>
        </div>
        <!--======================================================================================================
        Pie del Modal
        ======================================================================================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pll-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Productos</button>
        </div>
      </form>
    </div> 
  </div>
</div>
</div>
<!--/Modal-->
  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 2.4.0
    </div>