<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'get_categorias' || $job == 'add_categoria') {
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

    if ($job == 'get_categorias') {
        $query =  "SELECT * FROM categorias";

        $resultado = mysqli_query($con, $query);
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';

            while ($row = mysqli_fetch_array($resultado)) {

                $mysql_data[] = array(
                    "id_categoria"          => $row['id_categoria'],
                    "descripcion_categoria" => $row['descripcion_categoria'],
                    "imagen_categoria"      => "<img width='120px' height='80px' src='/images/product/".$row['imagen_categoria']."' /><div class='center-align'><a class='function_edit_img modal-trigger' data-idcategoria='".$row['id_categoria']."' data-imgactual='".$row['imagen_categoria']."' href='#modalImagen'>Modificar</a></div>"
                );
            }
        }
    } else if ($job == 'add_categoria') {
        $query = "INSERT INTO categorias (descripcion_categoria)
        values
        ('".$_POST['txtDescripcion']."')";
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