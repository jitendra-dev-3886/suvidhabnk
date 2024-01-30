<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
require("aeps_function.php");
$time = date("Y-m-d g:i:s A");


// check service status
$srst = $con->query("select * from service_status where ID='1'")->fetch_assoc();
if($srst['AEPS'] != "ON"){
    echo json_encode(array("status"=>false ,"response_code"=>  403 , "message"=>"This service is temporarily down." ,  "receivableData"=>["status"=>false, "response_code"=>  403 , "message"=>"This service is temporarily down."]));
    exit;
}

if(isset($_POST['aadhar'])){
      $timestamp = date("Y-m-d H:i:s");
      $time = date("g:i:s A");
      $date  = date("Y-m-d");
      $adhar = strip_tags($_POST['aadhar']);
      $finger = $_POST['fingerData'];
      $mobile = strip_tags($_POST['mobile']);
      $trans = strip_tags($_POST['transType']);
      $bank = strip_tags($_POST['bankName']);
      $long = $_POST['long'];
      $lat = $_POST['lat'];
      $am = $_POST['amount'];
      if($trans == "CW"){
          $url =  $paysprint['URL']."/api/v1/service/aeps/cashwithdraw/index";
          $msg = "Cash Withdrawl";
          if($am <= 101){
                echo json_encode(array("response_code"=>  500 , "message"=>"Please enter amount greater than 101. "));
              exit;
          }
          else if($am > 10000){
              echo json_encode(array("response_code"=>  500 , "message"=>"Please enter amount less than or equal to 10000. "));
              exit;
          }
      }
      else if($trans == "BE"){
          $url =  $paysprint['URL']."/api/v1/service/aeps/balanceenquiry/index";
          $msg = "Balance Enquiry";
      }
      else if($trans == "MS"){
          $url =  $paysprint['URL']."/api/v1/service/aeps/ministatement/index";
          $msg = "Mini Statement";
      }
      else if($trans == "M"){
          $url =  $paysprint['URL']."/api/v1/service/aadharpay/aadharpay/index";
          $msg = "Aadhar pay";
        if($am <= 101){
                echo json_encode(array("response_code"=>  500 , "message"=>"Please enter amount greater than 101. "));
              exit;
          }
          else if($am > 10000){
              echo json_encode(array("response_code"=>  500 , "message"=>"Please enter amount less than or equal to 10000. "));
              exit;
          }
      }
      
      
      if($_POST['device']==null || $_POST['device']==""){
          $accessmodetype = "SITE";
      }
      else{
          $accessmodetype = "APP";
      }
      
      
      $rtData = $con->query("select * from user where ID='".$usid."'")->fetch_assoc();
    $merchnt =$rtData['MOBILE'];
      
     $refrence = "PDRAP".$usid.date("md").date("is");
        $mc_id = $paysprint['MERCHANT_CODE'].$usid;
     if($trans == "CW" || $trans == "M"){
           $arr = array(
            "latitude"=>"$lat",
            "longitude"=>"$long",
            "mobilenumber"=>"$mobile",
            "referenceno"=>$refrence,
            "ipaddress"=> $_SERVER['REMOTE_ADDR'],
            "adhaarnumber"=>$adhar,
            "accessmodetype"=>$accessmodetype,
            "nationalbankidentification"=>"$bank",
            "requestremarks"=>"$msg",
            "data"=>"$finger",
            "pipe"=>"bank1",
            "timestamp"=>"$timestamp",
            "transactiontype"=>"$trans",
            "submerchantid"=>"$mc_id",
            "amount"=>$am,
            "is_iris" => false,
            );
      }
      else{
        $arr = array(
            "latitude"=>"$lat",
            "longitude"=>"$long",
            "mobilenumber"=>"$mobile",
            "referenceno"=>$refrence,
            "ipaddress"=> $_SERVER['REMOTE_ADDR'],
            "adhaarnumber"=>$adhar,
            "accessmodetype"=>$accessmodetype,
            "nationalbankidentification"=>"$bank",
            "requestremarks"=>"$msg",
            "data"=>"$finger",
            "pipe"=>"bank1",
            "timestamp"=>"$timestamp",
            "transactiontype"=>"$trans",
            "submerchantid"=>"$mc_id",
            "is_iris" => false,
            );
      }
            // echo json_encode($arr);
            // exit;
            $data_tkn = encryptaeps($arr);
            $sendData = array(
                "body"=>$data_tkn,
                );
                
                
            $main_body = json_encode($sendData , true);
          //  echo $main_body;
          //   exit;
            $token = create_token();
        $user = $con->query("select * from user  where ID='$usid' ")->fetch_assoc();
        if($user['AEPS_BAL'] != ""){
            $insert_report = "INSERT INTO `aeps_transactions`(`USER_ID`, `USER_TYPE`, `MOBILE`, `TIMESTAMP`, `TRANS_TYPE`, `REFFRENCE_ID`, `ACCESS_MODE`, `MERCHANT_ID`,
            `ADHAAR_NUM`, `AMOUNT`, `FILTER_DATE`) VALUES ('$usid','$ustypeid','$mobile', '$time ','$trans','$refrence','$accessmodetype','$mc_id','".encrypt_token(substr($adhar , 8 , 12))."', '$am' , '".date("Y-m-d")."')";
            if($con->query($insert_report)){
                        $curl = curl_init();
                        curl_setopt_array($curl, [
                          CURLOPT_URL => $url,
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 30,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "POST",
                          CURLOPT_POSTFIELDS => $main_body,
                          CURLOPT_HTTPHEADER => [
                             "Content-Type: application/json",
                            "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                            "Token:".$token
                            ],
                        ]);
                        
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        
                        curl_close($curl);
                        
                        //API Hit Log insert code here
                         $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','Aeps','$refrence','$token','$main_body','$response')");
                         
                            if($response == "" || $response == null){
                              $con->query("update aeps_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='Pending,Server Down' where REFFRENCE_ID='$refrence' ");
                                echo json_encode(array("response_code"=>  500 , "message"=>"Server Down. Try again after some time."));
                                exit;
                            }
                            echo $response;
                          $rslt = json_decode($response);
                          $status = $rslt->status;
                          $rrn = $rslt->bankrrn;
                          $msg = $rslt->message;
                          $rs_code = $rslt->response_code; 
                          if($rs_code == 1){
                              $st  = "Success";
                          }
                          else{
                              $st = "Failed";
                          }
                           callToRecon($refrence , $st);
                          // Response for cash withdrawl
                          $con->query("update aeps_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st,$msg' where REFFRENCE_ID='$refrence' ");
                          if($trans == "CW"){
                              if($rs_code == 1){
                                  $user_bal = $user['AEPS_BAL']+$am;
                                  $deduct_bal = "update user set AEPS_BAL='$user_bal' where ID='$usid' ";
                                  $con->query("update user set AEPS_BAL='$user_bal' where ID='$usid'  ");
                                  insert_allreport($usid  ,$refrence , "AEPS" , $user['AEPS_BAL']  , $user_bal , $am , "Credit" , "Aeps Transaction", "AEPS");
                                  
                                   //send sms of the txn
                                    $sndam = number_format($am , 2);
                                    $usbl = number_format($user_bal , 2);
                                    $usermb = substr($user['MOBILE'] , 7 , 10);
                                    $mbmsg = urlencode("INR $sndam has been Credited from your Paydeer.in A/C No *******$usermb  towards AEPS Txn. $refrence. AEPS Wallet Avl BAL is INR $usbl. Team PayDeer");
                                    $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);
      
                                  
                                  give_aeps_com($refrence , $usid ,"46");
                              }
                          }
                          else if($trans == "M"){
                              if($rs_code == 1){
                                  $user_bal = $user['AEPS_BAL']+$am;
                                //   $deduct_bal = "update user set AEPS_BAL='$user_bal' where ID='$usid' ";
                                  $con->query("update user set AEPS_BAL='$user_bal' where ID='$usid'  ");
                                  insert_allreport($usid  ,$refrence , "AEPS ADHAAR_PAY" , $user['AEPS_BAL']  , $user_bal , $am , "Credit" , "Aeps adhaarpay Transaction" , "AEPS");
                                  
                                    //send sms of the txn
                                    $sndam = number_format($am , 2);
                                    $usbl = number_format($user_bal , 2);
                                    $usermb = substr($user['MOBILE'] , 7 , 10);
                                    $mbmsg = urlencode("INR $sndam has been Credited from your Paydeer.in A/C No *******$usermb  towards AdhaarPay Txn. $refrence. AEPS Wallet Avl BAL is INR $usbl. Team PayDeer");
                                    $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);
      
                                  
                                  
                                  aadhar_com($refrence , $usid , "46");
                              }
                          }
                          else if($trans == "MS"){
                              if($rs_code == 1){
                                  $comm =$con->query("SELECT * FROM `etax_commission` WHERE SERVICE='Mini Statement'")->fetch_assoc();
                                        $rtcom = $comm['RT_COMM'];
                                        $dtcom = $comm['DT_COMM'];
                                         $user = $con->query("select * from user  where ID='$usid' ")->fetch_assoc();
                                        $ds_id = $user['OWNER_ID'];
                                        $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
                                        
                                            $us_main_bal = $user['MAIN_BAL'];
                                            $ds_main_bal = $ds_data['MAIN_BAL'];
                                            
                                            $update_bal = $us_main_bal+$rtcom;
                                            $ds_update_bal = $ds_main_bal+$dtcom;
                                            
                                            
                                        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$usid' ");
                                       
                                        insert_allreport($usid  ,$refrence , "Aeps MS Commission"  ,$us_main_bal , $update_bal , $rtcom , "Credit" , "Aeps MS Transaction Commission" , "MAIN");
                                        
                                        $con->query("update user set MAIN_BAL='$ds_update_bal'  where ID='$ds_id' ");
                                        
                                        insert_allreport($ds_id  ,$refrence , "Aeps MS Commission"  ,$ds_main_bal , $ds_update_bal , $dtcom ,  "Credit" , "Aeps MS Transaction Commission" , "MAIN");
                                        
                              }
                          }
                }
            else{
                echo json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
            }
        }
        else{
                echo json_encode(array("response_code"=>  500 , "message"=>"Balance could not fetched. Please retry or Relogin your account .."));
        }
}


