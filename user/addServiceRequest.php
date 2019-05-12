<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

////Test data
$_SESSION['u_id']=2;
//$_POST['service_id']=8;
//$_POST['r_description']="description";
//$_POST['r_latitude']="3.3434";
//$_POST['r_longitude']="3.676";

Utilities::verifyLogIn("USER");

//get data-------------------------------------------------------------
$serviceId = $_POST['service_id'];
$description = $_POST['r_description'];
$latitude = $_POST['r_latitude'];
$longitude = $_POST['r_longitude'];
$uId = $_SESSION['u_id'];

//DB
try {
    //find s_id for service id
    $result = Database::read("service", "service_id = :s", array(':s' => $serviceId), "s_id");
    $s_id = $result[0]['s_id'];

    $result = Database::insert("service_request",
        array('u_id', 's_id', 'service_id', 'r_description', 'r_latitude', 'r_longitude')
        , array($uId, $s_id, $serviceId, $description, $latitude, $longitude));
} catch (Error $e) {
    echo 'Could not connect to database';
    die();
}

echo 'SUCCESS';
