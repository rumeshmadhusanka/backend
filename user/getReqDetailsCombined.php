<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-type:JSON');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

$uid = $_SESSION['u_id'];
$sql = "select service.service_name,
       service_request.r_description,
       service_station.s_name,
       service_station.s_city,
       DATE_FORMAT(service_request.r_submit_time,'%e/%m/%Y %r')
           as r_submit_time,
       service.cost,
       service_request.r_status,
       service_station.s_telephone
from service_request
         inner join service_station on
    service_request.s_id = service_station.s_id
         inner join service on
    service_request.service_id = service.service_id
where service_request.u_id = :uid";
try {
    $result = Database::run($sql,array(':uid'=>$uid));
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $rows = array();
    while ($row = $result->fetch()) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} catch (Error $e) {
    echo "ERROR";
}
