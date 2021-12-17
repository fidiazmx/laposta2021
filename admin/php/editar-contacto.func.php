<?php

require_once ('../_inc/dbconfig.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'get_data_contacto' || $job == 'update_contacto') {
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

    if ($job == 'get_data_contacto') {
        $query =  "SELECT * FROM empresa_contacto"; 
        $resultado = mysqli_query($con, $query);        
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
        } else {
            $result  = 'success';
            $message = 'query success';   
            while ($row = mysqli_fetch_array($resultado)) {        
                $mysql_data[] = array(                           
                    "id_contacto"         => $row['id_ubicacion'],
                    "ubicacion"           => $row['ubicacion'],
                    "telefono_ubicacion"  => $row['telefono_ubicacion'],
                    "correo_ubicacion"    => $row['correo_ubicacion'],
                    "texto_url_mapa"      => $row['texto_url_mapa'],
                    "email_ubicacion"     => $row['email_ubicacion'],
                    "horario_1_ubicacion" => $row['horario_1_ubicacion'],
                    "horario_2_ubicacion" => $row['horario_2_ubicacion'],
                    "horario_3_ubicacion" => $row['horario_3_ubicacion'],
                    "direccion_ubicacion" => $row['direccion_ubicacion'],
                );            
            }
        }
    } else if ($job == 'update_contacto') {
        $transaction_flag = false;    

        $queryInicio = "UPDATE empresa_contacto 
        SET telefono_ubicacion = '".$_POST['txtTelBand']."', correo_ubicacion = '".$_POST['txtCorreoBand']."', horario_1_ubicacion = '".$_POST['txtHor1Band']."',
        horario_2_ubicacion = '".$_POST['txtHor2Band']."', horario_3_ubicacion = '".$_POST['txtHor3Band']."', direccion_ubicacion = '".$_POST['txtDirBand']."'
        WHERE id_contacto = 1 AND ubicacion = 'BANDERILLA';
        UPDATE empresa_contacto 
        SET telefono_ubicacion = '".$_POST['txtTelAcaj']."', correo_ubicacion = '".$_POST['txtCorreoAcaj']."', horario_1_ubicacion = '".$_POST['txtHor1Acaj']."',
        horario_2_ubicacion = '".$_POST['txtHor2Acaj']."', horario_3_ubicacion = '".$_POST['txtHor3Acaj']."', direccion_ubicacion = '".$_POST['txtDirAcaj']."'
        WHERE id_contacto = 2 AND ubicacion = 'ACAJETE';
        UPDATE empresa_contacto 
        SET telefono_ubicacion = '".$_POST['txtTelMata']."', correo_ubicacion = '".$_POST['txtCorreoMata']."', horario_1_ubicacion = '".$_POST['txtHor1Mata']."',
        horario_2_ubicacion = '".$_POST['txtHor2Mata']."', horario_3_ubicacion = '".$_POST['txtHor3Mata']."', direccion_ubicacion = '".$_POST['txtDirMata']."'
        WHERE id_contacto = 3 AND ubicacion = 'MATAOSCURA';
        ";

        //$queryInicio .= "";

        //$queryInicio = "";

        $resInicio = mysqli_multi_query($con, $queryInicio);

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