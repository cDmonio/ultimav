<?php
include('is_logged.php');
require_once ("../config/db.php");
require_once ("../config/conexion.php");

  $l_aco = $_POST['longacometida']; //Recibo mediante POST la longacometida de ajax
  $proyecto = $_POST['proyecto']; //Recibo el proyecto
  $tipos = $_POST['tipo']; //Recibo el tipo.
  //Que es la que he asignado.
  //Si es igual al proyecto seleccionado entonces muestrame el tipo de instalación del proyecto.
 // $query = "SELECT DISTINCT t_ins_proyecto FROM `proyectos` WHERE nom_proyecto='$proyecto'";
  //$result = $con->query($query);

   if($proyecto=="BEE Ingeniería" || $proyecto=="Magtel Masmovil") 
   {
?>

        <div class="form-group">
          <label for="longacometida" class="col-sm-3 control-label">Long. Acometida</label>
          <div class="col-sm-8">
            <select class="form-control" id="mod_longacometida" name="mod_longacometida" required>

<?php 

  $query = "SELECT DISTINCT long_aco_proyecto FROM `proyectos` WHERE nom_proyecto='$proyecto'";
  $result = $con->query($query);

    if($_POST['longacometida']!=""){
    $tipo .= "<option value='$l_aco'>$l_aco</option>";
  }
  else{
     $tipo .= "<option value=''>Seleccionar Longitud</option>";

  }

  $tipo .= "<option value=''>----------------------</option>";

  while($row = $result->fetch_assoc()){
    //if($row[id]>=6 && $row[id]<=7){
        $tipo .="";
    $tipo .= "<option value='$row[long_aco_proyecto]'>$row[long_aco_proyecto]</option>";
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
        <div class="form-group">
          <label for="longacometida" class="col-sm-3 control-label">Long. Acometida</label>
          <div class="col-sm-8">
            <input type="text" class="form-control" id="mod_longacometida" name="mod_longacometida" value='<?php echo $l_aco ?>' placeholder="Introducir acometida">
          </div>
        </div>

<?php } ?>


