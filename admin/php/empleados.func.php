<?php

require_once ('../_inc/dbconfig.php');
require_once ('log-sql.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'add_empleado' || $job == 'update_empleado' || $job == 'get_empleados' || $job == 'delete_empleado') {
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

    if ($job == 'add_empleado') {
        $transaction_flag = false;    

        $stringUser = bin2hex(openssl_random_pseudo_bytes(10));
        $stringPwd = bin2hex(openssl_random_pseudo_bytes(10));
        $queryUsuario = "INSERT INTO users (fk_id_rol, name, usuario, email, password, estatus, created_at) 
        VALUES (3, '".$_GET['txtNombre']."', '".$stringUser."', 'demo@correo.com', '".$stringPwd."', 'A', NOW()) ";
        $resUsuario = mysqli_query($con, $queryUsuario);

        if (!$resUsuario){
            $result  = 'error';
            $message = 'query error U';   
            LOGS($con, $queryUsuario, $resUsuario, 0, 'usuario', 0, "rol desconocido");
            mysqli_rollback($con);                       
        } else {
            $ultid = mysqli_insert_id($con);

            $queryEmpleado = "INSERT INTO empleados (fk_id_user, nombre_empleado, telefono_empleado, direccion_empleado, sueldo_semanal_empleado, importe_prestamo_maximo, adeudo_anterior, estatus, created_at) 
            VALUES (".$ultid.", '".$_GET['txtNombre']."', '".$_GET['txtTelefono']."', '".$_GET['txtDireccion']."', '".$_GET['txtSueldo']."', '0.00', '".$_GET['txtAdeudo']."', 'A', NOW()) ";
            $resEmpleado = mysqli_query($con, $queryEmpleado);

            if (!$resEmpleado){
                $result  = 'error';
                $message = 'query error E';
                LOGS($con, $queryEmpleado, $resEmpleado, 0, 'usuario', 0, "rol desconocido");
                mysqli_rollback($con);
            } else {
                $transaction_flag = true;
                if ($transaction_flag) {
                    mysqli_commit($con);
                }
    
                $result  = 'success';
                $message = 'query success';
                LOGS($con, $queryEmpleado, $resEmpleado, 0, 'usuario', 0, "rol desconocido");

            }                
        }    
    } else if ($job == 'update_empleado') {
        $transaction_flag = false;    

        //--email = '".$_GET['txtCorreo']."', estatus = '".$_GET['slEstatusUsuario']."', 
        $queryUsuario = "UPDATE users 
        SET name = '".$_GET['txtNombre']."', 
        updated_at = NOW() WHERE id = ".$_GET['id_usuario']." ";
        $resUsuario = mysqli_query($con, $queryUsuario);

        if (!$resUsuario){
            $result  = 'error';
            $message = 'query error U';  
            LOGS($con, $queryUsuario, $resUsuario, 0, 'usuario', 0, "rol desconocido"); 
            mysqli_rollback($con);                       
        } else {

            // $queryEmpleado = "UPDATE empleados SET nombre_empleado = '".$_GET['txtNombre']."', telefono_empleado = '".$_GET['txtTelefono']."', 
            // direccion_empleado = '".$_GET['txtDireccion']."', sueldo_semanal_empleado = '".$_GET['txtSueldo']."', 
            // importe_prestamo_maximo = '".$_GET['txtImporteMaximo']."', estatus = '".$_GET['slEstatusEmpleado']."', updated_at = NOW() 
            // WHERE id_empleado = ".$_GET['id_empleado'];
            $queryEmpleado = "UPDATE empleados SET nombre_empleado = '".$_GET['txtNombre']."', telefono_empleado = '".$_GET['txtTelefono']."', 
            direccion_empleado = '".$_GET['txtDireccion']."', sueldo_semanal_empleado = '".$_GET['txtSueldo']."', 
            updated_at = NOW() 
            WHERE id_empleado = ".$_GET['id_empleado'];
            $resEmpleado = mysqli_query($con, $queryEmpleado);

            if (!$resEmpleado){
                $result  = 'error';
                $message = 'query error E';
                LOGS($con, $queryEmpleado, $resEmpleado, 0, 'usuario', 0, "rol desconocido"); 
                mysqli_rollback($con);
            } else {
                $transaction_flag = true;
                if ($transaction_flag) {
                    mysqli_commit($con);
                }
    
                $result  = 'success';
                $message = 'query success';
                LOGS($con, $queryEmpleado, $resEmpleado, 0, 'usuario', 0, "rol desconocido"); 

            }                
        } 
    } else if ($job == 'get_empleados') {
        $query =  " SELECT '' espacio, u.id, u.name, u.email, u.estatus 'uestatus', 
        e.id_empleado, e.telefono_empleado, e.direccion_empleado, e.adeudo_anterior,
        e.sueldo_semanal_empleado, e.importe_prestamo_maximo, e.estatus 'eestatus' 
        FROM users u
        INNER JOIN empleados e ON u.id = e.fk_id_user"; 
    
        $resultado = mysqli_query($con, $query);        
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
            LOGS($con, $query, $resultado, 0, 'usuario', 0, "rol desconocido"); 
        } else {
            $result  = 'success';
            $message = 'query success';         
            while ($row = mysqli_fetch_array($resultado)) {                                   
                // $functions = '<a title="Editar empleado '.$row['id'].'" data-idempleado="'.$row['id'].'" 
                // data-nombreempleado="'.$row['name'].'" data-email="'.$row['email'].'" 
                // data-uestatus="'.$row['uestatus'].'" data-idempleado="'.$row['id_empleado'].'" 
                // data-telefonoempleado="'.$row['telefono_empleado'].'" data-direccionempleado="'.$row['direccion_empleado'].'" 
                // data-sueldo="'.$row['sueldo_semanal_empleado'].'" data-impmax="'.$row['importe_prestamo_maximo'].'" 
                // class="btn-floating waves-effect waves-light blue modal-trigger function_edit" href="#">Editar</a>';
                $functions = '<div class="invoice-action">
                    <a title="Editar empleado '.$row['id'].'" data-idempleado="'.$row['id_empleado'].'" data-idusuario="'.$row['id'].'" data-name="'.$row['name'].'" data-telefono-empleado="'.$row['telefono_empleado'].'" 
                        data-direccion-empleado="'.$row['direccion_empleado'].'" data-adeudo="'.$row['adeudo_anterior'].'" data-sueldo="'.$row['sueldo_semanal_empleado'].'" data-estatus="'.$row['eestatus'].'" 
                        href="#" style="color: blue;" class="invoice-action-edit function_edit">
                        <i class="material-icons">edit</i>
                    </a>
                    <a href="#" data-idempleado="'.$row['id_empleado'].'" data-idusuario="'.$row['id'].'" data-estatus="'.$row['eestatus'].'" style="color: red;" class="invoice-action-view mr-4 function_delete">
                        <i class="material-icons">cancel</i>
                    </a>                                        
                </div>';
                $mysql_data[] = array(                           
                    "espacio"                 => $row['espacio'],
                    "id"                      => $row['id_empleado'],
                    "name"                    => $row['name'],
                    "email"                   => $row['email'],
                    "uestatus"                => $row['uestatus'],
                    "id_empleado"             => $row['id_empleado'],                                                
                    "telefono_empleado"       => $row['telefono_empleado'],
                    "direccion_empleado"      => $row['direccion_empleado'],
                    "sueldo_semanal_empleado" => $row['sueldo_semanal_empleado'],
                    "importe_prestamo_maximo" => $row['importe_prestamo_maximo'],            
                    "eestatus"                => $row['eestatus'],            
                    "functions"               => $functions
                );
            }

            LOGS($con, $query, $resultado, 0, 'usuario', 0, "rol desconocido"); 

        }
    } elseif ($job == 'delete_empleado'){  
        $transaction_flag = false;
        mysqli_autocommit($con, false);

	    if ($id == ''){
	      	$result  = 'error';
	      	$message = 'id missing';
	    } else {
	      	$query = "DELETE FROM empleados WHERE id_empleado = '".$id."'";
			$resultado = mysqli_query($con, $query);       	
	      	if (!$resultado){
	        	$result  = 'error';
	        	$message = 'query error';
                mysqli_rollback($con);                
	      	} else {

                $query = "DELETE FROM users WHERE id = '".$_GET['idusuario']."'";
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
                    
                    $result  = 'success';
	        	    $message = 'query success';
                }	        
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