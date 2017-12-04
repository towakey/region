<?php
header("Content-type: text/html; charset=utf-8");

if(is_readable(realpath("../")."/setting.ini")){
    //SQLの設定ファイルがあるならLogin.phpへ
    http_response_code(301);
    header("Location:../../login.php");
    exit;
}else{
    //echo "Setting Nothing";
    if(isset($_POST["submit"])){
        $hostname=strip_tags(htmlspecialchars($_POST["hostname"],ENT_QUOTES));
        $username=strip_tags(htmlspecialchars($_POST["username"],ENT_QUOTES));
        $password=strip_tags(htmlspecialchars($_POST["password"],ENT_QUOTES));
        $datebase=strip_tags(htmlspecialchars($_POST["datebase"],ENT_QUOTES));
        $flg=strip_tags(htmlspecialchars($_POST["flg"],ENT_QUOTES));
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
        <title>Step1 SQLの設定</title>
    </head>
    <body>
        <div id="wrapper">
<?
echo "<form action=\"{$_SERVER["PHP_SELF"]}\" method=\"POST\">";
if($flg==0){
echo <<<EOT
            <form action="{$_SERVER["PHP_SELF"]}" method="POST">
                <div class="step">Step1</div>
                <div class="step_title">SQLの設定</div>
                <div class="input_date"><div class="items">HostName</div><div class="inputs"><input type="text" name="hostname" value="$hostname" required></div></div>
                <div class="input_date"><div class="items">UserName</div><div class="inputs"><input type="text" name="username" value="$username" required></div></div>
                <div class="input_date"><div class="items">Password</div><div class="inputs"><input type="text" name="password" value="$password" required></div></div>
                <div class="input_date"><div class="items">DateBase</div><div class="inputs"><input type="text" name="datebase" value="$datebase" required></div></div>
                <div class="entry"><input type="submit" name="submit" value="登録する" id="entry-button"></div>
            </form>
EOT;
}elseif($flg==1){
    echo "<div class=\"step\">Step1</div>";
    echo "<div class=\"step_title\">SQLの設定</div>";
    echo "<div class=\"input_date\"><div class=\"items\"></div><div class=\"inputs\">";
    $chk1=FALSE;
    $chk2=FALSE;
    $con=mysql_connect($hostname,$username,$password);
    if(!$con){
        //MySQL Connect Error
        echo "MySQLの接続に失敗しました";
    }else{
        //MySQL Connect OK
        echo "MySQLの接続に成功";
        $chk1=TRUE;
    }
    echo "</div></div>";
    echo "<div class=\"input_date\"><div class=\"items\"></div><div class=\"inputs\">";
    if(!mysql_select_db($datebase,$con)){
        echo "Datebaseの選択に失敗しました";
    }else{
        echo "Datebaseの選択に成功しました";
        $chk2=TRUE;
    }
    echo "</div></div>";
    if($chk1 && $chk2){
        //MySQLへの接続、DBへの接続が成功
        //setting.iniを作成
        $filename=realpath("../")."/setting.ini";
        file_put_contents($filename,"[sql_setting]\nhostname={$hostname}\nusername={$username}\npassword={$password}\ndatebase={$datebase}\n");
        echo "<div class=\"input_date\"><div class=\"items\"></div><div class=\"inputs\">Settingファイルを作成しました";
        echo "</div></div>";
        
        $mysqli=new mysqli($hostname,$username,$password,$datebase);
        if($mysqli->connect_error){
            echo $mysqli->connect_error;
            exit();
        }else{
            $mysqli->set_charset("utf8");
        }
        $sql="CREATE TABLE personalinfo(item VARCHAR(20) NOT NULL,contents VARCHAR(254))";
        mysqli_query($mysqli,$sql);
        $mysqli->close();

        echo "<div class=\"entry\"><input type=\"button\" name=\"submit\" value=\"ユーザー登録へ\" id=\"entry-button\" onClick=\"location.href='./step2.php'\"></div>";
    }else{
        //MySQL、DBのどちらか、もしくは両方の接続が失敗
        echo "<input type=\"hidden\" name=\"hostname\" value=\"$hostname\">";
        echo "<input type=\"hidden\" name=\"username\" value=\"$username\">";
        echo "<input type=\"hidden\" name=\"password\" value=\"$password\">";
        echo "<input type=\"hidden\" name=\"datebase\" value=\"$datebase\">";
        echo "<input type=\"hidden\" name=\"flg\" value=\"$flg\">";
        echo "<div class=\"entry\"><input type=\"submit\" name=\"submit\" value=\"入力をやり直す\" id=\"entry-button\"></div>";
    }
}
echo "</form>";
?>
        </div>
    </body>
</html>
