<?php
session_start();

require("../../../../Db/config.php");

include("../../Backend/Userinfo/getuserinfo.php");
require("../../Backend/Functions/all_function.php");
require("../../Auth/Auth.php");
require("function.php");


// error_reporting(E_ALL);
// ini_set("display_errors", 1);

// From auth.php check request;
$reqBodyAr = json_decode($reqBody , true);

extract($reqBodyAr);

// echo "wokr";
$us = $con->query("select * from aeps_merchant where MERCHANTCODE='$merchantcode' and STATUS='1'")->num_rows;
$us_dt = $con->query("select * from aeps_merchant where MERCHANTCODE='$merchantcode'")->fetch_assoc();
 
if($us_dt['STATUS'] != 1){
 $us_dt = $con->query("select * from user where ID='$usid'")->fetch_assoc();
 
$curl = curl_init();

$data = array(
    "merchantcode"=> $merchantcode,
    "mobile" => $mobile,
    "is_new" =>$is_new,
    "email"=>$email,
    "firm"=> $firm,
    "callback"=> "https://".$_SERVER['HTTP_HOST']."/Agent/Backend/AEPS/Paysprint/aeps_trans"
);

$data_str = json_encode($data , true);

$token = create_token();

curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/onboard/onboard/getonboardurl",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data_str,
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
    "Token:".$token
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
//   echo "<h1 style='text-align:center; margin-top:20px;'>Redirecting.. Please do not refresh the page</h1>";
  
  $rs = json_decode($response , true);
  $response_code = $rs['response_code'];
  $url = $rs['redirecturl'];
    $msg = str_replace("'" ,"\'", $rs['message']);
    $msg = str_replace("\n" ," ", $msg);
  if($response_code == 1){
    $olddt = $con->query("select * from aeps_merchant where MERCHANTCODE='$merchantcode' ");
    if($olddt->num_rows == 0){
          $con->query("INSERT INTO `aeps_merchant`(`REF_NO`, `TXN_ID`, `STATUS`, `MOBILE`, `PARTNERID`, `MERCHANTCODE`, `IS_ICICI_KYC`, `TIMESTAMP` , `TYPE` , `URL`) VALUES ('','',
        '2','$mobile','','$merchantcode','','$time' , 'API'  , '$callback')");
    }
    echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 111 , "message"=>$msg, "url"=>$url, "RequestId"=> $refId , "data"=>$rs]) , $refId);
    exit;
  }else{
    echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 113 , "message"=>$msg, "RequestId"=> $refId , "data"=>$rs]) , $refId);
    exit;
  }
}
else{
    echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 113 , "message"=>"User already registered.", "RequestId"=> $refId]) , $refId);
    exit;
}

?>
