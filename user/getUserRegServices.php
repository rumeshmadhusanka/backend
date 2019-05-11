<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

////Test data
$_SESSION['u_id'] = 2;

//get data
$uid = $_SESSION['u_id'];
try{
    $result=Database::read("service_request","u_id = :uid",array(':uid'=>$uid),"*");
    echo json_encode($result);
}catch (Error $e){
    echo "ERROR";
}
