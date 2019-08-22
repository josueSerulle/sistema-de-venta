<?php
    if($_SESSION["perfil"] == "Vendedor")
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
        Administrar Categoria
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Inicio</a></li>
        <li class="active">Administrar Categorias</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box">
        <div class="box-header with-border">
          <button class="btn btn-primary" data-toggle="modal" data-target="#modalAgregarCategoria">
            Agregar Categoria
          </button>
        </div>
        <div class="box-body">
          <table  class="table table-bordered table-striped dt-responsive tablas">
             <thead>
              <tr>
                <th style="width:10px">#</th>
                <th>Categoria</th>
                <th>Fecha</th>
                <th>Acciones</th>
              </tr>
             </thead>
             <tbody>
             <?php
              $categoria = ContrladorCategorias::ctrMostrarCategoria(null,null);
              foreach($categoria as $key => $valor)
              {
                echo '<tr>
                <td>'.($key+1).'</td>
                <td class="text-uppercase">'.$valor["categoria"].'</td>
                <td>'.$valor["fecha"].'</td>
                <td>
                  <div class="btn-group">
                    <button class="btn btn-warning btnEditarCategoria" data-toggle = "modal" data-target="#modalEditarCategoria" idCategoria = "'.$valor["id"].'"><i class="fa fa-pencil"></i></button>';
                    if($_SESSION["perfil"] == "Administrador")
                      echo '<button class="btn btn-danger btnEliminarCategoria" idCategoria = "'.$valor["id"].'"><i class="fa fa-times"></i></button>';
                  echo '</div>
                </td>
              </tr>';;
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
  <div id="modalAgregarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <!--======================================================================================================
    Modal Ingresar categoria
  ======================================================================================================-->
    <div class="modal-content">
      <form role="form" method="post">
        <!--======================================================================================================
        Cabeza del Modal
        ======================================================================================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Agregar Categoria</h4>
        </div>
        <!--======================================================================================================
        Cuerpo del Modal
        ======================================================================================================-->
        <div class="modal-body">
          <div class="box-body">
            <!--Entrada para el nombre-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="nuevaCategoria" id = "nuevaCategoria" placeholder="Ingresar Categoria" required />    
              </div> 
            </div>
            <!--/Entrada para el nombre-->
          </div>
        </div>
        <!--======================================================================================================
        Pie del Modal
        ======================================================================================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pll-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Categoria</button>
        </div>
         <?php
            $nuevaCategoria = new ContrladorCategorias();
            $nuevaCategoria -> ctrCrearCategoria();
         ?>
      </form>
    </div> 
  </div>
</div>
<!--/Modal-->
 <!--Modal-->
 <div id="modalEditarCategoria" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <!--======================================================================================================
    Modal Editar categoria
  ======================================================================================================-->
    <div class="modal-content">
      <form role="form" method="post">
        <!--======================================================================================================
        Cabeza del Modal
        ======================================================================================================-->
        <div class="modal-header" style="background: #3c8dbc; color: white">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Editar Categoria</h4>
        </div>
        <!--======================================================================================================
        Cuerpo del Modal
        ======================================================================================================-->
        <div class="modal-body">
          <div class="box-body">  
            <!--Entrada para el nombre-->
            <div class="form-group">
              <div class="input-group">
                <span class="input-group-addon"><i class="fa fa-th"></i></span>
                <input type="text" class="form-control input-lg" name="editarCategoria" id = "editarCategoria" placeholder="" required />    
                <input type="hidden" name="editarIdCategoria" id= "editarIdCategoria" />
              </div> 
            </div>
            <!--/Entrada para el nombre-->
          </div>
        </div>
        <!--======================================================================================================
        Pie del Modal
        ======================================================================================================-->
        <div class="modal-footer">
          <button type="button" class="btn btn-default pll-left" data-dismiss="modal">Salir</button>
          <button type="submit" class="btn btn-primary">Guardar Modificaciones</button>
        </div>
        <?php
            $editarCategoria = new ContrladorCategorias();
            $editarCategoria -> ctreditarCategoria();
         ?>
      </form>
    </div> 
  </div>
</div>
<?php
  $borrarCategoria = new ContrladorCategorias();
  $borrarCategoria -> ctrBorrarCategoria();
?>