<div id="back"></div>
<div class="login-box">
  <div class="login-logo">
    <img src="vistas/imagenes/plantilla/logo-blanco-bloque.png" alt="Logo" class="img-responsive" style="padding: 30px 100px 0px 100px" />
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Iniciar al Sistema</p>

    <form method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control" placeholder="Usuario" name="ingUsuario" autocomplete="off" requed>
        <span class="glyphicon glyphicon-user form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control" placeholder="Contraseña" name="ingPassword" requed>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-4">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
      </div>
      <?php
        $login = new ControladorUsuario();
        $login -> ctrIngresoUsuario();
      ?>
    </form>
  </div>
</div>