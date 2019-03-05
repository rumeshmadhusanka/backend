<?php header('Access-Control-Allow-Origin: *');
require_once 'common.php';
require_once 'config.php';

$connection = new PDO($dsn, $username, $password, $options);
$name=$_POST['name'];
$sql = "SELECT * FROM users where firstname = '$name'";
$stmt=$connection->prepare($sql);
$stmt->execute();
$result=$stmt->fetchAll(PDO::FETCH_ASSOC);
$jsonRes=json_encode($result);
echo $jsonRes;
