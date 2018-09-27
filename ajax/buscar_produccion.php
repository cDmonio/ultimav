<?php
	include('is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/* Connect To Database*/
	require_once ("../config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("../config/conexion.php");//Contiene funcion que conecta a la base de datos

	$action = (isset($_REQUEST['action'])&& $_REQUEST['action'] !=NULL)?$_REQUEST['action']:'';
	if (isset($_GET['id'])){
		$id_produccion=intval($_GET['id']);
		if ($delete1=mysqli_query($con,"DELETE FROM produccion WHERE id_produccion='".$id_produccion."'")){
		?>
			<div class="alert alert-success alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Aviso!</strong> Datos eliminados exitosamente.
			</div>
			<?php
		}else {
			?>
			<div class="alert alert-danger alert-dismissible" role="alert">
			  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
			  <strong>Error!</strong> Lo siento algo ha salido mal intenta nuevamente.
			</div>
			<?php

		}

	}

	$criterio = $_SESSION["user_id"];

	if($action == 'ajax'){
		// escaping, additionally removing everything that could be (html/javascript-) code
         $q = mysqli_real_escape_string($con,(strip_tags($_REQUEST['q'], ENT_QUOTES)));
		 $aColumns = array('orden_produccion');//Columnas de busqueda
		 $sTable = "produccion WHERE id_user_produccion='$criterio'";
		 $sWhere = "";
		// $anDw = " id_user_produccion='$criterio'";
		if ( $_GET['q'] != "" )
		{
			$sWhere = " and (";
			for ( $i=0 ; $i<count($aColumns) ; $i++ )
			{
				$sWhere .= $aColumns[$i]." LIKE '%".$q."%' OR ";
			}
			$sWhere = substr_replace( $sWhere, "", -3 );
			$sWhere .= ')';
		}
		$sWhere.=" order by estado_produccion, fecha_produccion DESC";
		include 'pagination.php'; //include pagination file
		//pagination variables
		$page = (isset($_REQUEST['page']) && !empty($_REQUEST['page']))?$_REQUEST['page']:1;
		$per_page = 40; //how much records you want to show
		$adjacents  = 4; //gap between pages after number of adjacents
		$offset = ($page - 1) * $per_page;
		//Count the total number of row in your table*/
		$count_query = mysqli_query($con, "SELECT count(*) AS numrows FROM $sTable $sWhere");
		$row= mysqli_fetch_array($count_query);
		
		$numrows = $row['numrows'];
		$total_pages = ceil($numrows/$per_page);
		//main query to fetch the data
		$sql="SELECT * FROM  $sTable $sWhere LIMIT $offset,$per_page";
		$query = mysqli_query($con, $sql);
		//loop through fetched data
		if ($numrows>0){

			?>
			<?php date_default_timezone_set('UTC');?>
			<div class="table-responsive">
			  <table class="table">
				<tr  class="success">
					<th>Editar</th>
					<th>Proyecto</th>
					<th>Nº Orden</th>
					<th>Estado</th>
					<th>Fecha Actuación</th>
					<th>Hora Cita</th>
					<th>Hora Inicio</th>
					<th>Hora Fin</th>
					<th class='text-right'>Cerrar/Fotos/Borrar</th>

				</tr>
				<?php
				while ($row=mysqli_fetch_array($query)){
						$id_produccion=$row['id_produccion'];
						$user_produccion=$row['user_produccion'];
						$estado_produccion=$row['estado_produccion'];
						$proyecto_produccion=$row['proyecto_produccion'];
						$orden_produccion=$row['orden_produccion'];
						$fecha_produccion= date('d/m/Y', strtotime($row['fecha_produccion']));
						$hcita_produccion=$row['hcita_produccion'];
						$inicio_produccion=$row['inicio_produccion'];
						$fin_produccion=$row['fin_produccion'];
						$km_produccion=$row['km_produccion'];
						$tipo_produccion=$row['tipo_produccion'];
						$tipo_long_produccion=$row['tipo_long_produccion']; //Añadido por Joe
						$router_produccion=$row['router_produccion'];//Añadido por Joe
						$deco_produccion=$row['deco_produccion'];//Añadido por Joe
						$antena_produccion=$row['antena_produccion'];//Añadido por Joe
						$bandeja_produccion=$row['bandeja_produccion'];//Añadido por Joe
						$material_produccion=$row['material_produccion'];
						$cp_produccion=$row['cp_produccion'];
						$fecha_produccionsf=$row['fecha_produccion'];
					?>
					<tr>
					<?php $horas = substr(($hcita_produccion), 0,2); ?>	
					<?php $minutos = substr(($hcita_produccion), -5, -3); ?>
					<?php
					if ($estado_produccion==0){$estado="Citado";?>
						<td class='text-letf'>  
								<a href="#" class='btn btn-default' title='Editar cita' data-proyecto='<?php echo $proyecto_produccion?>' data-orden='<?php echo $orden_produccion?>' data-fecha='<?php echo $fecha_produccionsf?>' data-chora='<?php echo $horas?>' data-cmin='<?php echo $minutos?>' data-id='<?php echo $id_produccion;?>' data-toggle="modal" data-target="#editarCita">

									<i class="glyphicon glyphicon-edit"></i>

								</a>
						</td>
					<?php } else { $estado="Cerrado";echo '<td></td>';}?>
					
						<td ><?php echo $proyecto_produccion; ?></td>
						<td ><?php echo $orden_produccion; ?></td>
						<td ><?php echo $estado; ?></td>
						<td ><?php echo $fecha_produccion; ?></td>
						<td ><?php echo $hcita_produccion; ?></td>
						<!--<td ><?php echo $horas; ?></td> -->
						<?php if ($estado_produccion==1){?>
						<td ><?php echo $inicio_produccion; ?></td>
						<td ><?php echo $fin_produccion; ?></td>
						<?php } else {echo '<td></td><td></td>';}?>

					<td class='text-right'>
					
						<a href="#" class='btn btn-default' title='Cerrar Orden' data-km='<?php echo $km_produccion;?>' data-proyecto='<?php echo $proyecto_produccion?>' data-orden='<?php echo $orden_produccion?>' data-cp='<?php echo $cp_produccion?>' data-fecha='<?php echo $fecha_produccionsf?>' data-inicio='<?php echo $inicio_produccion?>' data-fin='<?php echo $fin_produccion?>' data-tipo='<?php echo $tipo_produccion?>' data-longacometida='<?php echo $tipo_long_produccion?>' data-router='<?php echo $router_produccion?>' data-deco='<?php echo $deco_produccion?>' data-antena='<?php echo $antena_produccion?>' data-bandeja='<?php echo $bandeja_produccion?>' data-material='<?php echo $material_produccion?>' data-id='<?php echo $id_produccion;?>' data-estado='<?php echo $estado_produccion;?>' data-toggle="modal" data-target="#myModal2"><i class="glyphicon glyphicon-edit"></i></a>
						<?php
						$fichero = exec('ls ../fotos/'.$orden_produccion.'*.*',$output,$error);
						if (strlen($fichero)>5) {?>
						<a href="verfotos.php?code=<?php echo $orden_produccion;?>" TARGET="_blank" class='btn btn-default' title='Ver Fotos' ><i class="glyphicon glyphicon glyphicon-film"></i> </a>
						<?php } else {?>
						<a href="#" class='btn btn-default' title='' ><i class="glyphicon glyphicon-ban-circle"></i> </a>
						<?php } ?>
						<a href="#" class='btn btn-default' title='Borrar orden' onclick="eliminar('<?php echo $id_produccion; ?>')"><i class="glyphicon glyphicon-trash"></i> </a>
					</td>

					</tr>
					<?php
				}
				?>
				<tr>
					<td colspan=9><span class="pull-right">
					<?php echo paginate($page, $total_pages, $adjacents);
					?></span></td>
				</tr>
			  </table>
			</div>
			<?php
		}
	}
?>
