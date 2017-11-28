<?php
header("Content-type: text/html; charset=utf-8");

$path=dirname(__FILE__)."/";
if(!is_readable($path."setting.ini")){
    $err="Setting fils is Not Found";
    echo $err;
}
$ini_path=$path."setting.ini";
$ini=parse_ini_file($ini_path,true);

$sql_user=$ini["sql_setting"]["user"];
$sql_pass=$ini["sql_setting"]["pass"];


?>
