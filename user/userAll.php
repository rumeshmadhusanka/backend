<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Database.php';
require_once '../common/DataType.php';
require_once '../common/Utilities.php';
//ServiceStationAll.php
//test data-----------------------
$_SESSION['u_id'] = 1;
//$_POST['select'] = "SHOW_SALES_STATUS";
//--------------------------------

//get data to select the function
$select = trim($_POST['select']);

if ($select == "LOGIN") {
    login();
}
if ($select == "LOGOUT") {
    logout();
}
if ($select == "GET_SERVICE_STATIONS") {
    getServiceStations();
}
if ($select == "SIGN_UP") {
    signUp();
}
if ($select == "GET_SERVICES_IN_STATION") {
    getServiceStations();
}
if ($select == "GET_REQUEST_DETAILS") {
    getRequestDetails();
}
if ($select == "DELETE_USER") {
    deleteUser();
}
if ($select == "ADD_SERVICE_REQUEST") {
    addServiceRequest();
}
if ($select == "SEARCH_STATION") {
    searchAStation();
}
if ($select == "UPDATE_PROFILE") {
    updateProfile();
}
if ($select == "UPDATE_LOCATION") {
    updateLocation();
}
if ($select == "GET_PROFILE_INFO") {
    getProfileInfo();
}
if ($select == "CANCEL_REQUEST") {
    cancelRequest();
}

function login()
{
    $email = $_POST['log_email'];
    $password = $_POST['log_password'];

//validate and prepare
    $email = new Email($email);
    $email->validate();
    $passHash = Utilities::encrypt($password);

//DB
    try {
        $result = Database::read("user", 'u_email = :mail and u_password= :pass',
            array(':mail' => $email->getValue(), ':pass' => $passHash),
            "u_id,u_name,u_tele,u_email,u_profile_pic");
        if ($result != null) {
            $_SESSION['user'] = $result;
            $_SESSION['u_id'] = $result[0]['u_id'];
            echo 'SUCCESS';
        } else {
            echo "ERROR";
        }
    } catch (Error $e) {
        echo 'Could not connect to database';
    }
}

function signUp()
{
    if (isset($_SESSION)) {
        session_unset();
        session_destroy();
    }
    session_start();

//get data
    $name = $_POST['reg_username'];
    $password = $_POST['reg_password'];
    $telephone = $_POST['reg_telephone'];
    $email = $_POST['reg_email'];

//validate and prepare
    $userName = new UserName($name);
    $userTele = new Telephone($telephone);
    $userEmail = new Email($email);

    $userName->validate();
    $userTele->validate();
    $userEmail->validate();
    if (!($userName->getValidationStatus() and $userEmail->getValidationStatus()
        and $userTele->getValidationStatus())) {
        die("Details are not valid");
    }
    $passHash = Utilities::encrypt($password);

//DB
    try {
        Database::insert("user", array('u_name', 'u_tele', 'u_password', 'u_email')
            , array($userName->getValue(), $userTele->getValue(), $passHash, $userEmail->getValue()));
        echo 'SUCCESS';
    } catch (Error $e) {
        echo 'Could not connect to database';
        die();
    }
//login display



}

function logout()
{
    Utilities::log_out();
}

function getServiceStations()
{
    Utilities::verifyLogIn("USER");

    try {
        if (isset($_POST['s_id'])) {
            $sId = $_POST['s_id'];
            $result = Database::read("service_station", "s_id = :sid",
                array(':sid' => $sId), "*");
            echo json_encode($result);
        } else {
            $result = Database::read("service_station", "", array(), "s_id,s_name,s_city");
            echo json_encode($result);
        }
    } catch (Error $e) {
        echo "DB error";
    }

}

function getServicesInStation()
{
    Utilities::verifyLogIn("USER");

    if (!isset($_POST)) {
        die("GET data not defined");
    }
    $sId = $_POST['s_id'];
//DB
    try {
        $result = Database::read("service", "s_id = :sId and availability = :ava",
            array(':sId' => $sId, ':ava' => 'TRUE'), "service_id, service_name, cost, availability");
        echo json_encode($result);
    } catch (Error $e) {
        echo "DB error";
    }

}

function getRequestDetails()
{
    Utilities::verifyLogIn("USER");

    $uid = $_SESSION['u_id'];
    $sql = "select service.service_name,
       service_request.r_description,
       service_station.s_name,
       service_station.s_city,
       DATE_FORMAT(service_request.r_submit_time,'%e/%m/%Y %r')
           as r_submit_time,
       service.cost,
       service_request.r_status,
       service_station.s_telephone
from service_request
         inner join service_station on
    service_request.s_id = service_station.s_id
         inner join service on
    service_request.service_id = service.service_id
where service_request.u_id = :uid";
    try {
        $result = Database::run($sql, array(':uid' => $uid));
        $result->setFetchMode(PDO::FETCH_ASSOC);
        $rows = array();
        while ($row = $result->fetch()) {
            $rows[] = $row;
        }
        echo json_encode($rows);
    } catch (Error $e) {
        echo "ERROR";
    }
}

