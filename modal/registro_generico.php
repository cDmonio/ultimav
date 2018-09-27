	<?php
		if (isset($con))
		{
	?>
	<!-- Modal, el id del modal es llamado desde el dashboard como nuevoCliente -->
	<div class="modal fade" id="nuevoCliente" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>Ordenes Vodafone</h4>
				<h5 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i>(Solo son necesarias las que tenga que subir fotos y/o Instale material propio)</h5>

		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="guardar_produccion" name="guardar_produccion" enctype="multipart/form-data">

			  <input type="hidden" class="form-control" id="id_user" name="id_user" value="<?php echo $_SESSION['user_id']?>"  required>
			  <input type="hidden" class="form-control" id="user" name="user" value="<?php echo $_SESSION['firstname']?> <?php echo $_SESSION['lastname']?>"  required>

			  <center><input type="reset" class="btn btn-primary" value="Limpiar campos"></center><br>

				  <input type="hidden" class="form-control" id="km" name="km">

			  <div class="form-group">
				<label for="proyecto" class="col-sm-3 control-label">Proyecto</label>
				<div class="col-sm-8">
				<!-- el id se lo paso al documento produccion.js y luego en produccion .js tengo el POST y parseo a este select 
				  <select class="form-control" id="proyecto" name="proyecto" required>
				  	<option value="Vodafone">Vodafone</option>
				  </select> -->
				  <input type="text" class="form-control" id="proyecto" name="proyecto" readonly="readonly" value="Vodafone">
				</div>
			  </div>

			  <div class="form-group">
				<label for="orden" class="col-sm-3 control-label">Nº Orden</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="orden" name="orden" required>
				</div>
			  </div>


				<input type="hidden" class="form-control" id="cp" name="cp">
				<input type="hidden" class="form-control" id="fecha" name="fecha">			  
				<input type="hidden" class="form-control" id="inicio" name="inicio">
				<input type="hidden" class="form-control" id="fin" name="fin">
				<input type="hidden" class="form-control" id="tipo" name="tipo">
				<input type="hidden" class="form-control" id="deco" name="deco">
				<input type="hidden" class="form-control" id="router" name="router">


			 <!--- <div class="form-group">
				<label for="tipo" class="col-sm-3 control-label">Tipo Instalación</label>
				<div class="col-sm-8">
					<select class="form-control" id="tipo" name="tipo" required>
					</select>
				</div>
			  </div>
				-->
				<div class="form-group">
					<label for="longacometida" class="col-sm-3 control-label">Acometidas</label>
					<div class="col-sm-8">
						 <input type="text" class="form-control" name="longacometida" list="longacometida" placeholder="Numero de Acometidas :0, si no instalo">
						  <datalist id="longacometida">
						  </datalist>
					</div>
				</div>

				
					


			  		<div class="form-group">
						<label for="antena" class="col-sm-3 control-label">Antena</label>
					<div class="col-sm-8">
						<input type="text" class="form-control" id="antena" name="antena" placeholder="Introducir Antena">		</div>
					
					</div>

				<div class="form-group">
					<label for="bandeja" class="col-sm-3 control-label">Bandeja/RAK</label>
					<div class="col-sm-8">
					<input type="text" class="form-control" id="bandeja" name="bandeja" placeholder="Introducir Bandeja/RAK">
					</div>	
				</div>


			  <div class="form-group">
				<label for="material" class="col-sm-3 control-label">Otro Material Instalado</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="material" name="material"  maxlength="500" rows="5" ></textarea>
				</div>
				<label class="col-xs-2 control-label">Fotos:</label> 
				<input name="fotos[]" type="file" multiple="multiple" class="btn btn-default"/>
			  </div>
		  </div>

			<!--//Aquí llamo a la alerta generada por el ajax -->
			<div id="resultados_ajax"></div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="guardar_datos">Guardar datos</button>
		  </div>


		  </form>

			<!--aqui-->
		</div>
	  </div>
	</div>
	<?php
		}
	?>