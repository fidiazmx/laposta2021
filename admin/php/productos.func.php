<?php

require_once ('../_inc/dbconfig.php');
require_once ('function.generales.func.php');
require_once ('log-sql.php');

$job = '';
$id  = '';
if (isset($_GET['job'])) {
    $job = $_GET['job'];
    if ($job == 'get_nomina') {
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

   if ($job == 'get_nomina') {

        $arrFechas = [];
        $arrFechas = inicio_fin_semana(date('Y-m-d'));

        $fechini = $arrFechas["fechaInicio"];
        $fechfin = $arrFechas["fechaFin"];

        $query =  " SELECT emp.id_empleado, emp.nombre_empleado, emp.adeudo_anterior, emp.adeudo_actual,
        asis.lun_asis,
        asis.mar_asis, 
        asis.mie_asis, 
        asis.jue_asis, 
        asis.vie_asis, 
        asis.sab_asis,
        emp.sueldo_semanal_empleado salario,
        (SELECT COUNT(*) FROM inasistencias where inasistencias.fk_id_empleado = emp.id_empleado AND inasistencias.no_semana = asis.no_semana) total_dias_inasistencia,
        (SELECT IFNULL(SUM(monto_prestamo),0.00) monto_prestamo FROM prestamos_empleado WHERE no_semana = asis.no_semana 
        AND ((dia_semana = 'lun') OR (dia_semana = 'mar') OR (dia_semana = 'mie') OR (dia_semana = 'jue') OR (dia_semana = 'vie') OR (dia_semana = 'sab'))
        AND prestamos_empleado.fk_id_empleado = emp.id_empleado AND tipo_prestamo = 'A') prestamo_semana,
        (SELECT IFNULL(SUM(monto_prestamo),0.00) monto_prestamo_global FROM prestamos_empleado WHERE no_semana = asis.no_semana and tipo_prestamo = 'G') prestamo_global_semana,
        (SELECT IFNULL(SUM(monto_abono),0.00) abono_cuenta_empleados FROM abono_cuenta_empleados 
        WHERE no_semana = asis.no_semana AND abono_cuenta_empleados.fk_id_empleado = emp.id_empleado) abono_cuenta_semana
        FROM asistencias asis
        INNER JOIN empleados emp ON asis.fk_id_empleado = emp.id_empleado
        WHERE fecha_inicio = '".$fechini."' AND fecha_fin = '".$fechfin."' 
        "; 
    
        $resultado = mysqli_query($con, $query);        
        if (!$resultado){
            $result  = 'error';
            $message = 'query error';
            LOGS($con, $query, $resultado, 0, 'usuario', 0, "rol desconocido");
        } else {
            $result  = 'success';
            $message = 'query success';         
            $nominasemana = 0;
            while ($row = mysqli_fetch_array($resultado)) {                    
                $montodiapagado = $row['salario'] / 6;
                //$diastrabajados  = ($row['lun_asis'] + $row['mar_asis'] + $row['mie_asis'] + $row['jue_asis'] + $row['vie_asis'] + $row['sab_asis']) * ($montodiapagado);
                $montodiasnotrabajados  = $montodiapagado * $row['total_dias_inasistencia'];
                //$prestsemana = $diastrabajados - ();
                //$nominasemana = $nominasemana + ($diastrabajados - $row['prestamo_semana'] - $row['abono_cuenta_semana']);
                $mysql_data[] = array(                           
                    "nombre_empleado"     => $row['nombre_empleado'],
                    "lun_asis"            => $row['lun_asis'],                    
                    "mar_asis"            => $row['mar_asis'],                    
                    "mie_asis"            => $row['mie_asis'],                    
                    "jue_asis"            => $row['jue_asis'],                    
                    "vie_asis"            => $row['vie_asis'],                    
                    "sab_asis"            => $row['sab_asis'],                    
                    "salario"             => $row['salario'],                                        
                    //"descuento_faltas"    => round($diastrabajados,2),
                    //"prestamo_semana"     => round(($diastrabajados - $row['prestamo_semana']),2),
                    "descuento_faltas"    => '('.$row['total_dias_inasistencia'].')'.round($montodiasnotrabajados,2),
                    "prestamo_semana"     => round($row['prestamo_semana'],2),
                    "adeudo_anterior"     => $row['adeudo_anterior'],
                    "abono_cuenta_semana" => $row['abono_cuenta_semana'],                    
                    "adeudo_actual"       => $row['adeudo_actual'] + $row['prestamo_global_semana'],
                    //"salario_final"       => round(($diastrabajados - $row['prestamo_semana'] - $row['abono_cuenta_semana']),2)  
                    "salario_final"       => round((($row['salario'] - ($montodiasnotrabajados + $row['prestamo_semana'])) - $row['abono_cuenta_semana']),2)
                );
            }
            LOGS($con, $query, $resultado, 0, 'usuario', 0, "rol desconocido");
        }
    }
}

// Prepare data
$data = array(
    "result"  => $result,
    "message" => $message,
    "totsal"  =>  round($nominasemana,2),
    "data"    => $mysql_data
);
  
// Convert PHP array to JSON array
$json_data = json_encode($data);
print $json_data;


?>