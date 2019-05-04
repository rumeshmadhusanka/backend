<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

//get data
$name="susan";//$_POST['log_username'];
$password="password";//$_POST['log_password'];

//validate and prepare
$user=new UserName($name);
$user->validate();
$passHash=Utilities::encrypt($password);

//DB
try {
    $result = Database::read("user", 'u_name = :name and u_password= :pass',
        array(':name' => $user->getValue(), ':pass' => $passHash), "u_id,u_name,u_email,u_profile_pic");
}catch (Error $e){
    echo 'Could not connect to database';
}
//display
if($result!=null){
    $_SESSION['user']=$result;
    $_SESSION['u_id']=$result[0]['u_id'];
//    echo json_encode($_SESSION['u_id']);
//    echo json_encode($_SESSION['user']);

}else{
    echo 'FAILED';
}
