<?php
	session_start();
	if (!isset($_SESSION['user_login_status']) AND $_SESSION['user_login_status'] != 1) {
		echo "ESTOY DENTRO";
        header("location: login.php");
		exit;
		}

	/* Connect To Database*/
	require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
	require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

	$usuario = $_SESSION['user_id'];
	$active_ranking="active";

	$title="Ranking Puntos - Grupo Magaez";  	

?>


<!DOCTYPE html>
<html lang="es">
  <head>
    <?php include("head.php"); ?>
  </head>
  <body>
	<?php include("navbar.php"); ?>

    <div class="container">
		<div class="panel panel-success">
			<div class="panel-heading">
		   		<div class="btn-group pull-right">
		   		<?php if ($_SESSION["user_admin"] == "0") { ?> 
		    		<div id="puntos">
		    			<b>hola</b>
		    		</div>
		    				<?php } ?>
				</div>
			<h4><i class='glyphicon glyphicon-th-large'></i> Técnicos TOP</h4>
			</div>
					<div class="panel-body">

						<div class="outer_div">
							<div class="table-responsive">
							
<?php
	$diaInicial="01";
	$diaFinal="31";
	//$date=new DateTime();
	//$result = $date->format('Y/m');
	//$fecha1 = date(Y/m);
	//$concaFecha1=$result.$dia1;

	//echo $concaFecha1;
	list($year,$month,$day) = explode("/",date('Y/m/d'));
	//list($day,$month,$year,$hour,$min,$sec) = explode("/",date('d/m/Y/h/i/s'));
	$concaFechaIni = $year.'/'.$month.'/'.$diaInicial;
	$concaFechaFinal = $year.'/'.$month.'/'.$diaFinal;

	$f1 = $diaInicial.'/'.$month.'/'.$year;
	$f2 = $diaFinal.'/'.$month.'/'.$year;
	echo "Mostrando puntos <b>desde</b>: ";
	echo $f1;
	echo " <b>hasta</b>  ";
	echo $f2.".";

	$sql2 = "SELECT COUNT(id_produccion) AS idCont FROM produccion WHERE fecha_produccion BETWEEN '$concaFechaIni' AND '$concaFechaFinal'";
	$senten2 = mysqli_query($con,$sql2);
  	$row3=mysqli_fetch_array($senten2);	

  	$mm = $row3['idCont'];
  //	echo "<br>";
  	//echo "soy contador: ".$mm;
  	echo "<br>";
	//Esta es la importante
    $consulta = "SELECT id_user_produccion, user_produccion, SUM(puntos_produccion) as Total_Puntos FROM produccion WHERE fecha_produccion BETWEEN '$concaFechaIni' AND '$concaFechaFinal' GROUP BY id_user_produccion ORDER by Total_Puntos DESC LIMIT 15";
    $result = $con->query($consulta);


// Otra consulta:    $consulta = "SELECT DISTINCT t1.id_user_produccion, t1.user_produccion, t1.puntos_produccion, t2.user_id FROM produccion as t1, users as t2 WHERE t1.id_user_produccion = t2.user_id AND t1.fecha_produccion BETWEEN '$concaFechaIni' AND '$concaFechaFinal'";

    //$ejecutado=mysqli_query($con,$consulta);
  	//$row=mysqli_fetch_array($ejecutado);
//CONSULTA BUENA!!!! SELECT user_produccion, SUM(puntos_produccion) as Total_Puntos FROM produccion GROUP BY id_user_produccion ORDER by Total_Puntos DESC
 	//$puntosconsul = $row['tot_puntos'];
 	//$userproducc = $row['user_produccion'];

echo "<table class='table'>";
echo "<tbody>";
echo "<tr class='success'>";
echo "<th> Nº </th>";
echo "<th> Nombre </th>";
echo "<th> Puntos </th>";
echo "</tr>";
$i=1;

  while($row = $result->fetch_assoc()){
  	$puntosconsul=$row['Total_Puntos'];
  	$cortarPuntos= number_format($puntosconsul,2,",",".");
  	echo "<tr>";
  	echo "<td>".$i."</td>";
  	echo "<td> ".$row['user_produccion']." </td>";

  	echo "<td> ".$cortarPuntos." </td>";

  	$i=$i+1;

  	echo "</tr>";
  } 
  echo "<br>";
  echo "</tbody>";
  echo "</table>";
 ?>
								</table>
							</div>
						</div>
			  		</div>
		</div>
	</div>
	<hr>
	<?php include("footer.php"); ?>
	<script type="text/javascript" src="js/puntosProd.js"></script>
  </body>
</html>