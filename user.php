<?php header('Access-Control-Allow-Origin: *');
require_once 'common.php';
require_once 'config.php';

$connection = new PDO($dsn, $username, $password, $options);
$name=$_POST['name'];
$password=$_POST['password'];
$passHash=hash("sha512",$password);
$sql = "SELECT * FROM users where firstname = '$name' and password='$passHash'";
$stmt=$connection->prepare($sql);
$stmt->execute();
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
//$jsonRes=json_encode($result);
//echo $jsonRes;
if($result!=null){
    echo 'SUCCESS';
}else{
    echo 'FAILED';
}
