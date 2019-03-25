<?php
header('Access-Control-Allow-Origin: *');
require_once 'common.php';
require_once 'config.php';


//not working yet
$connection = new PDO($dsn, $username, $password, $options);
$tableName='users';
$firstName=$_POST['firstname'];
$lastName=$_POST['lastname'];
$password=$_POST['password'];
$passHash=hash("sha512",$password);
$sql = "INSERT INTO {$tableName} (`firstname`, `lastname`, `password`) VALUES ({$firstName}, {$lastName}, {$password})";
$stmt=$connection->query($sql);
echo "Successfully addded user to the database";
