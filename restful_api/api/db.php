<?php

$objConn = null;
$db_host = 'localhost';
$db_name = 'asm_androidnetworking';
$db_user = 'root';
$db_pass = '';

try{
    $objConn =new PDO("mysql:host=$db_host;dbname=$db_name",$db_user,$db_pass);
    $objConn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    die('loi ket noi'. $e->getMessage());
}
