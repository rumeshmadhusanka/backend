<?php header('Access-Control-Allow-Origin: *');
require_once 'common.php';
require_once 'config.php';

$connection = new PDO($dsn, $username, $password, $options);
$name=$_POST['s_name'];
$email=$_POST['s_email'];
$city=$_POST['s_city'];
$pass=$_POST['s_password'];
$passHassh=hash("sha512",$pass);
$workors=$_POST['s_workers'];
$picture=$_FILES['s_picture'];
//echo implode("|",$picture);
$sql = "insert into service_station (s_name, s_email, s_city,s_workers,s_password, s_picture) values ('$name','$email', '$city','$workors','$passHassh', '$picture' )";
$stmt=$connection->prepare($sql);
$stmt->execute();
echo "Successful";
//header("Location: index.html");
