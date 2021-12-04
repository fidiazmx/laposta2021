<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
	$job = $_GET['job'];
	if ($job == 'get_clientes' || $job == 'add_trabajo'   || $job == 'edit_cliente'  
		|| $job == 'delete_cliente' || $job == 'get_empleados' || $job == 'update_estatus') {
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
	    $query = "SELECT c.id_cliente, c.nombre_cliente, c.direccion_cliente, c.tel_cliente, estatus_espera espera, estatus_seguimiento seguimiento, estatus_avisa avisa, 
        estatus_aprobado aprobado, c.presupuesto, c.presupuesto2, c.presupuesto3, c.presupuesto4, c.ubicacion, e.nombre_empleado 
        FROM clientes c 
        INNER JOIN empleados e ON c.fk_id_empleado = e.id_empleado 
        where estatus_espera = 1 and estatus_aprobado = 0 
        ORDER BY id_cliente ASC";	    
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

				if ($row['espera'] == "0") { $color = "color:gray;"; $activo = 0; } else if ($row['espera'] == "1") { $color = "color:red;"; $activo = 1; }
				$espera = "<a data-idcliente=".$row['id_cliente']." data-activo='".$activo."' data-estado='espera' class='cambiaestado' href='#'><i class='material-icons' style='".$color."'>watch_later</i></a>";
				if ($row['seguimiento'] == "0") { $color = "color:gray;"; $activo = 0; } else if ($row['seguimiento'] == "1") { $color = "color:yellow;"; $activo = 1; }
				$seguimiento = "<a data-idcliente=".$row['id_cliente']." data-activo='".$activo."' data-estado='seguimiento' class='cambiaestado' href='#'><i class='material-icons' style='".$color."'>local_phone</i></a>";
				if ($row['avisa'] == "0") { $color = "color:gray;"; $activo = 0; } else if ($row['avisa'] == "1") { $color = "color:orange;"; $activo = 1; }
				$avisa = "<a data-idcliente=".$row['id_cliente']." data-activo='".$activo."' data-estado='avisa' class='cambiaestado' href='#'><i class='material-icons' style='".$color."'>person</i></a>";
				if ($row['aprobado'] == "0") { $color = "color:gray;"; $activo = 0; } else if ($row['aprobado'] == "1") { $color = "color:green;"; $activo = 1; }
				$aprobado = "<a data-idcliente=".$row['id_cliente']." data-activo='".$activo."' data-direccion='".$row['direccion_cliente']."' data-presup1='".$row['presupuesto']."' data-presup2='".$row['presupuesto2']."' data-presup3='".$row['presupuesto3']."' data-presup4='".$row['presupuesto4']."' data-estado='aprobado' data-presup='aprobado' class='cambiaestadoaprobado' href='#'><i class='material-icons' style='".$color."'>check</i></a>";

				$mysql_data[] = array(				  
				  "id_cliente"        => $row['id_cliente'],				  
				  "nombre_cliente"    => $row['nombre_cliente'],
				  "espera"            => $espera,				  
				  "seguimiento"       => $seguimiento,				  
				  "avisa"             => $avisa,				  
				  "aprobado"          => $aprobado,				  
				  "tel_cliente"       => $row['tel_cliente'],
				  "presupuesto"       => "<strong>".$row['presupuesto']."</strong>",
  				  "presupuesto2"      => "<strong>".$row['presupuesto2']."</strong>",
				  "presupuesto3"      => "<strong>".$row['presupuesto3']."</strong>",
				  "presupuesto4"      => "<strong>".$row['presupuesto4']."</strong>",
				  "direccion_cliente" => $row['direccion_cliente']
				);
		    }
    	}    
  	} elseif ($job == 'add_trabajo'){    
	    // Add cliente
  		$query = "INSERT INTO trabajos (fk_id_cliente, descripcion_trabajo, monto_adeuda, monto_precio, presup_seleccionado, fecha_creacion_trabajo) 
		  values ('".$id."','".$_GET['txtDescripcion']."','".$_GET['txtPrecio']."','".$_GET['txtPrecio']."', '".$_GET['presupsel']."', now())";  		
		$resultado = mysqli_query($con, $query);       	
	    if (!$resultado){
	      $result  = 'error';
	      $message = 'query error';
	    } else {
	      $result  = 'success';
	      $message = 'query success';
	    }  
  	} elseif ($job == 'add_cliente'){    
	    // Add cliente
  		$query = "INSERT INTO cat_clientes (Nombre,Direccion,Telefono,Quesemide,Ubicacion,FKidEmpleado,FechaCaptura) values ('".$_GET['txtNombre']."','".$_GET['txtDireccion']."','".$_GET['txtTelefono']."','".$_GET['slMide']."','".$_GET['txtUbicacion']."','".$_GET['slEmpleado']."',now())";
		$resultado = mysqli_query($con, $query);       	
	    if (!$resultado){
	      $result  = 'error';
	      $message = 'query error';
	    } else {
	      $result  = 'success';
	      $message = 'query success';
	    }  
  	} elseif ($job == 'edit_cliente'){    
	    // Edit cliente
	    if ($id == ''){
	      $result  = 'error';
	      $message = 'id missing';
	    } else {			
	  		$query = "UPDATE cat_clientes SET Nombre = '".$_GET['txtNombre']."', Direccion = '".$_GET['txtDireccion']."', Telefono = '".$_GET['txtTelefono']."', Quesemide = '".$_GET['slMide']."', Ubicacion = '".$_GET['txtUbicacion']."', FKidEmpleado = '".$_GET['slEmpleado']."' Where idCliente = '".$id."'";	  		
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
	      	$query = "DELETE FROM cat_clientes WHERE idCliente = '".$id."'";
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
	    $query = "SELECT * FROM cat_empleados ORDER BY idEmpleado asc";	
    	$resultado = mysqli_query($con, $query);       	
	    if (!$resultado){
	      	$result  = 'error';
	      	$message = 'query error';
	    } else {
			$result  = 'success';
	      	$message = 'query success';	      	
    		while ($row = mysqli_fetch_array($resultado)) {		    					        
				$mysql_data[] = array(				  
				  "idEmpleado"    => $row['idEmpleado'],				  				  
				  "Nombre"    	 => $row['Nombre']				  				  				  
				);
		    }
    	}    
  	} elseif ($job == 'update_estatus'){    
	    // Edit cliente
	    if ($id == ''){
	      $result  = 'error';
	      $message = 'id missing';
	    } else {			
	    	$estatus_update = "";
    		if ($_GET['estado'] == "espera") {
    			$estatus_update = "estatus_Espera";
    		} elseif ($_GET['estado'] == "seguimiento") {
				$estatus_update = "estatus_Seguimiento";
    		} elseif ($_GET['estado'] == "avisa") {
    			$estatus_update = "estatus_Avisa";
    		} elseif ($_GET['estado'] == "aprobado") {
    			$estatus_update = "estatus_Aprobado";
    		}

	  		$query = "UPDATE clientes SET $estatus_update = '".$_GET['activo']."' WHERE id_cliente = '".$id."'";	  	
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