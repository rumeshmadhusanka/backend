<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';

//get data-------------------------------------------------------------
$rId = $_GET['r_id'];
$status = $_GET['status'];

//update result
try {
    $result = Database::update("service_request", array('r_status' => $status), "r_id = :id", array(':id' => $rId));
} catch (Error $e) {
    echo 'Database Error';
}
echo "SUCCESS";
