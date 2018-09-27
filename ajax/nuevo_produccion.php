<?php date_default_timezone_set('UTC');?>
<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/
	if (empty($_POST['id_user'])) {
           $errors[] = "ID vacío";
        } else if (!empty($_POST['id_user'])){
		/* Connect To Database*/
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

		require_once ("../config/db2.php");//Conecta a excel_exports
		require_once ("../config/conexion2.php");//Conecta a excel_exports

		// escaping, additionally removing everything that could be (html/javascript-) code
		$id_user_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["id_user"],ENT_QUOTES)));
		$user_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["user"],ENT_QUOTES)));
		$proyecto_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["proyecto"],ENT_QUOTES)));
		$orden_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["orden"],ENT_QUOTES)));
		//$fecha_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["fecha"],ENT_QUOTES)));
		//$inicio_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["inicio"],ENT_QUOTES)));
		//$fin_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["fin"],ENT_QUOTES)));
		$tipo_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["tipo"],ENT_QUOTES)));
		$tipo_long_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["longacometida"],ENT_QUOTES))); //nueva linea, añadiré la acometida voy a probar.
		$router_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["router"],ENT_QUOTES)));
		$deco_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["deco"],ENT_QUOTES)));
		$antena_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["antena"],ENT_QUOTES)));
		$bandeja_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["bandeja"],ENT_QUOTES)));		
		$material_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["material"],ENT_QUOTES)));
		$km_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["km"],ENT_QUOTES)));
		$cp_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["cp"],ENT_QUOTES)));
		$date_added=date("Y-m-d H:i:s"); //Tengo que buscar algo para cambiar el formato de la fecha cada vez que se introduce algo.
		//$date_added=date_create_from_format('d-M-Y', $daddfecha);
		$estado_produccion=intval(1);

		$consulta="SELECT * FROM excel_reports WHERE code='$orden_produccion'";

		$ejecutado=mysqli_query($con2,$consulta);
		$row=mysqli_fetch_array($ejecutado);
		//Extraigo los siguientes datos de la consulta que hago a la base de datos de Vodafone.
		$orden_code = $row['code'];
		$fecha_actuacion = $row['date_acting'];
		$inio_actuacion = $row['date_begin'];
		$fin_actuacion = $row['date_finish'];
		$hcita_produccion= $row['tech_scheduledate'];


		//Excel_reports ejemplo.
		//$consulta="SELECT * FROM excel_reports WHERE code='$orden_produccion'";

			$sql="";
		if($_POST["proyecto"]=="Vodafone" && $orden_code==$orden_produccion){

			$sql="INSERT INTO produccion (id_user_produccion, user_produccion, estado_produccion, proyecto_produccion, orden_produccion, fecha_produccion, hcita_produccion, inicio_produccion, fin_produccion, tipo_produccion, tipo_long_produccion, router_produccion, deco_produccion, antena_produccion, bandeja_produccion, material_produccion, km_produccion, cp_produccion, date_added) VALUES ('$id_user_produccion','$user_produccion','$estado_produccion','$proyecto_produccion','$orden_produccion','$fecha_actuacion','$hcita_produccion','$inicio_actuacion','$fin_actuacion','$tipo_produccion','$tipo_long_produccion','$router_produccion','$deco_produccion','$antena_produccion', '$bandeja_produccion', '$material_produccion','$km_produccion','$cp_produccion','$date_added')";
            
			// subida de las Fotos:
			
            for($i=0; $i<count($_FILES['fotos']['name']); $i++) {
           //Obtenemos la ruta temporal del fichero
            $fichTemporal = $_FILES['fotos']['tmp_name'][$i];
 
	           //Si tenemos fichero procedemos
	           	if ($fichTemporal != ""){
	             //Definimos una ruta definitiva para guardarlo
				  $extension=explode(".",$_FILES["fotos"]["name"][$i]);
	              $destino = "../fotos/".$orden_produccion.'_'.$i.".".$extension[1];
				  move_uploaded_file($fichTemporal, $destino);
	          //Movemos a la ruta final
        
			  	}
			}
			
			
			
		}
		else{
				$errors[]="El Numero de orden ".$orden_produccion." no exite. Por favor Reviselo Adecuadamente<br>";

		}


			$query_new_insert = mysqli_query($con,$sql);

				if ($query_new_insert){
					$messages[] = "El registro ha sido ingresado satisfactoriamente.";
				} else{
					$errors []= "Lo sentimos el Regirtro no ha podido Hacerse.".mysqli_error($con);
				}
			}
			else {
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
						<strong>Informacion del Registro:</strong>
						<?php
							foreach ($messages as $message) {
									echo $message;
								}
							
						   // echo 'Fotos :'.$fichTemporal.'  ->'.$destino;
							?>
				</div>
				<?php
			}
			
?>
<?php
    header("Refresh: 5; url=index.php");
?>
