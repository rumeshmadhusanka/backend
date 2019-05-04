<?php
session_start();
//get the data from web page via ajax.
// Unfilled data must be submitted as null values
//cannot change profile pic
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

//verify login
//$_SESSION['u_id'] = 2;//------------------------------
Utilities::verifyLogIn("USER");
$uId = $_SESSION['u_id'];

////simulation--------------------------------------------
//$_POST['up_username']="PQR";
//$_POST['up_password']="password";
//$_POST['up_email']="pqr@gmail.com";
//$_POST['up_telephone']="";

//merge data array for non null values
$data=array();
if ($_POST['up_username']!=""){
    $userName = new UserName($_POST['up_username']);
    $userName->validate();
    if (!$userName->getValidationStatus()){
        die("User name not valid");
    }
    $i=array('u_name'=>$userName->getValue());
    $data=array_merge($data,$i);
}
if ($_POST['up_password']!=""){
    $i=array('u_password'=>Utilities::encrypt($_POST['up_password']));
    $data=array_merge($data,$i);
}
if ($_POST['up_telephone']!=""){
    $userTele = new Telephone($_POST['up_telephone']);
    $userTele->validate();
    if (!$userTele->getValidationStatus()){
        die("Tele not valid");
    }
    $i=array('u_tele'=>$userTele->getValue());
    $data=array_merge($data,$i);
}
if ($_POST['up_email']!=""){
    $userEmail = new Email($_POST['up_email']);
    $userEmail->validate();
    if (!$userEmail->getValidationStatus()){
        die("Email not valid");
    }
    $i=array('u_email'=>$userEmail->getValue());
    $data=array_merge($data,$i);
}

//DB
try {
    $result = Database::update("user",$data,"u_id = :uid",array(':uid'=>$uId));
} catch (Error $e) {
    echo 'Could not connect to database';
    die();
}

echo 'SUCCESS';
