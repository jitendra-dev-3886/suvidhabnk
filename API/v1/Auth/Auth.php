<?php
ob_start();
session_start();


// error_reporting(E_ALL);
// ini_set("display_errors", 1);



$data = getallheaders();

$reqBody = file_get_contents("php://input");

//generate uniqe id for every request;
$refId = "ZWIE".date("His")."_".uniqid()."_".date("Ymd");
if($data['Token'] == ""){
    // http_response_code(404);
    echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 500 , "message"=>"Bad Request.", "RequestId"=> $refId ]) , $refId);
    exit;
}

$headerToken = $data['Token'];
$token = decrypt_token($data['Token']);

$tknData = json_decode($token, true);

if($tknData['USERID'] == ""){
    // http_response_code(404);
    echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 404 , "message"=>"Invaild Token ", "RequestId"=> $refId ]) , $refId);
    exit;
}

$usid = $tknData['USERID'];
if($con->query("SELECT * FROM `api_user` WHERE ID='$usid' and TOKEN='".$data['Token']."'")->num_rows != 1){
    // http_response_code(404);
    echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 404 , "message"=>"Token Invaild. User not found"]) , $refId);
    exit;
}

// user details
$user = $con->query("SELECT * FROM `api_user` WHERE ID='$usid' and TOKEN='".$data['Token']."' ")->fetch_assoc();
if(strtolower($user['STATUS']) != "active"){
    // http_response_code(404);
    echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 404 , "message"=>"Token Invaild. User not active. Contact to admin"]) , $refId);
    exit;
}



if($reqBody == ""){
    echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 403 , "message"=>"Invaild Request. ", "RequestId"=> $refId ]) , $refId);
    exit;
}


// fetch paysprint credential
$paysprint = $con->query("SELECT * FROM `paysprint_api` WHERE ID='1' and STATUS='ACTIVE'")->fetch_assoc();

// fetch cashfree credential
$cashfree = $con->query("SELECT * FROM `cashfree_details` WHERE ID='1' and STATUS='ACTIVE'")->fetch_assoc();

//fetch news details
$news = $con->query("SELECT * FROM `news_alert` WHERE OWNER='ADMIN' AND OWNER_ID='1' AND USER_TYPE='$ustypeid' AND STATUS='active' order by ID desc")->fetch_assoc();
$date_now = date("Y-m-d");


?>