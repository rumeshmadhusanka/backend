<?php
session_start();
//send ajax post  request
//on a SUCCESSFUL login this script will echo 'SUCCESS'
//session vars will be created:  a whole json object of the user, u_id
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

////Testing
//$_POST['log_email']="susan@gmail.com";
//$_POST['log_password']="password";


//get data
$email = $_POST['log_email'];
$password = $_POST['log_password'];


//validate and prepare
$email = new Email($email);
$email->validate();
$passHash = Utilities::encrypt($password);

//DB
try {
    $result = Database::read("user", 'u_email = :mail and u_password= :pass',
        array(':mail' => $email->getValue(), ':pass' => $passHash), "u_id,u_name,u_tele,u_email,u_profile_pic");
} catch (Error $e) {
    echo 'Could not connect to database';
}
//display
if ($result != null) {
    $_SESSION['user'] = $result;
    $_SESSION['u_id'] = $result[0]['u_id'];
//    echo json_encode($_SESSION['u_id']);
//    echo json_encode($_SESSION['user']);
    echo 'SUCCESS';
} else {
    echo 'FAILED';
}
