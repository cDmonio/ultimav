<?php
include('is_logged.php');
require_once ("../config/db.php");
require_once ("../config/conexion.php");

 $proyecto = $_POST['proyecto'];
 $km = $_POST['km'];
 $cp = $_POST['cp'];
 $fecha = $_POST['fecha'];
 $inicio = $_POST['inicio'];
 $fin = $_POST['fin'];
 $router=$_POST['router'];
 
?>
 <?php if($proyecto!=="Vodafone") 
{ ?>
			  <div class="form-group">
				<label for="km" class="col-sm-3 control-label">KM´s antes del desplazamiento</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_km" name="mod_km" value="<?php echo $km; ?>" placeholder="Introducir Kms" required>
				</div>
			  </div>

			  			  <div class="form-group">
				<label for="cp" class="col-sm-3 control-label">Código postal</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_cp" name="mod_cp" value="<?php echo $cp; ?>" placeholder="Introducir C.P." required>
				</div>
			  </div>


			  <div class="form-group">
				<label for="fecha" class="col-sm-3 control-label">Fecha Actuación</label>
				<div class="col-sm-8">
				  <input type="date" class="form-control" id="mod_fecha" name="mod_fecha" value="<?php echo $fecha; ?>" required>
				</div>
			  </div>


			  <div class="form-group">
				<label for="inicio" class="col-sm-3 control-label">Hora Inicio</label>
				<div class="col-sm-8">
	
          		<input type="time" class="form-control" id="mod_inicio" name="mod_inicio" value="<?php echo $inicio; ?>" required>

				</div>
			  </div>


			  <div class="form-group">
				<label for="fin" class="col-sm-3 control-label">Hora Fin</label>
				<div class="col-sm-8">
          		<input type="time" class="form-control" id="mod_fin" name="mod_fin" value="<?php echo $fin; ?>" required>
				</div>
			  </div>
			  
			   <div class="form-group">
					<label for="router" class="col-sm-3 control-label">Router</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="mod_router" name="mod_router" value="<?php echo $router; ?>"placeholder="Introducir router">
						<p style="color:red">Detallar por <b>"Nº de Serie".</b></p>
					</div>
			  </div>

<?php } 
else { ?>
	<input type="hidden" class="form-control" id="mod_km" name="mod_km">
	<input type="hidden" class="form-control" id="mod_cp" name="mod_cp">
	<input type="hidden" class="form-control" id="mod_fecha" name="mod_fecha">
	<input type="hidden" class="form-control" id="mod_inicio" name="mod_inicio">
    <input type="hidden" class="form-control" id="mod_fin" name="mod_fin">
    <input type="hidden" class="form-control" id="mod_deco" name="mod_deco">
    <input type="hidden" class="form-control" id="mod_deco" name="mod_router">

<?php }

?>