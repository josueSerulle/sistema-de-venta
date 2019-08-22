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
              </tr>
             </thead>
             <tbody>
              <tr>
                <td>1</td>
                <td>Juan Villegas</td>
                <td>8161123</td>
                <td>juan@hotmail.com</td>
                <td>555-57-67</td>
                <td>calle 27 #40 -36</td>
                <td>1982-15-11</td>
                <td>35</td>
                <td>2017-12-11 12:05:32</td>
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
                <input type="text" class="form-control input-lg" id="datepicker" name="nuevofecha" placeholder="Ingresar fecha de nacimiento" required />    
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
  </div>
</div>
<!--/Modal-->