<?php
include('allFunctions.php');


  
$data = getallheaders();
if($data['Token'] == ""){
    http_response_code(404);
    echo json_encode(["rscode" => 120 , "message"=>"token not found"]);
    exit;
}


$token = $data['Token'];
$data = decrypt_token($data['Token']);
$jtData = json_decode($data, true);

$user_id = $jtData['id'];

$res = $con->query("SELECT * FROM user WHERE ID='$user_id' AND TOKEN='$token' ");
if(mysql_num_rows($res)<1)
{
    http_response_code(404);
    // header("Location: https://paydeer.in/crm/authsign_in.php");
    echo json_encode(["rscode" => 120 , "message"=>"Login again"]);
    exit;
}
  
    









?>