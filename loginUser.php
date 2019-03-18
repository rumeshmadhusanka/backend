<?php header('Access-Control-Allow-Origin: *');
require_once 'common.php';
require_once 'config.php';

$connection = new PDO($dsn, $username, $password, $options);
$name=$_POST['log_username'];
$password=$_POST['log_password'];

$passHash=hash("sha512",$password);

$sql = "SELECT * FROM user where u_name = '$name' and u_password='$passHash'";
$stmt=$connection->prepare($sql);
$stmt->execute();
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);

if($result!=null){
    echo 'SUCCESS';
}else{
    echo 'FAILED';
}
