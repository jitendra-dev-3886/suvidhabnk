<?php
session_start();
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");
include('function.php');
$time = date("g:i:s A");
$date = date("Y-m-d");

// maintenance text 
// if($usid != 9){
    
//  echo json_encode(array("status"=>false, "response_code"=>  400 , "message"=>"Under Maintenance. Please wait this service will work tonight. " , "receivableData" => ["message"=>"Under Maintenance. Please wait this service will work tonight. " ] ));
//  exit;
 
// }

//verify beneficiary vpa
if(isset($_POST['upiname'])){
    extract($_POST);

    $token = create_cashfree_token();

    $fixed = urlencode($upiname);
    // $url = "https://payout-api.cashfree.com/payout/v1/asyncValidation/bankDetails?name=$fixed&phone=$MOBILE&bankAccount=$ACCOUNT&ifsc=$IFSC";
    $url = "https://payout-api.cashfree.com/payout/v1/validation/upiDetails?name=$fixed&vpa=$upiid";
    
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
    // echo $result;
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $msg = $response['message'];
    extract($response);
    extract($data);
    
    
    
// {"status":"SUCCESS","subCode":"200","message":"Bank Account details verified successfully","accountStatus":"VALID","accountStatusCode":"ACCOUNT_IS_VALID","data":{"nameAtBank":"Mr  AROCKIA  ANBARAS","amountDeposited":"1","refId":"217276072","bankName":"STATE BANK OF INDIA","utr":"209915735437","city":"TIRUVADANAI","branch":"TIRUVADANAI","micr":0}}



    
            
    // $con->query("update cashfree_beneficiary set VERIFY_RESPONSE='$result' , NAME='$nameAtBank', BANKNAME='$bankName'  where BENEID='$beneid'");
    if($nameAtBank!=""){
            echo json_encode(["message"=>"Success\n".$msg, "response_code"=>1, "status"=>true, "receivableData"=>$response]);
    }
    else{
        echo json_encode(["message"=>$msg, "response_code"=>2, "status"=>false, "receivableData"=>$response]);
    }
    // if($nameAtBank != ""){
    //     $user = $con->query("select * from user where ID='$id'")->fetch_assoc();
    //     $update_bal = $user['DMT_2'] - 4;
    //     $con->query("update user set DMT_2='$update_bal' where ID='$id' ");
    //     insert_allreport($id  ,$refId , "DMT2.0  Account Verify" , $user['DMT_2']  , $update_bal ,4 , "Debit" , "DMT2.0  Account verification charge", "MAIN");
    // }
}




