<?php

require_once ('../_inc/dbconfig.php');

$con = mysqli_connect($db_server, $db_username, $db_password, $db_name);
if (mysqli_connect_errno()){
	$result  = 'error';
	$message = 'Failed to connect to database: ' . mysqli_connect_error();
	$job     = '';
}

mysqli_set_charset($con,"utf8");

	// upload file using move_uploaded_file function in php	
	if (!empty($_FILES['file']['name'])) {

		$fileName = $_FILES['file']['name'];
		
		$fileExt = explode('.', $fileName);
		$fileActExt = strtolower(end($fileExt));
		$allowImg = array('png','jpeg','jpg');
		$fileNew = rand() . "." . $fileActExt;  // rand function create the rand number 
		//FALTA CONDICIONAR CARPETAS DE ACUERDO A LA CATEGORIA
		//GUARDAR EL NOMBRE DE LA NUEVA IMAGEN EN LA BD
		//CAMBIAR EL EDITOR WYSIGYG NO FUNCIONA DEL TODO BIEN

		//recupera valores
		$idgaleria    = $_POST['idgaleria'];
		$urlact    = $_POST['urlact'];
		$imgact    = $_POST['imgact'];
		$desccampo = "imagen_galeria";

		$filePathAnt = '../..'.$urlact.$imgact;
		$filePath = '../..'.$urlact.$fileNew; 
		//$filePath = '../uploads/'.$fileNew; 

		if (in_array($fileActExt, $allowImg)) {
		    if ($_FILES['file']['size'] > 0  && $_FILES['file']['error']==0) {  
				if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
						unlink($filePathAnt);
						echo '<img src="'.$filePath.'" style="width:320px;height:300px;"/>';

						//query
						$queryImg = "UPDATE empresa_galeria_imagenes SET $desccampo = '".$fileNew."' ";
						$queryImg .= "WHERE id_galeria = ".$idgaleria." ";
						$resImg = mysqli_query($con, $queryImg);
				}else{
					echo "La imagen no se pudo actualizar, intente de nuevo.";
				}	
		    }else{
		    	echo "Archivo no disponible para actualizar";
		    }
		}else{	
		    echo "Este tipo de imagen no esta permitida";
		}
	}

?>