<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';
//ServiceStationAll.php
//test data-----------------------
$_SESSION['s_id'] = 31;
//$_POST['select'] = "ADD_SERVICE";
//--------------------------------

//get data to select the function
$select = trim($_POST['select']);

//select the function
if ($select == "LOGIN") {
    login();
}
if ($select == "LOGOUT") {
    logout();
}
if ($select == "ADD_STATION") {
    addStation();
}
if ($select == "GET_STATION_DETAILS") {
    getServiceStationDetails();
}
if ($select == "GET_SERVICE_REQUESTS") {
    getServiceRequests();
}
if ($select == "UPDATE_SERVICE_STATION") {
    updateServiceStation();
}
if ($select == "UPDATE_REQUEST_STATUS") {
    updateRequestStatus();
}
if ($select == "SHOW_SALES_STATUS") {
    showSalesStatus();
}
if ($select == "UPLOAD_PIC") {
    uploadPic();
}
if ($select == "DELETE_STATION") {
    deleteStation();
}
if ($select == "ADD_SERVICE") {
    addService();
}
if ($select == "REMOVE_SERVICE") {
    removeService();
}
if ($select == "CHANGE_SER_AVAIL") {
    changeServiceAvailability();
}

function login()
{
    $email = $_POST['email'];
    $password = $_POST['password'];
    $passHash = Utilities::encrypt($password);
    try {
        $result = Database::read("service_station", 's_email = :mail and s_password= :pass',
            array(':mail' => $email, ':pass' => $passHash),
            "s_id,s_name,s_email,s_city,s_telephone,s_latitude,s_longitude,s_picture");
        if (json_encode($result) != "[]") {
            echo 'SUCCESS';
            $_SESSION['user'] = $result;
            $_SESSION['s_id'] = $result[0]['s_id'];
        } else {
            echo "ERROR";
        }
    } catch (Error $e) {
        echo "ERROR";
    }
}

function addStation()
{
    if (isset($_SESSION)) {
        session_unset();
        session_destroy();
    }
    session_start();

    //get data-------------------------------------------------------------------------
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $city = $_POST['city'];
    $telephone = $_POST['telephone'];
    $latitude = $_POST['latitude'];
    $longitude = $_POST['longitude'];


//validate and prepare
    $name = new UserName($name);
    $email = new Email($email);
    $city = new City($city);
    $telephone = new Telephone($telephone);
    $latitude = new Coordinate($latitude);
    $longitude = new Coordinate($longitude);


    $name->validate();
    $email->validate();
    $telephone->validate();
    $city->validate();
    $latitude->validate();
    $longitude->validate();
    if (!($name->getValidationStatus() and $email->getValidationStatus()
            and $telephone->getValidationStatus()) and $city->getValidationStatus()
        and $latitude->getValidationStatus() and $longitude->getValidationStatus()) {
        die("Details are not valid");
    }
    $passHash = hash("sha512", $password);

//DB
    try {
        Database::insert("service_station", array('s_name', 's_email', 's_password'
            , 's_city', 's_telephone', 's_latitude', 's_longitude')
            , array($name->getValue(), $email->getValue(), $passHash, $city->getValue(), $telephone->getValue()
            , $latitude->getValue(), $longitude->getValue()));
    } catch (Error $e) {
        echo 'Could not connect to database';
        die();
    }
//login display

    echo 'SUCCESS';
}

function getServiceStationDetails()
{
    Utilities::verifyLogIn("SERVICE_CENTER");
    $sId = $_SESSION['s_id'];
    try {
        $result = Database::read("service_station", "s_id = :sid",
            array(':sid' => $sId),
            "s_id,s_name,s_email,s_city,s_telephone,s_latitude,s_longitude,s_picture");
        echo json_encode($result);
    } catch (Error $e) {
        echo "ERROR";
    }
}

function updateServiceStation()
{
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
    //echo json_encode($data);
//DB
    try {
        Database::update("service_station", $data, "s_id = :sid", array(':sid' => $sId));

    } catch (Error $e) {
        echo 'Could not connect to database';
        die();
    }

    echo 'SUCCESS';

}

function getServiceRequests()
{
    Utilities::verifyLogIn("SERVICE_CENTER");
    $sId = $_SESSION['s_id'];
    $status = $_POST['status'];//////////PENDING,DONE,CANCELLED

//find in db
    try {
        $result = Database::read("service_request", "s_id = :sId and r_status = :status"
            , array(':sId' => $sId, ':status' => $status), "*");
        echo json_encode($result);
    } catch (Error $e) {
        echo "Database error";
    }
}

function updateRequestStatus()
{
    Utilities::verifyLogIn("SERVICE_CENTER");
    $rId = $_POST['r_id'];
    $status = $_POST['status'];

//update result
    try {
        $result = Database::update("service_request", array('r_status' => $status), "r_id = :id", array(':id' => $rId));
    } catch (Error $e) {
        echo 'Database Error';
    }
    echo "SUCCESS";

}

function showSalesStatus()
{

}

function uploadPic()
{

//puts the image in a new name to the directory 'uploads'
//'uploads' dir should exist
//On success, will echo 'OK'
//new name should be saved into the database
    Utilities::verifyLogIn("SERVICE_CENTER");

    $target_dir = "../uploads/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            //echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }
    }
// Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
        && $imageFileType != "gif") {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    $newFileName = uniqid('uploaded-');
    $newTarget = $target_dir . $newFileName . "." . $imageFileType;  ////////////new full name plus path
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
        die();
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newTarget)) {
            //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
            Database::update('service_station',
                array('s_picture' => $newTarget),
                's_id= :id',
                array(':id' => $_SESSION['s_id']));
            echo 'SUCCESS';
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }

}

function deleteStation()
{
    Utilities::verifyLogIn("SERVICE_CENTER");

    $email = $_POST['email'];
    $password = $_POST['password'];
    $passHash = Utilities::encrypt($password);

    try {
        $availability = Database::read("service_station", "s_id = :sid AND s_email = :email AND s_password = :pass",
            array(':sid' => $_SESSION['s_id'], ':email' => $email, ':pass' => $passHash));
        if (json_encode($availability) != "[]") {
            Database::delete("service_station", "s_email = :email AND s_password = :pass",
                array(':email' => $email, ':pass' => $passHash));
            echo "SUCCESS";
            //Utilities::log_out();
        } else {
            echo "WRONG USERNAME OR PASSWORD";
        }
    } catch (Error $e) {
        echo "ERROR";
    }
}

function logout()
{
    Utilities::log_out();
}

function addService()
{
    Utilities::verifyLogIn("SERVICE_CENTER");
    $sid = $_SESSION['s_id'];
    $cost = $_POST['cost']=5000;
    $name = $_POST['name']="gear box repair";


    try {
        $res = Database::insert("service", array('s_id', 'service_name', 'cost'),
            array($sid, $name, $cost));
        if ($res == true) {
            echo "SUCCESS";
        } else {
            echo "ERROR";
        }
    } catch (Error $e) {
        echo "ERROR";
    }

}

function changeServiceAvailability()
{

}

function removeService()
{

}
