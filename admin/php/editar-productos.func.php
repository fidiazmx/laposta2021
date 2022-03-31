<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'get_productos' || $job == 'add_producto' || $job == 'update_producto' || $job == 'delete_producto') {
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

    if ($job == 'get_productos') {
        $query =  "SELECT '' espacio, p.id_producto, p.fk_id_categoria, p.imagen_detalle, p.imagen_catalogo, p.precio, p.ingredientes, p.indicaciones,
        p.descripcion_producto, c.descripcion_categoria, p.ingredientes, p.indicaciones, p.detalle_producto, p.detalle2_producto, p.activo, p.estatus
        FROM productos p
        INNER JOIN categorias c ON p.fk_id_categoria = c.id_categoria";

        $resultado = mysqli_query($con, $query);
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';

            $actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]";

            while ($row = mysqli_fetch_array($resultado)) {
                $preurl = "";
                switch ($row['fk_id_categoria']) {
                    case '1':
                        $preurl = "/productos/bovinos/";
                        break;
                    case '2':
                        $preurl = "/productos/porcinos/";
                        break;
                    case '3':
                        $preurl = "/productos/equinos/";
                        break;
                    case '4':
                        $preurl = "/productos/ovinos/";
                        break;
                    case '5':
                        $preurl = "/productos/aves/";
                        break;
                    default:
                        # code...
                        break;
                }

                $functions = '<div class="invoice-action">
                    <a title="Editar producto '.$row['id_producto'].'" data-idproducto="'.$row['id_producto'].'" data-idcat="'.$row['fk_id_categoria'].'" data-descprod="'.$row['descripcion_producto'].'" data-desccat="'.$row['descripcion_categoria'].'"
                        data-imgproducto="'.$row['imagen_catalogo'].'" data-imgdetalle="'.$row['imagen_detalle'].'"  data-precio="'.$row['precio'].'" data-ingredientes="'.$row['ingredientes'].'" data-indicaciones="'.$row['indicaciones'].'" data-activo="'.$row['activo'].'"
                        data-detprod="'.$row['detalle_producto'].'" data-det2prod="'.$row['detalle2_producto'].'" data-estatus="'.$row['estatus'].'" data-urlimg="'.$preurl.'"
                        href="#" style="color: blue;" class="invoice-action-edit function_edit">
                        <i class="material-icons">edit</i>
                    </a>
                    <a href="#" data-idproducto="'.$row['id_producto'].'" data-imgproducto="'.$row['imagen_catalogo'].'" data-imgdetalle="'.$row['imagen_detalle'].'" data-urlimg="'.$preurl.'"  style="color: red;" class="invoice-action-view mr-4 function_delete">
                        <i class="material-icons">cancel</i>
                    </a>
                </div>';

                $urlimgdet = $actual_link.$preurl.$row['imagen_detalle'];
                $urlimgcat = $actual_link.$preurl.$row['imagen_catalogo'];
                $estatusdesc = "";
                if ($row['activo'] == 'A') {
                    $estatusdesc = "ACTIVO";
                } else {
                    $estatusdesc = "INACTIVO";
                }

                $mysql_data[] = array(
                    "id_producto"           => $row['id_producto'],
                    "imagen_detalle"        => "<img width='80px' height='120px' src='".$urlimgdet."' /><div class='center-align'><a class='function_edit_img modal-trigger' data-idproducto='".$row['id_producto']."' data-urlimg='".$preurl."' data-imgactual='".$row['imagen_detalle']."' data-desccampo='imagen_detalle' href='#modalImagen'>Modificar</a></div>",
                    "imagen_catalogo"       => "<img width='100px' height='120px' src='".$urlimgcat."' /><div class='center-align'><a class='function_edit_img modal-trigger' data-idproducto='".$row['id_producto']."' data-urlimg='".$preurl."' data-imgactual='".$row['imagen_detalle']."' data-desccampo='imagen_catalogo' href='#modalImagen'>Modificar</a></div>",
                    "descripcion_producto"  => $row['descripcion_producto'],
                    "descripcion_categoria" => $row['descripcion_categoria'],
                    "ingredientes"          => $row['ingredientes'],
                    "indicaciones"          => $row['indicaciones'],
                    "estatus"               => $estatusdesc,
                    "functions"             => $functions
                );
            }
        }
    } else if ($job == 'update_producto') {
        $transaction_flag = false;

        $queryInicio = "UPDATE productos
        SET fk_id_categoria = '".$_POST['slCategoria']."', descripcion_producto = '".$_POST['txtDescripcion']."',
        detalle_producto = '".$_POST['txtDetProd']."', detalle2_producto = '".$_POST['txtDetEspec']."',
        ingredientes = '".$_POST['txtIngred']."', indicaciones = '".$_POST['txtIndic']."', precio = '".$_POST['txtPrecio']."',
        estatus = '".$_POST['slDisponible']."', activo = '".$_POST['swActivo']."'
        WHERE id_producto = ".$id." ";
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
    } else if ($job == 'add_producto') {
  		$query = "INSERT INTO productos (fk_id_categoria, descripcion_producto, detalle_producto, detalle2_producto, precio, estatus, ingredientes, indicaciones, activo)
        values
        ('".$_POST['slCategoria']."','".$_POST['txtDescripcion']."','".$_POST['txtDetProd']."','".$_POST['txtDetEspec']."','".$_POST['txtPrecio']."',
        '".$_POST['slEstatus']."','".$_POST['txtIngred']."','".$_POST['txtIndic']."','".$_POST['swActivo']."')";
        $resultado = mysqli_query($con, $query);
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';
        }
    } elseif ($job == 'delete_producto'){
        $transaction_flag = false;
        mysqli_autocommit($con, false);

	    if ($id == ''){
	      	$result  = 'error';
	      	$message = 'id missing';
	    } else {
	      	$query = "DELETE FROM productos WHERE id_producto = '".$id."'";
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