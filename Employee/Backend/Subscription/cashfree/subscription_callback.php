<?php
session_start();
include("../../../../Db/config.php");


if(isset($_POST["pageid"]) && $_POST["pageid"] == 1){

$fetchsubs = $con->query("SELECT * FROM `subscription`");

while($row = $fetchsubs->fetch_assoc()){
$id = $row["ID"];
$subsrefid = $row["SUB_REFFERENCE_ID"];
$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.cashfree.com/api/v2/subscriptions/'.$subsrefid,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json',
    'X-Client-Id: 1727088087a9a5521e7e50f944807271',
    'X-Client-Secret: 84f47aa6540673dec8567f262a82ac87db88da76'
  ),
));

$res = curl_exec($curl);
curl_close($curl);

$response = json_decode($res,true);
$status = $response["subscription"]["status"];
     
$con->query("UPDATE subscription SET STATUS ='$status',RESPONSE_DATA='$res' WHERE ID = '$id'");
     
}

echo json_encode(["response_code"=>1,"msg"=>$response["message"],"status"=>true]);
 
 
}
  
?>