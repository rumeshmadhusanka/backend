<?php
session_start();
header('Access-Control-Allow-Origin: *');
require_once 'Database.php';
require_once 'DataType.php';

//get data
$name=$_POST['log_username'];
$password=$_POST['log_password'];

//validate and prepare
$user=new UserName($name);
$user->validate();
$passHash=hash("sha512",$password);

//DB
$result=Database::read("user",'u_name = :name and u_password= :pass',
    array(':name'=>$name,':pass'=>$passHash),"*");

//display
if($result!=null){
    echo json_encode($result);
}else{
    echo 'FAILED';
}
