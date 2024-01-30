<?php
session_start();

require("../../../../Db/config.php");
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
require("../../Backend/Functions/all_function.php");
require("../../Auth/Auth.php");


// From auth.php check request;
$reqBodyAr = json_decode($reqBody , true);

// Add beneficiary 
extract($reqBodyAr);

if($VirutalID == ""){
    $response = array("response_code"=>  400 , "message" => "Please enter valid Virtual ID." , "RequestId"=> $refId);
     echo ApiHit($reqBody ,  $data['Token'] , $response , $refId);
    exit;
}

if($AccType = "VA")
{
    $result = json_decode(createVirtualAccount($VirutalID , $Name , $Mobile , $Email) , true);
     $acc = $result['data']['virtualAccountNumber'];
    $ifsc = $result['data']['ifsc'];
     $vaid = $result['data']['vAccountId'];
    
     $vamsg = $result['message'];
    if($result['SubCode'] == 200){
         $rspns = json_encode(array("response_code"=>111 , "message"=> "Account Fetched" , "RequestId"=> $refId , "data" => ["AccountNumber"=> $acc , "ifsc" => $ifsc , "VaccountId" => $vaid]));
    }
    else{
        $rspns = json_encode(array("response_code"=>113 , "message"=> "Account Not Found" , "RequestId"=> $refId , "data" => ["message"=> $vamsg , "ErrCode" => $result['SubCode']]));
    }
     echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
     exit;
}
else if($AccType = "UPI")
{
    $result = json_decode(createupi($VirutalVPAID , $Name , $Mobile , $Email) , true);
     
    $vap = $upirs['data']['virtualVPA'];
    $upaid = $upirs['data']['virtualVpaId'];
    
     $vamsg = $result['message'];
    if($result['SubCode'] == 200){
         $rspns = json_encode(array("response_code"=>111 , "message"=> "Account Created" , "RequestId"=> $refId , "data" => ["UPI"=> $upaid , "VaccountId" => $vap]));
    }
    else{
        $rspns = json_encode(array("response_code"=>113 , "message"=> "Account Not Created" , "RequestId"=> $refId , "data" => ["message"=> $vamsg , "ErrCode" => $result['SubCode']]));
    }
     echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
     exit;
}
else{
     $response = array("response_code"=>  400 , "message" => "Please enter valid AccType." , "RequestId"=> $refId);
     echo ApiHit($reqBody ,  $data['Token'] , $response , $refId);
    exit;
}