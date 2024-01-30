<?php
include("../../../Db/config.php");
include("../Functions/all_function.php");

date_default_timezone_set("Asia/Kolkata");

// Add beneficiary 
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
$json = file_get_contents('php://input');
// Converts it into a PHP object
$values = json_decode($json, true);

if ($json!="" || $json!=null) {
    extract($values);

        $user =   $con->query("select * from register_user_data where REQ_ID='$requestId' ")->fetch_assoc();
        $ID = $user['USER_ID'];
        
$userdata = $con->query("select * from user where ID='$ID' ")->fetch_assoc();
        
    $data = json_encode([
                 "task"=>"bankTransfer",
                 "essentials" =>[
                 "beneficiaryName"=> $userdata['FIRST_NAME'],
                 "beneficiaryAccount"=> $beneAcc,
                 "beneficiaryMobile"=> $user['MOBILE'],
                 "beneficiaryIFSC"=>$beneIFSC
                 ],
                ]);
                // echo $data;
    $auth = getsignzyAuthLive();
    $token = $auth['id'];
    $patronId = $auth['userId'];
    $url = "https://signzy.tech/api/v2/patrons/$patronId/bankaccountverifications";
    $curl = curl_init();
    curl_setopt_array($curl, array(
      CURLOPT_URL => $url,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        "authorization: $token",
        "content-type: application/json"
      ),
    ));
    
    $response = curl_exec($curl);
    // echo $response;
    $err = curl_error($curl);
    curl_close($curl);
    $rspns = json_decode($response , true);
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$ID','BankVerify','','$token','$data','".str_replace("'" , "\'" , $response)."')");
    $benename = $rspns['result']['bankTransfer']['beneName'];
    $bankrrn = $rspns['result']['bankTransfer']['bankRRN'];
    $active = $rspns['result']['active'];
    $mobileMatch = $rspns['result']['mobileMatch'];
    $nameMatch = $rspns['result']['nameMatch'];
    if($benename != ""){
        $benename = $benename;
    }
    else{
        $benename = $NAME;
    }
    
    if($bankrrn!="" && $active!=""){
        $con->query("update register_user_data set ACCOUNT_VERIFICATION='$response' where REQ_ID='$requestId' ");
        addPayout($response, $json , $ID , $requestId);
    }
    else{
        echo json_encode(["message"=>"Account not active. ", "response_code"=>300, "status"=>false, "receivableData"=>$rspns]);
        exit;
    }
    
}


function addPayout($verifyResponse, $json , $ID , $requestId){
    
    global $con;
    $myValue = json_decode($json, true);
    extract($myValue);
    // extract(json_decode($verifyResponse, true));
    
    $bankdt=json_decode($verifyResponse, true);
    $beneName=$bankdt['result']['bankTransfer']['beneName'];
    // $bankName=$bankdt['result']['bankTransfer']['beneName'];
    
    $url = "https://payout-api.cashfree.com/payout/v1/addBeneficiary";
    // $beneID = "PAYDEER" . $beneMobile . date("Ymdgis") . mt_rand(999, 9999);
    
    $beneID = "PDR".date("Ymd").mt_rand(999, 9999);
    
    $user = $con->query("SELECT * FROM `user` WHERE ID='$ID' ORDER BY ID DESC")->fetch_assoc();
    $usid = $ID;    
        $data = json_encode([
        "beneId" => $beneID,
        "name" => $user['FIRST_NAME'],
        "email" => $user['EMAIL'],
        "phone" => $user['MOBILE'],
        "bankAccount" => $beneAcc,
        "ifsc" => $beneIFSC,
        "address1" => $user['ADDRESS'],
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

    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','AddPayout','$beneID','','$data','$result')");
    if ($subCode == 200) {
        // echo "work";/
        
        $con->query("INSERT INTO `payout_users`(`NAME`, `BENEID`, `BANK_NAME`, `ACCOUNT`, `IFSC`, `VERIFY_RESPONSE`, `SEND_DATA`, `RESPONSE`, `DATE`, `STATUS`, `US_ID`) 
        VALUES ('$beneName','$beneID','$bankName','$beneAcc','$beneIFSC', '$verifyResponse' ,'$data','$result','".date("Y-m-d")."','Success','$usid')");
        
        $con->query("update register_user_data set BANK_DATA='$response' where REQ_ID='$requestId' ");
         echo json_encode(["message"=>$message, "response_code"=>1, "status"=>true, "receivableData"=>"Success"]);
         exit;
    }
    else if($subCode == 409){
        // echo "work1";
        
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
            VALUES ('$beneName','$beneId','$bankName','$beneAcc','$beneIFSC', '$verifyResponse' ,'$data','$result','".date("Y-m-d")."','Success','$usid')");
            
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
    
    $data="";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $response = json_decode($result, true);
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','GetBENEID','','','$data','$result')");
    $subCode = $response['subCode'];
    $status = $response['status'];
    $msg = $response['message'];
    $beneId = $response['data']['beneId'];
    return $beneId;
}




?>