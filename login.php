<?php
require_once(realpath("./")."/include/function.php");

if(isset($_POST["submit"])){
    $user=htmlspecialchars($_POST["username"],ENT_QUOTES);
    $pass=htmlspecialchars($_POST["password"],ENT_QUOTES);
    if(is_readable(realpath("./include")."/setting.ini")){
        $login_auth=new login_auth();
        if($login_auth->auth($user,$pass)){
            session_start();
            $_SESSION["USERID"]=$user;
            $login_auth->close();
            http_response_code(301);
            header("Location:./index.php");
            exit;
        }else{
        }
        $login_auth->close();
    }else{
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>login</title>
        <link rel="stylesheet" type="text/css" href="login.css">
    </head>
    <body>
        <div id="wrapper">
            <div id="login_box">
                <form action="<?=$_SERVER["PHP_SELF"]?>" method="POST">
                    <div class="title_block"><div class="title_contents">ユーザー名とパスワードの入力</div></div>
                    <div class="input_block"><div class="item">ユーザー名</div><div class="contents"><input type="text" name="username" value="" size="30"></div></div>
                    <div class="input_block"><div class="item">パスワード</div><div class="contents"><input type="password" name="password" value="" size="30"></div></div>
                    <div class="input_block"><button type="submit" name="submit" id="login_button">ログイン</button></div>
                </form>
            </div>
        </div>
    </body>
</html>
