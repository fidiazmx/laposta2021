<?php

require_once ('../_inc/dbconfig.php');
require_once ('function.generales.func.php');
require_once ('log-sql.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'add_prestamo' || $job == 'get_prestamo' || $job == 'delete_prestamo') {
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

    if ($job == 'add_prestamo') {
        $transaction_flag = false;
        date_default_timezone_set('America/Mexico_City');

        $numsemana = date('W');
        $fechaactual = date('Y-m-d');
        $diasem = dia_semana($fechaactual);
        $queryPrest = "INSERT INTO prestamos_empleado (fk_id_empleado, tipo_prestamo, no_semana, dia_semana, descripcion_prestamo, fecha_prestamo, pagado, adeuda, monto_prestamo, created_at) 
        VALUES (".$_GET['slEmpleado'].", '".$_GET['slTipoPrestamo']."', ".$numsemana.", '".$diasem."', '".$_GET['txtDescPrestamo']."', '".$_GET['txtFecha']."', '0.00', '".$_GET['txtMontoPrestamo']."', '".$_GET['txtMontoPrestamo']."', NOW()) ";
        $resPrest = mysqli_query($con, $queryPrest);

        if (!$resPrest) {
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
    } else if ($job == 'get_prestamo') {
        $query =  " SELECT pe.id_prestamo, e.id_empleado, e.nombre_empleado, 
        CASE pe.tipo_prestamo WHEN 'A' THEN 'Adelanto Semana' WHEN 'G' THEN 'Préstamo Global' END AS tipo_prestamo,
        pe.tipo_prestamo 'valor_tipo_prestamo',
        pe.descripcion_prestamo, pe.no_semana, 
        pe.dia_semana, pe.pagado, pe.adeuda, pe.monto_prestamo, fecha_prestamo 
        FROM prestamos_empleado pe
        INNER JOIN empleados e ON pe.fk_id_empleado = e.id_empleado"; 
    
        $resultado = mysqli_query($con, $query);        
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';         
            while ($row = mysqli_fetch_array($resultado)) {                                   
                // $functions = '<a title="Editar" data-idinasis="'.$row['id_inasistencia'].'" data-idempleado="'.$row['id_empleado'].'" 
                // data-nombreempleado="'.$row['nombre_empleado'].'" data-descripcion="'.$row['descripcion'].'" 
                // data-fechainasis="'.$row['fecha_inasistencia'].'" data-estatus="'.$row['estatus'].'" 
                // class="btn-floating waves-effect waves-light blue modal-trigger function_edit" href="#">Editar</a>';
                $functions = '<div class="invoice-action">
                    <a data-idprestamo="'.$row['id_prestamo'].'" data-idempleado="'.$row['id_empleado'].'" data-tipoprestamo="'.$row['valor_tipo_prestamo'].'" 
                    data-descprestamo="'.$row['descripcion_prestamo'].'" data-fecprestamo="'.$row['fecha_prestamo'].'" data-nosemana="'.$row['no_semana'].'"
                    data-pagado="'.$row['pagado'].'" data-adeuda="'.$row['adeuda'].'" data-montoprestamo="'.$row['monto_prestamo'].'"
                    href="#" style="color: blue;" class="invoice-action-edit function_edit">
                        <i class="material-icons">edit</i>
                    </a>
                    <a href="#" data-idprestamo="'.$row['id_prestamo'].'" style="color: red;" class="invoice-action-view mr-4 function_delete">
                        <i class="material-icons">cancel</i>
                    </a>                                        
                </div>';
                $mysql_data[] = array(                           
                    "id_prestamo"          => $row['id_prestamo'],
                    "nombre_empleado"      => $row['nombre_empleado'],
                    "tipo_prestamo"        => $row['tipo_prestamo'],
                    "descripcion_prestamo" => $row['descripcion_prestamo'],
                    "pagado"               => $row['pagado'],               
                    "adeuda"               => $row['adeuda'], 
                    "monto_prestamo"       => $row['monto_prestamo'],                            
                    "fecha_prestamo"       => $row['fecha_prestamo'],            
                    "functions"            => $functions
                );
            }
        }
    } elseif ($job == 'delete_prestamo'){  
	    if ($id == ''){
	      	$result  = 'error';
	      	$message = 'id missing';
	    } else {
	      	$query = "DELETE FROM prestamos_empleado WHERE id_prestamo = '".$id."'";
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