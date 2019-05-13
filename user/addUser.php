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
$name=$_POST['reg_username']="bu";
$password=$_POST['reg_password']="password";
$telephone=$_POST['reg_telephone']="875678657";
$email=$_POST['reg_email']="adf@gmail.com";

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
        ,array($userName->getValue(),$userTele->getValue(),$passHash,$userEmail->getValue()));
}catch (Error $e){
    echo 'Could not connect to database';
    die();
}
//login display

echo 'SUCCESS';
