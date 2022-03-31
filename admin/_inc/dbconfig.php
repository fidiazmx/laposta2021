<?php

//mysql://b2ca8ba5936d96:4c3fc5e5@us-cdbr-east-05.cleardb.net/heroku_7c1482fd2536ff5?reconnect=true
$db_server   = '';
$db_username = '';
$db_password = '';
$db_name     = '';


if ($_SERVER['HTTP_HOST'] == 'laposta2021.herokuapp.com') {
    $db_server   = 'us-cdbr-east-05.cleardb.net';
    $db_username = 'b2ca8ba5936d96';
    $db_password = '4c3fc5e5';
    $db_name     = 'heroku_7c1482fd2536ff5';
} else if ($_SERVER['HTTP_HOST'] == 'laposta.local')  {
    $db_server   = 'localhost';
    $db_username = 'admin';
    $db_password = '123456';
    $db_name     = 'laposta_db_2021';
} else if ($_SERVER['HTTP_HOST'] == 'laposta.com.mx')  {
    /*$db_server   = 'localhost';
    $db_username = 'lapostacom104453';
    $db_password = 'Chivas2010';
    $db_name     = 'Postadb2022_lapostacom104453';*/
    $db_server   = 'us-cdbr-east-05.cleardb.net';
    $db_username = 'b2ca8ba5936d96';
    $db_password = '4c3fc5e5';
    $db_name     = 'heroku_7c1482fd2536ff5';
}

?>