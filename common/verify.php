<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

$id=$_GET['id'];
$code=$_GET['code'];
try{
    $result = Database::run(
        "select * from verification_code where id = :id order by timestamp desc limit 1",
        array(':id'=>$id));
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $rows = array();
    while ($row = $result->fetch()) {
        $rows[] = $row;
    }
    //echo json_encode($rows);
    if ($rows[0]['value']==$code){
        Database::update("user",array('verified'=>"TRUE"),"u_id = :id",array(':id'=>$id));
        echo "SUCCESS";//todo replace with verify page
    }else{
        echo "ERROR";//todo replace with verify page
    }
}catch (Error $e){
    echo "ERROR DB";//todo replace with verify page
}

