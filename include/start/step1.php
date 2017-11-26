<?php
header("Content-type: text/html; charset=utf-8");

$path=realpath("../");
if(is_readable($path."/setting.in")){
    //SQLの設定ファイルがあるならLogin.phpへ
    http_response_code(301);
    header("Location:../../login.php");
    exit;
}else{
    //echo "Setting Nothing";
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="setup.css">
        <title>Step1 SQLの設定</title>
    </head>
    <body>
        <div id="wrapper">
            <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
                <div class="step">Step1</div>
                <div class="step_title">SQLの設定</div>
                <div class="input_date"><div class="items">HostName</div><div class="inputs"><input type="text"></div></div>
                <div class="input_date"><div class="items">UserName</div><div class="inputs"><input type="text"></div></div>
                <div class="input_date"><div class="items">Password</div><div class="inputs"><input type="text"></div></div>
                <div class="input_date"><div class="items">DateBase</div><div class="inputs"><input type="text"></div></div>
                <div class="entry"><input type="submit" name="submit" value="登録する" id="entry-button"></div>
            </form>
        </div>
    </body>
</html>
