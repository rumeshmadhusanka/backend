<?php
header('Access-Control-Allow-Origin: *');
require_once 'common.php';
require_once 'config.php';

$connection = new PDO($dsn, $username, $password, $options);
$tableName='users';
$firstName="vurb";
$lastName="buhfrb";
$password="bubfu";
$passHash=hash("sha512",$password);
$sql = "INSERT INTO users (`firstname`, `lastname`, `password`) VALUES ( `hde`, `cvevev`, `vfrv`)";
$connection->query($sql);
