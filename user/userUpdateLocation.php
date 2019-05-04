<?php //call this script to put data to the database via a ajax GET request
//update users location every 2 seconds via calling this script.
//Echos 'SUCCESS' on success
//Adds the session var 'current_location' (array)
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/Utilities.php';

Utilities::verifyLogIn("USER");

////Test Data
//$_GET['u_id']=1;
//$_GET['latitude']=51.507351;
//$_GET['longitude']=-0.127758;

//get data
$userId=$_GET['u_id'];
$latitude=$_GET['latitude'];
$longitude=$_GET['longitude'];

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
    //echo json_encode($_SESSION['current_location']);
    //echo $_SESSION['current_location']['latitude'];
    echo 'SUCCESS';
}else{
    echo 'FAILED';
}
