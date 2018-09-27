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
		$proyecto_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_proyecto"],ENT_QUOTES)));
		$orden_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_orden"],ENT_QUOTES)));
		$fecha_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fecha"],ENT_QUOTES)));
		//$inicio_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_inicio"],ENT_QUOTES)));
		//$fin_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fin"],ENT_QUOTES)));
		$tipo_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_tipo"],ENT_QUOTES)));
		$tipo_long_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_longacometida"],ENT_QUOTES))); //Añado esta edición.
		$router_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_router"],ENT_QUOTES))); //Añado esta edición.
		$deco_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_deco"],ENT_QUOTES)));
		$antena_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_antena"],ENT_QUOTES)));
		$bandeja_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_bandeja"],ENT_QUOTES)));
		$material_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_material"],ENT_QUOTES)));
		$km_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_km"],ENT_QUOTES)));
		$cp_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_cp"],ENT_QUOTES)));


		//$iHora=$_POST['iHora'];
		//$iMin=$_POST['iMin'];
		//$inicio_produccion=$iHora.":".$iMin;

		//$fHora=$_POST['fHora'];
		//$fMin=$_POST['fMin'];
		//$fin_produccion=$fHora.":".$fMin;

		if($_POST["mod_proyecto"]=="BEE IngenierÃ­a" || $_POST["mod_proyecto"]=="Magtel Masmovil"){
			$consulta="SELECT precio_proyecto FROM proyectos WHERE nom_proyecto='$proyecto_produccion' AND t_ins_proyecto='$tipo_produccion' AND long_aco_proyecto='$tipo_long_produccion'";

			$inicio_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_inicio"],ENT_QUOTES)));
			$fin_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fin"],ENT_QUOTES)));
			$precio_produccion = $row['precio_proyecto'];

			$ejecutado=mysqli_query($con,$consulta);
			$row=mysqli_fetch_array($ejecutado);

		}
		else{ //Si no, la longitud nos da igual.
			$consulta="SELECT precio_proyecto FROM proyectos WHERE nom_proyecto='$proyecto_produccion' AND t_ins_proyecto='$tipo_produccion'";
				$ejecutado=mysqli_query($con,$consulta);
				$row=mysqli_fetch_array($ejecutado);


			if($_POST["mod_proyecto"]=="IP Global"){
				$inicio_produccion=$_POST["mod_inicio"];
				$fin_produccion=$_POST["mod_fin"];
				
				if($inicio_produccion < $fin_produccion){
					$resto = $inicio_produccion - $fin_produccion;
					
					$horas = substr(($resto), 0,2);	
					$minutos = substr(($resto), -5, -3);

					if ($horas > "00"){
						$contH = $horas;
					}
					if($minutos >= "01"){
						$contM = "1";
					}

					$resultado = ($contH + $contM) * 30;
					$precio_produccion = $resultado;
				}
			}
			else{
				$inicio_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_inicio"],ENT_QUOTES)));
				$fin_produccion=mysqli_real_escape_string($con,(strip_tags($_POST["mod_fin"],ENT_QUOTES)));
				$precio_produccion = $row['precio_proyecto'];
			}
		}

		//$ejecutado=mysqli_query($con,$consulta);
		//$row=mysqli_fetch_array($ejecutado);
		//$precio_produccion = $row['precio_proyecto'];
		$puntos_produccion=$precio_produccion / 21; //Aquí calcul o los puntos que tendrá.

		if($_POST["mod_proyecto"]=="Ono") {
			  $precio_produccion=calcularono($inicio_produccion,$fin_produccion);
			  $puntos_produccion=$precio_produccion / 21;
			}


		$estado_produccion=intval(1);

		$id_produccion=intval($_POST['mod_id']);

		$sql="UPDATE produccion SET estado_produccion='".$estado_produccion."', proyecto_produccion='".$proyecto_produccion."', orden_produccion='".$orden_produccion."', fecha_produccion='".$fecha_produccion."', inicio_produccion='".$inicio_produccion."', fin_produccion='".$fin_produccion."', tipo_produccion='".$tipo_produccion."', tipo_long_produccion='".$tipo_long_produccion."', router_produccion='".$router_produccion."', deco_produccion='".$deco_produccion."', antena_produccion='".$antena_produccion."', bandeja_produccion='".$bandeja_produccion."', material_produccion='".$material_produccion."', km_produccion='".$km_produccion."', cp_produccion='".$cp_produccion."', precio_produccion='".$precio_produccion."',  puntos_produccion='".$puntos_produccion."' WHERE id_produccion='".$id_produccion."'";


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

function calcularono($inicio,$final) {
	    $diferencia=resta($inicio,$final);
        $dif=explode(":",$diferencia);
        $horas=intval($dif[0]);
        $minutos=intval($dif[1]);
        $tramos=0;
       
        if ($horas == 0) {$horas=1;$tramos=0;}
        if($minutos<16 && $minutos>0) $tramos=1;
        if($minutos<31 && $minutos>15) $tramos=2;
        if($minutos<46 && $minutos>30) $tramos=3;
        if($minutos>45) {$horas++;$tramos=0;}
              
        // Calculo el importe con los tramos y las horas, sumando 1 por el desplazamiento
        $horas++;
        $facturacion = ($horas*21)+($tramos*0.25*21);
        $facturacion = number_format($facturacion, 2, '.', '');
        return $facturacion;
}
function resta($inicio, $fin)
{
    $dif=date("H:i:s", strtotime("00:00:00") + strtotime($fin) - strtotime($inicio) );
    return $dif;
}

?>
