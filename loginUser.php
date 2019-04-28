<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once 'Database.php';
require_once 'DataType.php';

//get data
$name=$_POST['log_username'];
$password=$_POST['log_password'];

//validate and prepare
$user=new UserName($name);
$user->validate();
$passHash=hash("sha512",$password);

$sql = "SELECT * FROM user where u_name = '$name' and u_password='$passHash'";
$stmt=$connection->prepare($sql);
$stmt->execute();
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

if($result!=null){
    echo 'SUCCESS';

    foreach ($result as $row=>$col){
        echo 'row:'.$row."  ".'col: '.$col;
    }
}else{
    echo 'FAILED';

}
