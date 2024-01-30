<?php
session_start();

require("../../../../Db/config.php");
// error_reporting(E_ALL);
// ini_set("display_errors", 1);

include("../../Backend/Userinfo/getuserinfo.php");
require("../../Backend/Functions/all_function.php");
require("../../Auth/Auth.php");
require("payoutFunctions.php");


// From auth.php check request;
$reqBodyAr = json_decode($reqBody , true);


//Check Status

$refrence = trim($reqBodyAr['refId']);
$txn = $con->query("select * from payout_transaction where REFFRENCE_ID='$refrence' and APITYPE='API' ")->fetch_assoc();
$rsRefId = $txn['RES_REFID'];
$usID = $txn['USER_ID'];


if($rsRefId == ""){
     echo ApiHit($reqBody ,  $data['Token'] , json_encode(array("response_code"=>  400 , "message"=>"Transaction not found for check status. $refrence", "RequestId"=> $refId)) , $refId);
    exit;
}
$curl = curl_init();
    $url = "https://payout-api.cashfree.com/payout/v1.1/getTransferStatus?referenceId=$rsRefId";
    // echo $url;
    // exit;
    $token = create_cashfree_token();
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    // echo $result;
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $status = $response['data']['transfer']['status'];
    $msg = $response['data']['transfer']['reason'];
    
    if($msg==null || $msg ==""){
        $msg = $status;
    }
    
    
if(strtolower($txn['STATUS']) != "success" || strtolower($txn['STATUS']) != "rejected"){
    
   $con->query("update payout_transaction set CHECK_RESPONSE='".str_replace("'" , "\'" , $result)."'   , STATUS='$status'  where REFFRENCE_ID='$refrence' ");
  
     if(strtolower($status) == "rejected"){
        $user = $con->query("select * from api_user where ID='$usID' ")->fetch_assoc();
        $refundBal = $user['AEPS_BAL']+$txn['AMOUNT'];
        $con->query("update api_user set AEPS_BAL='$refundBal' where ID='$usID'");
       insert_allreport($usID  ,$refrence , "PAYOUT Refund" , $user['AEPS_BAL']  , $refundBal , $txn['AMOUNT'] , "Credit" , "PAYOUT Transaction Refund", "AEPS");
       revert_payout_com($refrence , $usID ,46);
    }
}
    
    if(strtolower($status) == "success"){
     echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code"=>111 , "message"=>$msg, "RequestId"=> $refId , "data"=> $response]) , $refId);
     exit;
    }
    else{
     echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code"=>113 , "message"=>$msg, "RequestId"=> $refId , "data"=> $response]) , $refId);
     exit;
    }
    