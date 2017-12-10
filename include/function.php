<?php
header("Content-type: text/html; charset=utf-8");

$path=dirname(__FILE__)."/";
if(!is_readable($path."setting.ini")){
    http_response_code(301);
    header("Location:../../login.php");
    exit;
}

class login_auth{
    private $mysqli;

    function __construct(){
        $path=dirname(__FILE__);
        $ini_path=$path."/setting.ini";

        $ini=parse_ini_file($ini_path,true);

        $hostname=$ini["sql_setting"]["hostname"];
        $username=$ini["sql_setting"]["username"];
        $password=$ini["sql_setting"]["password"];
        $datebase=$ini["sql_setting"]["datebase"];

        $this->mysqli=new mysqli($hostname,$username,$password,$datebase);
        $this->mysqli->set_charset("utf8");
    }
    function auth($input_user,$input_pass){
        $sql="SELECT * FROM personalinfo WHERE item = 'username' OR item = 'password'";
        if($result=$this->mysqli->query($sql)){
            while($row=$result->fetch_assoc()){
                switch($row["item"]){
                    case "username":
                    $user=$row["contents"];
                    break;
                    case "password":
                    $pass=$row["contents"];
                    break;
                }
            }
            $result->close();
            if($user === $input_user && $pass === $input_pass){
                return TRUE;
            }else{
                return FALSE;
            }
        }else{
            return FALSE;
        }
    }
    function check(){
        
    }
    function close(){
        $this->mysqli->close();
    }
}

function login_check(){
    $path=dirname(__FILE__);
    $ini_path=$path."/setting.ini";

    $ini=parse_ini_file($ini_path,true);

    $hostname=$ini["sql_setting"]["hostname"];
    $username=$ini["sql_setting"]["username"];
    $password=$ini["sql_setting"]["password"];
    $datebase=$ini["sql_setting"]["datebase"];

    $mysqli=new mysqli($hostname,$username,$password,$datebase);
    $mysqli->set_charset("utf8");

    $sql="SELECT * FROM personalinfo WHERE item = 'username'";
    if($result=$mysqli->query($sql)){
        while($row=$result->fetch_assoc()){
            switch($row["item"]){
                case "username":
                $user=$row["contents"];
                break;
            }
        }
        $result->close();

        $session_user=$_SESSION["USERID"];
        
        if($user === $session_user){
            return TRUE;
        }else{
            return FALSE;
        }
    }else{
        return FALSE;
    }

    $mysqli->close();
}

?>
