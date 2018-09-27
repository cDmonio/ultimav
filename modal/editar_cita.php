	<?php
		if (isset($con))
		{
	?>
	<!-- Modal -->
	<div class="modal fade" id="editarCita" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	  <div class="modal-dialog" role="document">
		<div class="modal-content">
		  <div class="modal-header">
			<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			<h4 class="modal-title" id="myModalLabel"><i class='glyphicon glyphicon-edit'></i> Editar cita</h4>
		  </div>

		  <div class="modal-body">

			<form class="form-horizontal" method="post" id="editar_cita" name="editar_cita">

			<input type="hidden" class="form-control" id="mod_estado" name="mod_estado" value="1" required>

			  <input type="hidden" name="mod_id" id="mod_id">

			  <div class="form-group">
				<label for="proyecto" class="col-sm-3 control-label">Proyecto</label>
				<div class="col-sm-8">
				  <select class="form-control" id="mod_proyecto" name="mod_proyecto" required>
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
					  <option value="Vodafone">Vodafone</option>

				  </select>
				</div>
			  </div>

			  <div class="form-group">
				<label for="orden" class="col-sm-3 control-label">Nº Orden</label>
				<div class="col-sm-8">
				  <input type="text" class="form-control" id="mod_orden" name="mod_orden" required>
				</div>
			  </div>


			  <div class="form-group">
				<label for="fecha" class="col-sm-3 control-label">Fecha Actuación</label>
				<div class="col-sm-8">
				  <input type="date" class="form-control" id="mod_fecha" name="mod_fecha" required>
				</div>
			  </div>

			  <div class="form-group">
				<label for="fin" class="col-sm-3 control-label">Hora Cita</label>
				<div class="col-sm-8">
				  	<select id="mod_chora" name="mod_chora" required="required">
		                    <option value="" selected="selected"></option>
		                    <option value="00">00</option>
		                    <option value="01">01</option>
		                    <option value="02">02</option>
		                    <option value="03">03</option>
		                    <option value="04">04</option>
		                    <option value="05">05</option>
		                    <option value="06">06</option>
		                    <option value="07">07</option>
		                    <option value="08">08</option>
		                    <option value="09">09</option>
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
            	<select id="mod_cmin" name="mod_cmin" required="required">
            		<option value="" selected="selected"></option>
            		<option value="00">00</option>
            		<option value="30">30</option>
            	</select>
				</div>
			  </div>

				
		  </div>
		<!--//Aquí llamo a la alerta generada por el ajax -->
		<div id="resultados_ajax4"></div>
		  <div class="modal-footer">
			<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			<button type="submit" class="btn btn-primary" id="actualizar_cita">Actualizar cita</button>
		  </div>
		  </form>
		</div>
	  </div>
	</div>
	<?php
		}
	?>
