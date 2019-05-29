<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once '../common/Utilities.php';
Utilities::verifyLogIn("SERVICE_CENTER");
?>
