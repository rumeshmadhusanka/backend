<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-type:JSON');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';
//$_POST['s_id']=30;
//no login check
//DB
try{
    if (isset($_POST['s_id'])){
        $sId=$_POST['s_id'];
        $result = Database::read("service_station", "s_id = :sid",
            array(':sid'=>$sId), "*");
        echo json_encode($result);
    }else {
        $result = Database::read("service_station", "", array(), "s_id,s_name,s_city");
        echo json_encode($result);
    }
}catch (Error $e){
    echo "DB error";
}
