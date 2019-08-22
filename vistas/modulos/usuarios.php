<?php
    if($_SESSION["perfil"] != "Administrador")
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
        Administrar Usuarios
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Usuarios</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarUsuario">
            Agregar Usuario
          </button>
        </div>
        <div class="box-body">
          <table  class="table table-bordered table-striped dt-responsive tablas">
             <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Nombre</th>
                <th>Usuario</th>
                <th>Foto</th>
                <th>Perfil</th>
                <th>Estado</th>
                <th>Ultimo login</th>
                <th>Acciones</th>
              </tr>
             </thead>
             <tbody>
              <?php
                $item = null;
                $valor = null;
                $usuario = ControladorUsuario:: ctrMostrarUsuarios($item,$valor);
                foreach($usuario as $key => $valor)
                {
                  echo ' <tr>
                    <td>'.($key+1).'</td>
                    <td>'.$valor["Nombre"].'</td>
                    <td>'.$valor["usuario"].'</td>';
                    if($valor["foto"] != "")
                      echo '<td><img src="'.$valor["foto"].'" class = "img-thumbail" width = "40px" /></td>';
                    else
                      echo '<td><img src="vistas/imagenes/usuario/default/anonymous.png" class = "img-thumbail" width = "40px" /></td>';
                    echo '<td>'.$valor["perfil"].'</td>';
                    if($valor["estado"] != 0)
                      echo '<td><button class="btn btn-success btn-xs btnActivar" idUsuario = "'.$valor["id"].'" estadoUsuario = "0">Activado</button></td>';
                    else
                      echo '<td><button class="btn btn-danger btn-xs btnActivar" idUsuario = "'.$valor["id"].'" estadoUsuario = "1">Desactivado</button></td>';

                    echo '<td>'.$valor["ultimo_login"].'</td>
                    <td>
                      <div class="btn-group">
                        <button class="btn btn-warning btnEditarUsuario"  idUsuario = "'.$valor["id"].'" data-toggle="modal" data-target="#modalEditarUsuario"><i class="fa fa-pencil"></i></button>
                        <button class="btn btn-danger btnEliminar" idUsuario = "'.$valor["id"].'" fotoUsuario = "'.$valor["foto"].'" usuario = "'.$valor["usuario"].'"><i class="fa fa-times"></i></button>
                      </div>
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
  <!--======================================================================================================
    Modal INgresar usuario
  ======================================================================================================-->
  <div id="modalAgregarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--======================================================================================================
        Cabeza del Modal
        ======================================================================================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Usuarios</h4>
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
                <input type="text" class="form-control input-lg" name="nuevoNombre" placeholder="Ingresar Nombre" required />    
              </div> 
            </div>
            <!--/Entrada para el nombre-->
            <!--Entrada para el usuario-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" name="nuevoUsuario"id="nuevoUsuario" placeholder="Ingresar Usuario" required />    
              </div> 
            </div>
            <!--/Entrada para el usuario-->
            <!--Entrada para la password-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="nuevoPassword" placeholder="Ingresar contraseña" required />    
              </div> 
            </div>
            <!--/Entrada para la password-->
            <!--Entrada para el Perfil-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="nuevoPerfil" class="form-control input-lg">
                  <option value="">Seleccionar perfil</option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>    
              </div>
            </div>
            <!--/Entrada para el Perfil-->
            <!--Entrada para subir la foto-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="nuevaFoto"/>
              <p class="help-block">Peso maximo de la foto 2 mb</p>
              <img src="vistas/imagenes/usuario/default/anonymous.png" class="img-thumbmail previsualizar" width="100px"/>
            </div>
            <!--/Entrada para subir la foto-->
          </div>
        </div>
        <!--======================================================================================================
        Pie del Modal
        ======================================================================================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pll-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Usuario</button>
        </div>
        <?php
          $crearUsuario = new ControladorUsuario();
          $crearUsuario -> ctrCrearUsuario();
        ?>
      </form>
    </div> 
  </div>
</div>
<!--/Modal-->
 <!--======================================================================================================
    Modal Editar usuario
  ======================================================================================================-->
  <div id="modalEditarUsuario" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <form role="form" method="post" enctype="multipart/form-data">
        <!--======================================================================================================
        Cabeza del Modal
        ======================================================================================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Usuarios</h4>
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
                <input type="text" class="form-control input-lg" id="editarNombre" name="editarNombre" value="" required />    
              </div> 
            </div>
            <!--/Entrada para el nombre-->
            <!--Entrada para el usuario-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-key"></i></span>
                <input type="text" class="form-control input-lg" id="EditarUsuario" name="EditarUsuario" value="" readOnly />    
              </div> 
            </div>
            <!--/Entrada para el usuario-->
            <!--Entrada para la password-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                <input type="password" class="form-control input-lg" name="editarPassword" placeholder="Escriba nueva contraseña" />  
                <input type="hidden" name="passwordActual" id="passwordActual" />  
              </div> 
            </div>
            <!--/Entrada para la password-->
            <!--Entrada para el Perfil-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-users"></i></span>
                <select name="editarPerfil" class="form-control input-lg">
                  <option value="" id="editarPerfil"></option>
                  <option value="Administrador">Administrador</option>
                  <option value="Especial">Especial</option>
                  <option value="Vendedor">Vendedor</option>
                </select>    
              </div>
            </div>
            <!--/Entrada para el Perfil-->
            <!--Entrada para subir la foto-->
            <div class="form-group">
              <div class="panel">SUBIR FOTO</div>
              <input type="file" class="nuevaFoto" name="editarFoto"/>
              <p class="help-block">Peso maximo de la foto 2 mb</p>
              <img src="vistas/imagenes/usuario/default/anonymous.png" class="img-thumbmail previsualizar" width="100px"/>
              <input type="hidden" name="fotoActual" id="fotoActual" />
            </div>
            <!--/Entrada para subir la foto-->
          </div>
        </div>
        <!--======================================================================================================
        Pie del Modal
        ======================================================================================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pll-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Modificar Usuario</button>
        </div>
        <?php
          $editarUsuario = new ControladorUsuario();
          $editarUsuario -> ctrEditarUsuario();
        ?>
      </form>
    </div> 
  </div>
</div>
<!--/Modal-->
<?php
  $borrarUsuario = new ControladorUsuario();
  $borrarUsuario -> ctrBorrarUsuario();
?>