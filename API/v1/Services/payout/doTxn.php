<?php
session_start();

require("../../../../Db/config.php");

include("../../Backend/Userinfo/getuserinfo.php");
require("../../Backend/Functions/all_function.php");
require("../../Auth/Auth.php");
require("payoutFunctions.php");


// error_reporting(E_ALL);
// ini_set("display_errors", 1);
// From auth.php check request;
$reqBodyAr = json_decode($reqBody , true);


// payout Transactiono acount.
$amount = strip_tags($reqBodyAr['SendAmount']);
$bene_id  =$reqBodyAr['beneid'];

// amount validations
if($amount < 100){
    $response = array("response_code"=>  403 , "message" => "Please enter amount greater than 100." , "RequestId"=> $refId);
     echo ApiHit($reqBody ,  $data['Token'] , $response , $refId);
    exit;
}

$charge_amount = calc_com($amount , $usid , "");

if($charge_amount == ""){
   $charge_amount=0; 
}
// $refrence = "ZWEI".date("Ymd").mt_rand(999, 9999);
$refrence = $reqBodyAr['refId'];
 
$insert_report = "INSERT INTO `payout_transaction`(`USER_ID`, `BENE_ID`,`ACCOUNT`,`TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID` ,`FILTER_DATE` , `APITYPE`)
VALUES ('$usid','$bene_id','$acc','".date("g:i:s A")."','$amount','$mode','$refrence' , '".date("Y-m-d")."' , 'API')";
$user_bal = $user['AEPS_BAL']-$amount;

if($user_bal-$charge_amount >= 0 && $amount > 0){
        $deduct_bal = "update api_user set AEPS_BAL='$user_bal' where ID='$usid'";
        if($con->query($insert_report) && $con->query($deduct_bal) ){
        $url = "https://payout-api.cashfree.com/payout/v1/requestAsyncTransfer";
        $reqdata = json_encode([
                "beneId" => $bene_id,
                "amount" => $amount,
                "transferId" => $refrence
            ]);
        //   echo $reqdata;
    $token = create_cashfree_token();
        
            $headers = array(
                'Content-Type:application/json',
                'Authorization: Bearer ' . $token
            );
        
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $reqdata);
            curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
            $result = curl_exec($ch);
            // echo $result;
            
            $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) 
            VALUES ('$usid','PAYOUTTXN','$refrence','$token','$reqdata','$result')");
 
 
            $response = json_decode($result, true);
            $subCode = $response['subCode'];
            $status = $response['status'];
            $msg = $response['message'];
            $resRefId = $response['data']['referenceId'];
            
            if($msg==null || $msg ==""){
                $msg = $status;
            }
            
            if(strtolower($status) == "success"){
                $rspns = json_encode(array("response_code"=>111 , "message"=>$msg , "RequestId"=> $refId , "status" => $status,  "data" => $response));
            }
            if(strtolower($status) == "accepted"){
                $rspns = json_encode(array("response_code"=>112 , "message"=>"Pending  ".$msg, "RequestId"=> $refId , "status" => $status,  "data" => $response));
            }
            else if(strtolower($status) == "rejected" || strtolower($status) == "error"){
                $rspns = json_encode(array("response_code"=>113 , "message"=>$msg , "RequestId"=> $refId , "status" => $status,  "data" => $response));
            }
            else {
                $rspns = json_encode(array("response_code"=>400 , "message"=>$msg , "RequestId"=> $refId , "status" => "Failed",  "data" => $response));
            } 
            
            
            
            if($subCode == "200" || $subCode == "201" || $subCode == "202"){
              $con->query("update payout_transaction set RESPONSE='".str_replace("'" , "\'" , $result)."'  , STATUS='$status', RES_REFID='$resRefId' where REFFRENCE_ID='$refrence' ");
              insert_allreport($usid  ,$refrence , "PAYOUT" , $user['AEPS_BAL']  , $user_bal , $amount , "Debit" , "PAYOUT Transaction", "AEPS");
              give_payout_com($refrence , $usid ,$ustypeid);
            }
            else{
              $con->query("update api_user set AEPS_BAL='".$user['AEPS_BAL']."' where ID='$usid' ");
              $con->query("update payout_transaction set RESPONSE='".str_replace("'" , "\'" , $result)."'  , STATUS='$status' where REFFRENCE_ID='$refrence' ");
            }
            echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
        }
        else{
            $rspns = json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"  , "RequestId"=> $refId));
             echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
             exit;
        }
    }
    else{
        $rspns = json_encode(array("response_code"=>  115 , "message"=>"You have not balance.. Please add balance."  , "RequestId"=> $refId));
         echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
        exit;
    }
    
    

