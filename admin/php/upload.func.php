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
		$idprod    = $_POST['idproducto'];
		$urlact    = $_POST['urlact'];
		$imgact    = $_POST['imgact'];
		$desccampo = $_POST['desccampo'];

		$filePath = '../..'.$urlact.$fileNew; 
		//$filePath = '../uploads/'.$fileNew; 

		if (in_array($fileActExt, $allowImg)) {
		    if ($_FILES['file']['size'] > 0  && $_FILES['file']['error']==0) {  
				if (move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
						echo '<img src="'.$filePath.'" style="width:320px;height:300px;"/>';

						//query
						$queryImg = "UPDATE productos SET $desccampo = '".$fileNew."' ";
						$queryImg .= "WHERE id_producto = ".$idprod." ";
						$resImg = mysqli_query($con, $queryImg);

						if (!$resImg){
							$result  = 'error';
							$message = 'query error U';  
							mysqli_rollback($con);                       
						} else {            										
							$result  = 'success';
							$message = 'query success';       
							
							$data = array(
								"result"  => $result,
								"message" => $message,
								//"data"    => $mysql_data
							);
							  
							// Convert PHP array to JSON array
							$json_data = json_encode($data);
							print $json_data;
						}

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