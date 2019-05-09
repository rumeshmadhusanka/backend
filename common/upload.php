<?php
//puts the image in a new name to the directory 'uploads'
//'uploads' dir should exist
//On success, will echo 'OK'
//new name should be saved into the database
session_start();
require_once 'Database.php';
//$_SESSION['u_id']='susan';//get username from session----------------------------
$target_dir = "../uploads/";
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
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
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
    && $imageFileType != "gif" ) {
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
$newFileName=uniqid('uploaded-');
$newTarget=$target_dir .$newFileName.".".$imageFileType;  ////////////new full name plus path
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    die();
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $newTarget)) {
        //echo "The file ". basename( $_FILES["fileToUpload"]["name"]). " has been uploaded.";
        Database::update('user',
            array('u_profile_pic'=>$newTarget),
            'u_id= :id',
            array(':id'=>$_SESSION['u_id']));
        echo 'OK';
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}
