<?php
require_once(realpath("./")."/include/function.php");
session_start();
if(login_check()){
    echo"session_ok";
}else{
    http_response_code(301);
    header("Location:./login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>legion</title>
    </head>
    <body>
        <a href="logout.php">ログアウト</a>
    </body>
</html>
