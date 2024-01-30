<?php
session_start();
include("../../../../Db/config.php");


    $userid = $_POST["user"];
    $fetchuser = $con->query("SELECT * FROM user WHERE ID = '$userid'")->fetch_assoc();
    
    $subsid = "PDRSUBS_".$usid.date("Ymd").mt_rand(999, 9999);
    $planrowid = $_POST["subsplan"];
    
    $planData = $con->query("SELECT * FROM `subscription_plan` WHERE ID='$planrowid' ORDER BY ID DESC LIMIT 1")->fetch_assoc(); 
    
    $planid = $planData['PLAN_ID'];
    $intervalType = $planData['INTERVAL_TYPE'];
    $intervals = $planData['INTERVALS'];
    $authamount = $planData['AMOUNT'];
    
    $name = $fetchuser["FIRST_NAME"].' '.$fetchuser["LAST_NAME"];
    $email = $fetchuser["EMAIL"];
    $mobile = $fetchuser["MOBILE"];
    $subscriptionNote = $_POST["subscriptionNote"];
    $firstChargeDate = date('Y-m-d',strtotime("+1 $intervalType"));
    $expTime = date('Y-m-d H:m:s',strtotime("+$intervals $intervalType"));
    
    $data = json_encode([
             "subscriptionId"=> $subsid,
             "planId"=> "$planid",
             "customerName"=> "$name",
             "customerEmail"=> "$email",
             "customerPhone"=> "$mobile",
             "firstChargeDate"=> "$firstChargeDate",
             "authAmount"=> $authamount,
             "expiresOn"=> "$expTime",
             "returnUrl"=> "https://paydeer.in/admin/",
             "subscriptionNote"=> "$subscriptionNote",
             "notificationChannels"=> ["EMAIL", "SMS"]
    ]);
    

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.cashfree.com/api/v2/subscriptions',
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

$subrefid = $response["subReferenceId"];
$msg = $response["message"];
$status = $response["subStatus"];

$con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`)
        VALUES ('$userid','Web Subsciption','$subsid','Web Subscription','$data','$res')");
 
 if($response["status"] == 'OK'){
     $resdata = json_encode(["response_code"=>1,"msg"=>$response["message"],"status"=>true]);
     
     $con->query("INSERT INTO `subscription`(`SUB_REFFERENCE_ID`,`SUBSCRIPTION_ID`, `PLAN_ROW_ID`, `USER_ID`, `CUSTOMER_NAME`, `EMAIL`, `MOBILE`, `FIRST_CHARGE_DATE`, `EXPIRY_DATE`, `SUBS_REMARK`, `MESSAGE`, `STATUS`, `RESPONSE_DATA`) VALUES 
     ('$subrefid','$subsid','$planrowid','$userid','$name','$email','$mobile','$firstChargeDate','$expTime','$subscriptionNote','$msg','$status','$res')");
     
 }else if($response["status"] == 'ERROR'){
     $resdata = json_encode(["response_code"=>3,"msg"=>$response["message"],"status"=>false]);
     
 }else{
     
     $resdata = json_encode(["response_code"=>5,"msg"=>"Server Internal Error Contact Admin..!","status"=>false]);
 }
 
 echo $resdata;

  
?>