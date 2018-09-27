<?php
	include('ajax/is_logged.php');//Archivo verifica que el usario que intenta acceder a la URL esta logueado
	/*Inicia validacion del lado del servidor*/

		/* Connect To Database*/
		require_once ("config/db.php");//Contiene las variables de configuracion para conectar a la base de datos
		require_once ("config/conexion.php");//Contiene funcion que conecta a la base de datos

//Copiar esto Para el ranking.
	$fecha_inicio=date('Y/m/d', strtotime($_POST['fecha_inicio']));
	$fecha_fin=date('Y/m/d', strtotime($_POST['fecha_fin']));

  $sql="";
  $vodafone="vodafone";
  if (isset($_REQUEST['check1']))
  {
    $sql = "select * from produccion where cast(fecha_produccion as date) between '$fecha_inicio' and '$fecha_fin' order by fecha_produccion DESC;";
  }else
  {
    $sql = "select * from produccion where proyecto_produccion <> '$vodafone' AND cast(fecha_produccion as date) between '$fecha_inicio' and '$fecha_fin' order by fecha_produccion DESC;";
  }

 $resultado = mysqli_query ($con,$sql) or die (mysqli_error ());
 $registros = mysqli_num_rows ($resultado);

 if ($registros > 0) {
   require_once 'classes/PHPExcel.php';
   $objPHPExcel = new PHPExcel();

   //Informacion del excel
   $objPHPExcel->
    getProperties()
        ->setCreator("")
        ->setLastModifiedBy("")
        ->setTitle("")
        ->setSubject("")
        ->setDescription("")
        ->setKeywords("")
        ->setCategory("");

//Aquí elegimos por qué fila empezaremos, empezamos por la 2da.
   $i = 2;
   while ($registro = mysqli_fetch_object ($resultado)) {

	 $objPHPExcel->getActiveSheet()->setTitle('Registros');
      	$objPHPExcel->setActiveSheetIndex(0)
//Inserto valores estaticos para el encabezado
->setCellValue('A1', 'Técnico')
->setCellValue('B1', 'Proyecto')
->setCellValue('C1', 'Codigo ID')
->setCellValue('D1', 'Fecha Actuacion')
->setCellValue('E1', 'Hora Inicio')
->setCellValue('F1', 'Hora Fin')
->setCellValue('G1', 'Tipo Instalacion')
->setCellValue('H1', 'Longitud Acometida')
->setCellValue('I1', 'Router')
->setCellValue('J1', 'Decodificador')
->setCellValue('K1', 'Material Instalado')
->setCellValue('L1', 'KM antes')
->setCellValue('M1', 'Cod Postal')
->setCellValue('N1', 'Precio')
->setCellValue('O1', 'Puntos')

            ->setCellValue('A'.$i, $registro->user_produccion)
            ->setCellValue('B'.$i, $registro->proyecto_produccion)
            ->setCellValue('C'.$i, $registro->orden_produccion)
            ->setCellValue('D'.$i, $registro->fecha_produccion)
            ->setCellValue('E'.$i, $registro->inicio_produccion)
            ->setCellValue('F'.$i, $registro->fin_produccion)
            ->setCellValue('G'.$i, $registro->tipo_produccion)
            ->setCellValue('H'.$i, $registro->tipo_long_produccion)
            ->setCellValue('I'.$i, $registro->router_produccion)
            ->setCellValue('J'.$i, $registro->deco_produccion)
            ->setCellValue('K'.$i, $registro->material_produccion)
            ->setCellValue('L'.$i, $registro->km_produccion)
            ->setCellValue('M'.$i, $registro->cp_produccion)
            ->setCellValue('N'.$i, $registro->precio_produccion)
						->setCellValue('O'.$i, $registro->puntos_produccion);
      $i++;
   }
}
//Joe fechas falta modificar el tipo del formato.
$uno = "Produccion-";
$dos = "desde-".$fecha_inicio."-hasta-".$fecha_fin;
$tres = ".xls";
$concateno = $uno.$dos.$tres;

header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename='.$concateno.'');
header('Cache-Control: max-age=0');

$objWriter=PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel2007');
$objWriter->save('php://output');
exit;
mysqli_close ();
?>
