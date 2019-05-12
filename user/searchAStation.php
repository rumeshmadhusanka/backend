<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

//$keyWord = "full";
//$table = "service";

//Get data
$keyWord = $_POST['keyword'];
$table = $_POST['table'];

try {
    $stations = Database::read($table, "service_name LIKE :s", array(':s' => "%" . $keyWord . "%"), "s_id");
    $result = array();
    foreach ($stations as $val) {
        $a = Database::read("service_station", "s_id = :id", array(':id' => $val['s_id']));
        $result = array_merge($result, $a);
    }
    $result=array_unique($result,SORT_REGULAR);
    echo json_encode(array_values($result));
} catch (Error $e) {
    echo "ERROR";
}