function deleteUser()
{
    Utilities::verifyLogIn("USER");

    $email = $_POST['email'];
    $password = $_POST['password'];
    $passHash = Utilities::encrypt($password);

    try {
        $availability = Database::read("user", "u_id = :uid AND u_email = :email AND u_password = :pass",
            array(':uid' => $_SESSION['u_id'], ':email' => $email, ':pass' => $passHash));
        if (json_encode($availability) != "[]") {
            Database::delete("user", "u_email = :email AND u_password = :pass",
                array(':email' => $email, ':pass' => $passHash));
            echo "SUCCESS";
        } else {
            echo "WRONG USERNAME OR PASSWORD";
        }
    } catch (Error $e) {
        echo "ERROR";
    }

}

function addServiceRequest()
{
    Utilities::verifyLogIn("USER");

//get data-------------------------------------------------------------
    $serviceId = $_POST['service_id'];
    $description = $_POST['r_description'];
    $latitude = $_POST['r_latitude'];
    $longitude = $_POST['r_longitude'];
    $uId = $_SESSION['u_id'];

//DB
    try {
        //find s_id for service id
        $result = Database::read("service", "service_id = :s", array(':s' => $serviceId), "s_id");
        $s_id = $result[0]['s_id'];

        Database::insert("service_request",
            array('u_id', 's_id', 'service_id', 'r_description', 'r_latitude', 'r_longitude')
            , array($uId, $s_id, $serviceId, $description, $latitude, $longitude));
        echo 'SUCCESS';
    } catch (Error $e) {
        echo 'Could not connect to database';
        die();
    }


}

function searchAStation()
{
    $keyWord = $_POST['keyword'];
    $table = $_POST['table'];

    try {
        $stations = Database::read($table, "service_name LIKE :s", array(':s' => "%" . $keyWord . "%"), "s_id");
        $result = array();
        foreach ($stations as $val) {
            $a = Database::read("service_station", "s_id = :id", array(':id' => $val['s_id']));
            $result = array_merge($result, $a);
        }
        $result = array_unique($result, SORT_REGULAR);
        echo json_encode(array_values($result));
    } catch (Error $e) {
        echo "ERROR";
    }
}

function updateProfile()
{
    Utilities::verifyLogIn("USER");
    $uId = $_SESSION['u_id'];

////simulation--------------------------------------------
//$_POST['up_username']="PQR";
//$_POST['up_password']="password";
//$_POST['up_email']="pqr@gmail.com";
//$_POST['up_telephone']="";

//merge data array for non null values
    $data = array();
    if ($_POST['up_username'] != "") {
        $userName = new UserName($_POST['up_username']);
        $userName->validate();
        if (!$userName->getValidationStatus()) {
            die("User name not valid");
        }
        $i = array('u_name' => $userName->getValue());
        $data = array_merge($data, $i);
    }
    if ($_POST['up_password'] != "") {
        $i = array('u_password' => Utilities::encrypt($_POST['up_password']));
        $data = array_merge($data, $i);
    }
    if ($_POST['up_telephone'] != "") {
        $userTele = new Telephone($_POST['up_telephone']);
        $userTele->validate();
        if (!$userTele->getValidationStatus()) {
            die("Tele not valid");
        }
        $i = array('u_tele' => $userTele->getValue());
        $data = array_merge($data, $i);
    }
    if ($_POST['up_email'] != "") {
        $userEmail = new Email($_POST['up_email']);
        $userEmail->validate();
        if (!$userEmail->getValidationStatus()) {
            die("Email not valid");
        }
        $i = array('u_email' => $userEmail->getValue());
        $data = array_merge($data, $i);
    }

//DB
    try {
        Database::update("user", $data, "u_id = :uid", array(':uid' => $uId));
    } catch (Error $e) {
        echo 'Could not connect to database';
        die();
    }

    echo 'SUCCESS';

}

function updateLocation()
{
    Utilities::verifyLogIn("USER");
    $userId = $_GET['u_id'];
    $latitude = $_GET['latitude'];
    $longitude = $_GET['longitude'];
//DB
    try {
        $result = Database::insert("user_location", array('u_id', 'latitude', 'longitude')
            , array($userId, $latitude, $longitude));
        if ($result != null) {
            $_SESSION['current_location'] = array('latitude' => $latitude, 'longitude' => $longitude);
            echo 'SUCCESS';
        } else {
            echo 'FAILED';
        }
    } catch (Error $e) {
        echo 'Could not connect to database';
    }
}

function getProfileInfo()
{

    Utilities::verifyLogIn("USER");
    $uId = $_SESSION['u_id'];

//DB
    try {
        $result = Database::read("user", 'u_id = :uid',
            array(':uid' => $uId), "u_id,u_name,u_tele,u_email,u_profile_pic");
        echo json_encode($result);
    } catch (Error $e) {
        echo 'FAILED';
    }

}

function cancelRequest()
{
    Utilities::verifyLogIn("USER");
    $rId = $_GET['r_id'];
    try {
        Database::update("service_request", array('r_status' => "CANCELLED"), "r_id = :id"
            , array(':id' => $rId));
    } catch (Error $e) {
        echo 'Database Error';
    }
    echo "SUCCESS";
}
