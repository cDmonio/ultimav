<?php
		if (isset($con))
		{
	?>
	<!-- Modal, el id del modal es llamado desde el dashboard como nuevoCliente -->
	<div class="modal fade" id="nuevoCita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Añadir nueva CITA</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="registrar_cita" name="registrar_cita">

				<input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $_SESSION['user_id']?>"  required>
							<!-- Añado el estado en el que estará la cita -->	
			  <input type="hidden" class="form-control" id="cita" name="cita" value="0"  required>

			  <center><input type="reset" class="btn btn-primary" value="Limpiar campos"></center><br>


				<?php if ($_SESSION["user_admin"]=="1") {?>

				<div class="form-group">
					<label for="tecnicos" class="col-sm-3 control-label">Técnico</label>
					<div class="col-sm-8">
					  <select class="form-control" id="tecnicos" name="tecnicos" required>
					  </select>
					</div>
				</div>
			  <?php  }
			  else { ?>
			  	
			  <input type="hidden" class="form-control" id="user" name="user" value="<?php echo $_SESSION['firstname']?> <?php echo $_SESSION['lastname']?>"  required>
			  	<?php 
			  		}
			  	?>


			  <div class="form-group">
				<label for="proyecto" class="col-sm-3 control-label">Proyecto</label>
				<div class="col-sm-8">
				<!-- el id se lo paso al documento produccion.js y luego en produccion .js tengo el POST y parseo a este select  -->
				  <select class="form-control" id="proyecto" name="proyecto" required>
					  <option value=""></option>
					  <option value="Autronic">Autronic</option>
					  <option value="BEE Ingeniería">BEE Ingeniería</option>
					  <option value="Dominion">Dominion</option>	
					  <option value="Gestelcom">Gestelcom</option>	
					  <option value="Grupo ICA">Grupo ICA</option>
					  <option value="Indea">Indea</option>
					  <option value="Magtel Jazztel Orange">Magtel Jazztel Orange</option>				 
					  <option value="Magtel Masmovil">Magtel Masmovil</option>		 
					  <option value="Ono">Ono</option> 				  		  
				  </select>

				</div>
			  </div>

			  <div class="form-group">
				<label for="orden" class="col-sm-3 control-label">Nº Orden</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="orden" name="orden" required>
				</div>
			  </div>

			  <div class="form-group">
				<label for="fecha" class="col-sm-3 control-label">Fecha Actuación</label>
				<div class="col-sm-8">
				  <input type="date" class="form-control" id="fecha" name="fecha" required>
				</div>
			  </div>

			  <div class="form-group">
				<label for="inicio" class="col-sm-3 control-label">Hora Cita</label>
				<div class="col-sm-8">
				  	<select id="chora" name="chora" required="required">
		                    <option value="" selected="selected"></option>
		                    <option value="0">00</option>
		                    <option value="1">01</option>
		                    <option value="2">02</option>
		                    <option value="3">03</option>
		                    <option value="4">04</option>
		                    <option value="5">05</option>
		                    <option value="6">06</option>
		                    <option value="7">07</option>
		                    <option value="8">08</option>
		                    <option value="9">09</option>
		                    <option value="10">10</option>
		                    <option value="11">11</option>
		                    <option value="12">12</option>
		                    <option value="13">13</option>
		                    <option value="14">14</option>
		                    <option value="15">15</option>
		                    <option value="16">16</option>
		                    <option value="17">17</option>
		                    <option value="18">18</option>
		                    <option value="19">19</option>
		                    <option value="20">20</option>
		                    <option value="21">21</option>
		                    <option value="22">22</option>
		                    <option value="23">23</option>
		            </select>
            h
            	<select id="cmin" name="cmin" required="required">
            		<option value="" selected="selected"></option>
            		<option value="0">00</option>
            		<option value="30">30</option>
            	</select>
				</div>
			  </div>

		  </div>

			<!--//Aquí llamo a la alerta generada por el ajax -->
			<div id="resultados_ajax3"></div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_cita">Guardar Cita</button>
		  </div>


		  </form>

			<!--aqui-->
		</div>
	  </div>
	</div>
	<?php
		}
	?>