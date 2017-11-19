<?php
header("Content-type: text/html; charset=utf-8");

if(!is_readable("./setting.ini")){
    $err="Setting fils is Nothing";
    echo $err;
}
?>
