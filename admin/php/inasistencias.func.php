<?php

require_once ('../_inc/dbconfig.php');
require_once ('function.generales.func.php');
require_once ('log-sql.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'add_inasistencia' || $job == 'update_inasistencia' || $job == 'get_inasistencia' || $job == 'delete_inasistencia') {
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

    if ($job == 'add_inasistencia') {
        $transaction_flag = false;    
        date_default_timezone_set('America/Mexico_City');

        $diasem = dia_semana($_GET["txtFecha"]);
        $nosem = date('W');
        $queryInasis = "INSERT INTO inasistencias (fk_id_empleado, no_semana, dia_semana, descripcion, fecha_inasistencia, estatus, created_at, fk_id_user) 
        VALUES (".$_GET['slEmpleado'].", ".$nosem.", '".$diasem."', 'ninguna', '".$_GET['txtFecha']."', 'A', NOW(), '".$_GET['id_usuario']."') ";
        $resInasis = mysqli_query($con, $queryInasis);

        if (!$resInasis){
            $result  = 'error';
            $message = 'query error U';   
            LOGS($con, $queryInasis, $resInasis, 0, 'usuario', 0, "rol desconocido");
            mysqli_rollback($con);                       
        } else {
            $transaction_flag = true;
            if ($transaction_flag) {
                mysqli_commit($con);
            }

            $result  = 'success';
            $message = 'query success';        
            LOGS($con, $queryInasis, $resInasis, 0, 'usuario', 0, "rol desconocido");
        }    
    } else if ($job == 'update_inasistencia') {
        $transaction_flag = false;    

        $queryInasis = "UPDATE inasistencias 
        SET descripcion = '".$_GET['txtDescripcion']."', fecha_inasistencia = '".$_GET['txtFecha']."', estatus = '".$_GET['slEstatus']."', fk_id_user = '".$_GET['id_user']."', 
        updated_at = NOW() WHERE id_inasistencia = ".$_GET['id']." AND fk_id_empleado = ".$_GET['id_empleado']." ";
        $resInasis = mysqli_query($con, $queryInasis);

        if (!$resInasis){
            $result  = 'error';
            $message = 'query error U';   
            LOGS($con, $queryInasis, $resInasis, 0, 'usuario', 0, "rol desconocido");
            mysqli_rollback($con);                       
        } else {
            $transaction_flag = true;
            if ($transaction_flag) {
                mysqli_commit($con);
            }

            $result  = 'success';
            $message = 'query success';    
            LOGS($con, $queryInasis, $resInasis, 0, 'usuario', 0, "rol desconocido"); 
        } 
    } else if ($job == 'get_inasistencia') {
        $query =  " SELECT '' espacio, i.id_inasistencia, e.nombre_empleado, e.id_empleado, i.descripcion, i.fecha_inasistencia, i.estatus
        FROM inasistencias i
        INNER JOIN empleados e ON i.fk_id_empleado = e.id_empleado"; 
    
        $resultado = mysqli_query($con, $query);        
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
            LOGS($con, $query, $resultado, 0, 'usuario', 0, "rol desconocido");
        } else {
            $result  = 'success';
            $message = 'query success';         
            while ($row = mysqli_fetch_array($resultado)) {                                   
                // $functions = '<a title="Editar" data-idinasis="'.$row['id_inasistencia'].'" data-idempleado="'.$row['id_empleado'].'" 
                // data-nombreempleado="'.$row['nombre_empleado'].'" data-descripcion="'.$row['descripcion'].'" 
                // data-fechainasis="'.$row['fecha_inasistencia'].'" data-estatus="'.$row['estatus'].'" 
                // class="btn-floating waves-effect waves-light blue modal-trigger function_edit" href="#">Editar</a>';
                $functions = '<div class="invoice-action">
                    <a href="#" title="Editar" data-idinasis="'.$row['id_inasistencia'].'" data-idempleado="'.$row['id_empleado'].'" 
                        data-nombreempleado="'.$row['nombre_empleado'].'" data-fechainasis="'.$row['fecha_inasistencia'].'" 
                        style="color: blue;" class="invoice-action-edit function_edit">
                        <i class="material-icons">edit</i>
                    </a>
                    <a href="#" data-idinasis="'.$row['id_inasistencia'].'" style="color: red;" class="invoice-action-view mr-4 function_delete">
                        <i class="material-icons">cancel</i>
                    </a>                                        
                 </div>';
                $mysql_data[] = array(                           
                    "espacio"                 => $row['espacio'],
                    "id"                      => $row['id_inasistencia'],
                    // "name"                    => $row['id_empleado'],
                    "empleado"                => $row['nombre_empleado'],
                    // "uestatus"                => $row['descripcion'],
                    "fecha_inasistencia"      => $row['fecha_inasistencia'],                                                
                    // "estatus"                 => $row['estatus'],                    
                    "functions"               => $functions
                );
            }
            LOGS($con, $query, $resultado, 0, 'usuario', 0, "rol desconocido");
        }
    } elseif ($job == 'delete_inasistencia'){  
	    // Delete cliente
	    if ($id == ''){
	      	$result  = 'error';
	      	$message = 'id missing';
	    } else {
	      	$query = "DELETE FROM inasistencias WHERE id_inasistencia = '".$id."'";
			$resultado = mysqli_query($con, $query);       	
	      	if (!$resultado){
	        	$result  = 'error';
	        	$message = 'query error';
	      	} else {
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