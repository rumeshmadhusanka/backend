<?php header('Access-Control-Allow-Origin: *');
require_once 'common.php';
require_once 'config.php';

//fake data from frontend
$_POST['username']="pqr";
$_POST['firstname']="firstname";
$_POST['lastname']="last";
$_POST['password']="password";
$_POST['email']="email";
$_POST['age']="24";
$_POST['location']='2.675684';

$connection = new PDO($dsn, $username, $password, $options);
$username=$_POST['username'];
$firstname=$_POST['firstname'];
$lastname=$_POST['lastname'];
$password=$_POST['password'];
$email=$_POST['email'];
$age=$_POST['age'];
$location=$_POST['location'];
$passHash=hash("sha512",$password);
$sql = "insert into users (username, firstname, lastname, password, email, age, location)
VALUES ('$username','$firstname','$lastname','$passHash','$email','$age','$location')";
$stmt=$connection->prepare($sql);
$stmt->execute();
