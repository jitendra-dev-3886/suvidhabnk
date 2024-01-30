<?php
session_start();

require("../../../../Db/config.php");

include("../../Backend/Userinfo/getuserinfo.php");
require("../../Backend/Functions/all_function.php");
require("../../Auth/Auth.php");

// error_reporting(E_ALL);
// ini_set("display_errors", 1);

// From auth.php check request;
$reqBodyAr = json_decode($reqBody , true);

// Add beneficiary 
    extract($reqBodyAr);
    // old data
    $oldrow = $con->query("select * from payout_users where REG_TYPE='API' and ACCOUNT='$beneAcc' and IFSC='$beneIFSC' ")->num_rows;
    if($oldrow != 0){
        echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 112 , "message"=>"Bene already registered.", "RequestId"=> $refId]) , $refId);
        exit;
    }
    if($beneID == ""){
         echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 114 , "message"=>"BeneId could not be empty.", "RequestId"=> $refId]) , $refId);
        exit;
    }
    
    if($beneName == ""){
         echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 114 , "message"=>"Bene Name could not be empty.", "RequestId"=> $refId]) , $refId);
        exit;
    }
    
    if($beneEmail == ""){
         echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 114 , "message"=>"Bene Email could not be empty.", "RequestId"=> $refId]) , $refId);
        exit;
    }
    
    if($beneMobile == ""){
         echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 114 , "message"=>"Bene Mobile could not be empty.", "RequestId"=> $refId]) , $refId);
        exit;
    }
    if($beneAcc == ""){
         echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 114 , "message"=>"Bene Account could not be empty.", "RequestId"=> $refId]) , $refId);
        exit;
    }
    if($beneIFSC == ""){
         echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 114 , "message"=>"Bene IFSC could not be empty.", "RequestId"=> $refId]) , $refId);
        exit;
    }
    if($beneAdd == ""){
         echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 114 , "message"=>"Bene Address could not be empty.", "RequestId"=> $refId]) , $refId);
        exit;
    }
    
    
    $url = "https://payout-api.cashfree.com/payout/v1/addBeneficiary";
    // $beneID = "ZWEI".date("Ymd").mt_rand(999, 9999);
    $reqdata = json_encode([
        "beneId" => $beneID,
        "name" => $beneName,
        "email" => $beneEmail,
        "phone" => $beneMobile,
        "bankAccount" => $beneAcc,
        "ifsc" => $beneIFSC,
        "address1" => $beneAdd,
        ]);


    $token = create_cashfree_token();
    // echo $token;
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
    
    if($result == ""){
         echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 114 , "message"=>"Server Error. Try again later.", "RequestId"=> $refId]) , $refId);
        exit;
    }
    
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $msg = $response['message'];
    if ($subCode == 200) {
        $con->query("INSERT INTO `payout_users`(`NAME`, `BENEID`, `BANK_NAME`, `ACCOUNT`, `IFSC`, `SEND_DATA`, `RESPONSE`, `DATE`, `STATUS`, `US_ID` , `REG_TYPE`) 
        VALUES ('$beneName','$beneID','$bankName','$beneAcc','$beneIFSC','$reqdata','$result','".date("Y-m-d")."','Success','$usid' , 'API')");
        $rspns = json_encode(["response_code" => 111 , "message"=>"Bene registered." , "BeneId" => $beneID , "RequestId"=> $refId , "addResponse" => $response]);
        echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
        exit;
    }
    else if($subCode == 409){
        $oldBene = $con->query("select * from cashfree_beneficiary where ACCOUNT='$beneAcc' and IFSC='$beneIFSC' ")->fetch_assoc();
        extract($oldBene);
        
        $fetchedBeneId =  getBeneficiaryId($beneAcc, $beneIFSC);
        if($fetchedBeneId ==null || $fetchedBeneId == ""){
            $beneId = $BENEID;
        }
        else{
           $beneId = $fetchedBeneId;
        }
        
        $con->query("INSERT INTO `payout_users`(`NAME`, `BENEID`, `BANK_NAME`, `ACCOUNT`, `IFSC`, `VERIFY_RESPONSE`, `SEND_DATA`, `RESPONSE`, `DATE`, `STATUS`, `US_ID` , `REG_TYPE`) 
        VALUES ('$NAME','$beneId','$bankName','$beneAcc','$beneIFSC', '$VERIFY_RESPONSE' ,'$reqdata','$result','".date("Y-m-d")."','Success','$usid' , 'API')");
         $rspns = json_encode(["response_code" => 112 , "message"=>"Bene registered." , "BeneId" => $beneId , "RequestId"=> $refId , "addResponse" => $response]);
        echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
        exit;
    }
    else{
         $rspns = json_encode(["response_code" => 113 , "message"=>$msg , "RequestId"=> $refId , "addResponse" => $response]);
        echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
        exit;
    }





function getBeneficiaryId($acc, $ifsc){
    
    $url = "https://payout-api.cashfree.com/payout/v1/getBeneId?bankAccount=$acc&ifsc=$ifsc";
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
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $status = $response['status'];
    $msg = $response['message'];
    $beneId = $response['data']['beneId'];
    return $beneId;
}


