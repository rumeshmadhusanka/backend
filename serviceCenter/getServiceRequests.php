<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';
$_SESSION['s_id']=1;
Utilities::verifyLogIn("SERVICE_CENTER");
//get data-------------------------------------------------------------
$sId = $_SESSION['s_id']=1;
$status = $_GET['status'];//////////PENDING,DONE,CANCELLED

//find in db
try {
    $result = Database::read("service_request", "s_id = :sId and r_status = :status"
        , array(':sId' => $sId, ':status' => $status), "*");
    echo json_encode($result);
}catch (Error $e){
    echo "Database error";
}
