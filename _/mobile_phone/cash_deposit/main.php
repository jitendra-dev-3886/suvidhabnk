<?php

$id = $_POST['user_id'];
$token = $_POST['token'];
$usertype_id = $_POST['user_type'];
include("../includes/config.php");
include("../includes/main_function.php");
include("../includes/fetch_data.php");

        $mysql_qry = "select * FROM user WHERE ID ='$id' AND TOKEN_ID = '$token'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
        }else{
            
            $rs = json_encode(array("responsecode"=>  999 , "message"=>"Session Expired", "response_code"=>999, "status"=>false));
            echo $rs;
            return;
        }

if(isset($_POST['send_otp'])){
    //$name = $_POST['fname'];
    $am = $_POST['amount'];
    $acc = $_POST['account'];
    $mobile = $_POST['mobile'];
    $long = $_POST['long'];
    $lati = $_POST['lati'];
    $id = $_POST['user_id'];
    
    
    
    $merchant_mobile = $user['MOBILE'];
    $merchants = $con->query("SELECT * FROM `aeps_merchant` WHERE MOBILE='$merchant_mobile'")->fetch_assoc();
    $merchant_id = $merchants['MERCHANTCODE'];
    
    $refrence =  substr(str_shuffle("123457890QWERTYUIOPASDFGHJKLZXCVBNMasdfghjklqwertyuiopzxcvbnm") , 0 , 10);
    $tkn = create_token();
    
    $curl = curl_init();
    $data = json_encode(array('timestamp' => time() ,'longitude' =>$long,'latitude' => $lati,'mobilenumber' => $mobile,
    'accountnumber' => $acc,'referenceno' => $refrence,'submerchantid' => $merchant_id,'amount' => $am,'ipaddress' => $_SERVER['REMOTE_ADDR'],'pipe' => 'bank1'));
    // echo $data;
    // return;
 
            curl_setopt_array($curl, [
              CURLOPT_URL => $paysprint['URL']."/api/v1/service/cashdeposit/cashdeposit/sendotp",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $data,
              CURLOPT_HTTPHEADER => [
                  "Accept: application/json",
                "Content-Type: application/json",
                "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                "Token: ".$tkn
               ],
            ]);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            echo trim($response);
}


if(isset($_POST['verifyotp'])){
    $acc = $_POST['account'];
    $otp = $_POST['otp'];
    $mtxn = $_POST['merchanttxnid'];
    $txntoken = $_POST['txnreferenceno'];
    $onetimetoken = $_POST['onetimetoken'];
    $benename = $_POST['beneficiaryName'];
    $id = $_POST['user_id'];
    
    
    $merchant_mobile = $user['MOBILE'];
    $merchants = $con->query("SELECT * FROM `aeps_merchant` WHERE MOBILE='$merchant_mobile'")->fetch_assoc();
    $merchant_id = $merchants['MERCHANTCODE'];
    
    $tkn = create_token();
    $curl = curl_init();
    $jsonData = json_encode(array('merchanttxnid' => $mtxn,'txntoken' => $onetimetoken,'txnreferenceno' => $txntoken,'otp' => $otp,'submerchantid' => $merchant_id));
    // echo $jsonData;
    curl_setopt_array($curl, [
      CURLOPT_URL => $paysprint['URL']."/api/v1/service/cashdeposit/cashdeposit/verifyotp",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $jsonData,
      CURLOPT_HTTPHEADER => [
          "Accept: application/json",
        "Content-Type: application/json",
        "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
        "Token: ".$tkn
      ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    
    curl_close($curl);
    echo $response;
       $rstl = json_decode($response);
      $rs_code = $rstl->responsecode; 
      $msg = $rstl->message;
      if($rs_code == 1){
      }
}


if(isset($_POST['start_transact'])){
    $mtxn1 = $_POST['mcid'];
    $txntoken1 = $_POST['txntoken'];
    $refrence = $_POST['ref'];
    $acc = $_POST['acc'];
    $amount = $_POST['amount'];
    $usertype_id = $user['USER_TYPE'];
    $jsonData = json_encode(array('merchanttxnid' => $mtxn1,'txntoken' => $txntoken1,'txnreferenceno' => $refrence));
    
  $insert_report = "INSERT INTO `cash_deposit_transaction`( `USER_ID`, `USER_TYPE`, `ACC_NUM`, `AMOUNT`, `REFFRENCE_ID`, `SEND_DATA`)
        VALUES ('$id','$usertype_id','$acc','$amount','$refrence','".str_replace("'" , "\'" , $jsonData)."')";
        
        $user_bal = $user['MAIN_BAL']-$amount;
        if($user_bal >= 0){
                $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$id' and USER_TYPE='$usertype_id'";
                if($con->query($insert_report) && $con->query($deduct_bal) ){
                //  echo $data;  
  $tkn = create_token();
            $curl = curl_init();
            // echo $jsonData;
            curl_setopt_array($curl, [
              CURLOPT_URL => $paysprint['URL']."/api/v1/service/cashdeposit/cashdeposit/transact",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $jsonData,
              CURLOPT_HTTPHEADER => [
                  "Accept: application/json",
                "Content-Type: application/json",
                "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                "Token: ".$tkn
              ],
            ]);
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            echo trim($response);
              $rstl = json_decode($response);
              $rs_code = $rstl->response_code; 
              $msg = $rstl->message;
              $st_msg = $rstl->txn_status;
              if($rs_code == 1){
                  $st = "Success";
                insert_allreport($id  ,$refrence , "Cash Deposit" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "Cash Deposit Transaction","ip_address", "device");
              }
              else{
                  $st = "Failed";
                insert_allreport($id  ,$refrence , "Cash Deposit" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $amount , "Failed" , "Cash Deposit Transaction","ip_address", "device");
              }
              
              $con->query("update cash_deposit_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st' where REFFRENCE_ID='$refrence' ");
                
              if($rs_code != 1 && $rs_code != 0){
                //   $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$id' and USER_TYPE='$usertype_id' ");
              }
              else{
                // have to give lic bill commision 
                //   give_dmt_com($refrence , $id ,$usertype_id);
              }
        }
        else{
            echo json_encode(array("response_code"=>  500 , "message"=>"Internel Server Error.", "responsecode"=>  500));
        }
    }
    else{
        echo json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance.", "responsecode"=>  400));
    }
    
}
?>