<?php
include('is_logged.php');
require_once ("../config/db.php");
require_once ("../config/conexion.php");


  $query = 'SELECT user_id, firstname, lastname FROM users WHERE user_admin <> "1" ORDER BY firstname ASC';
  $result = $con->query($query);
  $listas .="";

  $listas .= "<option value=''>-Seleccionar Tecnico-</option>";

  while($row = $result->fetch_assoc()){

    $listas .= "<option value='$row[user_id]'>$row[firstname] $row[lastname]</option>";

  }

echo utf8_encode($listas); //Muestro nombres y apellidos sin ningun tipo de caracteres especiales.
//Si fuera al contario sería: utf8_decode.
?>