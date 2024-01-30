<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
include('dmt_function.php');
$time = date("Y-m-d g:i:s A");
$date = date("Y-m-d");


// check service status
$srst = $con->query("select * from service_status where ID='1'")->fetch_assoc();
if($srst['DMT'] != "ON"){
    echo json_encode(array("status"=>false ,"response_code"=>  403 , "message"=>"This service is temporarily down." ,  "receivableData"=>["status"=>false, "response_code"=>  403 , "message"=>"This service is temporarily down."]));
    exit;
}

// Send otp for registeration
if(isset($_POST['send_otp'])){
    $mb = $_POST['mobile'];
    if($_POST['otpSendTime'] > 3){
        
        $receivableData = ["rs_code"=>500 , "smsotpst" => "OTP Send Limit exceeds. Please try again after some time."];
        
        
        $err = ["response_code"=>500, "message"=>"OTP Send Limit exceeds. Please try again after some time.", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
        
    }
    
    $olduser = $con->query("select * from cf_dmt_user where MOBILE='$mb' ")->num_rows;
    if($olduser >= 1){
        $rscode = 111;
        $receivableData = ["rs_code"=>111 , "smsotpst" => "User is registered"];
        $err = ["response_code"=>111, "message"=>"User is registered.", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
        
        // echo json_encode(["rs_code"=>$rscode]);
        // exit;
    }
    else{
      $otp = mt_rand(99999 , 999999);
       $mbmsg = urlencode("Dear Customer, $otp is the OTP to register $mb  as a Remitter. Do not share your OTP with anyone. PayDeer or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds. Team Paydeer");
      $smsrs = json_decode(sendSMS($mb, $mbmsg , 1307164568552309561) , true);
      
        $receivableData = ["rs_code"=>112 ,  "smsotpst"=> $smsrs['ErrorMessage'] , "OTPHASH"=>encrypt_token($otp) ];
        $err = ["response_code"=>112, "message"=>"Otp has been sent.", "status"=>true, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
    }
  
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
     
$charge_amount = calc_dmt_com($amount , $usid , $ustypeid);
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
    
      $otp2 = mt_rand(99999 , 999999);
      
    $usermb = substr($user['MOBILE'] , 7 , 10);
       $mbmsg2 = urlencode("$otp2 is the OTP to INR $amount has been Debited from your Paydeer.in A/C No *******$usermb  towards DMT Txn. . PayDeer or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds. Team PayDeer");
      $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg2 , 1307164568651364269) , true);
      
        // $receivableData = ["rs_code"=>111 , "smsotpst2"=> $smsrs2['ErrorMessage'] , "OTPHASH2"=>encrypt_token($otp2) ];
        $receivableData = ["rs_code"=>111 , "smsotpst"=> $smsrs2['ErrorMessage'] , "OTPHASH"=>encrypt_token($otp2) ];
        $err = ["response_code"=>1, "message"=>"Otp has been sent.", "status"=>true, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
      
}


if(isset($_POST['hash_code'])){
    extract($_POST);
    
if($otp == ""){
    // echo json_encode(["rscode"=> 403 , "message"=> "OTP Not matched" ]);
    //  exit;
    $err = ["response_code"=>403, "message"=>"OTP Not matched.", "status"=>false];
    echo json_encode($err);
    exit;
}

if($hash_code == ""){
    
    // echo json_encode(["rscode"=> 403 , "message"=> "Verification failed" ]);
    //  exit;
    $err = ["response_code"=>403, "message"=>"Verification failed.", "status"=>false];
    echo json_encode($err);
    exit;
}

if($otp != decrypt_token($hash_code)){
    //  echo json_encode(["rscode"=> 403 , "message"=> "OTP Not matched " ]);
    //  exit;
    $err = ["response_code"=>403, "message"=>"OTP Not matched.", "status"=>false];
    echo json_encode($err);
    exit;
}

    $con->query("INSERT INTO `cf_dmt_user`(`USER_ID`, `ADDRESS`, `PINCODE`, `MOBILE`,`TIMESTAMP`) VALUES ('$usid','$address','$pincode','$mobile','".date("Y-m-d g:i:s")."')");
    // echo json_encode(["rs_code"=>111 , "message"=> "Success"]);
    $err = ["response_code"=>111, "message"=>"Success.", "status"=>true];
    echo json_encode($err);
    exit;
}

// Add beneficiary 
if (isset($_POST['beneName'])) {
    extract($_POST);
    $beneList = $con->query("select * from cashfree_beneficiary where ACCOUNT='$beneAcc' and IFSC='$beneIFSC' and REMIT_MOBILE='$remitMobile' and US_ID ='$usid'")->num_rows;
    if($beneList >= 1){
        
        $receivableData = ["subCode" => "301" , "message" => "Bene Already Added in this account "];
        
        $err = ["response_code"=>301, "message"=>"Bene Already Added in this account", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);    
        exit;
    }
    
    $url = "https://payout-api.cashfree.com/payout/v1/addBeneficiary";
    $beneID = "PDR".$usid.date("Ymd").mt_rand(999, 9999);
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
    $msg = $response['message'];

    if($msg==null || $msg ==""){
                $msg = "";
    }

    $receivableData = json_decode($result);
    
    
    if ($subCode == "200") {
        
        $err = ["response_code"=>1, "message"=>$msg, "status"=>true, "receivableData"=>$receivableData];
        echo json_encode($err);    
        
        $con->query("INSERT INTO `cashfree_beneficiary`(`NAME`, `EMAIL`, `MOBILE`, `ACCOUNT`, `IFSC`, `ADDRESS`, `BENEID`, `DATE`,`US_ID` , `REMIT_MOBILE`)
        VALUES ('$beneName','$beneEmail','$beneMobile','$beneAcc','$beneIFSC','$beneAdd','$beneID','" . date("Y-m-d") . "','$usid' , '$remitMobile')");
    }
    else if ($subCode == "409") {
        
        if($msg=="Entered bank Account is already registered" || $msg=="Bene Already Added in this account"){
            
            $err = ["response_code"=>1, "message"=>$msg, "status"=>true, "receivableData"=>$receivableData];
        }
        else{
            $err = ["response_code"=>2, "message"=>$msg, "status"=>false, "receivableData"=>$receivableData];
        }
        echo json_encode($err);   
        
        $bene = $con->query("select * from cashfree_beneficiary where MOBILE='$beneMobile' and ACCOUNT='$beneAcc' and IFSC='$beneIFSC' order by ID DESC LIMIT 1")->fetch_assoc();
        $beneId = $bene['BENEID'];
        
        $fetchedBeneId =  getBeneficiaryId($beneAcc, $beneIFSC);
        if($fetchedBeneId ==null || $fetchedBeneId == ""){
            $beneId = $bene['BENEID'];
        }
        else{
           $beneId = $fetchedBeneId;
        }
        
        
        $con->query("INSERT INTO `cashfree_beneficiary`(`NAME`, `EMAIL`, `MOBILE`, `ACCOUNT`, `IFSC`, `ADDRESS`, `BENEID`, `DATE`,`US_ID`, `REMIT_MOBILE`)
        VALUES ('$beneName','$beneEmail','$beneMobile','$beneAcc','$beneIFSC','$beneAdd','$beneId','" . date("Y-m-d") . "','$usid', '$remitMobile')");
    }
    else{
        if($msg=="Entered bank Account is already registered" || $msg=="Bene Already Added in this account"){
            
            $err = ["response_code"=>1, "message"=>$msg, "status"=>true, "receivableData"=>$receivableData];
        }
        else{
            $err = ["response_code"=>2, "message"=>$msg, "status"=>false, "receivableData"=>$receivableData];
        }
        echo json_encode($err);   
    }
}


// Delete Beneficiary
if (isset($_POST['bene_delete'])) {
    extract($_POST);
    
     $beneList = $con->query("select * from cashfree_beneficiary where `BENEID`='$beneID'")->num_rows;
    if($beneList > 1){
         $con->query("DELETE FROM `cashfree_beneficiary` WHERE `BENEID`='$beneID' and US_ID='$usid' and REMIT_MOBILE='$remitMobile'");
        $receivableData = ["subCode" => "200" , "message" => "Bene Deleted from this account. "];
        
        $err = ["response_code"=>1, "message"=>"Bene Deleted", "status"=>true, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
        
    }
    
    
    $url = "https://payout-api.cashfree.com/payout/v1/removeBeneficiary";
    $data = json_encode([
        "beneId" => $beneID
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
    $msg = $response['message'];


    if ($subCode == 200) {
        $con->query("DELETE FROM `cashfree_beneficiary` WHERE `BENEID`='$beneID' ");
    
        $err = ["response_code"=>1, "message"=>$msg, "status"=>true, "receivableData"=>$response];
        echo json_encode($err);
    }
    else{
        
        $err = ["response_code"=>2, "message"=>$msg, "status"=>false, "receivableData"=>$response];
        echo json_encode($err);
    }
    
}


// Send Amount 
if(isset($_POST['send_amount'])){
$bene_id = strip_tags($_POST['bene_id']);
$acc = strip_tags($_POST['send_am_acc']);
$send_amount = strip_tags($_POST['send_amount']);
$hash_code = strip_tags($_POST['smhash_code']);

$mb = strip_tags($_POST['remitter_mobile']);
$otp = strip_tags($_POST['agentOTP']);
    
$charge_amount = calc_dmt_com($send_amount , $usid , $ustypeid);

if($send_amount+$charge_amount > $user['MAIN_BAL']){
    $response = array("response_code"=>  403 , "message" => "Insufficient Balance");
     echo json_encode(array("response_code"=>  400 , "receivableData" => $response));  
    exit;
}


// amount validations
if($send_amount < 100){
    $response = array("response_code"=>  403 , "message" => "Please enter amount greater than 100.");
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

$usBal = $user['MAIN_BAL'];
if($usBal > $send_amount){
      
        //spillt the transaction is amount is greater than 5000
        if($send_amount > 5000){
            $sm = ceil($send_amount/5000);
            for($i=0; $i<$sm; $i++)
            {   
                  $refrence = "PDR".$usid.date("Ymd").mt_rand(999, 9999);
                $snd = 5000;
                if($send_amount > 5000){
                    $am = $send_amount-$snd;
                }
                else{
                    $snd = $send_amount;
                }
                
                
                $insert_report = "INSERT INTO `xdmt_transactions`(`USER_ID`, `USER_TYPE`, `MOBILE`, `BENE_ID`, `ACCOUNT`, `TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID`, `COMM_REFID`,`FILTER_DATE`, `APINAME`)
                VALUES ('$usid','$ustypeid','$mb','$bene_id','$acc','$time','$snd','$txn_type','$refrence' , '$comonRefID','$date', 'CASHFREE')";
                $user_bal = $usBal-$snd;
                $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid'";
                if($con->query($insert_report) && $con->query($deduct_bal) ){
                    $url = "https://payout-api.cashfree.com/payout/v1/requestAsyncTransfer";
           
                      $data = json_encode([
                        "beneId" => $bene_id,
                        "amount" => $snd,
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
                    $response = json_decode($result, true);
                    $subCode = $response['subCode'];
                    $status = $response['status'];
                    $msg = $response['message'];
                    $resRefId = $response['data']['referenceId'];
                    
                          $con->query("update xdmt_transactions set RESPONSE='".str_replace("'" , "\'" , $result)."'  , STATUS='$status' , RES_REFID='$resRefId'  where REFFRENCE_ID='$refrence' ");
                          if($subCode == "200" || $subCode == "201" || $subCode == "202"){
                              insert_allreport($usid  ,$refrence , "XDMT" , $usBal  , $user_bal , $snd , "Debit" , "XDMT Transaction", "MAIN");
                              give_dmt_com($refrence , $usid ,$ustypeid);
                               
                                $sndam = number_format($snd , 2);
                                $usbl = number_format($user_bal , 2);
                                $usermb = substr($user['MOBILE'] , 7 , 10);
                                $mbmsg = urlencode("INR $sndam has been Debited from your Paydeer.in A/C No *******$usermb  towards XDMT Txn. $refrence. Main Wallet Avl BAL is INR $user_bal. Team PayDeer");
                                $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);
      
                               // retailer commission
                                //   if($ustypeid == 46 && strtolower($status) == "success"){
                                //   }
                          }
                          else{
                              $con->query("update user set MAIN_BAL='$usBal' where ID='$usid' ");
                          }
                    }
                    else{
                        $gotrsnps = json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
                    }
                
                $send_amount =  $am;
                $usBal = $user_bal;
            }
           echo json_encode(array("response_code"=>  1 , "txncount"=>  $sm , "TxnType"=>"111" , "receivableData" => $gotrsnps, "message"=>""."$msg"));  
        }
        else{
          $insert_report = "INSERT INTO `xdmt_transactions`(`USER_ID`, `USER_TYPE`, `MOBILE`, `BENE_ID`, `ACCOUNT`, `TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID` , `COMM_REFID`, `FILTER_DATE`, `APINAME`)
            VALUES ('$usid','$ustypeid','$mb','$bene_id','$acc','$time','$send_amount','$txn_type','$refrence' , '$comonRefID', '$date', 'CASHFREE')";
            $user_bal = $user['MAIN_BAL']-$send_amount;
            $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid'";
            if($con->query($insert_report) && $con->query($deduct_bal) ){
             $url = "https://payout-api.cashfree.com/payout/v1/requestAsyncTransfer";
           
              $data = json_encode([
                "beneId" => $bene_id,
                "amount" => $send_amount,
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
            $response = json_decode($result, true);
            $subCode = $response['subCode'];
            $status = $response['status'];
            $msg = $response['message'];
            $resRefId = $response['data']['referenceId'];
                  $con->query("update xdmt_transactions set RESPONSE='".str_replace("'" , "\'" , $result)."'  , STATUS='$status' , RES_REFID='$resRefId'  where REFFRENCE_ID='$refrence' ");
                  if($subCode == "200" || $subCode == "201" || $subCode == "202"){
                      insert_allreport($usid  ,$refrence , "XDMT" , $user['MAIN_BAL']  , $user_bal , $send_amount , "Debit" , "XDMT Transaction", "MAIN");
                      give_dmt_com($refrence , $usid ,$ustypeid);
                      
                        
                      //send sms of the txn
                        $sndam = number_format($send_amount , 2);
                        $usbl = number_format($user_bal , 2);
                        $usermb = substr($user['MOBILE'] , 7 , 10);
                        $mbmsg = urlencode("INR $sndam has been Debited from your Paydeer.in A/C No *******$usermb  towards DMT Txn. $refrence. Main Wallet Avl BAL is INR $usbl. Team PayDeer");
                        $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);
      
                       // retailer commission
                        //   if($ustypeid == 46 && strtolower($status) == "success"){
                        //   }
                  }
                  else{
                      $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid' ");
                  }
                  
               echo json_encode(array("response_code"=>  1 ,"txncount"=>1 , "TxnType"=>"112" , "receivableData" => $response, "message"=>""."$msg"));  
                }
            else{
                    echo json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
                }
        }
    }
    else{
        echo json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
    }
}


//Check Status
if(isset($_POST['check_dmt_status'])){
$refrence = trim($_POST['ref_id']);
$txn = $con->query("select * from xdmt_transactions where REFFRENCE_ID='$refrence'")->fetch_assoc();
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
    
    if(strtolower($status) == "success"){
          echo json_encode(array("response_code"=>  1 , "message"=>$status, "status">true, "receivableData"=>json_decode($result)));
    }
    else{
          echo json_encode(array("response_code"=>  400 , "message"=>$status, "status">false, "receivableData"=>json_decode($result)));
    }
    
    
    if(strtolower($status) == "rejected"){
        $user = $con->query("select * from user where ID='$usID' ")->fetch_assoc();
        $refundBal = $user['MAIN_BAL']+$txn['AMOUNT'];
          $con->query("update user set MAIN_BAL='$refundBal' where ID='$usID'");
          
       insert_allreport($usID  ,$refrence , "XDMT Refund" , $user['MAIN_BAL']  , $refundBal , $txn['AMOUNT'] , "Credit" , "XDMT Transaction Refund", "MAIN");
       
          revert_dmt_com($refrence , $usID ,46);
               //send sms of the txn
        $sndam = number_format($txn['AMOUNT'] , 2);
        $usbl = number_format($refundBal , 2);
        $usermb = substr($user['MOBILE'] , 7 , 10);
         $mbmsg = urlencode("INR $sndam has been Debited from your Paydeer.in A/C No *******$usermb  towards DMT Refund Txn. $refrence. Main Wallet Avl BAL is INR $usbl. Team PayDeer");
          $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);
          
        //  insert_allreport($usID  ,$refrence , "XDMT Failed" , $user['MAIN_BAL']  , $refundBal , $txn['AMOUNT'] , "Credit" , "XDMT Transaction Failed", "MAIN");
    }
   $con->query("update xdmt_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $result)."'   , STATUS='$status'  where REFFRENCE_ID='$refrence' ");
}

if(isset($_POST['row_id'])) {
    
    $rowid = $_POST['row_id'];
    $mysql_qry = "SELECT * FROM cashfree_beneficiary WHERE ID ='$rowid' ORDER BY ID DESC LIMIT 1";
        $result = mysqli_query($con ,$mysql_qry);
        $row = mysqli_fetch_array($result);
        $beneName = $row['NAME'];
        $beneAcc = $row['ACCOUNT'];
        $beneMobile = $row['MOBILE'];
        $beneIFSC = $row['IFSC'];
        
        $oldData = $row['VERIFY_RESPONSE'];
        
        if($oldData != null || $oldData != ""){
            $rspns = json_decode($oldData , true);
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
                echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
                exit;
            }
            else{
                echo json_encode(["message"=>"Mobile $mobileMatch"."<br>"."Name $nameMatch", "response_code"=>300, "status"=>false, "receivableData"=>"Failure"]);
                exit;   
            }
            
        }
    
    
    $data = json_encode([
                 "task"=>"bankTransfer",
                 "essentials" =>[
                 "beneficiaryName"=> $beneName,
                 "beneficiaryAccount"=> $beneAcc,
                 "beneficiaryMobile"=> $beneMobile,
                 "beneficiaryIFSC"=>$beneIFSC
                 ],
                ]);
    $auth = getsignzyAuth();
    $token = $auth['id'];
    $patronId = $auth['userId'];
    $url = "https://preproduction.signzy.tech/api/v2/patrons/$patronId/bankaccountverifications";
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
    $err = curl_error($curl);
    curl_close($curl);
    $rspns = json_decode($response , true);
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
        
        $sql = "UPDATE cashfree_beneficiary SET VERIFY_RESPONSE='$response' WHERE ID='$rowid'";
        mysqli_query($con, $sql);
        
        echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$response]);
        exit;
    }
    else{
        echo json_encode(["message"=>"Mobile $mobileMatch"."<br>"."Name $nameMatch", "response_code"=>300, "status"=>false, "receivableData"=>"Failure"]);
        exit;
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

