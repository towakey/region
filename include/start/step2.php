<?php
header("Content-type: text/html; charset=utf-8");

if(is_readable(realpath("../")."/setting.in")){
    //SQLの設定ファイルがあるならLogin.phpへ
    http_response_code(301);
    header("Location:../../login.php");
    exit;
}else{
    $flg=0;
    //echo "Setting Nothing";
    if(isset($_POST["submit"])){
        $flg=strip_tags(htmlspecialchars($_POST["flg"],ENT_QUOTES));
        $username=strip_tags(htmlspecialchars($_POST["username"],ENT_QUOTES));
        $password1=strip_tags(htmlspecialchars($_POST["password1"],ENT_QUOTES));
        $email=strip_tags(htmlspecialchars($_POST["email"],ENT_QUOTES));
        if($flg==1){
            $flg=0;
        }else{
            $flg=1;
        }
    }else{
        $flg=0;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <link rel="stylesheet" type="text/css" href="setup.css">
        <title>Step2 ユーザー情報の登録</title>
    </head>
    <body>
        <div id="wrapper">
<?
echo "<form action=\"{$_SERVER["PHP_SELF"]}\" method=\"POST\">";
if($flg==0){
echo <<<EOT
                <div class="step">Step2</div>
                <div class="step_title">ユーザー登録</div>
                <div class="input_date"><div class="items_user">ユーザー名</div><div class="inputs"><input type="text" name="username" size=40 value="$username" required></div></div>
                <div class="input_date"><div class="items_user">パスワード</div><div class="inputs"><input type="text" name="password1" size=40 value="$password1" required></div></div>
                <div class="input_date"><div class="items_user">メールアドレス</div><div class="inputs"><input type="email" name="email" size=40 value="$email" required></div></div>
                <div class="entry"><input type="submit" name="submit" value="確認する" id="entry-button"></div>
EOT;
}elseif($flg==1){
    echo "<div class=\"step\">Step2</div>";
    echo "<div class=\"step_title\">ユーザー登録</div>";
    echo "<div class=\"input_date\"><div class=\"items_user\">ユーザー名</div><div class=\"inputs\">$username</div></div>";
    echo "<div class=\"input_date\"><div class=\"items_user\">パスワード</div><div class=\"inputs\">$password1</div></div>";
    echo "<div class=\"input_date\"><div class=\"items_user\">メールアドレス</div><div class=\"inputs\">$email</div></div>";
    echo "<input type=\"hidden\" name=\"username\" value=\"$username\">";
    echo "<input type=\"hidden\" name=\"password1\" value=\"$password1\">";
    echo "<input type=\"hidden\" name=\"email\" value=\"$email\">";
    echo "<input type=\"hidden\" name=\"flg\" value=\"$flg\">";
    echo "<div class=\"input_date\"><div class=\"items_user\"></div><div class=\"inputs\">以上で登録します、よろしいですか？</div></div>";
    echo "<div class=\"entry\"><input type=\"button\" name=\"submit\" value=\"ユーザー登録\" id=\"entry-button\" onClick=\"location.href='../../index.php'\"><input type=\"submit\" name=\"submit\" value=\"やり直す\" id=\"entry-button\"></div>";
}
echo "</form>";
?>
        </div>
    </body>
</html>
