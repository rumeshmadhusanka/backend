<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once 'Database.php';
require_once 'DataType.php';

//get data-------------------------------------------------------------
$sId = 1;//$_SESSION['s_id'];
$status = "DONE";//$_GET['status'];
//find pending
$result= Database::read("service_request", "s_id = :sId and r_status = :status"
    , array(':sId' => $sId, ':status' => $status), "*");
echo json_encode($result);
