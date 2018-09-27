	<?php
		if (isset($con))
		{
	?>
	
	<!-- Modal -->
	<div class="modal fade" id="excel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-circle-arrow-down'></i> Exportar a Excel</h4>
		  </div>
		  <div class="modal-body">
		  
			<form class="form-horizontal" method="post" action="exportar_excel.php">
			  
			  <div class="form-group">
				<label for="fecha_inicio" class="col-sm-3 control-label">Fecha Inicio</label>
				<div class="col-sm-8">
				  <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
				</div>
			  </div>
			  
			  <div class="form-group">
				<label for="fecha_fin" class="col-sm-3 control-label">Fecha Fin</label>
				<div class="col-sm-8">
				  <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" required>
				</div>
			  </div>

			  <div class="form-group">
				<label for="fecha_fin" class="col-sm-3 control-label">¿Extraer todos los Clientes?</label>
				<div class="col-sm-8">
				  <input type="checkbox" name="check1">
				</div>
			  </div>
			  
			<center><button type="submit" class="btn btn-primary" id="exportar" name="exportar">Exportar Excel</button></center>
			  
		  </div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>