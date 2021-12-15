<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'get_data_nosotros' || $job == 'update_nosotros') {
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

    if ($job == 'get_data_nosotros') {
        $query =  "SELECT * FROM empresa_nosotros WHERE id_nosotros = 1 AND fk_id_empresa = 1"; 
        $resultado = mysqli_query($con, $query);        
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';   
            $row = mysqli_fetch_array($resultado);                                                              
            $mysql_data[] = array(                           
                "texto_por_que" => $row['texto_por_que'],
                "texto_mision"  => $row['texto_mision'],
                "texto_vision"  => $row['texto_vision'],
                "texto_valores" => $row['texto_valores']                
            );            
        }
    } else if ($job == 'update_nosotros') {
        $transaction_flag = false;    

        $queryInicio = "UPDATE empresa_nosotros
        SET texto_por_que = '".$_POST['textoPorque']."', texto_mision = '".$_POST['textoMision']."', 
        texto_vision = '".$_POST['textoVision']."', texto_valores = '".$_POST['textoValores']."'
        WHERE id_nosotros = 1 AND fk_id_empresa = 1";
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