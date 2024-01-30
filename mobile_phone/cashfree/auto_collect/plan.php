<?php

include("../../includes/configuration.php");
include("../../../Agent/Backend/Functions/all_function.php");
date_default_timezone_set("Asia/Kolkata");
include("../../my_curls/myCurl.php");



if(isset($_POST['redirect_url'])){

    $sus_id = "PDRSUBSID_".$usid.date("Ymd").mt_rand(999, 9999);


    $firstChargeDate = date('Y-m-d',strtotime("+2 day"));
    $expTime = date('Y-m-d H:m:s',strtotime("+5 day"));

    $data = json_encode([
    "subscriptionId"=> $sus_id,
     "planId"=> "PDRSUBSPLAN_202204284902",
     "customerName"=> "Sk Samar",
     "customerEmail"=> "iamalsksamar@gmail.com",
     "customerPhone"=> "8240193509",
     "firstChargeDate"=>"$firstChargeDate",
     "authAmount"=> 1,
     "expiresOn"=> "$expTime",
     "returnUrl"=> "https://paydeer.in/mobile_phone/signzy/plan_back.php",
     "subscriptionNote"=> "Subscription Plan for Paydeer",
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
echo $res;

// $response = json_decode($res,true);
//  if($response["status"] == 'OK'){
     
     
//      $sql = "UPDATE user SET `SUBSCRIPTION`='$sus_id' WHERE MOBILE='$mobile'";
//      $finalizationD =  mysqli_query($con, $sql);
     
//      $resdata = json_encode(["response_code"=>1,"msg"=>$response["message"],"status"=>true]);

 
     
//  }else if($response["status"] == 'ERROR'){
     
//      $resdata = json_encode(["response_code"=>3,"msg"=>$response["message"],"status"=>false]);
 
//  }else{
     
//      $resdata = json_encode(["response_code"=>5,"msg"=>"Server Internal Error Contact Admin..!","status"=>false]);
//  }
//  echo $resdata;

    
}


?>