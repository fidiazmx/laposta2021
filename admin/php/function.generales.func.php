<?php

function inicio_fin_semana($fecha){

    $diaInicio="Monday";
    $diaFin="Sunday";

    $strFecha = strtotime($fecha);

    $fechaInicio = date('Y-m-d',strtotime('last '.$diaInicio,$strFecha));
    $fechaFin = date('Y-m-d',strtotime('next '.$diaFin,$strFecha));

    if(date("l",$strFecha)==$diaInicio){
        $fechaInicio= date("Y-m-d",$strFecha);
    }
    if(date("l",$strFecha)==$diaFin){
        $fechaFin= date("Y-m-d",$strFecha);
    }
    return Array("fechaInicio"=>$fechaInicio,"fechaFin"=>$fechaFin);
}

function dia_semana($pfechadia) {
    // $date='2019-02-15';
    // echo date('l-d', strtotime($date));

    $tmpdia = "";
    $day = date("l", strtotime($pfechadia));
    switch ($day) {
        case "Monday":
            $tmpdia = "lun";
        break;
        case "Tuesday":
            $tmpdia = "mar";
        break;
        case "Wednesday":
            $tmpdia = "mie";
        break;
        case "Thursday":
            $tmpdia = "jue";
        break;
        case "Friday":
            $tmpdia = "vie";
        break;
        case "Saturday":
            $tmpdia = "sab";
        break;
    }

    return $tmpdia;
}


?>