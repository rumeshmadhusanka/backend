<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-type:JSON');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

//no login check
//get data
if (!isset($_GET)){
    die("GET data not defined");
}
$sId=$_GET['s_id'];
//DB
try{
    $result=Database::read("service","s_id = :sId and availability = :ava",
        array(':sId'=>$sId,':ava'=>'TRUE'),"service_id, service_name, cost, availability");
    echo json_encode($result);
}catch (Error $e){
    echo "DB error";
}
