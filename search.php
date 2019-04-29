<?php header('Access-Control-Allow-Origin: *');
require_once 'Utilities.php';

//$_GET['keyword']="full";//del when actually using---------------------
$keyWord="";
$table="";
if (isset($_GET)) {
    $keyWord=$_GET['keyword'];
    $table=$_GET['table'];
}elseif ($_GET['keyword']===''){
    die();
}

echo Utilities::searchFrom($table,$keyWord);
