<?php

require_once ('../_inc/dbconfig.php');
require_once ('log-sql.php');



$job = '';
$id  = '';
if (isset($_GET['job'])) {
  $job = $_GET['job'];
  if ($job == 'login') {
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

if ($job != ''){

	$con = mysqli_connect($db_server, $db_username, $db_password, $db_name);
	if (mysqli_connect_errno()){
		$result  = 'error';
		$message = 'Failed to connect to database: ' . mysqli_connect_error();
        $job     = '';
        LOGS($con, $message, $result, 0, "usuario log", 0, "rol log");
	}

	mysqli_set_charset($con,"utf8");

    // Execute job
    if ($job == 'login'){ 
        $tipoemp = "";
        if (isset($_GET['txtUsuario'])) { $usuario = $_GET['txtUsuario']; }
        if (isset($_GET['txtPassword'])) { $password = $_GET['txtPassword']; }        

        $queryusr = "SELECT u.id, u.fk_id_rol, u.name, u.usuario, u.password, r.descripcion_rol
                    FROM users u
                    INNER JOIN roles r ON u.fk_id_rol = r.id_rol
                    WHERE u.usuario= '".$usuario."' AND u.password = '".$password."' AND u.estatus = 'A' ";        
        $resusr = mysqli_query($con, $queryusr);

        if ( mysqli_num_rows($resusr) > 0) {            
            if (!$resusr){
                $result  = 'error';
                $message = 'query error';
                LOGS($con, $queryusr, $resusr, 0, $usuario, 0, "rol log");
            } else {
                $result  = 'success';
			    $message = 'query valido usuario';

                $rowpwd=mysqli_fetch_array($resusr);
                //if (password_verify($password, $rowpwd['password'])) {
                                                        
                    $mysql_data[] = array(				
                        "id"        => $rowpwd['id'],
                        "fk_id_rol" => $rowpwd['fk_id_rol'],
                        "usuario"   => $rowpwd['usuario'],
                        "descrol"   => $rowpwd['descripcion_rol']    
                    );
                /*} else {
                    $result  = 'error';
                    $message = 'Los datos del usuario son incorrectos';                            
                    LOGS($con, $queryusr, $resusr, $rowpwd['id'], $usuario, $rowpwd['fk_id_rol'], $rowpwd['descripcion_rol']);
                }*/       
                LOGS($con, $queryusr, $resusr, $rowpwd['id'], $usuario, "", "");
            }   
        } else {
            $result  = 'error';
            $message = 'Los datos del usuario son incorrectos';
        }                                
    }			
	// Close database connection
  	mysqli_close($con);
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