// Send otp for send amount
if(isset($_POST['sendamountotp'])){
    $amount = $_POST['send_amount'];
    if($amount == ""){
         $receivableData = ["rs_code"=>500 , "smsotpst" => "Amount can not be empty"];
        
        $err = ["response_code"=>500, "message"=>"Amount can not be empty", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
    }
      if($amount < 100){
         $receivableData = ["rs_code"=>500 , "smsotpst" => "Amount should be greater or equal than 100."];
        
        $err = ["response_code"=>500, "message"=>"Amount should be greater or equal than 100.", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
    }
     
$charge_amount = calc_upi_com($amount , $usid , $ustypeid);
// echo $charge_amount;
// exit;
if($amount+$charge_amount > $user['MAIN_BAL']){
   $receivableData = ["rs_code"=>500 , "smsotpst" => "Low Balance."];
        
        $err = ["response_code"=>500, "message"=>"Low Balance.", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
}

  if($_POST['otpSendTime'] > 3){
        $receivableData = ["rs_code"=>500 , "smsotpst" => "OTP Send Limit exceeds. Please try again after some time."];
        
        $err = ["response_code"=>500, "message"=>"OTP Send Limit exceeds. Please try again after some time.", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
        
    }
    
    // send OTP on agent mobile
      $usermb = substr($user['MOBILE'] , 7 , 10);
      $otp2 = mt_rand(99999 , 999999);
      $mbmsg2 = urlencode("$otp2 is the OTP to INR $amount has been Debited from your Paydeer.in A/C No *******$usermb  towards UPI Txn. . PayDeer or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds. Team PayDeer");
      $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg2 , 1307164568651364269) , true);
      
        // $receivableData = ["rs_code"=>111 , "smsotpst2"=> $smsrs2['ErrorMessage'] , "OTPHASH2"=>encrypt_token($otp2) ];
        $receivableData = ["rs_code"=>111 , "smsotpst"=> $smsrs2['ErrorMessage'] , "OTPHASH"=>encrypt_token($otp2) ];
        $err = ["response_code"=>1, "message"=>"Otp has been sent.", "status"=>true, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
      
}




// Send Amount 
if(isset($_POST['send_amount'])){
     
$upi_id = strip_tags($_POST['sendupi_id']);
$upi_name = strip_tags($_POST['sendupi_name']);
$upi_mobile = strip_tags($_POST['sendupi_mobile']);
$send_amount = strip_tags($_POST['send_amount']);
$hash_code = strip_tags($_POST['smhash_code']);

$otp = strip_tags($_POST['agentOTP']);
    
if($send_amount > $user['MAIN_BAL']){
    $response = array("response_code"=>  403 , "message" => "Insufficient Balance");
     echo json_encode(array("response_code"=>  400 , "receivableData" => $response));  
    exit;
}

// validation of agent otp
if($otp == ""){
    $response = array("response_code"=>  403 , "message" => "Enter Agent  OTP");
     echo json_encode(array("response_code"=>  400 , "receivableData" => $response, "message"=>"Enter Agent OTP"));  
    exit;
}

if($hash_code == ""){
    $response = array("response_code"=>  403 , "message" => "Agent Verification failed" );
     echo json_encode(array("response_code"=>  400 , "receivableData" => $response, "message"=>"Enter Agent OTP"));  
    exit;

}

if($otp != decrypt_token($hash_code)){
    
    // echo json_encode(array("response_code"=>  403 , "message" => "Agent OTP Not matched ".decrypt_token($hash_code2) ));
     $response = array("response_code"=>  403 , "message" => "Incorrect OTP" );
      echo json_encode(array("response_code"=>  400 , "receivableData" => $response, "message"=>"Agent Verification failed"));  
    exit;
}

    
 $refrence = "PDR".$usid.date("Ymd").mt_rand(999, 9999);
 $comonRefID =   "PDR".$usid.$bene_id.date("Ymd").mt_rand(999, 9999);


if($send_amount > 25000){
      $response = array("response_code"=>  400 , "responseReason" => "Error", "message" => "Amount should be less than 25001");
       echo json_encode(array("response_code"=>  400 , "receivableData" => $response, "message"=>"Amount should be less than 25001"));  
      exit;
}

$charge_amount = calc_upi_com($amount , $usid , $ustypeid);

$usBal = $user['MAIN_BAL'];
if($usBal > $send_amount+$charge_amount){
      
          $insert_report = "INSERT INTO `upi_transactions`(`USER_ID`, `USER_TYPE`, `MOBILE`, `UPI_ID`, `NAME`, `TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID` , `COMM_REFID`, `FILTER_DATE`, `APINAME`)
            VALUES ('$usid','$ustypeid','$upi_mobile','$upi_id','$upi_name','$time','$send_amount','$txn_type','$refrence' , '$comonRefID', '$date', 'CASHFREE')";
            $user_bal = $user['MAIN_BAL']-$send_amount;
            $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid' and USER_TYPE='$ustypeid'";
            if($con->query($insert_report) && $con->query($deduct_bal) ){
              insert_allreport($usid  ,$refrence , "UPI" , $user['MAIN_BAL']  , $user_bal , $send_amount , "Debit" , "UPI Transaction", "MAIN");
              $url = "https://payout-api.cashfree.com/payout/v1/directTransfer";
              $data = json_encode([
                         "amount"=> $send_amount,
                         "transferId"=> $refrence,
                         "transferMode"=> "upi",
                         "remarks"=> "UPI Transfer",
                         "beneDetails" => [
                             "name"=> $upi_name,
                             "vpa"=> $upi_id,
                             "phone"=> $upi_mobile,
                             "email"=> "info@paydeer.in",
                             "address1"=> "A108 Adam Street, New York, NY 535022"
                         ]
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
            $response = json_decode($result, true);
            $subCode = $response['subCode'];
            $status = $response['status'];
            $msg = $response['message'];
            $resRefId = $response['data']['referenceId'];
                  $con->query("update upi_transactions set RESPONSE='".str_replace("'" , "\'" , $result)."'  , STATUS='$status' , RES_REFID='$resRefId'  where REFFRENCE_ID='$refrence' ");
                  if($subCode == "200" || $subCode == "201" || $subCode == "202"){
                      //send sms of the txn
                        $sndam = number_format($send_amount , 2);
                        $usbl = number_format($user_bal , 2);
                        $usermb = substr($user['MOBILE'] , 7 , 10);
                         $mbmsg = urlencode("INR $sndam has been Debited from your Paydeer.in A/C No *******$usermb  towards UPI Txn. $refrence. Main Wallet Avl BAL is INR $usbl. Team PayDeer");
                          $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);
      
                       // retailer commission
                        //   if($ustypeid == 46 && strtolower($status) == "success"){
                              give_upi_com($refrence , $usid ,$ustypeid);
                        //   }
                  }
                  else{
                      $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid' ");
                      insert_allreport($usid  ,$refrence , "UPI REFUND" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $send_amount , "Credit" , "UPI REFUND Transaction", "MAIN");
                  }
                  
               echo json_encode(array("response_code"=>  1 ,"txncount"=>1 , "TxnType"=>"112" , "receivableData" => $response, "message"=>""."$msg"));  
        }
        else{
                echo json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
            }
    }
    else{
        echo json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
    }
}

//Check Status
if(isset($_POST['check_upi_status'])){
$refrence = trim($_POST['ref_id']);
$txn = $con->query("select * from upi_transactions where REFFRENCE_ID='$refrence'")->fetch_assoc();
$rsRefId = $txn['RES_REFID'];
$usID = $txn['USER_ID'];
if($rsRefId == ""){
    echo json_encode(array("response_code"=>  400 , "message"=>"Transaction not found for check status."));
    exit;
}

if(strtolower($txn['STATUS']) == "success" || strtolower($txn['STATUS']) == "rejected"){
    echo json_encode(array("response_code"=>  400 , "message"=>"Transaction status already confirmed. "));
    exit;
}

$curl = curl_init();
    $url = "https://payout-api.cashfree.com/payout/v1.1/getTransferStatus?transferId=$refrence";
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
    $status = $response['status'];
    $msg = $response['message'];
    
    if(strtolower($status) == "success"){
          echo json_encode(array("response_code"=>  1 , "message"=>$msg, "status">true, "receivableData"=>$response));
    }
    else{
          echo json_encode(array("response_code"=>  400 , "message"=>$msg, "status">false, "receivableData"=>$response));
    }
    
    
   if(strtolower($status) == "rejected"){
        $user = $con->query("select * from user where ID='$usID' ")->fetch_assoc();
        $refundBal = $user['MAIN_BAL']+$txn['AMOUNT'];
          $con->query("update user set MAIN_BAL='$refundBal' where ID='$usID'");
          
       insert_allreport($usID  ,$refrence , "UPI Refund" , $user['MAIN_BAL']  , $refundBal , $txn['AMOUNT'] , "Credit" , "UPI Transaction Refund", "MAIN");
       revert_upi_com($refrence , $usID ,46);
       
          //send sms of the txn
        $sndam = number_format($txn['AMOUNT'] , 2);
        $usbl = number_format($refundBal , 2);
        $usermb = substr($user['MOBILE'] , 7 , 10);
         $mbmsg = urlencode("INR $sndam has been Credited from your Paydeer.in A/C No *******$usermb  towards UPI Refund Txn. $refrence. Main Wallet Avl BAL is INR $usbl. Team PayDeer");
          $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);
      
      
      
        //  insert_allreport($usID  ,$refrence , "UPI Failed" , $user['MAIN_BAL']  , $refundBal , $txn['AMOUNT'] , "Credit" , "UPI Transaction Failed", "MAIN");
    }
   $con->query("update upi_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $result)."'   , STATUS='$status'  where REFFRENCE_ID='$refrence' ");
}


?>