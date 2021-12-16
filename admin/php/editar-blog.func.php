<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'get_notas' || $job == 'add_nota' || $job == 'update_nota' || $job == 'delete_nota') {
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

    if ($job == 'get_notas') {
        $query =  "SELECT b.id_nota_blog, b.titulo_nota, b.imagen_nota, b.texto_nota, u.name, b.fecha_alta, b.activo  
        FROM blog b
        INNER JOIN users u ON b.fk_id_user = u.id"; 
    
        $resultado = mysqli_query($con, $query);        
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';         

            while ($row = mysqli_fetch_array($resultado)) {                        
                $functions = '<div class="invoice-action">
                    <a title="Editar nota '.$row['id_nota_blog'].'" data-idnota="'.$row['id_nota_blog'].'" data-titulo="'.$row['titulo_nota'].'" 
                        data-textonota="'.$row['texto_nota'].'" data-textonota="'.$row['texto_nota'].'" data-activo="'.$row['activo'].'" 
                        href="#" style="color: blue;" class="invoice-action-edit function_edit">
                        <i class="material-icons">edit</i>
                    </a>
                    <a href="#" data-idnota="'.$row['id_nota_blog'].'" style="color: red;" class="invoice-action-view mr-4 function_delete">
                        <i class="material-icons">cancel</i>
                    </a>                                        
                </div>';                                
                if ($row['activo'] == 'A') {
                    $estatusdesc = "ACTIVO";
                } else {
                    $estatusdesc = "INACTIVO"; 
                }           
                
                $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";     
                $preurl = "/blog/";
                $urlimgblog = $actual_link.$preurl.$row['imagen_nota'];
                $mysql_data[] = array(                           
                    "id_nota_blog" => $row['id_nota_blog'],
                    "imagen_nota"  => "<img width='100px' height='120px' src='".$urlimgblog."' /><div class='center-align'><a class='function_edit_img modal-trigger' data-idnota='".$row['id_nota_blog']."' data-urlimg='".$preurl."' data-imgactual='".$row['imagen_nota']."' data-desccampo='imagen_nota' href='#modalImagen'>Modificar</a></div>",
                    "titulo_nota"  => $row['titulo_nota'],
                    "texto_nota"   => $row['texto_nota'],
                    "name"         => $row['name'],
                    "fecha_alta"   => $row['fecha_alta'],                    
                    "activo"       => $estatusdesc,             
                    "functions"    => $functions
                );
            }
        }
    } else if ($job == 'update_nota') {
        $transaction_flag = false;    

        $queryInicio = "UPDATE blog
        SET titulo_nota = '".$_POST['txtTituloNota']."', texto_nota = '".$_POST['textonota']."', 
        fk_id_user = '".$_POST['id_usuario_modifica']."', fecha_modif = NOW(), activo = '".$_POST['swActivo']."'
        WHERE id_nota_blog = ".$_POST['id']." ";
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
    } else if ($job == 'add_nota') {
  		$query = "INSERT INTO blog (titulo_nota, texto_nota, fk_id_user, activo, fecha_alta) 
        values
        ('".$_POST['txtTituloNota']."','".$_POST['textonota']."','".$_POST['id_usuario_modifica']."','".$_POST['swActivo']."', NOW())";
        $resultado = mysqli_query($con, $query);       	
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';
        }  
    } elseif ($job == 'delete_nota'){  
        $transaction_flag = false;
        mysqli_autocommit($con, false);

	    if ($id == ''){
	      	$result  = 'error';
	      	$message = 'id missing';
	    } else {
	      	$query = "DELETE FROM blog WHERE id_nota_blog = '".$id."'";
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