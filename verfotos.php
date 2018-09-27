<!DOCTYPE html>
<html lang="es">
    <head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Visualizacion de Imagenes de Actuacion</title>
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
	
	<link rel="stylesheet" href="css/custom.css">
	<link rel=icon href='img/logo-icon.png' sizes="32x32" type="image/png">
        <style>
            section{
                width:100%;
                margin:0 auto;
            }
			/*Para que el contenedor muestre elementos aunque estos sean flotantes*/
            #container:after {
                content: " ";
                display: block;
                height: 0;
                clear: both;
            }
            #container{
                width: 90%;
                margin:0 auto;
            }
			/*Estructura de cada componente de la galeria (imagen + descripcion)*/
            #container div{
                width: 28%;
                height: auto;
                
                display:inline;
                float:left;
                margin:15px 3% 0 0;
            }
			/*Se rota ligeramente al posicionarnos encima del componente de la galeria (imagen + descripcion)*/
			
            #container div img{
                width: 100%;
                height: auto;
                box-shadow: 0 0 10px #666;
                border: 5px solid #FFF
            }
			/*Estructura de la descripcion, por defecto no se muestra*/
            #container div img ~ span{
                width: 100%;
                display:block;
                opacity:0;
                -webkit-transition: opacity 1s;
                margin:7px 0;
                padding:2px 5px;
                border-radius: 10px;
                color:#FFF;
                background:rgba(0, 0, 0, 0.7);
                text-align:center;
            }
			/*Se muestra la descripcion al posicionar el cursor encima de la imagen*/
            #container div img:hover + span{
                opacity:1;
            }
			/*Media query de ejemplo para pantallas de alta resolucion
			  pero pueden haber mas, este media query permite mostrar hasta 5 imagenes por filas
			*/
            @media (min-width:1600px){
                #container div{
                    width: 15%;
                }
            }
        </style>
    </head>
    <body>
	
<?php
if($_POST['borrar'])
	{
	foreach ($_POST as $clave=>$valor)
   		{
   		
		if ($clave!='mayor' && $clave!='borrar') {
			$xx=explode("_",$clave);
			$ncl=$xx[0]."_".$xx[1].".".$xx[2];
			unlink($ncl);
			//echo "borro $ncl"."</br>";
			}
   		}
	}
if($_POST['subir'])
	{
	foreach ($_POST as $clave=>$valor)
   		{
   		if ($clave=='mayor') {$inicio=$valor+1;}
   		}
	}
	$codigo=$_GET['code'];
	 for($i=0; $i<count($_FILES['fotos']['name']); $i++) {
           //Obtenemos la ruta temporal del fichero
            $fichTemporal = $_FILES['fotos']['tmp_name'][$i];
 
           //Si tenemos fichero procedemos
           if ($fichTemporal != ""){
             //Definimos una ruta definitiva para guardarlo
			  $extension=explode(".",$_FILES["fotos"]["name"][$i]);
              $destino = "fotos/".$codigo.'_'.$inicio.".".$extension[1];
			  move_uploaded_file($fichTemporal, $destino);
			  echo $destino.'</br>';
			  $inicio=$inicio+1;
 }
}	
?>
        <section>
            <div id="container">
			<?php
			$codigo=$_GET['code'];
			echo '<h3>Imagenes Tomadas en la Actuacion :'.$codigo.'</h3>';
			?>
			<form  method="post" action="" id="form0" name="form0" enctype="multipart/form-data">
			<input type="submit" class="btn btn-danger" id="borrar" name="borrar" value="Borrar Fotos Seleccionadas"></input>
		   	<input type="submit" class="btn btn-primary" id="subir" name="subir" value="Subir Nuevas Fotos de Esta Actuacion:"></input>
			<input name="fotos[]" type="file" multiple="multiple" class="btn btn-default"/>
			
			<?php
				$codigo=$_GET['code'];$mayor=0;
				$fichero = exec('ls fotos/'.$codigo.'*.*',$output,$error);
				//echo '<h4>Imagenes  :'.$fichero.'</h4>';
				//print_r($output);
                while(list(,$fichero) = each($output)){
                $adjunto = $fichero;
				$x1=explode("_",$fichero);
				$x2=explode(".",$x1[1]);
				$a=$x2[0];
				if ($a>$mayor) {$mayor=$a;}
			    echo'
				  <div class="gallery_product col-lg-4 col-md-4 col-sm-4 col-xs-6">
				<input type="checkbox" name="'.$fichero.'"></input>
                <img src="'.$fichero.'" class="img-responsive">
                </div>';
				}
				?>
				<input type="hidden" class="form-control" id="mayor" name="mayor" value="<?php echo $mayor;?>">
            </div>
			
		   </form>
        </section>
    </body>
</html>