<?php

require_once ('../_inc/dbconfig.php');
require_once ('log-sql.php');

$job = '';
$id  = '';
if (isset($_POST['job'])) {
    $job = $_POST['job'];
    if ($job == 'login_usuario') {
        if (isset($_POST['id'])){
            $id = $_POST['id'];
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

    if ($job == 'login_usuario') {
        $queryusr = "SELECT id, name, r.id_rol 'idrol', r.descripcion_rol 'descripcionrol'   
                    FROM users u
                    INNER JOIN roles r ON u.fk_id_rol = r.id_rol
                    WHERE u.usuario= '".$_POST['txtUsuario']."' AND u.password = '".$_POST['txtPassword']."' AND u.estatus = 'A'";        
        $resusr = mysqli_query($con, $queryusr);

        $controws = mysqli_num_rows($resusr);
        if ( $controws > 0) {            
            if (!$resusr){
                $result  = 'error';
                $message = 'query error';
                LOGS($con, $queryusr, $resusr, 0, $_POST['txtUsuario'], 0, "rol desconocido");
            } else {
                $result  = 'success';
			    $message = 'query valido usuario';

                $rowpwd=mysqli_fetch_array($resusr);                                                                    
                $mysql_data[] = array(				
                    "id"             => $rowpwd['id'],
                    "name"           => $rowpwd['name'],
                    "idrol"          => $rowpwd['idrol'],
                    "descripcionrol" => $rowpwd['descripcionrol'],
                );

                LOGS($con, $queryusr, $resusr, $rowpwd['id'], $rowpwd['name'], $rowpwd['idrol'], $rowpwd['descripcionrol']);
            }   
        } else {
            $result  = 'error';
            $message = 'Los datos del usuario son incorrectos';
            LOGS($con, $queryusr, $resusr, 0, $_POST['txtUsuario'], 0, "rol desconocido");
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