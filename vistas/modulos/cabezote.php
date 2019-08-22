<header class="main-header">
	<!--=================================================
	logo tipo
	==================================================-->
 	<a href="inicio" class="logo">
 		<!--logo mini-->
		<span class="logo-mini">
			<img src="vistas/imagenes/plantilla/icono-blanco.png" class="img-responsive" style="padding: 10px" />
		</span>
 		<!--logo normal-->
 		<span class="logo-lg">
 				<img src="vistas/imagenes/plantilla/logo-blanco-lineal.png" class="img-responsive" style="padding: 10px" />
 		</span>
 	</a>
	<!--=================================================
	Barra de navegacion
	==================================================-->
	<nav class="navbar navbar-static-top" role="navigateon">
		<!--Boton de navegacion-->
		<a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
			<span class="sr-only">Toggle navigation</span>
		</a>
		<!--Perfil del usuario-->
		<div class="navbar-custom-menu">
			<ul class="nav navbar-nav">
				<!-- User Account: style can be found in dropdown.less -->
				<li class="dropdown user user-menu">
            		<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<?php
							if($_SESSION["foto"] != "")
								echo '<img src="'.$_SESSION["foto"].'" class="user-image"/>';
							else
								echo '<img src="vistas/imagenes/usuario/default/anonymous.png" class="user-image"/>';
						?>
						<span class="hidden-xs"><?php echo $_SESSION["nombre"]; ?></span>
            		</a>
            		<ul class="dropdown-menu">
              			<!-- User image -->
              			<li class="user-header">
							<?php
								if($_SESSION["foto"] != "")
									echo '<img src="'.$_SESSION["foto"].'" class="user-image"/>';
								else
									echo '<img src="vistas/imagenes/usuario/default/anonymous.png" class="user-image"/>';
							?>
							<p>	<?php echo $_SESSION["nombre"]; ?></p>
							<p>Perfil: <?php echo strtoupper($_SESSION["perfil"]); ?></p>
              			</li>
              			<!-- Menu Footer-->
              			<li class="user-footer">
                			<div class="pull-right">
                  				<a href="salir" class="btn btn-default btn-flat">Salir</a>
                			</div>
						</li>
            		</ul>
				</li>
			</ul>
		</div>
	</nav>
</header>