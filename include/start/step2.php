<?php
header("Content-type: text/html; charset=utf-8");

if(is_readable(realpath("../")."/setting.ini")){
    $ini=parse_ini_file("../setting.ini");
    $hostname=$ini['hostname'];
    $username=$ini['username'];
    $password=$ini['password'];
    $datebase=$ini['datebase'];
    $mysqli=new mysqli($hostname,$username,$password,$datebase);


    if($mysqli->connect_error){
        echo $mysqli->connect_error;
        exit();
    }else{
        $mysqli->set_charset("utf8");
    }

    
    if(!$mysqli->query("SHOW TABLES LIKE 'personalinfo'")){
        //基本情報を格納するpersonalinfoテーブルが存在しない
    }else{
        $flg=0;
        if(isset($_POST["submit"])){
            $flg=strip_tags(htmlspecialchars($_POST["flg"],ENT_QUOTES));
            $user=strip_tags(htmlspecialchars($_POST["user"],ENT_QUOTES));
            $password1=strip_tags(htmlspecialchars($_POST["password1"],ENT_QUOTES));
            $email=strip_tags(htmlspecialchars($_POST["email"],ENT_QUOTES));
            if($_POST["submit"]=="Check"){
                $flg=1;
            }elseif($_POST["submit"]=="Back"){
                $flg=0;
            }elseif($_POST["submit"]=="OK"){
                $flg=2;
                $sql="INSERT INTO personalinfo VALUES ('username','$user',0),('password','$password1',0),('email','$email',0)";
                $mysqli->query($sql);
            }
        }else{
            $flg=0;
        }
    }
    $mysqli->close();
}else{
    //settingファイルが無いのでstep1へ
    http_response_code(301);
    header("Location:../../step1.php");
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
                <div class="input_date"><div class="items_user">ユーザー名</div><div class="inputs"><input type="text" name="user" size=40 value="$user" required></div></div>
                <div class="input_date"><div class="items_user">パスワード</div><div class="inputs"><input type="text" name="password1" size=40 value="$password1" required></div></div>
                <div class="input_date"><div class="items_user">メールアドレス</div><div class="inputs"><input type="email" name="email" size=40 value="$email" required></div></div>
                <input type="hidden" name="flg" value="0">
                <div class="entry"><button type="submit" name="submit" value="Check" id="entry-button">Check</button></div>
EOT;
}elseif($flg==1){
    echo "<div class=\"step\">Step2</div>";
    echo "<div class=\"step_title\">ユーザー登録</div>";
    echo "<div class=\"input_date\"><div class=\"items_user\">ユーザー名</div><div class=\"inputs\">$user</div></div>";
    echo "<div class=\"input_date\"><div class=\"items_user\">パスワード</div><div class=\"inputs\">$password1</div></div>";
    echo "<div class=\"input_date\"><div class=\"items_user\">メールアドレス</div><div class=\"inputs\">$email</div></div>";
    echo "<input type=\"hidden\" name=\"user\" value=\"$user\">";
    echo "<input type=\"hidden\" name=\"password1\" value=\"$password1\">";
    echo "<input type=\"hidden\" name=\"email\" value=\"$email\">";
    echo "<input type=\"hidden\" name=\"flg\" value=\"1\">";
    echo "<div class=\"input_date\"><div class=\"items_user\"></div><div class=\"inputs\">以上で登録します、よろしいですか？</div></div>";
    echo "<div class=\"entry\">";
    echo "<button type=\"submit\" name=\"submit\" value=\"OK\" id=\"entry-button\">OK</button>";
    echo "<button type=\"submit\" name=\"submit\" value=\"Back\" id=\"entry-button\">Back</button>";
    echo "</div>";
}elseif($flg==2){
    echo "<div class=\"step\">Step2</div>";
    echo "<div class=\"step_title\">ユーザー登録</div>";
    echo "<div class=\"input_date\"><div class=\"items_user\">ユーザー名</div><div class=\"inputs\">$user</div></div>";
    echo "<div class=\"input_date\"><div class=\"items_user\">パスワード</div><div class=\"inputs\">$password1</div></div>";
    echo "<div class=\"input_date\"><div class=\"items_user\">メールアドレス</div><div class=\"inputs\">$email</div></div>";
    echo "<div class=\"input_date\"><div class=\"items_user\"></div><div class=\"inputs\">ユーザー登録完了</div></div>";
    echo "<div class=\"entry\">";
    echo "<button type=\"button\" name=\"submit\" value=\"next\" id=\"entry-button\" onClick=\"location.href='./step_finish.php'\">Next</button>";
    echo "</div>";
}
echo "</form>";
?>
        </div>
    </body>
</html>
