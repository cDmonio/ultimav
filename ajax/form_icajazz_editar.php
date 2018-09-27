<?php
include('is_logged.php'); //Archivo verifica que el usario que intenta acceder a la URL esta logueado
		require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos
//Áquí podemos añadir más cosas para Jazztel e Ica.
$proyecto = $_POST['proyecto'];
$deco = $_POST['deco'];
?>
 <?php if($proyecto=="Grupo ICA" || $proyecto=="Magtel Jazztel Orange") 
{ ?>
	<label for="deco" class="col-sm-3 control-label">Decodificador</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="mod_deco" name="mod_deco" value='<?php echo $deco ?>' placeholder="Introducir deco">
						<p style="color:red">Detallar por <b>"Nº de Serie y Modelo".</b></p>
					</div>
<?php } 
else { ?>
	<input type="hidden" class="form-control" id="mod_deco" name="mod_deco" value=""  required>
<?php }
?>
