<?php
require_once 'Database.php';
//----------------------------------
echo json_encode(Database::read("user",'u_name = :name'
    ,array(':name'=>'susan'),"u_id,u_name"));
//---------------------------------
//echo Database::insert('user',array('u_email','u_name'),array('nyhu','vytybufyhbhy'));
//-----------------------------------
//$newTarget="bhvuy";
//Database::update('user',
//    array('u_profile_pic'=>$newTarget),
//    'u_name= :name',
//    array(':name'=>'susan'));
