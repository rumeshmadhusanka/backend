<?php //call this script to put data to the database via a ajax request
//update users location every 2 seconds via calling this script.
session_start();
header('Access-Control-Allow-Origin: *');
require_once 'common/Database.php';

//get data
$userId=1;//$_GET['u_id'];
$latitude=51.507351;//$_GET['latitude'];
$longitude=-0.127758;//$_GET['longitude'];

//DB
try {
    $result = Database::insert("user_location",array('u_id','latitude','longitude')
        ,array($userId,$latitude,$longitude));
}catch (Error $e){
    echo 'Could not connect to database';
}
//display
if($result!=null){
    $_SESSION['current_location']=array('latitude'=>$latitude,'longitude'=>$longitude);
    echo json_encode($_SESSION['current_location']);
    //echo $_SESSION['current_location']['latitude'];
}else{
    echo 'FAILED';
}
