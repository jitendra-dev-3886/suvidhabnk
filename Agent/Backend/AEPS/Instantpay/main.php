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

if($user['AEPS_COMM'] == ""){
      echo json_encode(array("response_code"=>  500 , "status"=>"Your commission package not set. Contact to admin."));
        exit;
}


if(isset($_POST['regaadhar'])){
      $timestamp = date("Y-m-d H:i:s");
      $time = date("g:i:s A");
      $date  = date("Y-m-d");
      
      $adhar = strip_tags($_POST['regaadhar']);
      $regpan = strip_tags($_POST['regpan']);
      $regmobile = strip_tags($_POST['regmobile']);
      $regemail = strip_tags($_POST['regemail']);
      $long = $_POST['long'];
      $lat = $_POST['lat'];
      
      
        $arr = [
             "mobile"=> $regmobile,
            "pan"=> $regpan,
            "email"=> $regemail,
            "aadhaar"=> encryptaeps($adhar),
            "latitude"=> $lat,
            "longitude"=> $long,
            "consent"=> "Y"
            ];
                
            $main_body = json_encode($arr , true);
            // echo $main_body;
            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => "https://api.instantpay.in/user/outlet/signup/initiate",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $main_body,
              CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                    "X-Ipay-Auth-Code: 1",
                    "X-Ipay-Client-Id: YWY3OTAzYzNlM2ExZTJlOVX4sAN3V5eJmLO2VUng6oE=",
                    "X-Ipay-Client-Secret: 16bf5dca78b6eff629416f8ddb9846be966e3dd93093807ed186b2ca3f1b61a4",
                    "X-Ipay-Endpoint-Ip: 172.67.42.207",
                ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
             if($response == "" || $response == null){
                        echo json_encode(array("response_code"=>  500, "status"=>false, "statuscode"=>  500 , "message"=>"Server Down. Try again after some time."));
                        exit;
            }
            // echo $response;
            $rslt = json_decode($response , true);
            $st = $rslt['statuscode'];
            $odid = $rslt['orderid'];
            $ipayid = $rslt['ipay_uuid'];
            if($st == "TXN"){
                    echo json_encode(array("status"=>true ,"response_code"=>  1 , "message"=>"Success" ,  "receivableData"=>$rslt));
                
                $con->query("INSERT INTO `instant_aeps_merchants`(`USER_ID`, `MOBILE`, `PAN`, `EMAIL`, `AADHAAR`, `RESPONSE`, `OUTID`, `ORDERID`, `IPAYID`)
                VALUES ('$usid','$regmobile','$regpan','$regemail','$adhar','".str_replace("'" , "\'" , $response)."','','$odid','$ipayid')");     
            }
            else{
                echo json_encode(array("status"=>false ,"response_code"=>  2 , "message"=>$rslt['status'] ,  "receivableData"=>$rslt));
            }
            //API Hit Log insert code here
             $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','Aeps','$refrence','$token','$main_body','$response')");
           
}


// otp verification
if(isset($_POST['otpReferenceID'])){
      $timestamp = date("Y-m-d H:i:s");
      $time = date("g:i:s A");
      $date  = date("Y-m-d");
      
      $otpReferenceID = strip_tags($_POST['otpReferenceID']);
      $hash = strip_tags($_POST['hash']);
      $regotp = strip_tags($_POST['regotp']);
      
        $arr = [
             "otpReferenceID"=> $otpReferenceID,
            "hash"=> $hash,
            "otp"=> $regotp
            ];
                
            $main_body = json_encode($arr , true);
            // echo $main_body;
            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => "https://api.instantpay.in/user/outlet/signup/validate",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $main_body,
              CURLOPT_HTTPHEADER => [
                    "Content-Type: application/json",
                    "X-Ipay-Auth-Code: 1",
                    "X-Ipay-Client-Id: YWY3OTAzYzNlM2ExZTJlOVX4sAN3V5eJmLO2VUng6oE=",
                    "X-Ipay-Client-Secret: 16bf5dca78b6eff629416f8ddb9846be966e3dd93093807ed186b2ca3f1b61a4",
                    "X-Ipay-Endpoint-Ip: 172.67.42.207",
                ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
             if($response == "" || $response == null){
                        echo json_encode(array("response_code"=>  500 , "status"=>"Server Down. Try again after some time."));
                        exit;
             }
             
             
                           
            // echo $response;
            $rslt = json_decode($response , true);
            $st = $rslt['statuscode'];
            $odid = $rslt['orderid'];
            $ipayid = $rslt['ipay_uuid'];
            $utleid = $rslt['data']['outletId'];
            
            if($st =="ERR"){
                echo json_encode(["status"=>false, "response_code"=>3, "message"=>$st,  "receivableData"=>$rslt]);
                exit;
            }
            
            if($st == "TXN"){
                echo json_encode(["status"=>true, "response_code"=>1, "message"=>"Success",  "receivableData"=>$rslt]);
                $con->query("update `instant_aeps_merchants` set RESPONSE='".str_replace("'" , "\'" , $response)."' , OUTID='$utleid'  where USER_ID='$usid' ");     
            }
            else{
                echo json_encode(["status"=>false, "response_code"=>3, "message"=>$st,  "receivableData"=>$rslt]);
                exit;
            }
            //API Hit Log insert code here
             $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','Aeps','$refrence','$token','$main_body','$response')");
            exit;
      
      
}



if(isset($_POST['aadhar'])){
      $timestamp = date("Y-m-d H:i:s");
      $time = date("g:i:s A");
      $date  = date("Y-m-d");
      $adhar = strip_tags($_POST['aadhar']);
      $mobile = strip_tags($_POST['mobile']);
      $trans = strip_tags($_POST['transType']);
      $bank = strip_tags($_POST['bankName']);
      $long = $_POST['long'];
      $lat = $_POST['lat'];
      $am = $_POST['amount'];
      $finger = $_POST['fingerData'];
     $xml = simplexml_load_string($finger , "SimpleXMLElement", LIBXML_NOCDATA);
    $json = json_encode($xml);
    $fingerar = json_decode($json , true);
    // echo $finger;
    if($finger == ""){
          echo json_encode(array("statuscode"=>  500 , "status"=>"Finger Not Scanned."));
          exit;
    }
    foreach($xml->Data as $obj){
        $datatype = $obj->attributes()->type;
    }
     $datatypejsn = json_encode($datatype);
    $datatypear = json_decode($datatypejsn , true);
    
    foreach($xml->Skey as $obj){
        $citype = $obj->attributes()->ci;
    }
         $citypejsn = json_encode($citype);
    $citypear = json_decode($citypejsn , true);
    
    
    // print_r($finger);
    // exit;
      if($trans == "CW"){
          $url =  "https://api.instantpay.in/fi/aeps/cashWithdrawal";
          $msg = "Cash Withdrawl";
          if($am <= 101){
                echo json_encode(array("statuscode"=>  500 , "status"=>"Please enter amount greater than 101. "));
              exit;
          }
          else if($am > 10000){
              echo json_encode(array("statuscode"=>  500 , "status"=>"Please enter amount less than or equal to 10000. "));
              exit;
          }
      }
      else if($trans == "BE"){
          $url = "https://api.instantpay.in/fi/aeps/balanceInquiry";
          $msg = "Balance Enquiry";
      }
      else if($trans == "MS"){
          $url =  "https://api.instantpay.in/fi/aeps/miniStatement";
          $msg = "Mini Statement";
      }
      
      
      if($_POST['device']==null || $_POST['device']==""){
          $accessmodetype = "SITE";
      }
      else{
          $accessmodetype = "APP";
      }
      
        $subuser = $con->query("select * from instant_aeps_merchants where USER_ID='$usid' and OUTID<>'' ")->fetch_assoc();
      
         $refrence = "PDR".$usid.date("Ymd").mt_rand(999, 9999);
        $arr = [
             "bankiin"=> $bank,
            "latitude"=> $lat,
            "longitude"=> $long,
            "mobile"=> $mobile,
            "amount"=> $am,
            "externalRef"=> $refrence,
            "biometricData"=> [
                "encryptedAadhaar"=> encryptaeps($adhar),
                "dc"=> $fingerar['DeviceInfo']['@attributes']['dc'],
                "ci"=> $citypear[0],
                "hmac"=> $fingerar['Hmac'],
                "dpId"=> $fingerar['DeviceInfo']['@attributes']['dpId'],
                "mc"=> $fingerar['DeviceInfo']['@attributes']['mc'],
                "pidDataType"=> $datatypear[0],
                "sessionKey"=> $fingerar['Skey'],
                "mi"=> $fingerar['DeviceInfo']['@attributes']['mi'],
                "rdsId"=> $fingerar['DeviceInfo']['@attributes']['rdsId'],
                "errCode"=> $fingerar['Resp']['@attributes']['errCode'],
                "errInfo"=> $fingerar['Resp']['@attributes']['errInfo'],
                "fCount"=> $fingerar['Resp']['@attributes']['fCount'],
                "fType"=> $fingerar['Resp']['@attributes']['fType'],
                "iCount"=> 0,
                "iType"=> "",
                "pCount"=> 0,
                "pType"=> "",
                "srno"=> $fingerar['DeviceInfo']['additional_info']['Param'][0]['@attributes']['value'],
                "sysid"=> $fingerar['DeviceInfo']['additional_info']['Param'][1]['@attributes']['value'],
                "pidData"=> $fingerar['Data'],
                "qScore"=> $fingerar['Resp']['@attributes']['qScore'],
                "nmPoints"=> $fingerar['Resp']['@attributes']['nmPoints'],
                "rdsVer"=>  $fingerar['DeviceInfo']['@attributes']['rdsVer']
            ]];
                
            $main_body = json_encode($arr , true);
            // print_r($main_body);
            //  exit;
        //     $token = create_token();
        $user = $con->query("select * from user  where ID='$usid' ")->fetch_assoc();
        if($user['AEPS_BAL'] != ""){
            $insert_report = "INSERT INTO `aeps_transactions`(`USER_ID`, `USER_TYPE`, `MOBILE`, `TIMESTAMP`, `TRANS_TYPE`, `REFFRENCE_ID`, `ACCESS_MODE`, `MERCHANT_ID`,
            `ADHAAR_NUM`, `AMOUNT`, `FILTER_DATE`) VALUES ('$usid','$ustypeid','$mobile', '$time ','$trans','$refrence','$accessmodetype','".$subuser['OUTID']."','".encrypt_token(substr($adhar , 8 , 12))."', '$am' , '".date("Y-m-d")."')";
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
                                "Accept: application/json",
                                "Content-Type: application/json",
                                "X-Ipay-Auth-Code: 1",
                                "X-Ipay-Client-Id: YWY3OTAzYzNlM2ExZTJlOVX4sAN3V5eJmLO2VUng6oE=",
                                "X-Ipay-Outlet-Id: ".$subuser['OUTID'],
                                "X-Ipay-Client-Secret: 16bf5dca78b6eff629416f8ddb9846be966e3dd93093807ed186b2ca3f1b61a4",
                                "X-Ipay-Endpoint-Ip: 101.53.133.96",
                            ],
                        ]);
                        
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        
                        curl_close($curl);
                        echo $response;
                            
                        //API Hit Log insert code here
                         $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','Aeps','$refrence','$token','$main_body','$response')");
                         
                            if($response == "" || $response == null){
                              $con->query("update aeps_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='Pending,Server Down' where REFFRENCE_ID='$refrence' ");
                                echo json_encode(array("statuscode"=>  500 , "status"=>"Server Down. Try again after some time."));
                                exit;
                            }
                         $rslt = json_decode($response , true);
                          $rrn = $rslt['opreratorId'];
                          $msg = $rslt['status'];
                          $rs_code = $rslt['statuscode'];
                          if($rs_code == "TXN"){
                              $st  = "Success";
                          }
                          else{
                              $st = "Failed";
                          }
                          callToRecon($refrence , $st);
                          // Response for cash withdrawl
                          $con->query("update aeps_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st,$msg' where REFFRENCE_ID='$refrence' ");
                          if($trans == "CW"){
                              if($rs_code == "TXN"){
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
                              if($rs_code == "TXN"){
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
                              if($rs_code == "TXN"){
                                  $comm =$con->query("SELECT * FROM `etax_commission` WHERE SERVICE='Mini Statement'")->fetch_assoc();
                                        $rtcom = $comm['RT_COMM'];
                                        $dtcom = $comm['DT_COMM'];
                                         $user = $con->query("select * from user  where ID='$usid' and USER_TYPE='46'")->fetch_assoc();
                                        $ds_id = $user['OWNER_ID'];
                                        $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
                                        
                                            $us_main_bal = $user['MAIN_BAL'];
                                            $ds_main_bal = $ds_data['MAIN_BAL'];
                                            
                                            $update_bal = $us_main_bal+$rtcom;
                                            $ds_update_bal = $ds_main_bal+$dtcom;
                                            
                                            
                                        $con->query("update user set MAIN_BAL='$update_bal'  where ID='".$usid."' ");
                                       
                                        insert_allreport($usid  ,$refrence , "Aeps MS Commission"  ,$us_main_bal , $update_bal , $rtcom , "Credit" , "Aeps MS Transaction Commission" , "MAIN");
                                        
                                        $con->query("update user set MAIN_BAL='$ds_update_bal'  where ID='$ds_id' ");
                                        
                                        insert_allreport($ds_id  ,$refrence , "Aeps MS Commission"  ,$ds_main_bal , $ds_update_bal , $dtcom ,  "Credit" , "Aeps MS Transaction Commission" , "MAIN");
                                        
                              }
                          }
                }
            else{
                echo json_encode(array("statuscode"=>  500 , "status"=>"Some internel server error. We are fixing it"));
            }
        }
        else{
                echo json_encode(array("statuscode"=>  500 , "status"=>"Balance could not fetched. Please retry or Relogin your account .."));
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
          $msg = $rslt->status;
          $rs_code = $rslt->statuscode; 
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
                  insert_allreport($usid  ,$refrence , "AEPS" , $user['AEPS_BAL']  , $user_bal , $transaction['AMOUNT'] , "Credit" , "Aeps Transaction");
                  give_aeps_com($refrence , $usid , $ustypeid);
              }
          }
         callToRecon($refrence , $status);
}




?>