<?php 

if ($_SERVER['HTTP_HOST'] == 'laposta2021.herokuapp.com') {
    $db_server   = 'us-cdbr-east-04.cleardb.com';
    $db_username = 'b187311181ea3a';
    $db_password = '4de3c0bc';
    $db_name     = 'heroku_f6286574aa75e0d';
} else if ($_SERVER['HTTP_HOST'] == 'laposta.local')  {
    $db_server   = 'localhost';
    $db_username = 'admin';
    $db_password = '123456';
    $db_name     = 'laposta_db_2021';
}

?>