<?php
header("Content-type: text/html; charset=utf-8");

if(is_readable(realpath("../")."/setting.in")){
    //SQLの設定ファイルがあるならLogin.phpへ
    http_response_code(301);
    header("Location:../../login.php");
    exit;
}else{
    //echo "Setting Nothing";
    if(isset($_POST["submit"])){
        //
        $flg=1;
        $hostname=strip_tags(htmlspecialchars($_POST["hostname"],ENT_QUOTES));
        $username=strip_tags(htmlspecialchars($_POST["username"],ENT_QUOTES));
        $password=strip_tags(htmlspecialchars($_POST["password"],ENT_QUOTES));
        $datebase=strip_tags(htmlspecialchars($_POST["datebase"],ENT_QUOTES));
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
if($flg==0){
echo <<<EOT
            <form action="{$_SERVER["PHP_SELF"]}" method="POST">
                <div class="step">Step2</div>
                <div class="step_title">ユーザー登録</div>
                <div class="input_date"><div class="items_user">ユーザー名</div><div class="inputs"><input type="text" name="hostname" value="$hostname"></div></div>
                <div class="input_date"><div class="items_user">パスワード</div><div class="inputs"><input type="text" name="username" value="$username"></div></div>
                <div class="input_date"><div class="items_user">パスワード（確認）</div><div class="inputs"><input type="text" name="password" value="$password"></div></div>
                <div class="input_date"><div class="items_user">メールアドレス</div><div class="inputs"><input type="text" name="datebase" value="$datebase"></div></div>
                <div class="entry"><input type="submit" name="submit" value="登録する" id="entry-button"></div>
            </form>
EOT;
}elseif($flg==1){
    echo "<div class=\"step\">Step1</div>";
    echo "<div class=\"step_title\">SQLの設定</div>";
    echo "<div class=\"input_date\"><div class=\"items\"></div><div class=\"inputs\">";
    $con=mysql_connect($hostname,$username,$password);
    if(!$con){
        //MySQL Connect Error
        echo "MySQLの接続に失敗しました";
    }else{
        //MySQL Connect OK
        echo "MySQLの接続に成功";
    }
    echo "</div></div>";
    echo "<div class=\"input_date\"><div class=\"items\"></div><div class=\"inputs\">";
    if(!mysql_select_db($datebase,$con)){
        echo "Datebaseの選択に失敗しました";
    }else{
        echo "Datebaseの選択に成功しました";
    }
    echo "</div></div>";
    echo "<div class=\"entry\"><input type=\"submit\" name=\"submit\" value=\"ユーザー登録する\" id=\"entry-button\"></div>";
}
?>
        </div>
    </body>
</html>
