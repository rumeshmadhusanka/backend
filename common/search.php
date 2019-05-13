<?php header('Access-Control-Allow-Origin: *');
require_once 'Utilities.php';

//$_GET['keyword']="full";//del when actually using---------------------
$keyWord="";
$table="";
if (isset($_GET)) {
    $keyWord=$_GET['keyword'];
    $table=$_GET['table'];
}elseif ($_GET['keyword']===''){
    die();
}

if ($table=="service") {
    $field="service_name";
    echo Utilities::searchFromServiceTable($table, $field, $keyWord);
}else if ($table=="service_station"){
    $field="s_name";
    echo Utilities::searchFromServiceTable($table, $field, $keyWord);
}else{
    echo "ERROR";
}
