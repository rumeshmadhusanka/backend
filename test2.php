<?php
$password="password";
$passHash=hash("sha512",$password);
echo $passHash;