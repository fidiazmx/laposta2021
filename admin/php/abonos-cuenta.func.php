<?php

require_once ('../_inc/dbconfig.php');
require_once ('function.generales.func.php');
require_once ('log-sql.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'add_abono' || $job == 'get_abono' || $job == 'delete_abono') {
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

    if ($job == 'add_abono') {
        $transaction_flag = false;
        date_default_timezone_set('America/Mexico_City');

        $queryempadeuant = "SELECT adeudo_anterior   
        FROM empleados e        
        WHERE e.id_empleado= ".$_GET['slEmpleado']." ";        
        $resadeant = mysqli_query($con, $queryempadeuant);

        if (!$resadeant) {
            $result  = 'error';
            $message = 'query error ';   
            LOGS($con, $queryempadeuant, $resadeant, 0, 'usuario', 0, "rol desconocido");
            mysqli_rollback($con);      
        } else {

            $rowempade=mysqli_fetch_array($resadeant);
            $adeudoanterior = $rowempade["adeudo_anterior"];
            
            $numsemana = date('W');
            $fechaactual = date('Y-m-d');
            $diasem = dia_semana($fechaactual);
            $adeantmenabono = $adeudoanterior - $_GET['txtMontoAbono'];
            $queryPrest = "INSERT INTO abono_cuenta_empleados (fk_id_empleado, no_semana, descripcion, monto_abono, adeudo_anterior, adeudo_anterior_despues_abono, created_at) 
            VALUES (".$_GET['slEmpleado'].", ".$numsemana.", '".$_GET['txtDescAbono']."', '".$_GET['txtMontoAbono']."', '".$adeudoanterior."', '".$adeantmenabono."', NOW()) ";
            $resPrest = mysqli_query($con, $queryPrest);

            if (!$resPrest) {
                $result  = 'error';
                $message = 'query error U';
                mysqli_rollback($con);
            } else {

                $queryEmpleado = "UPDATE empleados 
                SET adeudo_anterior = '".$adeudoanterior."', adeudo_actual = '".$adeantmenabono."',
                updated_at = NOW() WHERE id_empleado = ".$_GET['slEmpleado']." ";
                $resEmpleado = mysqli_query($con, $queryEmpleado);

                if (!$resEmpleado){
                    $result  = 'error';
                    $message = 'query error U';  
                    LOGS($con, $queryEmpleado, $resEmpleado, 0, 'usuario', 0, "rol desconocido"); 
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
    } else if ($job == 'get_abono') {
        $query =  " SELECT id_abono_cuenta, fk_id_empleado, e.nombre_empleado, no_semana, descripcion, monto_abono, ac.created_at
        FROM abono_cuenta_empleados ac
        INNER JOIN empleados e ON ac.fk_id_empleado = e.id_empleado"; 
    
        $resultado = mysqli_query($con, $query);        
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';         
            while ($row = mysqli_fetch_array($resultado)) {                                                   
                $functions = '<div class="invoice-action">
                    <a data-idabono="'.$row['id_abono_cuenta'].'" data-idempleado="'.$row['fk_id_empleado'].'" data-nombreemp="'.$row['nombre_empleado'].'" 
                    data-nosemana="'.$row['no_semana'].'" data-descripcion="'.$row['descripcion'].'" data-montoabono="'.$row['monto_abono'].'"
                    data-fechaabono="'.$row['created_at'].'" 
                    href="#" style="color: blue;" class="invoice-action-edit function_edit">
                        <i class="material-icons">edit</i>
                    </a>
                    <a data-idabono="'.$row['id_abono_cuenta'].'" data-idempleado="'.$row['fk_id_empleado'].'" href="#" style="color: red;" class="invoice-action-view mr-4 function_delete">
                        <i class="material-icons">cancel</i>
                    </a>                                        
                </div>';
                $mysql_data[] = array(                           
                    "id_abono_cuenta"  => $row['id_abono_cuenta'],
                    "nombre_empleado"  => $row['nombre_empleado'],
                    "no_semana"        => $row['no_semana'],
                    "descripcion"      => $row['descripcion'],
                    "monto_abono"      => $row['monto_abono'],               
                    "created_at"       => $row['created_at'],                 
                    "functions"        => $functions
                );
            }
        }
    } elseif ($job == 'delete_abono'){  
	    if ($id == ''){
	      	$result  = 'error';
	      	$message = 'id missing';
	    } else {
	      	$query = "DELETE FROM abono_cuenta_empleados WHERE id_abono_cuenta = '".$id."'";
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