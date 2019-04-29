<?php header('Access-Control-Allow-Origin: *');
require_once 'Database.php';

//$_GET['keyword']="full";//del when actually using---------------------
$connection = Database::get_connection();
if (isset($_GET)) {
    $keyWord=$_GET['keyword'];
}elseif ($_GET['keyword']===''){
    die();
}

//$sql = "SELECT * FROM service WHERE service_name LIKE '%%$keyWord%%' LIMIT 3";
$result=Database::read("service","service_name LIKE '%%$keyWord%%' LIMIT 5",
    array(),"*");

//display
if($result!=null){
    $_SESSION['services']=$result;
    echo json_encode($result);
}else{
    echo 'NULL';
}
//header("Location: index.html");
