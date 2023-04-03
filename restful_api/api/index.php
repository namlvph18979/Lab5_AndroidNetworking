<?php
// header('Content-Type: application/json; charset=utf-8');

require_once('db.php');

if(!isset($_GET['res']))
    die('Resource notfound');

$file = $_GET['res'];

$file_path = __DIR__.'/'.$file.'.php';


if( file_exists(  $file_path   ) )
    require_once $file_path;
else
    die('File notfound: ' . $file );
?>