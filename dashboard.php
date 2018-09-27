<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
		//echo "ESTOY DENTRO";
        header("location: login.php");
		exit;
        }
//	Borro de aqui Joe session_start();, estaba mal y lo pongo al principio.
		if($_SESSION["user_admin"] <> "0"){
		header("Location: login.php");
	exit();
		}

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

	$active_dashboard="active"; //Controlo la pestaña, si estoy en esta página estoy activo, si no, no sale el hipervinculo como activo.
	$title="Sistema de Producción - Grupo Magaez"; //Título
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("head.php");?> <!-- Cargo todo el archivo head.php -->
  </head>
  <body>
	<?php
	include("navbar.php"); //Cargo el archivo navbar.php
	?>

    <div class="container"> <!--Contenedor del menu -->
			<div class="panel panel-success">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
			</div>
			<h4><i class='glyphicon glyphicon-th-large'></i> Proyectos</h4> 
		</div>
		<div class="panel-body"> <!-- Links del panel para añadir cita o Cliente -->

					<center>

					<div class="col-sm-2 col-xs-6 col-md-2">
                      <a href="" data-toggle="modal" data-target="#nuevoCita"><img width="50px"  src="img/list.png"></a><br>Añadir Cita
                    </div>

					<div class="col-sm-2 col-xs-6 col-md-2">
                      <a href="" data-toggle="modal" data-target="#nuevoCliente"><img width="50px" src="img/list.png"></a><br>Añadir Vodafone
                    </div>
				
					</center>

		</div>
	</div>

	<div class="panel panel-success">
		<div class="panel-heading">
		    <div class="btn-group pull-right"> 
		    	<div id="puntos"> <!-- Cargaré los puntos del técnico con ajax y jquery -->
		    	</div>
			</div>
			<h4><i class='glyphicon glyphicon-check'></i> Mi Producción</h4>
		</div>
		<div class="panel-body">

			<?php
				include("modal/registro_generico.php");
				include("modal/editar_generico.php");
				include("modal/editar_cita.php");
				include("modal/registrar_cita.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion"> <!-- Este form servirá para hacer una búsquda -->

						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Número de Orden</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Introduce el Número de Orden" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">

								<span id="loader"></span> <!-- Cargamos el resultado -->
							</div>

						</div>
			</form>
				<div id="resultados"></div><!-- Carga los datos ajax -->
				<div class='outer_div'></div><!-- Carga los datos ajax -->

  </div>
</div>

	</div>
	<hr>
	<?php
	include("footer.php");
	?>
	<script type="text/javascript" src="js/produccion.js"></script>
  </body>
</html>