function callToRecon($ref , $status){
    global $con , $paysprint;
    
        $arr = array(
            "reference"=>"$ref",
            "status"=>"$status",
            );
            
        $data_tkn = encryptaeps($arr);
        $sendData = array(
            "body"=>$data_tkn,
            );
        $main_body = json_encode($sendData , true);
        $token = create_token();
        
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => $paysprint['URL']."/api/v1/service/aeps/threeway/threeway",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $main_body,
          CURLOPT_HTTPHEADER => [
             "Content-Type: application/json",
            "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
            "Token:".$token
            ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        
    //   echo $response;
      $con->query("INSERT INTO `aeps_recon_response`(`DATA`, `RESPONSE`) VALUES ('".json_encode($arr)."','$response')");
}




// update transaction status
if(isset($_POST['check_aeps_status'])){
$refrence = $_POST['ref_id'];
$curl = curl_init();
// echo "$refrence";
// exit;

      $arr = array(
            "reference"=>"$refrence",
            );
            
        $data_tkn = encryptaeps($arr);
        $sendData = array(
            "body"=>$data_tkn,
            );
        $main_body = json_encode($sendData , true);
        
        // echo json_encode($arr)."<br>".$main_body;
        // exit;
       $tkn = create_token();
    //   echo $data;
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/aeps/aepsquery/query",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $main_body,
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
        "Content-Type: application/json",
        "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
        "Token: ".$tkn
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
echo $response;
curl_close($curl);
       $rslt = json_decode($response);
          $status = $rslt->status;
          $rrn = $rslt->bankrrn;
          $msg = $rslt->message;
          $rs_code = $rslt->response_code; 
          $txn_st = $rslt->txnstatus; 
        //   echo "<br>".$txn_st;
          if($txn_st == 1){
              $st  = "Success";
          }
          else if($txn_st == 2){
              $st  = "Pending";
          }
          else{
              $st = "Failed";
          }
    //   exit;
      $transaction = $con->query("select * from aeps_transactions where REFFRENCE_ID='$refrence'")->fetch_assoc();
      $user = $con->query("select * from user where ID='$usid'")->fetch_assoc();
      $update_bal = $user['AEPS_BAL'] + $transaction['AMOUNT'];
      
          // Response for cash withdrawl
          $con->query("update aeps_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st,$msg' where REFFRENCE_ID='$refrence' ");
          if($transaction['TRANS_TYPE'] == "CW"){
              if($txn_st == 1){
                  $user_bal = $user['AEPS_BAL']+$transaction['AMOUNT'];
                  $deduct_bal = "update user set AEPS_BAL='$user_bal' where ID='$usid' ";
                  $con->query($deduct_bal);
                //   insert_allreport($usid  ,$refrence , "AEPS" , $user['AEPS_BAL']  , $user_bal , $transaction['AMOUNT'] , "Credit" , "Aeps Transaction");
                  give_aeps_com($refrence , $usid , $ustypeid);
              }
          }
         callToRecon($refrence , $status);
}




?>