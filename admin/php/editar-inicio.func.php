<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'get_data_inicio' || $job == 'update_inicio') {
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

    if ($job == 'get_data_inicio') {
        $query =  "SELECT * FROM empresa WHERE id_empresa = 1"; 
        $resultado = mysqli_query($con, $query);        
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';   
            $row = mysqli_fetch_array($resultado);                                                              
            $mysql_data[] = array(                           
                "texto_principal_linea1"     => $row['texto_principal_linea1'],
                "texto_principal_linea2"     => $row['texto_principal_linea2'],
                "texto_principal_linea3"     => $row['texto_principal_linea3'],
                "url_video_principal"        => $row['url_video_principal'],
                "mensaje_principal_contacto" => $row['mensaje_principal_contacto'],
                "texto_historia"             => $row['texto_historia']
            );            
        }
    } else if ($job == 'update_inicio') {
        $transaction_flag = false;    

        $queryInicio = "UPDATE Empresa 
        SET texto_principal_linea1 = '".$_POST['txtLinea1']."', texto_principal_linea2 = '".$_POST['txtLinea2']."', texto_principal_linea3 = '".$_POST['txtLinea3']."',
        url_video_principal = '".$_POST['txtLineaVideoYoutube']."', mensaje_principal_contacto = '".$_POST['textoContacto']."', texto_historia = '".$_POST['textoHistoria']."'
        WHERE id_empresa = 1";
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