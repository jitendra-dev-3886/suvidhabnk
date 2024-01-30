<?php
ob_start();
session_start();


// error_reporting(E_ALL);
// ini_set("display_errors", 1);



$data = getallheaders();
if($data['Token'] == ""){
    http_response_code(404);
    echo json_encode(["rscode" => 500 , "message"=>"token not found"]);
    exit;
}

$token = decrypt_token($data['Token']);

$tknData = json_decode($token, true);

if($tknData['ID'] == ""){
    http_response_code(404);
    echo json_encode(["rscode" => 404 , "message"=>"Invaild Token "]);
    exit;
}

$usid = $tknData['ID'];
if($con->query("SELECT * FROM `lead` WHERE ID='$usid' and TOKEN_ID='".$data['Token']."'")->num_rows != 1){
    http_response_code(404);
    echo json_encode(["rscode" => 404 , "message"=>"Token Invaild. User not found"]);
    session_destroy();
    exit;
}

// user details
$user = $con->query("SELECT * FROM `lead` WHERE ID='$usid' and TOKEN_ID='".$data['Token']."' ")->fetch_assoc();
// if(strtolower($user['US_STATUS']) != "active"){
//     http_response_code(404);
//     echo json_encode(["rscode" => 404 , "message"=>"Token Invaild. User not active. Contact to admin"]);
//     session_destroy();
//     exit;
// }


?>