<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
	$job = $_GET['job'];
	if ($job == 'get_trabajos' || $job == 'get_cliente'   || $job == 'add_anticipo'   || $job == 'edit_cliente'  
		|| $job == 'delete_cliente' || $job == 'get_empleados' || $job == 'update_estatus' || $job == 'update_deuda') {
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
  	if ($job == 'get_trabajos'){    	
  		$query = "SELECT '' espacio, t.id_trabajo, c.nombre_cliente, t.descripcion_trabajo, t.estatus_fabricado, t.estatus_instalado, t.estatus_terminado, t.monto_pagado, t.monto_adeuda, t.monto_precio 
          FROM trabajos t INNER JOIN clientes c ON t.fk_iD_cliente = c.id_cliente WHERE t.monto_adeuda > 0 || t.estatus_terminado = 0";
    	$resultado = mysqli_query($con, $query);       	
	    if (!$resultado){
	      	$result  = 'error';
	      	$message = 'query error';
	    } else {
			$result  = 'success';
	      	$message = 'query success';	      	
	      	$fabricado = "";
	      	$instalado = "";
	      	$terminado = "";	      	
    		while ($row = mysqli_fetch_array($resultado)) {		    					        
		        
                $functions = '<a data-id="'.$row['id_trabajo'].'" class="function_trabajos" href="#">Historial</a>&nbsp;&nbsp;';
		        $functions .= '<a data-id="'.$row['id_trabajo'].'" class="modal-trigger function_anticipo" href="#modalTrabajo">Anticipo</a>&nbsp;&nbsp;';
				
		        if ($row['estatus_fabricado'] == 0) { $activo = 0; $color = "color: gray;"; } else if ($row['estatus_fabricado'] == 1) { $activo = 1; $color = "color: green;"; }
                $fabricado="<div class='invoice-action'>
                        <a data-idtrabajo=".$row['id_trabajo']." data-activo='".$activo."' data-estado='fabricado' href='#' style='".$color."' class='invoice-action-edit cambiaestado'>
                            <i class='material-icons'>check_circle</i>
                        </a>                                                                                             
                    </div>";

                if ($row['estatus_instalado'] == 0) { $activo = 0; $color = "color: gray;"; } else if ($row['estatus_instalado'] == 1) { $activo = 1; $color = "color: green;"; }
                $instalado="<div class='invoice-action'>
                        <a data-idtrabajo=".$row['id_trabajo']." data-activo='".$activo."' data-estado='instalado' href='#' style='".$color."' class='invoice-action-edit cambiaestado'>
                            <i class='material-icons'>check_circle</i>
                        </a>                                                                                             
                </div>";

                if ($row['estatus_terminado'] == 0) { $activo = 0; $color = "color: gray;"; } else if ($row['estatus_terminado'] == 1) { $activo = 1; $color = "color: green;"; }
                $terminado="<div class='invoice-action'>
                        <a data-idtrabajo=".$row['id_trabajo']." data-activo='".$activo."' data-estado='terminado' data-adeudatrabajo=".$row['monto_adeuda']." href='#' style='".$color."' class='invoice-action-edit cambiaestado'>
                            <i class='material-icons'>check_circle</i>
                        </a>                                                                                             
                </div>";

				$mysql_data[] = array(	
                  "espacio"		         => $row['espacio'],  
				  "id_trabajo"		     => $row['id_trabajo'],				  
				  "nombre_cliente"    	 => $row['nombre_cliente'],
				  "descripcion_trabajo"  => $row['descripcion_trabajo'],
				  "estatus_fabricado"    => "<div align='center'>".$fabricado."</div>",
				  "estatus_instalado"    => "<div align='center'>".$instalado."</div>",
				  "estatus_terminado"    => "<div align='center'>".$terminado."</div>",
			  	  "monto_pagado"    	 => "<div align='right' style='color:#048021;'><strong>".$row['monto_pagado']."</strong></div>",
				  "monto_adeuda"         => "<div align='right' style='color:#ff0000;'><strong>".$row['monto_adeuda']."</strong></div>",
				  "monto_precio"         => "<div align='right'><strong>".$row['monto_precio']."</strong></div>",	
				  "functions"            => $functions
				);
		    }
    	}    
  	} elseif ($job == 'add_anticipo'){    
	    // Add cliente
  		$query = "INSERT INTO rel_trabajo_anticipos (FKidTrabajo,DescripcionAnticipo,Anticipo,FechaAnticipo) values ('".$id."','".$_GET['txtDescripcion']."','".$_GET['txtAnticipo']."',now());";		
		$query .= "UPDATE cat_trabajos SET Pagado = (SELECT SUM(Anticipo) FROM rel_trabajo_anticipos WHERE FKidTrabajo = '".$id."') WHERE idTrabajo = '".$id."'";		
		$resultado = mysqli_multi_query($con, $query);       	
	    if (!$resultado){
	      $result  = 'error';
	      $message = 'query error';
	    } else {
	      $result  = 'success';
	      $message = 'query success';
	    }  
  	} elseif ($job == 'get_cliente'){    
	    // GET CLIENTE
	    if ($id == ''){
	      	$result  = 'error';
	      	$message = 'id missing';
	    } else {
	      	$query = "SELECT * FROM cat_clientes WHERE idCliente = '".$id."'";
    		$resultado = mysqli_query($con, $query);       	
	      if (!$resultado){
	        $result  = 'error';
	        $message = 'query error';
	      } else {
	        $result  = 'success';
	        $message = 'query success';
	        while ($row = mysqli_fetch_array($resultado)){
	          $mysql_data[] = array(
	           "idCliente"    => $row['idCliente'],				  
			  	"Nombre"      => $row['Nombre'],
		  		"Direccion"   => $row['Direccion'],
			  	"Telefono"    => $row['Telefono'],
			  	"Presupuesto"    => $row['Presupuesto'],				  
			  	"Quesemide"   => $row['Quesemide'],
			  	"Quesemide"   => $row['Quesemide'],				  
			  	"Ubicacion"   => $row['Ubicacion'],
			  	"FKidEmpleado"   => $row['FKidEmpleado'],
	          );
	        }
	      }
	    }  
  	} elseif ($job == 'add_cliente'){    
	    // Add cliente
  		$query = "INSERT INTO cat_clientes (Nombre,Direccion,Telefono,Quesemide,Presupuesto,Ubicacion,FKidEmpleado,FechaCaptura) values ('".$_GET['txtNombre']."','".$_GET['txtDireccion']."','".$_GET['txtTelefono']."','".$_GET['slMide']."','".$_GET['txtPresupuesto']."','".$_GET['txtUbicacion']."','".$_GET['slEmpleado']."',now())";
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
	  		$query = "UPDATE cat_clientes SET Nombre = '".$_GET['txtNombre']."', Direccion = '".$_GET['txtDireccion']."', Telefono = '".$_GET['txtTelefono']."', Quesemide = '".$_GET['slMide']."', Presupuesto = '".$_GET['txtPresupuesto']."', Ubicacion = '".$_GET['txtUbicacion']."', FKidEmpleado = '".$_GET['slEmpleado']."' Where idCliente = '".$id."'";	  		
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
    		if ($_GET['estado'] == "fabricado") {
    			$estatus_update = "Estatus_Fabricado";
    		} elseif ($_GET['estado'] == "instalado") {
				$estatus_update = "Estatus_Instalado";
    		} elseif ($_GET['estado'] == "terminado") {
    			$estatus_update = "Estatus_Terminado";
    		}

	  		$query = "UPDATE cat_trabajos SET $estatus_update = '".$_GET['activo']."' Where idTrabajo = '".$id."'";	  	
	  		//echo $query;	
			$resultado = mysqli_query($con, $query);       	
			if (!$resultado){
			$result  = 'error';
			$message = 'query error';
			} else {
			$result  = 'success';
			$message = 'query success';
			}
	    }    
  	} elseif ($job == 'update_deuda'){    
	    // Edit cliente
	    if ($id == ''){
	      $result  = 'error';
	      $message = 'id missing';
	    } else {			
	    	$query = "UPDATE cat_trabajos SET Adeuda = Precio - Pagado WHERE idTrabajo = '".$id."'";	    	
	  		//$query = "UPDATE cat_trabajos SET $estatus_update = '".$_GET['activo']."' Where idTrabajo = '".$id."'";	  	
	  		//echo $query;	
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