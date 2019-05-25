<?php
//session_start();
require_once 'common/Database.php';
//echo json_encode($_SESSION);
//if (!isset($_SESSION['u_name'])){
//    die("Not logged in");
//}
////----------------------------------
//echo json_encode(Database::read("user",'u_name = :name'
//    ,array(':name'=>'susan'),"*"));
//---------------------------------
//echo Database::insert('user',array('u_email','u_name'),array('nyhu','vytybufyhbhy'));
//-----------------------------------
//$newTarget="bhvuy";
//Database::update('user',
//    array('u_profile_pic'=>$newTarget),
//    'u_name= :name',
//    array(':name'=>'susan'));
//-------------------------------------------
//$serviceId="1";
////DB
//$result=Database::read("service","service_id = :s",array(':s'=>$serviceId),"s_id");
////DB
//echo $result[0]['s_id'];
//-------------------------------------------
//$i=array("I"=>"uom");
//$j=array("You"=>"uop");
//echo json_encode(array_merge($i,$j));
//header("location: index.html");

function random_str($length, $keyspace = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ')
{
    $pieces = [];
    $max = mb_strlen($keyspace, '8bit') - 1;
    for ($i = 0; $i < $length; ++$i) {
        try {
            $pieces [] = $keyspace[random_int(0, $max)];
        } catch (Exception $e) {

        }
    }
    return implode('', $pieces);
}
echo random_str(32);
