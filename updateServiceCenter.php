<?php header('Access-Control-Allow-Origin: *');
require_once 'common.php';
require_once 'config.php';

$connection = new PDO($dsn, $username, $password, $options);
$name=$_POST['s_name'];
$email=$_POST['s_email'];
$city=$_POST['s_city'];
$workors=$_POST['s_workers'];
$picture=$_FILES['s_picture'];
echo implode("|",$picture);
$sql = "insert into service_station (s_name, s_email, s_city,s_workers, s_picture) values ('$name','$email', '$city','$workors', '$picture' )";
$stmt=$connection->prepare($sql);
$stmt->execute();