<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once 'Database.php';
require_once 'DataType.php';

//get data-------------------------------------------------------------
$sId = $_SESSION['s_id'];
$status = $_GET['status'];//////////PENDING,DONE,CANCELLED

//find in db
try {
    $result = Database::read("service_request", "s_id = :sId and r_status = :status"
        , array(':sId' => $sId, ':status' => $status), "*");
    echo json_encode($result);
}catch (Error $e){
    echo "Database error";
}
