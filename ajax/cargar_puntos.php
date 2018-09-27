<?php
include('is_logged.php');
require_once ("../config/db.php");
require_once ("../config/conexion.php");
 

	$diaInicial="01";
	$diaFinal="31";

	list($year,$month,$day) = explode("/",date('Y/m/d'));
	$concaFechaIni = $year.'/'.$month.'/'.$diaInicial;
	$concaFechaFinal = $year.'/'.$month.'/'.$diaFinal;
	//echo "Mostrando puntos <b>desde</b>: ";
	//echo $concaFechaIni;
	//echo " <b>hasta</b>  ";
	//echo $concaFechaFinal.".";


 $usuario = $_SESSION['user_id'];
 //Hago una consulta y le digo que me sume los puntos totales siempre que el usuario sea igual al usuario que está logeado.
 $consulta = "SELECT SUM(puntos_produccion) AS tot_puntos FROM produccion WHERE id_user_produccion='$usuario' AND fecha_produccion BETWEEN '$concaFechaIni' AND '$concaFechaFinal'";

 $ejecutado=mysqli_query($con,$consulta);
 $row=mysqli_fetch_array($ejecutado);

 $puntosconsul = $row['tot_puntos'];

 //Falta añadir la condición de la fecha, desde la fecha 1 al 31
?>
	<h4>Puntos del mes: <b><FONT COLOR="black"><?php echo number_format($puntosconsul,2,",",".") ?></FONT></b></h4>

<!--	<h4>Puntos del mes: <b><FONT COLOR="black"><?php echo $puntosconsul ?></FONT></b></h4> -->