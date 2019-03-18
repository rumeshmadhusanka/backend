<?php header('Access-Control-Allow-Origin: *');
require_once 'common.php';
require_once 'config.php';

$connection = new PDO($dsn, $username, $password, $options);
$username=$_POST['reg_username'];
$telephone=$_POST['reg_telephone'];
$password=$_POST['reg_password'];
$email=$_POST['reg_email'];
$passHash=hash("sha512",$password);
$sql = "insert into user (u_name, u_tele, u_password, u_email)
VALUES ('$username','$telephone','$passHash','$email')";
$stmt=$connection->prepare($sql);
$stmt->execute();
