<?php

	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
				echo "ESTOY DENTRO";
        header("location: login.php");
		exit;
        }
		if($_SESSION["user_admin"] <> "1"){
		header("Location: login.php");
		exit();
		}

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

	$active_dashboard="active";
	$title="Sistema de Producción - Grupo Magaez";
?>
<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("head.php");?>
  </head>
  <body>
	<?php
	include("navbar.php");
	?>

    <div class="container">

	<div class="panel panel-success">
		<div class="panel-heading">
		    <div class="btn-group pull-right">
                <a href="" data-toggle="modal" data-target="#excel"><img width="40px"  src="img/excel.png"></a>
			</div>
			<h4><i class='glyphicon glyphicon-check'></i> Producción</h4>
		</div>
		<div class="panel-body">

					<div class="col-sm-2 col-xs-6 col-md-2">
                      <a href="" data-toggle="modal" data-target="#nuevoCita"><img width="50px"  src="img/list.png"></a><br>Añadir Cita
                    </div>
        </div>
		<div class="panel-body">
			<?php
				include("modal/registro_generico.php");
				include("modal/editar_generico.php");
				include("modal/editar_cita.php");
				include("modal/registrar_cita.php");
				include("modal/excel.php");
			?>
			<form class="form-horizontal" role="form" id="datos_cotizacion">

						<div class="form-group row">
							<label for="q" class="col-md-2 control-label">Número de Orden</label>
							<div class="col-md-5">
								<input type="text" class="form-control" id="q" placeholder="Introduce el Número de Orden" onkeyup='load(1);'>
							</div>
							<div class="col-md-3">

								<span id="loader"></span>
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
	<script type="text/javascript" src="js/produccion_admin.js"></script>
  </body>
</html>
