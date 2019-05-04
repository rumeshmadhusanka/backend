<?php
if (isset($_SESSION)){
    echo json_encode($_SESSION);
}
else{
    echo "ERROR";
}
