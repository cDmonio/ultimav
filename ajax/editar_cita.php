<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['mod_id'])) {
           $errors[] = "ID vacío";
        } else if (!empty($_POST['mod_id'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		// escaping, additionally removing everything that could be (html/javascript-) code
		// escaping, additionally removing everything that could be (html/javascript-) code
		//$estado_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cita"],ENT_QUOTES)));		
		$proyecto_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_proyecto"],ENT_QUOTES)));
		$orden_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_orden"],ENT_QUOTES)));
		$fecha_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fecha"],ENT_QUOTES)));
		$date_added=date("Y-m-d H:i:s"); 


		$chora=$_POST['mod_chora'];
		$cmin=$_POST['mod_cmin'];
		$hcita_produccion=$chora.":".$cmin;

		$estado_produccion=intval(1);

		$id_produccion=intval($_POST['mod_id']);

		$sql="UPDATE produccion SET proyecto_produccion='".$proyecto_produccion."', orden_produccion='".$orden_produccion."', fecha_produccion='".$fecha_produccion."', hcita_produccion='".$hcita_produccion."' WHERE id_produccion='".$id_produccion."'";

		$query_update = mysqli_query($con,$sql);
			if ($query_update){
				$messages[] = "El registro ha sido actualizado satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
			}
		} else {
			$errors []= "Error desconocido.";
		}

		if (isset($errors)){

			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong>
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){

				?>
				<div class="alert alert-success" role="alert">
						<button type="button" class="close" data-dismiss="alert">&times;</button>
						<strong>¡Bien hecho!</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							?>
				</div>
				<?php
			}

?>
