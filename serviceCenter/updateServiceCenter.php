<?php
//get data from web page via ajax.
// Unfilled data must be submitted as null values
//cannot change profile pic
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';

//verify login
//$_SESSION['s_id'] = 25;//------------------------------
Utilities::verifyLogIn("SERVICE_CENTER");
$sId = $_SESSION['s_id'];

////simulation--------------------------------------------
//$_POST['up_name'] = "PQR";
//$_POST['up_password'] = "password";
//$_POST['up_email'] = "pqr@gmail.com";
//$_POST['up_telephone'] = "";
//$_POST['up_city'] = "";
//$_POST['up_latitude'] = "54.8758";
//$_POST['up_longitude'] = "45.4774";

//merge data array for non null values
$data = array();
if ($_POST['up_name'] != "") {
    $userName = new UserName($_POST['up_name']);
    $userName->validate();
    if (!$userName->getValidationStatus()) {
        die("User name not valid");
    }
    $i = array('s_name' => $userName->getValue());
    $data = array_merge($data, $i);
}
if ($_POST['up_password'] != "") {
    $i = array('s_password' => Utilities::encrypt($_POST['up_password']));
    $data = array_merge($data, $i);
}
if ($_POST['up_telephone'] != "") {
    $userTele = new Telephone($_POST['up_telephone']);
    $userTele->validate();
    if (!$userTele->getValidationStatus()) {
        die("Tele not valid");
    }
    $i = array('s_telephone' => $userTele->getValue());
    $data = array_merge($data, $i);
}
if ($_POST['up_email'] != "") {
    $userEmail = new Email($_POST['up_email']);
    $userEmail->validate();
    if (!$userEmail->getValidationStatus()) {
        die("Email not valid");
    }
    $i = array('s_email' => $userEmail->getValue());
    $data = array_merge($data, $i);
}
if ($_POST['up_city'] != "") {
    $city = new City($_POST['up_city']);
    $city->validate();
    if (!$city->getValidationStatus()) {
        die("City not valid");
    }
    $i = array('s_city' => $city->getValue());
    $data = array_merge($data, $i);
}
if ($_POST['up_latitude'] != "") {
    $latitude = new Coordinate($_POST['up_latitude']);
    $latitude->validate();
    if (!$latitude->getValidationStatus()) {
        die("Latitude not valid");
    }
    $i = array('s_latitude' => $latitude->getValue());
    $data = array_merge($data, $i);
}
if ($_POST['up_longitude'] != "") {
    $longitude = new Coordinate($_POST['up_longitude']);
    $longitude->validate();
    if (!$longitude->getValidationStatus()) {
        die("longitude not valid");
    }
    $i = array('s_longitude' => $longitude->getValue());
    $data = array_merge($data, $i);
}
echo json_encode($data);
//DB
try {
    $result = Database::update("service_station", $data, "s_id = :sid", array(':sid' => $sId));

} catch (Error $e) {
    echo 'Could not connect to database';
    die();
}

echo 'SUCCESS';
