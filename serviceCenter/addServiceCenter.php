<?php
if(isset($_SESSION)){
    session_unset();
    session_destroy();
}
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';

//get data-------------------------------------------------------------------------
$name=$_POST['s_name'];
$email=$_POST['s_email'];
$password=$_POST['s_password'];
$city=$_POST['s_city'];
$telephone=$_POST['s_telephone'];
$latitude=$_POST['s_latitude'];
$longitude=$_POST['s_longitude'];


//validate and prepare
$name=new UserName($name);
$email=new Email($email);
$city=new City($city);
$telephone=new Telephone($telephone);
$latitude=new Coordinate($latitude);
$longitude=new Coordinate($longitude);



$name->validate();
$email->validate();
$telephone->validate();
$city->validate();
$latitude->validate();
$longitude->validate();
if (!($name->getValidationStatus() and $email->getValidationStatus()
    and $telephone->getValidationStatus()) and $city->getValidationStatus()
    and  $latitude->getValidationStatus() and $longitude->getValidationStatus()){
    die("Details are not valid");
}
$passHash=hash("sha512",$password);

//DB
try {
    $result = Database::insert("service_station",array('s_name','s_email','s_password'
        ,'s_city','s_telephone','s_latitude','s_longitude')
        ,array($name->getValue(),$email->getValue(),$passHash,$city->getValue(),$telephone->getValue()
        ,$latitude->getValue(),$longitude->getValue()));
}catch (Error $e){
    echo 'Could not connect to database';
    die();
}
//login display

echo 'SUCCESS';
