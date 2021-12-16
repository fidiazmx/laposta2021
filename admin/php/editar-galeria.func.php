<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'get_galeria' || $job == 'add_galeria' || $job == 'update_galeria' || $job == 'delete_galeria') {
        if (isset($_GET['id'])){
            $id = $_GET['id'];
            if (!is_numeric($id)){
                $id = '';
            }
        }
    } else {
        $job = '';
    }
}

// Prepare array
$mysql_data = array();

// Valid job found
if ($job != '') {

    // Connect to database
    $con = mysqli_connect($db_server, $db_username, $db_password, $db_name);
    if (mysqli_connect_errno()){
        $result  = 'error';
        $message = 'Failed to connect to database: ' . mysqli_connect_error();
        $job     = '';
    }

    mysqli_set_charset($con,"utf8");

    if ($job == 'get_galeria') {
        $query =  "SELECT *
        FROM empresa_galeria_imagenes";        
    
        $resultado = mysqli_query($con, $query);        
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';         

            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";     

            while ($row = mysqli_fetch_array($resultado)) {     
                $preurl = "";
                switch ($row['ubicacion']) {
                    case 'ACAJETE':
                        $preurl = "/images/gallery/acajete/";
                        break;
                    case 'BANDERILLA':
                        $preurl = "/images/gallery/banderilla/";
                        break;
                    case 'MATAOSCURA':
                        $preurl = "/images/gallery/mataoscura/";
                        break;                    
                    default:
                        # code...
                        break;
                }
                
                $functions = '<div class="invoice-action">
                    <a title="Editar imagen '.$row['id_galeria'].'" data-idgaleria="'.$row['id_galeria'].'" data-imggaleria="'.$row['imagen_galeria'].'" 
                        data-descimagen="'.$row['desc_imagen'].'" data-ubicacion="'.$row['ubicacion'].'" data-activo="'.$row['activo'].'" data-urlimg="'.$preurl.'"
                        href="#" style="color: blue;" class="invoice-action-edit function_edit">
                        <i class="material-icons">edit</i>
                    </a>
                    <a href="#" data-idgaleria="'.$row['id_galeria'].'" style="color: red;" class="invoice-action-view mr-4 function_delete">
                        <i class="material-icons">cancel</i>
                    </a>                                        
                </div>';                                
                                             
                $urlimggaleria = $actual_link.$preurl.$row['imagen_galeria'];
                
                if ($row['activo'] == 'A') {
                    $estatusdesc = "ACTIVO";
                } else {
                    $estatusdesc = "INACTIVO"; 
                }    

                $mysql_data[] = array(                           
                    "id_galeria" => $row['id_galeria'],
                    "imagen_galeria" => "<div class='center-align'><img width='100px' height='120px' src='".$urlimggaleria."' /></div><div class='center-align'><a class='function_edit_img modal-trigger' data-idgaleria='".$row['id_galeria']."' data-urlimg='".$preurl."' data-imgactual='".$row['imagen_galeria']."' data-desccampo='imagen_galeria' href='#modalImagen'>Modificar</a></div>",
                    "desc_imagen"    => $row['desc_imagen'],                    
                    "ubicacion"      => $row['ubicacion'],                    
                    "activo"         => $estatusdesc,             
                    "functions"      => $functions
                );
            }
        }
    } else if ($job == 'update_galeria') {
        $transaction_flag = false;    

        $queryInicio = "UPDATE empresa_galeria_imagenes
        SET desc_imagen = '".$_POST['txtDescImagen']."', ubicacion = '".$_POST['slUbicacion']."', 
        activo = '".$_POST['swActivo']."' WHERE id_galeria = ".$_POST['id']." ";
        $resInicio = mysqli_query($con, $queryInicio);

        if (!$resInicio){
            $result  = 'error';
            $message = 'query error U';  
            mysqli_rollback($con);                       
        } else {            
            $transaction_flag = true;
            if ($transaction_flag) {
                mysqli_commit($con);
            }

            $result  = 'success';
            $message = 'query success';               
        }
    } else if ($job == 'add_galeria') {
  		$query = "INSERT INTO empresa_galeria_imagenes (fk_id_empresa, desc_imagen, ubicacion, activo) 
        values
        (1,'".$_POST['txtDescImagen']."','".$_POST['slUbicacion']."','".$_POST['swActivo']."')";
        $resultado = mysqli_query($con, $query);       	
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';
        }  
    } elseif ($job == 'delete_galeria'){  
        $transaction_flag = false;
        mysqli_autocommit($con, false);

	    if ($id == ''){
	      	$result  = 'error';
	      	$message = 'id missing';
	    } else {
	      	$query = "DELETE FROM empresa_galeria_imagenes WHERE id_galeria = '".$id."'";
			$resultado = mysqli_query($con, $query);       	
	      	if (!$resultado){
	        	$result  = 'error';
	        	$message = 'query error';
                mysqli_rollback($con);                
	      	} else {
                $transaction_flag = true;
                if ($transaction_flag) {
                    mysqli_commit($con);
                }

                //unlink imagenes subidas
                
                
                $result  = 'success';
                $message = 'query success';                        
	      	}
	    }  
  	} 
}

// Prepare data
$data = array(
    "result"  => $result,
    "message" => $message,
    "data"    => $mysql_data
);
  
// Convert PHP array to JSON array
$json_data = json_encode($data);
print $json_data;


?>