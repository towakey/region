<?php
    http_response_code(301);
    //header("Location:include/start/step2.php");
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
                <form action="<?=$_SERVER["PHP_SELF"]?>" method="post">
                    <div class="input_block"><div class="item">ユーザー名</div><div class="contents"><input type="text" name="" value="" size="30"></div></div>
                    <div class="input_block"><div class="item">パスワード</div><div class="contents"><input type="text" name="" value="" size="30"></div></div>
                    <div class="input_block"><button id="login_button">ログイン</button></div>
                </form>
            </div>
        </div>
    </body>
</html>
