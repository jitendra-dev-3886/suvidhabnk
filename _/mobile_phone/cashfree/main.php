<?php

include("../includes/configuration.php");
include("../../Agent/Backend/Functions/all_function.php");
date_default_timezone_set("Asia/Kolkata");

// Add beneficiary 

$json = file_get_contents('php://input');
// Converts it into a PHP object
$values = json_decode($json, true);

if ($json!="" || $json!=null) {
    extract($values);
    $data = json_encode([
                 "task"=>"bankTransfer",
                 "essentials" =>[
                 "beneficiaryName"=> $beneName,
                 "beneficiaryAccount"=> $beneAcc,
                 "beneficiaryMobile"=> $beneMobile,
                 "beneficiaryIFSC"=>$beneIFSC
                 ],
                ]);
    $auth = getsignzyAuthLive();
    $token = $auth['id'];
    $patronId = $auth['userId'];
    $url = "https://signzy.tech/api/v2/patrons/$patronId/bankaccountverifications";
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 50,
      CURLOPT_TIMEOUT => 350,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        "authorization: $token",
        "content-type: application/json"
      ),
    ));
    
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $rspns = json_decode($response , true);
    $benename = $rspns['result']['bankTransfer']['beneName'];
    $bankrrn = $rspns['result']['bankTransfer']['bankRRN'];
    $active = $rspns['result']['active'];
    $mobileMatch = $rspns['result']['mobileMatch'];
    $nameMatch = $rspns['result']['nameMatch'];
    
    $error = $rspns['error']['message'];
    // {"error":{"statusCode":400,"name":"error","message":"invalid IFSC code","status":400}}
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`)
        VALUES ('BankVerifyRetialer','BankVerifyRetialer','Registration','Registration','$data','$response')");
    
    if($benename != ""){
        $benename = $benename;
    }
    else{
        $benename = $NAME;
    }
    
    
    if($bankrrn!="" && $active!=""){
        addPayout($response, $json);
    }
    else{
        echo json_encode(["message"=>"Invalid account details<br>".$error, "response_code"=>300, "status"=>false, "receivableData"=>"Failure"]);
        exit;
    }
    
}


function addPayout($verifyResponse, $json){
    
    global $con;
    $myValue = json_decode($json, true);
    extract($myValue);
    $url = "https://payout-api.cashfree.com/payout/v1/addBeneficiary";
    // $beneID = "PAYDEER" . $beneMobile . date("Ymdgis") . mt_rand(999, 9999);
    $beneID = "PDR".date("Ymd").mt_rand(999, 9999);
    $user = $con->query("SELECT * FROM `user` WHERE MOBILE='$registerMobile' ORDER BY ID DESC")->fetch_assoc();
    $usid = $user['ID'];    
        $data = json_encode([
        "beneId" => $beneID,
        "name" => $beneName,
        "email" => $beneEmail,
        "phone" => $beneMobile,
        "bankAccount" => $beneAcc,
        "ifsc" => $beneIFSC,
        "address1" => $beneAdd,
    ]);
    
    
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
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    // echo $result;
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $message = $response['message'];

        $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`)
        VALUES ('Onboarding','Mobile Onboarding','Registration','Registration','$data','$result')");

    if ($subCode == 200) {
        
        $con->query("INSERT INTO `payout_users`(`NAME`, `BENEID`, `BANK_NAME`, `ACCOUNT`, `IFSC`, `VERIFY_RESPONSE`, `SEND_DATA`, `RESPONSE`, `DATE`, `STATUS`, `US_ID`) 
        VALUES ('$beneName','$beneID','$bankName','$beneAcc','$beneIFSC', '$verifyResponse' ,'$data','$result','".date("Y-m-d")."','Success','$usid')");
        
         echo json_encode(["message"=>$message, "response_code"=>1, "status"=>true, "receivableData"=>"Success"]);
         exit;
    }
    else if($subCode == 409){
        
        
        if($message=="Entered bank Account is already registered"){
            $oldBene = $con->query("select * from cashfree_beneficiary where ACCOUNT='$beneAcc' and IFSC='$beneIFSC' ")->fetch_assoc();
            extract($oldBene);
            
        
        $fetchedBeneId =  getBeneficiaryId($beneAcc, $beneIFSC);
        if($fetchedBeneId ==null || $fetchedBeneId == ""){
            $beneId = $BENEID;
        }
        else{
           $beneId = $fetchedBeneId;
        }
            
            
            $con->query("INSERT INTO `payout_users`(`NAME`, `BENEID`, `BANK_NAME`, `ACCOUNT`, `IFSC`, `VERIFY_RESPONSE`, `SEND_DATA`, `RESPONSE`, `DATE`, `STATUS`, `US_ID`) 
            VALUES ('$NAME','$beneId','$bankName','$beneAcc','$beneIFSC', '$verifyResponse' ,'$data','$result','".date("Y-m-d")."','Success','$usid')");
            
            echo json_encode(["message"=>"Success But ".$message, "response_code"=>1, "status"=>true, "receivableData"=>"Success"]);
            exit; 
        }
        else{
            
            echo json_encode(["message"=>$message, "response_code"=>300, "status"=>false, "receivableData"=>"Failure"]);
            exit;   
        }
    }
    else{
        echo json_encode(["message"=>$message, "response_code"=>300, "status"=>false, "receivableData"=>"Failure"]);
        exit;   
    }
    
}

function getBeneficiaryId($acc, $ifsc){
    global $con;
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
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`)
        VALUES ('Onboarding','Mobile Onboarding','Registration','Registration','$url','$result')");
    
    return $beneId;
}




?>