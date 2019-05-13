<?php
session_start();
header('Access-Control-Allow-Origin: *');
header('Content-type:JSON');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

Utilities::verifyLogIn("USER");

$email = $_POST['email'];
$password = $_POST['password'];
$passHash = Utilities::encrypt($password);

try {
    $availability = Database::read("user", "u_id = :uid AND u_email = :email AND u_password = :pass",
        array(':uid'=>$_SESSION['u_id'],':email' => $email, ':pass' => $passHash));
    if (json_encode($availability)!= "[]" ) {
        Database::delete("user", "u_email = :email AND u_password = :pass",
            array(':email' => $email, ':pass' => $passHash));
        echo "SUCCESS";
    } else {
        echo "WRONG USERNAME OR PASSWORD";
    }
} catch (Error $e) {
    echo "ERROR";
}
