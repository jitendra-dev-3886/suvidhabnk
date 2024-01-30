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
if($con->query("SELECT * FROM `user` WHERE ID='$usid' and TOKEN_ID='".$data['Token']."'")->num_rows != 1){
    http_response_code(404);
    echo json_encode(["rscode" => 404 , "message"=>"Token Invaild. User not found"]);
    session_destroy();
    exit;
}

// user details
$user = $con->query("SELECT * FROM `user` WHERE ID='$usid' and TOKEN_ID='".$data['Token']."' ")->fetch_assoc();
// if(strtolower($user['US_STATUS']) != "active"){
//     http_response_code(404);
//     echo json_encode(["rscode" => 404 , "message"=>"Token Invaild. User not active. Contact to admin"]);
//     session_destroy();
//     exit;
// }

$ustypeid = $user['USER_TYPE']; 
// fetch user profile credential
$profile = $con->query("SELECT * FROM `user_profile` WHERE USER_ID='$usid'")->fetch_assoc();

$user_type = $con->query("SELECT * FROM `user_type` WHERE ID='$ustypeid' and STATUS='ACTIVE'")->fetch_assoc(); 

//fetch DMT Data 
$dmt_user = $con->query("SELECT * FROM `dmt_user` WHERE USER_ID='$usid' and USER_TYPE='$ustypeid' ")->fetch_assoc(); 


//fetch Payout Data 
$payout_user = $con->query("SELECT * FROM `payout_users` WHERE US_ID='$usid' ORDER BY ID DESC LIMIT 1")->fetch_assoc(); 

// fetch paysprint credential
$paysprint = $con->query("SELECT * FROM `paysprint_api` WHERE ID='1' and STATUS='ACTIVE'")->fetch_assoc();

//fetch news details
$news = $con->query("SELECT * FROM `news_alert` WHERE OWNER='ADMIN' AND OWNER_ID='1' AND USER_TYPE='$ustypeid' AND STATUS='active' order by ID desc")->fetch_assoc();
$date_now = date("Y-m-d");


?>