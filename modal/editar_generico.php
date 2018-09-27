	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Cerrar Parte</h4>
		  </div>
		  <div class="modal-body">
			<form class="form-horizontal" method="post" id="editar_produccion" name="editar_produccion">

			<input type="hidden" class="form-control" id="mod_estado" name="mod_estado" value="1" required>

			  <input type="hidden" name="mod_id" id="mod_id">


			  <div class="form-group">
				<label for="proyecto" class="col-sm-3 control-label">Proyecto</label>
				<div class="col-sm-8">
				  <select class="form-control" id="mod_proyecto" name="mod_proyecto" required>
				  </select>
				</div>
			  </div>

			  <div class="form-group">
				<label for="orden" class="col-sm-3 control-label">Nº Orden</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_orden" name="mod_orden" required>
				</div>
			  </div>
			  <!-- Aquí cargo gran parte del formulario, todo lo que no sea Vodafone. -->
			  <div id="cargarForm">
			  </div>

			  <div id="longtipos">
			  </div>

			 <div id="longacometidas">	
			 </div>

	 		<!--IR AL ARCHIVO PRODUCCION.JS HAY QUE COGER DE AHI LOS DATOS, ESTE ES MOD_TIPO POR EJEMPLO -->
	 		<!-- parte del form para Jazztel e Ica  -->
			  	<div class="form-group" id="mod_icajazz">
			  	</div>

			  <!--	//Terminar de etiquetar aqui los ids de antena y deco. -->
			  	<div id="mod_antenabandeja">
			  	</div>

			  <div class="form-group">
				<label for="material" class="col-sm-3 control-label">Material Instalado</label>
				<div class="col-sm-8">
					<textarea class="form-control" id="mod_material" name="mod_material"   maxlength="500" rows="5" ></textarea>
				<p style="color:red">Detallar los equipos instalados MARCA, MODELO y SERIE, así como TODOS los consumibles.</p>
				</div>
				<label class="col-xs-2 control-label">Fotos:</label> 
				<input name="fotos[]" type="file" multiple="multiple" class="btn btn-default"/>

			  </div>
			  
		  </div>
		<!--//Aquí llamo a la alerta generada por el ajax -->
		<div id="resultados_ajax2"></div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_datos">Actualizar</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
