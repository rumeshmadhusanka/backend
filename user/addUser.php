<?php
if(isset($_SESSION)){
    session_unset();
    session_destroy();
}
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

//get data
$name=$_POST['reg_username'];
$password=$_POST['reg_password'];
$telephone=$_POST['reg_telephone'];
$email=$_POST['reg_email'];

//validate and prepare
$userName=new UserName($name);
$userTele=new Telephone($telephone);
$userEmail=new Email($email);

$userName->validate();
$userTele->validate();
$userEmail->validate();
if (!($userName->getValidationStatus() and $userEmail->getValidationStatus()
    and $userTele->getValidationStatus())){
    die("Details are not valid");
}
$passHash=Utilities::encrypt($password);

//DB
try {
    $result = Database::insert("user",array('u_name','u_tele','u_password','u_email')
        ,array($userName,$userTele,$passHash,$userEmail));
}catch (Error $e){
    echo 'Could not connect to database';
    die();
}
//login display

echo 'SUCCESS';
