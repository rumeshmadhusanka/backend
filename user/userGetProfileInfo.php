<?php
//get the data from web page via ajax.
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-type:JSON');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

//verify login
$_SESSION['u_id'] = 1;//------------------------------
Utilities::verifyLogIn("USER");
$uId = $_SESSION['u_id'];

//DB
try {
    $result = Database::read("user", 'u_id = :uid',
        array(':uid' => $uId), "u_id,u_name,u_tele,u_email,u_profile_pic");
} catch (Error $e) {
    echo 'FAILED';
}
echo json_encode($result);
