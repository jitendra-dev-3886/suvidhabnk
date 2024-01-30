<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
require("function.php");
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
$time = date("Y-m-d g:i:s A");


//  if($usid != 868651){
     
//   $response = array("response_code"=>  403 , "message" => "Service Under maintenance.");
//      echo json_encode(array("response_code"=>  400 ,  "message" => "Service Under maintenance." , "receivableData" => $response));  
//     exit;
    
//  }
    

//submit capture finger data


function getRefid(){
    global $con, $user;
    $refrence =  "SUVFA".$user['ID'].date("YmdHis");
    
    $row = $con->query("select * from `aeps_transactions` where REFFRENCE_ID='$refrence' ")->num_rows;
    if($row == 0 && $refrence !=""){
        return $refrence;
    }
    else{
        getRefid();
    }
}

if(isset($_POST['getBanks'])){
    echo getbank();
    exit();
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
      if($trans == "CW"){
          $url =  "https://fingpayap.tapits.in/fpaepsservice/api/cashWithdrawal/merchant/php/withdrawal";
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
          $url =  "https://fingpayap.tapits.in/fpaepsservice/api/balanceInquiry/merchant/php/getBalance";
          $msg = "Balance Enquiry";
      }
      else if($trans == "MS"){
          $url =  "https://fingpayap.tapits.in/fpaepsservice/api/miniStatement/merchant/php/statement";
          $msg = "Mini Statement";
      }
      else if($trans == "M"){
          $url =  "https://fingpayap.tapits.in/fpaepsservice/api/aadhaarPay/merchant/php/pay";
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
      
       
      $rtData = $con->query("select * from user where ID='".$usid."'")->fetch_assoc();
    $merchnt =$rtData['MOBILE'];
     $refrence = getRefid();
    /**  
    //   $existsrefidcheck = $con->query("select * from aeps_transactions where REFFRENCE_ID='$refrence'")->num_rows;
    //   if($existsrefidcheck > 0){
    //  $refrence = "SUV".mt_rand(100,999).date("md").date("his");
    //   }else{
    //  $refrence = "SUV".mt_rand(100,999).date("md").date("his");
          
    //   }
    **/
    if($refrence == ""){
        $refrence = getRefid();
    }
      
      
    $apuser = $con->query("select * from fing_aeps_merchant where MOBILE='$merchnt' and STATUS='active' order by ID DESC limit 1");
    
    if($apuser == 0){
            echo json_encode(array("response_code"=>  500 , "message"=>"No active merchant found. Contact to admin."));
          exit;
      }
    $apuser = $apuser->fetch_assoc();
    

      $finger = $_POST['fingerData'];
         $xml = simplexml_load_string($finger , "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $fingerar = json_decode($json , true);
       
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
             //   "fType": "'.$fingerar['Resp']['@attributes']['fType'].'",

        $citypear = json_decode($citypejsn , true);
    $refrence = getRefid();    
    $mcTxnID = getRefid();
    $arr = '{
              "merchantTranId": "'.$refrence.'",
              "merchantTransactionId": "'.$mcTxnID.'",
               "languageCode": "en",
               "latitude": '.$lat.',
               "longitude": '.$long.',
               "mobileNumber": "'.$merchnt.'",
               "paymentType": "B",
               "requestRemarks": "'.$msg.' '.$refrence.'",
               "timestamp": "'.$timestamp.'",
               "transactionAmount": "'.$am.'",
               "transactionType": "'.$trans.'",
               "merchantUserName": "'.$apuser['MERCHANTCODE'].'",
               "merchantPin": "'.md5($apuser['MERCHANTCODE']).'",
               "superMerchantId": 969,
               
              "cardnumberORUID": {
                 "adhaarNumber": "'.$adhar.'",
                 "indicatorforUID": 0,
                 "nationalBankIdentificationNumber":"'.$bank.'"
                 },
                 
             "captureResponse": 
                     {
                         "errCode": "'.$fingerar['Resp']['@attributes']['errCode'].'",
                         "errInfo": "'.$fingerar['Resp']['@attributes']['errInfo'].'",
                         "fCount": "'.$fingerar['Resp']['@attributes']['fCount'].'",
                         "fType": "2",
                         "iCount": "0",
                         "iType": null,
                         "pCount": "0",
                         "pType": "0",
                         "nmPoints": "'.$fingerar['Resp']['@attributes']['nmPoints'].'",
                         "qScore": "'.$fingerar['Resp']['@attributes']['qScore'].'",
                         "dpID": "'.$fingerar['DeviceInfo']['@attributes']['dpId'].'",
                         "rdsID": "'.$fingerar['DeviceInfo']['@attributes']['rdsId'].'",
                         "rdsVer": "'.$fingerar['DeviceInfo']['@attributes']['rdsVer'].'",
                         "dc": "'.$fingerar['DeviceInfo']['@attributes']['dc'].'",
                         "mi": "'.$fingerar['DeviceInfo']['@attributes']['mi'].'",
                         "mc":"'.$fingerar['DeviceInfo']['@attributes']['mc'].'",
                         "ci": "'.$citypear[0].'",
                         "sessionKey":"'.$fingerar['Skey'].'",
                         "hmac": "'.$fingerar['Hmac'].'",
                         "PidDatatype": "'.$datatypear[0].'",
                         "Piddata":"'.$fingerar['Data'].'"
                     }
            }';
    //   echo $arr;
    //   exit;
           $insert_report = "INSERT INTO `aeps_transactions`(`USER_ID`, `USER_TYPE`, `MOBILE`, `TIMESTAMP`, `TRANS_TYPE`, `REFFRENCE_ID`, `ACCESS_MODE`, `MERCHANT_ID`,
        `ADHAAR_NUM`, `AMOUNT`, `FILTER_DATE` , `API` ) VALUES ('$usid','$ustypeid','$mobile', '$time ','$trans','$refrence','$accessmodetype','$mc_id','".encrypt_token(substr($adhar , 8 , 12))."', '$am' , '".date("Y-m-d")."' , 'FINGPAY')";
        if($con->query($insert_report)){
                $response = hit($url , $arr , 132412344563 , $refrence);
                // echo $url;
                echo $response;
                // exit;
                //API Hit Log insert code here
                 $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','AepsFingpayHit','$refrence','$token','$arr','$response')");
                 
                    if($response == "" || $response == null){
                      $con->query("update aeps_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='Pending' where REFFRENCE_ID='$refrence' ");
                        echo json_encode(array("response_code"=>  500 , "message"=>"Server Down. Try again after some time."));
                        exit;
                    }
                // echo $response;
                // exit;
                $rslt = json_decode($response , true);
                $status = $rslt['status'];
                $message = $rslt['message'];
                $stcode = $rslt['statusCode'];
                $fptxnid = $rslt['data']['fpTransactionId'];
                $bnkRRN = $rslt['data']['bankRRN'];
                $txnrscode = $rslt['data']['responseCode'];
                $txnst = $rslt['data']['transactionStatus'];
                
                /**
                // if($response == NULL || $response == ''){
                //         $txnst = "Pending";
                // }
                // else if($status == false){
                //         $txnst = "Failed";
                // }
                // else if($bnkRRN != "" && $txnrscode == "00"){
                //         $txnst = "Success";
                // }
                **/
                
                if($response == NULL || $response == ''){
                        $txnst = "Pending";
                }
                else if($status == false){
                        $txnst = "Failed";
                }
                else if($bnkRRN != "" && $txnrscode == "00"){
                        $txnst = "Success";
                }
                
                 // Response for cash withdrawl
                          $con->query("update aeps_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$txnst', MESSAGE='$message' where REFFRENCE_ID='$refrence' ");
                          if($trans == "CW"){
                              if($bnkRRN != "" && $txnrscode == "00"){
                                  $user_bal = $user['AEPS_BAL']+$am;
                                  $deduct_bal = "update user set AEPS_BAL='$user_bal' where ID='$usid' ";
                                  $con->query("update user set AEPS_BAL='$user_bal' where ID='$usid'  ");
                                  insert_allreport($usid  ,$refrence , "AEPS" , $user['AEPS_BAL']  , $user_bal , $am , "Credit" , "Aeps Transaction", "AEPS");
                                  give_aeps_com($refrence , $usid ,"46");
                              }
                          }
                          else if($trans == "M"){
                              if($bnkRRN != "" && $txnrscode == "00"){
                                  $user_bal = $user['AEPS_BAL']+$am;
                                //   $deduct_bal = "update user set AEPS_BAL='$user_bal' where ID='$usid' ";
                                  $con->query("update user set AEPS_BAL='$user_bal' where ID='$usid'  ");
                                  insert_allreport($usid  ,$refrence , "AEPS ADHAAR_PAY" , $user['AEPS_BAL']  , $user_bal , $am , "Credit" , "Aeps adhaarpay Transaction" , "AEPS");
                                  aadhar_com($refrence , $usid , "46");
                              }
                          }
                          else if($trans == "MS"){
                              if($bnkRRN != "" && $txnrscode == "00"){
                                  $comm =$con->query("SELECT * FROM `etax_commission` WHERE SERVICE='Mini Statement'")->fetch_assoc();
                                        $rtcom = $comm['RT_COMM'];
                                        $dtcom = $comm['DT_COMM'];
                                         $user = $con->query("select * from user  where ID='$usid' ")->fetch_assoc();
                                        $ds_id = $user['OWNER_ID'];
                                        $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
                                        
                                            $us_main_bal = $user['MAIN_BAL'];
                                            $ds_main_bal = $ds_data['AEPS_BAL'];
                                            
                                            $update_bal = $us_main_bal+$rtcom;
                                            $ds_update_bal = $ds_main_bal+$dtcom;
                                            
                                            
                                        $con->query("update user set MAIN_BAL='$update_bal'  where ID='$usid' ");
                                       
                                        insert_allreport($usid  ,$refrence , "Aeps MS Commission"  ,$us_main_bal , $update_bal , $rtcom , "Credit" , "Aeps MS Transaction Commission" , "MAIN");
                                        
                                        $con->query("update user set AEPS_BAL='$ds_update_bal'  where ID='$ds_id' ");
                                        
                                        insert_allreport($ds_id  ,$refrence , "Aeps MS Commission"  ,$ds_main_bal , $ds_update_bal , $dtcom ,  "Credit" , "Aeps MS Transaction Commission" , "AEPS");
                                        
                              }
                          }
                          
                          
                // Hit Recon API
                $jsonDt = '[{"serviceType":"'.$trans.'","merchantTransactionId":"'.$refrence.'",
                            "fingpayTransactionId":"'.$fptxnid.'",
                            "transactionRrn":"'.$bnkRRN.'",
                            "responseCode":"'.$txnrscode.'",
                            "transactionDate":"'.date("d-m-Y").'"
                            }]';
                
              hitrecon($refrence , 969 , "SUV".$merchnt , $jsonDt,$dc="");
        }
        else{
            echo json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
        }
}