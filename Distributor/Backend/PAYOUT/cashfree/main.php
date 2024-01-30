<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
include('payout_function.php');

// check service status
$srst = $con->query("select * from service_status where ID='1'")->fetch_assoc();
if($srst['PAYOUT'] != "ON"){
    echo json_encode(array("status"=>false ,"response_code"=>  403 , "message"=>"This service is temporarily down." ,  "receivableData"=>["status"=>false, "response_code"=>  403 , "message"=>"This service is temporarily down."]));
    exit;
}


// Add beneficiary 
if (isset($_POST['beneName'])) {
    extract($_POST);
    $url = "https://payout-api.cashfree.com/payout/v1/addBeneficiary";
    $beneID = "PDR".date("Ymd").mt_rand(999, 9999);
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
    echo $result;
    $response = json_decode($result, true);
    $subCode = $response['subCode'];

    if ($subCode == 200) {
        // $con->query("INSERT INTO `cashfree_beneficiary`(`NAME`, `EMAIL`, `MOBILE`, `ACCOUNT`, `IFSC`, `ADDRESS`, `BENEID`, `DATE`,`US_ID`)
        // VALUES ('$beneName','$beneEmail','$beneMobile','$beneAcc','$beneIFSC','$beneAdd','$beneID','" . date("Y-m-d") . "','$usid')");
        $con->query("INSERT INTO `payout_users`(`NAME`, `BENEID`, `BANK_NAME`, `ACCOUNT`, `IFSC`, `SEND_DATA`, `RESPONSE`, `DATE`, `STATUS`, `US_ID`) 
        VALUES ('$beneName','$beneID','$bankName','$beneAcc','$beneIFSC','$data','$result','".date("Y-m-d")."','Success','$usid')");
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
    
        $con->query("INSERT INTO `payout_users`(`NAME`, `BENEID`, `BANK_NAME`, `ACCOUNT`, `IFSC`, `VERIFY_RESPONSE`, `SEND_DATA`, `RESPONSE`, `DATE`, `STATUS`, `US_ID`) 
        VALUES ('$NAME','$beneId','$bankName','$beneAcc','$beneIFSC', '".str_replace("'" , "\'" .$VERIFY_RESPONSE)."' ,'$data','$result','".date("Y-m-d")."','Success','$usid')");
    }
}



// send otp for transaction 
if(isset($_POST['sendotp'])){
    extract($_POST);
    if($amount == ""){
        $receivableData = ["smsotpst"=> "Amount cannot be empty", "OTPHASH"=>"" ];
        $err = ["response_code"=>3, "message"=>"Amount cannot be empty", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
        
        //echo json_encode(array("rscode"=>  500 , "message"=>"Amount cannot be empty"));
        //exit;
    }
    if($amount < 100 ){
        $receivableData = ["smsotpst"=> "Enter amount greater than 100", "OTPHASH"=>"" ];
        $err = ["response_code"=>3, "message"=>"Enter amount greater than 100", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
        
        //echo json_encode(array("rscode"=>  500 , "message"=>"Amount cannot be empty"));
        //exit;
    }
      
    $charge_amount = calc_com($amount , $usid , $ustypeid);

     if($amount > $user['AEPS_BAL'] && $charge_amount > $user['MAIN_BAL']){
         $receivableData = ["smsotpst"=> "Your balance is low.", "OTPHASH"=>"" ];
        $err = ["response_code"=>3, "message"=>"Your balance is low.", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
        
        //echo json_encode(array("rscode"=>  500 , "message"=>"Amount cannot be empty"));
        //exit;
    }
      if($_POST['otpSendTime'] > 3){
        
        $receivableData = ["rs_code"=>500 , "smsotpst" => "OTP Send Limit exceeds. Please try again after some time."];
        
        
        $err = ["response_code"=>500, "message"=>"OTP Send Limit exceeds. Please try again after some time.", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
    }
    
    $usmb = $user['MOBILE'];
    $email = $user['EMAIL'];
    
    $otp = mt_rand(99999 , 999999);
     // send OTP on agent mobile
    $usermb = substr($user['MOBILE'] , 7 , 10);
      $otp2 = mt_rand(99999 , 999999);
      $mbmsg2 = urlencode("$otp2 is the OTP to INR $amount has been Debited from your Paydeer.in A/C No *******$usermb  towards Payout Txn. . PayDeer or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds. Team PayDeer");
      $smsrs = json_decode(sendSMS($user['MOBILE'] , $mbmsg2 , 1307164568651364269) , true);
      
  
  $receivableData = ["smsotpst"=> $smsrs['ErrorMessage'] , "OTPHASH"=>encrypt_token($otp2) ];
  
  if($smsrs['ErrorMessage']=="Success"){
    $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true, "receivableData"=>$receivableData];      
  }
  else{
      $err = ["response_code"=>3, "message"=>$smsrs['ErrorMessage'], "status"=>false, "receivableData"=>$receivableData];   
  }
  
  echo json_encode($err);
  
}


// payout Transactiono acount.
if(isset($_POST['send_amount'])){
    
$bene_id  =$payout_user['BENEID'];
$acc = $payout_user['ACCOUNT'];


$amount = strip_tags($_POST['send_amount']);
//verify the otp 
$verify = strip_tags($_POST['verify']);
$otp = strip_tags($_POST['otp']);

// amount validations
if($amount < 100){
    $response = array("response_code"=>  403 , "message" => "Please enter amount greater than 100.");
     echo json_encode(array("response_code"=>  400 ,"message" => "Please enter amount greater than 100.", "receivableData" => $response));  
    exit;
}

if($otp == ""){
    
    $err = ["response_code"=>3, "message"=>"OTP Not matched", "status"=>false];
    echo json_encode($err);
    exit;
}

if($verify == ""){
    
    $err = ["response_code"=>3, "message"=>"Verification failed", "status"=>false];
    echo json_encode($err);
    exit;
}

if($otp != decrypt_token($verify)){
    
    $err = ["response_code"=>3, "message"=>"OTP Not matched ", "status"=>false];
    echo json_encode($err);
    exit;
}

$refrence = "PDR".date("Ymd").mt_rand(999, 9999);
 
$insert_report = "INSERT INTO `payout_transaction`(`USER_ID`, `BENE_ID`,`ACCOUNT`,`TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID` ,`FILTER_DATE`)
VALUES ('$usid','$bene_id','$acc','".date("g:i:s A")."','$amount','$mode','$refrence' , '".date("Y-m-d")."')";
$user_bal = $user['AEPS_BAL']-$amount;

$charge_amount = calc_com($amount , $usid , $ustypeid);
    
if($user_bal-$charge_amount >= 0 && $amount > 0){
        $deduct_bal = "update user set AEPS_BAL='$user_bal' where ID='$usid'";
        if($con->query($insert_report) && $con->query($deduct_bal) ){
        $url = "https://payout-api.cashfree.com/payout/v1/requestAsyncTransfer";
        $data = json_encode([
                "beneId" => $bene_id,
                "amount" => $amount,
                "transferId" => $refrence
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
            $status = $response['status'];
            $msg = $response['message'];
            $resRefId = $response['data']['referenceId'];
            
            if($msg==null || $msg ==""){
                $msg = $status;
            }
            
            if(strtolower($status) == "success"){
                echo json_encode(array("response_code"=>1 , "message"=>$msg, "status"=>true, "receivableData"=>json_decode($result)));
            }
            if(strtolower($status) == "accepted"){
                echo json_encode(array("response_code"=>1 , "message"=>"Pending  ".$msg, "status"=>true, "receivableData"=>json_decode($result)));
            }
            else if(strtolower($status) == "rejected" || strtolower($status) == "error"){
                echo json_encode(array("response_code"=>3 , "message"=>$msg, "status"=>false, "receivableData"=>json_decode($result)));
            }
            else {
                echo json_encode(array("response_code"=>2 , "message"=>$msg, "status"=>false, "receivableData"=>json_decode($result)));
            }
            
            
            if($subCode == "200" || $subCode == "201" || $subCode == "202"){
              $con->query("update payout_transaction set RESPONSE='".str_replace("'" , "\'" , $result)."'  , STATUS='$status', RES_REFID='$resRefId' where REFFRENCE_ID='$refrence' ");
              insert_allreport($usid  ,$refrence , "PAYOUT" , $user['AEPS_BAL']  , $user_bal , $amount , "Debit" , "PAYOUT Transaction", "AEPS");
              
                 //send sms of the txn
                        $sndam = number_format($amount , 2);
                        $usbl = number_format($user_bal , 2);
                        $usermb = substr($user['MOBILE'] , 7 , 10);
                         $mbmsg = urlencode("INR $sndam has been Debited from your Paydeer.in A/C No *******$usermb  towards Payout Txn. $refrence. AEPS Wallet Avl BAL is INR $usbl. Team PayDeer");
                          $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);
      
      
      
                //  if(strtolower($status) == "success"){
                          give_payout_com($refrence , $usid ,$ustypeid);
                    //   }
            //   give_payout_com($refrence , $usid ,$ustypeid);
            }
            else{
              $con->query("update user set AEPS_BAL='".$user['AEPS_BAL']."' where ID='$usid' ");
              $con->query("update payout_transaction set RESPONSE='".str_replace("'" , "\'" , $result)."'  , STATUS='$status' where REFFRENCE_ID='$refrence' ");
            }
        }
        else{
            echo json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it", "status"=>false));
        }
    }
    else{
        echo json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance.", "status"=>false));
    }
    
}


//Check Status
if(isset($_POST['check_status'])){
$refrence = trim($_POST['ref_id']);
$txn = $con->query("select * from payout_transaction where REFFRENCE_ID='$refrence'")->fetch_assoc();
$rsRefId = $txn['RES_REFID'];
$usID = $txn['USER_ID'];


if($rsRefId == ""){
    echo json_encode(array("response_code"=>  400 , "message"=>"Transaction not found for check status. $refrence", "status"=>false));
    exit;
}
if(strtolower($txn['STATUS']) == "success" || strtolower($txn['STATUS']) == "rejected"){
    echo json_encode(array("response_code"=>  400 , "message"=>"Transaction status already confirmed. ", "status"=>false));
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
    
    if(strtolower($status) == "success"){
        echo json_encode(array("response_code"=>1 , "message"=>$msg, "status"=>true, "receivableData"=>json_decode($result)));    
    }
    else{
        echo json_encode(array("response_code"=>2 , "message"=>$msg, "status"=>false, "receivableData"=>json_decode($result)));    
    }
    
    
   $con->query("update payout_transaction set CHECK_RESPONSE='".str_replace("'" , "\'" , $result)."'   , STATUS='$status'  where REFFRENCE_ID='$refrence' ");
    if(strtolower($status) == "rejected"){
        $user = $con->query("select * from user where ID='$usID' ")->fetch_assoc();
        $refundBal = $user['AEPS_BAL']+$txn['AMOUNT'];
          $con->query("update user set AEPS_BAL='$refundBal' where ID='$usID'");
       insert_allreport($usID  ,$refrence , "PAYOUT Refund" , $user['AEPS_BAL']  , $refundBal , $txn['AMOUNT'] , "Credit" , "PAYOUT Transaction Refund", "AEPS");
               
                 
          revert_payout_com($refrence , $usID ,46);
          //send sms of the txn
        $sndam = number_format($txn['AMOUNT'] , 2);
        $usbl = number_format($refundBal , 2);
        $usermb = substr($user['MOBILE'] , 7 , 10);
         $mbmsg = urlencode("INR $sndam has been Credited from your Paydeer.in A/C No *******$usermb  towards Payout Refund Txn. $refrence. Main Wallet Avl BAL is INR $usbl. Team PayDeer");
          $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);
      
      
      
      
        //  insert_allreport($usID  ,$refrence , "Payout Failed" , $user['AEPS_BAL']  , $refundBal , $txn['AMOUNT'] , "Credit" , "Payout Transaction Failed");
    }
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



?>