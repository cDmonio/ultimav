<?php
include('is_logged.php');
require_once ("../config/db.php");
require_once ("../config/conexion.php");

$proyecto = $_POST['proyecto'];

//  Consulta para extraer los proyectos que no sean Vodafone.
  $query = 'SELECT DISTINCT nom_proyecto FROM proyectos where nom_proyecto <> "Vodafone" ORDER BY nom_proyecto ASC';
  $result = $con->query($query);
  $listas .="";
  $listas .= "<option value='$proyecto'>$proyecto</option>";
  $listas .= "<option value=''>----------------------</option>";
   
  while($row = $result->fetch_assoc()){
    $listas .= "<option value='$row[nom_proyecto]'>$row[nom_proyecto]</option>";
  }

echo $listas;
?>