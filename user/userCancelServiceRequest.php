<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

Utilities::verifyLogIn("USER");

//get data
$rId = $_GET['r_id'];

//update result
try {
    $result = Database::update("service_request", array('r_status' => "CANCELLED"), "r_id = :id"
        , array(':id' => $rId));
} catch (Error $e) {
    echo 'Database Error';
}
echo "SUCCESS";
