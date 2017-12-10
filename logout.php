<?php
require_once(realpath("./")."/include/function.php");

if(isset($_POST["submit"])){
    $check=$_POST["submit"];
    if($check==="yes"){
        //セッション変数をすべて解除
        $_SESSION=array();
        //セッションクッキーの削除
        if(isset($_COOKIE[session_name()])){
            setcookie(session_name(),'',time()-42000,'/');
        }
        session_destroy();
        http_response_code(301);
        header("Location:./login.php");
        exit;
    }else{
        http_response_code(301);
        header("Location:./index.php");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>logout</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <div id="wrapper">
            <div id="login_box">
                <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
                    <div class="title_block"><div class="title_contents">ログアウトしますか？</div></div>
                    <div class="input_block"><button type="submit" name="submit" id="login_button" value="yes">はい</button></div>
                    <div class="input_block"><button type="submit" name="submit" id="login_button" value="no">いいえ</button></button></div>
                </form>
            </div>
        </div>
    </body>
</html>
