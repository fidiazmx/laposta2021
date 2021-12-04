<?php

require_once ('../_inc/dbconfig.php');
require_once ('function.generales.func.php');
require_once ('log-sql.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'add_asistencia' || $job == 'update_inasistencia' || $job == 'get_inasistencia') {
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

    if ($job == 'add_asistencia') {
        $transaction_flag = false; 
        date_default_timezone_set("America/Mexico_City");   
        $numsemana = date('W');

        //limpia lo que exista de la semana actual
        $querylimpianomsem = "DELETE FROM asistencias WHERE no_semana = ".$numsemana." ";
        $reslimnosem = mysqli_query($con, $querylimpianomsem);
        LOGS($con, $querylimpianomsem, $reslimnosem, 0, 'usuario', 0, "rol desconocido");
        
        $arrFechas = [];
        $arrFechas = inicio_fin_semana(date('Y-m-d'));

        $fechini = $arrFechas["fechaInicio"];
        $fechfin = $arrFechas["fechaFin"];

        //buscar inasistencias de la semana
        $queryempinasis = "SELECT * FROM inasistencias WHERE fecha_inasistencia BETWEEN '".$fechini."' AND '".$fechfin."' AND estatus = 'A'";
        $resempinasis = mysqli_query($con, $queryempinasis);
        $arrEmpinasis = mysqli_fetch_all($resempinasis);
        LOGS($con, $queryempinasis, $resempinasis, 0, 'usuario', 0, "rol desconocido");

        //buscar empleados activos de la semana
        $querynoemp = "SELECT * FROM empleados WHERE estatus = 'A'";
        $resContEmp = mysqli_query($con, $querynoemp);
        LOGS($con, $querynoemp, $resContEmp, 0, 'usuario', 0, "rol desconocido");

        //num empleados
        $rowct=mysqli_num_rows($resContEmp);
        if ($rowct > 0) {

            $querygenasis = "INSERT INTO asistencias (fk_id_empleado, no_semana, lun_asis, mar_asis, mie_asis, jue_asis, vie_asis, sab_asis, fecha_inicio, fecha_fin) VALUES ";
        
            $cont = 1;
            while ($row = mysqli_fetch_array($resContEmp)) {//recorre empleados
                if ($cont == $rowct) { $separador = ";"; } else { $separador = ","; }
                //Revisar el listado de inasistencias para armar el insert
                $vallun = "1"; $valmar = "1"; $valmie = "1"; $valjue = "1"; $valvie = "1"; $valsab = "1"; 
                for ($i=0; $i <= (count($arrEmpinasis)-1); $i++) { 
                    
                    if ($row['id_empleado'] == $arrEmpinasis[$i][1]) {
                        if ($arrEmpinasis[$i][3] == "lun") { $vallun = "0"; }
                        if ($arrEmpinasis[$i][3] == "mar") { $valmar = "0"; }
                        if ($arrEmpinasis[$i][3] == "mie") { $valmie = "0"; }
                        if ($arrEmpinasis[$i][3] == "jue") { $valjue = "0"; }
                        if ($arrEmpinasis[$i][3] == "vie") { $valvie = "0"; }
                        if ($arrEmpinasis[$i][3] == "sab") { $valsab = "0"; }
                    }                    
                }
                
                $querygenasis .= "(".$row['id_empleado'].", ".$numsemana.",'".$vallun."','".$valmar."','".$valmie."','".$valjue."','".$valvie."','".$valsab."','".$fechini."','".$fechfin."')".$separador." ";

                $cont++;
            }
            
            $resqueryasis = mysqli_query($con, $querygenasis);
            LOGS($con, $querygenasis, $resqueryasis, 0, 'usuario', 0, "rol desconocido");

            $transaction_flag = true;
            if ($transaction_flag) {
                mysqli_commit($con);
            }

            $result  = 'success';
            $message = 'query success';
        } else {
            $result  = 'success';
            $message = 'query success no existen empleados registrados';
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