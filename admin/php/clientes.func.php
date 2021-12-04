<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
	$job = $_GET['job'];
	if ($job == 'get_clientes' || $job == 'add_cliente'   || $job == 'update_cliente' || $job == 'get_empleados' || $job =='get_tipoproductos' || $job =='delete_cliente') {
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
if ($job != ''){
	// Connect to database
	$con = mysqli_connect($db_server, $db_username, $db_password, $db_name);
	if (mysqli_connect_errno()){
		$result  = 'error';
		$message = 'Failed to connect to database: ' . mysqli_connect_error();
		$job     = '';
	}

	// Execute job
  	if ($job == 'get_clientes'){    	
	    // GET CLIENTES
	    $query = "SELECT '' espacio, c.id_cliente, c.nombre_cliente, c.direccion_cliente, c.tel_cliente, c.tel_cel_cliente, c.fecha_captura, estatus_espera espera, 
		estatus_seguimiento seguimiento, estatus_avisa avisa, estatus_aprobado aprobado, c.fk_id_tipo_producto, c.ubicacion, e.id_empleado, e.nombre_empleado 'nombre_empleado',
		c.presupuesto, c.presupuesto2, c.presupuesto3, c.presupuesto4 
		FROM clientes c 
		INNER JOIN empleados e ON c.fk_id_empleado = e.id_empleado 
		where estatus_espera = 0 ORDER BY c.id_cliente ASC";
	    //$query = "SELECT * FROM cat_clientes ORDER BY idCliente asc";	
    	$resultado = mysqli_query($con, $query);       	
	    if (!$resultado){
	      	$result  = 'error';
	      	$message = 'query error';
	    } else {
			$result  = 'success';
	      	$message = 'query success';	      	
	      	$espera = "";
	      	$seguimiento = "";
	      	$avisa = "";
	      	$aprobado = "";
    		while ($row = mysqli_fetch_array($resultado)) {		  
				$espera = "<div class='invoice-action'><a href='#' data-idcliente='".$row['id_cliente']."' data-nombrecliente='".$row['nombre_cliente']."' data-direccion='".$row['direccion_cliente']."' data-telfijo='".$row['tel_cliente']."' data-telcel='".$row['tel_cel_cliente']."' data-mide='".$row['fk_id_tipo_producto']."' data-empleadoatn='".$row['id_empleado']."' data-ubicacion='".$row['ubicacion']."' data-activo='".$row['espera']."' data-estado='espera' style='color: gray;' class='invoice-action-edit cambiaestado'><i class='material-icons'>watch_later</i></a></div>";
				
				$functions = "
				<div class='invoice-action'>
					<a href='#' data-idcliente='".$row['id_cliente']."' data-nombrecliente='".$row['nombre_cliente']."' data-direccion='".$row['direccion_cliente']."' data-telfijo='".$row['tel_cliente']."' data-telcel='".$row['tel_cel_cliente']."' data-mide='".$row['fk_id_tipo_producto']."' data-empleadoatn='".$row['id_empleado']."' data-ubicacion='".$row['ubicacion']."' data-presup='".$row['presupuesto']."' data-presup2='".$row['presupuesto2']."' data-presup3='".$row['presupuesto3']."' data-presup4='".$row['presupuesto4']."' style='color: blue;' class='invoice-action-edit function_edit'>
						<i class='material-icons'>edit</i>
					</a>
					<a href='#' data-idcliente='".$row['id_cliente']."' style='color: red;' class='invoice-action-view mr-4 function_delete'>
						<i class='material-icons'>cancel</i>
					</a>                                        
				</div>";
								
				$mysql_data[] = array(		
					"espacio"           => $row['espacio'],	  
					"nombre_cliente"    => $row['nombre_cliente'],
					"espera"            => $espera,
					"direccion_cliente" => $row['direccion_cliente'],
					"tel_cliente"       => $row['tel_cliente'],
					"tel_cel_cliente"   => $row['tel_cel_cliente'],
					"fecha_captura"     => $row['fecha_captura'],								  
					"functions"         => $functions
				);
		    }
    	}    
	 } elseif ($job == 'get_tipoproductos'){    	
	    // GET CLIENTES
	    $query = "SELECT id_tipo_producto, descripcion FROM tipo_producto";	    
    	$resultado = mysqli_query($con, $query);       	
	    if (!$resultado){
	      	$result  = 'error';
	      	$message = 'query error';
	    } else {
			$result  = 'success';
	      	$message = 'query success';	      		      	
    		while ($row = mysqli_fetch_array($resultado)) {		    					        
				$mysql_data[] = array(				  
				  "id_tipo_producto" => $row['id_tipo_producto'],				  
				  "descripcion"    => $row['descripcion']			  				  
				);
		    }
    	}    
  	} elseif ($job == 'add_cliente'){    
	    // Add cliente
  		$query = "INSERT INTO clientes (nombre_cliente,direccion_cliente,tel_cliente,tel_cel_cliente,fk_id_tipo_producto,presupuesto,ubicacion,fk_id_empleado,fecha_captura) 
		values
		('".$_GET['txtNombre']."','".$_GET['txtDireccion']."','".$_GET['txtTelFijo']."','".$_GET['txtTelCel']."','".$_GET['slMide']."',
		'".$_GET['txtPresupuesto']."','".$_GET['txtUbicacion']."','".$_GET['slEmpleado']."',now())";
		$resultado = mysqli_query($con, $query);       	
	    if (!$resultado){
	      $result  = 'error';
	      $message = 'query error';
	    } else {
	      $result  = 'success';
	      $message = 'query success';
	    }  
  	} elseif ($job == 'update_cliente'){    
	    // Edit cliente
	    if ($id == ''){
	      $result  = 'error';
	      $message = 'id missing';
	    } else {			
	  		$query = "UPDATE clientes SET nombre_cliente = '".$_GET['txtNombre']."', direccion_cliente = '".$_GET['txtDireccion']."', ";
			$query .= "tel_cliente = '".$_GET['txtTelFijo']."', tel_cel_cliente = '".$_GET['txtTelCel']."', fk_id_tipo_producto = '".$_GET['slMide']."', ";
			$query .= "Presupuesto = '".$_GET['txtPresupuesto']."', Presupuesto2 = '".$_GET['txtPresupuesto2']."', Presupuesto3 = '".$_GET['txtPresupuesto3']."', ";
			$query .= "Presupuesto4 = '".$_GET['txtPresupuesto4']."', Ubicacion = '".$_GET['txtUbicacion']."', fk_id_empleado = '".$_GET['slEmpleado']."' ";

			//estado
			if ($_GET['estado'] != "null" || $_GET['activo'] != "null") {
				if ($_GET['estado'] == "espera") { $estatus_update = "Estatus_Espera"; } elseif ($_GET['estado'] == "seguimiento") { $estatus_update = "Estatus_Seguimiento"; } elseif ($_GET['estado'] == "avisa") { $estatus_update = "Estatus_Avisa"; } elseif ($_GET['estado'] == "aprobado") { $estatus_update = "Estatus_Aprobado"; }
				$query .= ", $estatus_update = '".$_GET['activo']."' ";
			}

			$query .= "Where id_cliente = '".$id."'";	  		
			$resultado = mysqli_query($con, $query);       	
			if (!$resultado){
			$result  = 'error';
			$message = 'query error';
			} else {
			$result  = 'success';
			$message = 'query success';
			}
	    }    
  	} elseif ($job == 'delete_cliente'){  
	    // Delete cliente
	    if ($id == ''){
	      	$result  = 'error';
	      	$message = 'id missing';
	    } else {
	      	$query = "DELETE FROM clientes WHERE id_cliente = '".$id."'";
			$resultado = mysqli_query($con, $query);       	
	      	if (!$resultado){
	        	$result  = 'error';
	        	$message = 'query error';
	      	} else {
	        	$result  = 'success';
	        	$message = 'query success';
	      	}
	    }  
  	} elseif ($job == 'get_empleados'){    	
	    // GET CLIENTES
	    $query = "SELECT * FROM empleados ORDER BY id_empleado asc";	
    	$resultado = mysqli_query($con, $query);       	
	    if (!$resultado){
	      	$result  = 'error';
	      	$message = 'query error';
	    } else {
			$result  = 'success';
	      	$message = 'query success';	      	
    		while ($row = mysqli_fetch_array($resultado)) {		    					        
				$mysql_data[] = array(				  
				  "id_empleado"    => $row['id_empleado'],				  				  
				  "nombre_empleado"    	 => $row['nombre_empleado']				  				  				  
				);
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