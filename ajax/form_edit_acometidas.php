<?php
include('is_logged.php');
require_once ("../config/db.php");
require_once ("../config/conexion.php");

  $proyecto = $_POST['proyecto']; //Recibo mediante POST la variable proyect de ajax
  $tipo = $_POST['tipo'];

     if($proyecto!=="Vodafone") 
   {
?>
          <div class="form-group">
        <label for="tipo" class="col-sm-3 control-label">Tipo Instalación</label>
        <div class="col-sm-8">
          <select class="form-control" id="mod_tipo" name="mod_tipo" required>

  <?php
  //Que es la que he asignado.
  //Si es igual al proyecto seleccionado entonces muestrame el tipo de instalación del proyecto.
  $query = "SELECT DISTINCT t_ins_proyecto FROM `proyectos` WHERE nom_proyecto='$proyecto'";
  $result = $con->query($query);

  if($_POST['tipo']!=""){
    $tipo .= "<option value='$tipo'>$tipo</option>";
  }
  else{
     $tipo .= "<option value=''>Seleccionar Acometida</option>";
  }
 
  $tipo .= "<option value=''>----------------------</option>";

  while($row = $result->fetch_assoc()){
	  //if($row[id]>=6 && $row[id]<=7){
    $tipo .="";
    $tipo .= "<option value='$row[t_ins_proyecto]'>$row[t_ins_proyecto]</option>";
	 // }
  }

echo $tipo;

?>

          </select>
        </div>
        </div>

<?php } 
else{
?>

    <input type="hidden" class="form-control" id="mod_tipo" name="mod_tipo">

<?php } ?>