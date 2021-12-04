<?php 
function LOGS($xconn, $xtransaccion, $resultado, $idusuario, $usuarionombrepersona, $rol, $nombrerol){
    $xcarpetaLogs = '../logs/logsquery/';
    $xcarpetaErrs = '../logs/errors/';

    //Ejecutar transaccion
    $xtransaccion_old = $xtransaccion;    
    $xresult_sql = $resultado;
    
    //$xlast_error = sqlsrv_errors();    
    date_default_timezone_set('UTC');
    date_default_timezone_set("America/Mexico_City");
    $xfecha = date("Y-m-d");
    $xhora = date("H:i:s");
    
    // Generación de la ficha
    $xcadenota = "\nFECHA:\t\t".date("Y-m-d").", ".date("H:i:s");
    $xcadenota.= "\nUSUARIO:\t".$idusuario." - ".$usuarionombrepersona; // Aqui colocar tus propias variables de sesi?n
    $xcadenota.= "\nHOST:\t\t".$_SERVER['HTTP_HOST'];
    $xcadenota.= "\nCLIENTE:\t".$_SERVER['REMOTE_ADDR'];    
    $xcadenota.= "\nROL:\t\t".$rol." - ".$nombrerol; // Aqui colocar tus propias variables de sesión

    //$xcadenota.= "\nLLAMADA:\t".$_SERVER['HTTP_REFERER']; // Coloca el nombre del programa que hizo la llamada al programa que se ejecutó    
    if (isset($_SERVER['HTTP_REFERER'])){         
        $xcadenota.= "\nLLAMADA:\t".$_SERVER['HTTP_REFERER'];
    } else {
        $xcadenota.= "\nLLAMADA:\t".$_SERVER["HTTP_HOST"].$_SERVER["REQUEST_URI"];
    } 

    $xcadenota.= "\nMETODO:\t\t".$_SERVER['REQUEST_URI']; // Coloca el nombre del programa que se ejecutó más sus variables trasferidas por la URL
    
    //if ($xlast_error)
    //    $xcadenota.= "\n\t\t".$xlast_error; // En caso de haber error, coloca el mensaje de error del manejador de la BD

    if( ($xlast_error = mysqli_error($xconn) ) != null) { 
    if ($xlast_error != null){
        // foreach( $xlast_error as $error) { 
            $xcadenota.= "\n\t\terror message: ".$xlast_error."\n"; // En caso de haber error, coloca el mensaje de error del manejador de la BD
            // $xcadenota.= "\t\t\tSQLSTATE: ".$error[ 'SQLSTATE']."\n";  
            // $xcadenota.= "\t\t\tcode: ".$error[ 'code']."\n";  
            // $xcadenota.= "\t\t\tmessage: ".$error[ 'message']."\n";  
        }
    }
    
    $xcadenota.= "\nQUERY:\t\t".$xtransaccion_old."\n\n"; // Coloca la transacci?n o la consulta tal cual sucedi? en la BD

    // Aquí decidir la carpeta donde se tengan permisos de escritura para el usuario www-data
    // automáticamente se creará un archivo por día, y en caso de existir, adiciona al final cada bloque de mensajes
    $arch = fopen($xcarpetaLogs."logs_".date("Y-m-d").".txt", "a+"); 

    fwrite($arch, $xcadenota);
    fclose($arch);
    //
    if ($xlast_error != null) {
        $arch_error = fopen($xcarpetaErrs."errors_".date("Y-m-d").".txt", "a+");
        fwrite($arch_error, $xcadenota);
        fclose($arch_error);            
    } // ENDIF
    return $xresult_sql;
} // END FUNCTION
?>