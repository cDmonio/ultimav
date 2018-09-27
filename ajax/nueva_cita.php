<?php date_default_timezone_set('UTC');?>
<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['id_user'])) {
           $errors[] = "ID vacío";
        } else if (!empty($_POST['id_user'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		//require_once ("../config/db2.php");
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
		//require_once ("../config/conexion2.php");

		// escaping, additionally removing everything that could be (html/javascript-) code
		if($_SESSION['user_admin']=='1'){
			
			$id_user_produccion=$_POST['tecnicos'];

			$sql2="SELECT firstname, lastname FROM users WHERE user_id='$id_user_produccion'"; 
			$ejecutado=mysqli_query($con,$sql2);
			$row=mysqli_fetch_array($ejecutado);

			$user_produccion=$row['firstname']." ".$row['lastname'];

		}

		else{
			$id_user_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["id_user"],ENT_QUOTES)));
			$user_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["user"],ENT_QUOTES)));
		}
		
		$estado_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["cita"],ENT_QUOTES)));		
		$proyecto_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["proyecto"],ENT_QUOTES)));
		$orden_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["orden"],ENT_QUOTES)));
		$fecha_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));
		$date_added=date("Y-m-d H:i:s"); 

		$chora=$_POST['chora'];
		$cmin=$_POST['cmin'];
		$hcita_produccion=$chora.":".$cmin;


				$sql="INSERT INTO produccion (id_user_produccion, user_produccion, estado_produccion, proyecto_produccion, orden_produccion, fecha_produccion, hcita_produccion, date_added) VALUES ('$id_user_produccion','$user_produccion','$estado_produccion','$proyecto_produccion','$orden_produccion','$fecha_produccion','$hcita_produccion', '$date_added')";

			$query_new_insert = mysqli_query($con,$sql);

				if ($query_new_insert){
					$messages[] = "El registro ha sido ingresado satisfactoriamente.";
				} else{
					$errors[]= "Lo siento algo ha salido mal intenta nuevamente.".mysqli_error($con);
				}
			}
			else {
				$errors[]= "Error desconocido.";
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
<?php
    header("Refresh: 5; url=index.php");
?>
