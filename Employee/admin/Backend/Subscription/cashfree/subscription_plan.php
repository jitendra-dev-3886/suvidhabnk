<?php
session_start();
include("../../../../Db/config.php");

    $planid = "PDRSUBSPLAN_".$usid.date("Ymd").mt_rand(999, 9999);
    $planName = $_POST["planname"];
    $intervals = $_POST["interval"];
    $planamount = $_POST["planamount"];
    $intervalType = $_POST["intervaltype"];
    $description = $_POST["description"];
    
    $data = json_encode([
        "planId" => $planid,
        "planName" => $planName,
        "type" => "PERIODIC",
        "amount" => $planamount,
        "intervalType" => $intervalType,
        "intervals" => $intervals,
        "description" => "$description",
    ], JSON_NUMERIC_CHECK);

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.cashfree.com/api/v2/subscription-plans',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => array(
    'X-Client-Id: 1727088087a9a5521e7e50f944807271',
    'X-Client-Secret: 84f47aa6540673dec8567f262a82ac87db88da76',
    'Content-Type: application/json'
  ),
));

$res = curl_exec($curl);

curl_close($curl);


$response = json_decode($res,true);
 
 if($response["status"] == 'OK'){
     $resdata = json_encode(["response_code"=>1,"msg"=>$response["message"],"status"=>true]);
     $con->query("INSERT INTO `subscription_plan`(`PLAN_ID`, `PLAN_NAME`, `PLAN_TYPE`, `INTERVAL_TYPE`, `INTERVALS`, `AMOUNT`, `DESCRIPTION`, `STATUS`) VALUES 
     ('$planid','$planName','PERIODIC','$intervalType','$intervals','$planamount','$description','Active')");
 }else if($response["status"] == 'ERROR'){
     $resdata = json_encode(["response_code"=>3,"msg"=>$response["message"],"status"=>false]);
     
 }else{
     
     $resdata = json_encode(["response_code"=>5,"msg"=>"Server Internal Error Contact Admin..!","status"=>false]);
 }
 
 echo $resdata;

  
?>