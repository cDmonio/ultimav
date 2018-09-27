<?php
include('is_logged.php');
require_once ("../config/db.php");
require_once ("../config/conexion.php");
	$proyecto = $_POST['proyecto'];
	$antena = $_POST['antena'];
	$bandeja = $_POST['bandeja'];
 	if($proyecto=="Vodafone") 
{ ?>
	<div class="form-group">
	<label for="antena" class="col-sm-3 control-label">Antena</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="mod_antena" name="mod_antena" placeholder="Introducir Antena" value='<?php echo $antena ?>'></div>
					
					</div>

	<div class="form-group">
	<label for="bandeja" class="col-sm-3 control-label">Bandeja o RAK</label>
					<div class="col-sm-8">
					<input type="text" class="form-control" id="mod_bandeja" name="mod_bandeja" placeholder="Introducir Bandeja o RAK" value='<?php echo $bandeja ?>'>

					</div>	
	</div>
<?php }else { ?>
	<input type="hidden" class="form-control" id="mod_antena" name="mod_antena" value="">
	<input type="hidden" class="form-control" id="mod_bandeja" name="mod_bandeja" value="">
<?php
} 
?>