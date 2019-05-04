<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';

//get data-------------------------------------------------------------
$serviceId = 8;//$_GET['service_id'];
$description = "description";//$_GET['r_description'];
$latitude = "3.3434";//$_GET['r_latitude'];
$longitude = "3.676";//$_GET['r_longitude'];
$uId = 1;//$_SESSION['u_id'];

//find s_id for service id
$result=Database::read("service","service_id = :s",array(':s'=>$serviceId),"s_id");
$s_id=$result[0]['s_id'];
//DB
try {
    $result = Database::insert("service_request",
        array('u_id', 's_id', 'service_id', 'r_description','r_latitude','r_longitude')
        , array($uId, $s_id, $serviceId, $description,$latitude,$longitude));
} catch (Error $e) {
    echo 'Could not connect to database';
    die();
}
//login display

echo 'SUCCESS';
