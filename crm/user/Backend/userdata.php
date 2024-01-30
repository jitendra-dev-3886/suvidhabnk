<?php


include('allFunctions.php');


$data = getallheaders();
if($data['Token'] == ""){
    http_response_code(999);
    echo json_encode(["rscode" => 999 , "message"=>"token not found"]);
    exit;
}

$token = decrypt_token($data['Token']);

$tknData = json_decode($token, true);

if($tknData['ID'] == ""){
    http_response_code(999);
    echo json_encode(["rscode" => 999 , "message"=>"Invaild Token "]);
    exit;
}

$id = $tknData['ID'];
if($con->query("SELECT * FROM `user` WHERE ID='$id' and TOKEN='".$data['Token']."'")->num_rows != 1){
    http_response_code(999);
    echo json_encode(["rscode" => 999 , "message"=>"Token Invaild. User not found"]);
    session_destroy();
    exit;
}

// user details
$user = $con->query("SELECT * FROM `user` WHERE ID='$id' and TOKEN='".$data['Token']."' ")->fetch_assoc();



?>