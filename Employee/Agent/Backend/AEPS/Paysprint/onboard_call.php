<?php
// error_reporting(0);
include("../../../Db/config.php");

// // Takes raw data from the request
$json = file_get_contents('php://input');

// insert the data into db 
$con->query("INSERT INTO `aeps_callback_rspns`(`RESPONSE`, `TIME`) VALUES ('$json','$time')");

    echo json_encode(['status'=>200, 'msg'=>'success']);


?>