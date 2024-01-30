<?php
session_start();
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");

include("recharge_function.php");
include("../../../test_api/whatsapp_api.php");

// error_reporting(E_ALL);
// ini_set("display_errors" , 1);

// give_com("TXN852023GAUTAM" , "1" ,"46");
// exit;
$longlat=$con->query("SELECT * FROM `login_history` WHERE USER_ID='$usid' ORDER BY ID DESC")->fetch_assoc();
$longitude=$longlat['LONGITUDE'];
$latitude=$longlat['LATITUDE'];

$time = date("g:i:s A");
$timestamp = date("Y-m-d g:i:s A");
$srst = $con->query("select * from service_status where ID='1'")->fetch_assoc();
if($srst['RECHARGE'] != "ON"){
    echo json_encode(array("status"=>false ,"response_code"=>  403 , "message"=>"This service is temporarily down." ,  "receivableData"=>["status"=>false, "response_code"=>  403 , "message"=>"This service is temporarily down."]));
    exit;
}


if(isset($_POST['recharge_mobile'])){
    $mb = $_POST['recharge_mobile'];
    $am = $_POST['recharge_amount'];
    $op = $_POST['recharge_operator'];
    
    $longi = $_POST['longi'];
    $lati = $_POST['lati'];
    $refrence =  "SUV".date("Ymd").mt_rand(999 , 9999);
    $tpin = strip_tags($_POST['tpin']);
 

// validation of user tpin
$userPin = $con->query("select * from tpin where USER_ID='$usid' AND STATUS='active'");

if($userPin->num_rows == 0){
          echo json_encode(array("response_code"=>  400 , "message" => "Your M-Pin is Blank. Please set tpin first then continue the transaction."));
             exit;
        }
        else{
            $pinData =$userPin->fetch_assoc();
            $Tpin = $pinData['TPIN'];
            if($Tpin == ""){
              echo json_encode(array("response_code"=>  400 , "message" => "Your M-Pin is Blank. Please set tpin first then continue the transaction."));
              exit;
            }
            
            
            // echo json_encode(["message"=>"US ID IS ".$usid." and TPIN IS ".$tpin. " But TPIN WAS ".$Tpin, "status"=>false, "response_code"=>343]);
            //  exit();
            
            if($Tpin != $tpin){
              echo json_encode(array("response_code"=>  400 , "message" => "Your M-Pin is wrong. Please try again later. 3 Unsuccessfull attemps will temporarily block your account."));
              exit;
            }
        }

    $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$op'")->fetch_assoc();
      $serchApi = $serch['APICOMPANY'];
      $op_name = $serch['PRODUCTNAME'];
      $backup_api = $serch['BACKUP_API'];
      $opId = $serch['ID'];
      if(strtolower($serchApi) == "paysprint"){
          paysprint_recharge($op , $mb , $am , $refrence , $op_name , $opId ,  $serch['SERVICETYPE']);
      }
      else if(strtolower($serchApi) != ""){
        //   echo "other";
          recharge($serchApi , $mb , $op , $am , $backup_api , $op_name , $refrence , $opId , $serch['SERVICETYPE']);
      }
      else{
           $rs = json_encode(array("response_code"=>  500 , "message"=>"Operator Not Found"));
                    echo $rs;
      }
}



function recharge($api_name ,$mb , $op , $am , $backup_api , $op_name , $txn_id , $opId ,$serviceType){
    global $con , $time , $ustypeid , $usid , $user; // use connection in function 
    
    //search api from db 
    $api = $con->query("SELECT * FROM `rechargeApi` WHERE ID='$api_name'")->fetch_assoc();
    $url_p = $api['APIURL']; // p defines to parameter
    if($url_p != ""){
                
            $mobile_p = $api['MBPARAMETER'];
            $operator_p = $api['OPRAMETER'];
            $amount_p = $api['AMNTPARAMETER'];
            $format = $api['APITYPE'];
            $circle_p = $api['APITYPE'];
            $txn_p = $api['TXNIDPARAMETER'];
            $optional_p = $api['OPTNLPARAMETER'];
            $response_type_p = $api['APITYPE'];
            $hit_type_p = $api['APIHITTYPE'];
            
            //result parameters
            $rs_txn_id = $api['RESULT_TXN_PARA'];
            $rs_op_id = $api['RESULT_OP_ID_PARA'];
            $rs_status = $api['RESULT_ST_PARA'];
            $rs_error = $api['RESULT_ERROR_PARA'];
            $success_response = $api['SCSRESPONSE'];
            $pending_response = $api['PNDRESPONDE'];
            
            //api request url 
            $req_url = trim("$url_p&$mobile_p=$mb&$operator_p=$op&$amount_p=$am&$txn_p=$txn_id");
            if($optional_p != ""){$req_url.= "&$optional_p&$mobile_p=$mb";}
            // echo $req_url;
            // exit;
            $insert_report = "INSERT INTO `recharge_transaction`(`USER_ID`, `USER_TYPE`, `MOBILE`, `AMOUNT`, `OPERATOR`, `TIMESTAMP` , `REFERENCE_ID`, `SERVICE` , `LONG_CODE`  , `FILTER_DATE`) 
            VALUES ('$usid','$ustypeid','$mb','$am','$op_name,$api_name' ,'$time' , '$txn_id' , '$serviceType' , '$op'  , '".date("Y-m-d")."')";
            
            $user_bal = $user['MAIN_BAL']-$am;
            if($user_bal >= 0){
                if($con->query($insert_report)){
                     //echo $tkn;
                     //exit;
                    $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid' and USER_TYPE='$ustypeid'";
                    if($con->query($deduct_bal)){
                        //start curl request
                      $curl = curl_init();
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => $req_url,
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => $hit_type_p,
                        //  CURLOPT_HTTPHEADER => array(
                        //         'Authorization: Basic TU0wMDA5MDA6Z2o5MGZ2YiNAJQ=='
                        //       ),
                        ));
                        $response = curl_exec($curl);
                        curl_close($curl);
                        // echo $response;
                        // exit;
                        
                        //get api response type
                        if($response_type_p == "JSON"){
                            $result = json_decode($response);
                            $status_r =  $result->$rs_status; // here r represent response 
                            $error_r =  $result->$rs_error;
                            $txn_id_r =  $result->$rs_txn_id;
                            $operator_id_r =  $result->$rs_op_id;
                        }else if($response_type_p == "XML"){
                            $result = simplexml_load_string($response);
                            $status_r =  $result->$rs_status; // here r represent response 
                            $error_r =  $result->$rs_error;
                            $txn_id_r =  $result->$rs_txn_id;
                            $operator_id_r =  $result->$rs_op_id;
                        }else{
                            $result = explode("," , $response);
                            $status_r =  $result[$rs_status]; // here r represent response 
                            $error_r =  $result[$rs_error];
                            $txn_id_r =  $result[$rs_txn_id];
                            $operator_id_r =  $result[$rs_op_id];
                        }
                        // print_r($result);
                        // check wheater status is success or pending
                          if($status_r == $success_response && $status_r != ""){
                              $status_r = "Success";
                              $user_bal = $user['MAIN_BAL']-$am;
                          }
                          else if($status_r == $pending_response && $status_r!=""){
                              $status_r = "Pending";
                            //   give_com($txn_id , $usid ,$ustypeid);
                          }
                          else{
                              $status_r = "Failed";
                          }
                          
                          
                          $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','Mobile Recharge','$txn_id','','$req_url','$response')");
                          
                          $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status_r,$error_r' , OPERATOR_ID='$operator_id_r' where REFERENCE_ID='$txn_id' ");
                          if($status_r == "Success" || $status_r == "Pending"){
                               insert_allreport($usid  ,$txn_id , "Recharge" , $user['MAIN_BAL']  , $user_bal , $am , "Debit" , "Recharge Transaction", "MAIN");
      
      
                              echo json_encode(array(
                                        "response_code"=> 1,
                                        "message"=>$error_r,
                                        "opid"=>$operator_id_r
                                      ));
                                if($status_r == "Success"){
                                // retailer commission
                                //   if($ustypeid == 46){
                                      give_com($txn_id , $usid ,$ustypeid);
                                //   } 
                                  $mobile="91$mb";
                                    $msg="Your Mobile Number $mb Amount $am recharge has been SUCCESS Available Main Balance - Rs. $user_bal - Suvidha BANKio Team";
                                    recharge_msg_success($mobile,$msg);
                                }
                           }
                          else{
                              $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid'");
                            //   insert_allreport($usid  ,$txn_id , "Recharge" , $user['MAIN_BAL']  ,  $user['MAIN_BAL']  , $am , "Failed" , "Recharge Transaction", "MAIN");
                               insert_allreport($usid  ,$txn_id , "Recharge" , $user['MAIN_BAL']  ,  $user['MAIN_BAL']  , $am , "Failed" , "Recharge Transaction", "MAIN");
                               echo json_encode(array(
                                            "response_code"=> 2,
                                            "message"=>$error_r
                                          ));
                            //   if($backup_api != ""){
                            //       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='$backup_api'")->fetch_assoc();
                            //       $backup_op_longcode = $backup_op['PRODUCTCODE'];
                            //     //   echo $backup_api;
                            //     //   exit;
                            //       backup_api($backup_api , $mobile , $backup_op_longcode , $amount , $op_name);
                            //   }
                            }
                    // $mobile="91$mb";
                    // $msg="Your Mobile Number $mb Amount $am recharge has been SUCCESS Available Main Balance - Rs. $user_bal - Suvidha BANKio Team";
                    // recharge_msg($mobile,$msg);
                    }else{
                            $rs = json_encode(array("response_code"=>  400 , "message"=>"Error in deducting balance"));
                        echo $rs;
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' "); 
                    //   $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' "); 
                        }
                        
                        
                        $mobile="91$mb";
                    $msg="Your Mobile Number $mb Amount $am recharge has been FAILED Available Main Balance - Rs. $user_bal - Suvidha BANKio Team";
                    recharge_msg_failed($mobile,$msg);
                        
                        
                        
                    }
                else{
                        $rs = json_encode(array("response_code"=>  500 , "message"=>"Some internel server error in data. We are fixing it"));
                        echo $rs;
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
                    //   $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
                }
            }
            else{
                $rs = json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
                echo $rs;
            //   $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
            //   $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
            }
        }else{
              $rs = json_encode(array("response_code"=>  500 , "message"=>"Something Not Good. Contact admin"));
                    echo $rs;
        }
    }
 
 
function paysprint_recharge($op , $mb , $am , $refrence , $op_name , $opId ,$serviceType){
// function recharge($serchApi , $mb , $op , $am , $backup_api , $op_name , $refrence , $opId ,$serviceType){
    // global $con ,$paysprint, $time , $ustypeid , $usid , $user;

     $data = json_encode(
            array(
              "operator"=>$op,  
              "canumber"=>$mb,    
              "amount"=>$am,     
              "referenceid"=>$refrence
                )
            );


$tkn = create_token();
//   echo $tkn;
//   exit;
$curl = curl_init();
$insert_report = "INSERT INTO `recharge_transaction`(`USER_ID`, `USER_TYPE`, `MOBILE`, `AMOUNT`, `OPERATOR`, `TIMESTAMP` , `REFERENCE_ID`, `SERVICE` , `LONG_CODE` , `FILTER_DATE`) 
VALUES ('$usid','$ustypeid','$mb','$am','$op_name, paysprint','$time' , '$refrence', '$serviceType' , '$op' , '".date("Y-m-d")."' )";
$user_bal = $user['MAIN_BAL']-$am;
    if($user_bal >= 0){
        if($con->query($insert_report)){
                $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid'";
                if($con->query($deduct_bal)){
                    curl_setopt_array($curl, [
                      CURLOPT_URL => $paysprint['URL']."/api/v1/service/recharge/recharge/dorecharge",
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
                      echo $response;
                      
                $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','Recharge','$refrence','$tkn','$data','$response')");
 
                    $rstl = json_decode($response);
                  $rs_code = $rstl->response_code; 
                  $msg = $rstl->message;
                  $operatorid = $rstl->operatorid;
                  $st = $rstl->status; 
                    if($st === true || $rs_code == 1){
                        $status = "success";
                    }
                    else if($rs_code == 2 ||$rs_code == 3 ||$rs_code == 4){
                        $status = "pending";
                    }
                    else{
                        $status = "failed";   
                        $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid'");
                    }
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
                      if($rs_code == 1){
                             insert_allreport($usid  ,$refrence , "Recharge" , $user['MAIN_BAL']  , $user_bal , $am , "Debit" , "Recharge Transaction", "MAIN");
                                  //send sms of the txn
                                $sndam = number_format($am , 2);
                                $usbl = number_format($user_bal , 2);
                                $usermb = substr($user['MOBILE'] , 7 , 10);
                                //  $mbmsg = urlencode("INR $sndam has been Debited from your Nsdpay.in A/C No *******$usermb  towards Recharge Txn. $refrence. Main Wallet Avl BAL is INR $usbl. Team Nsdpay");
                                //   $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , ) , true);
      
                             if($status == "success"){
                                // retailer commission
                                  if($ustypeid == 46){
                                      give_com($refrence , $usid ,$ustypeid);
                                  } 
                                }
                      }else{
                             insert_allreport($usid  ,$refrence , "Recharge" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $am , "Failed" , "Recharge Transaction");
                      }
                }else{
                    $rs = json_encode(array("response_code"=>  400 , "message"=>"Error in deducting balance"));
                    echo $rs;
              $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' "); 
                }
            }
        else{
                $rs = json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
                echo $rs;
              $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
        }
    }
    else{
        $rs = json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
        echo $rs;
      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
    }
    
}


// update transaction status
if(isset($_POST['check_status'])){
$refrence = $_POST['ref_id'];
$curl = curl_init();
// echo "$refrence";
// exit;
$data = json_encode(
            array(
                "referenceid"=>"$refrence",
                )
            );
       $tkn = create_token();
    //   echo $data;
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/recharge/recharge/status",
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
echo $response;
curl_close($curl);
     $rstl = json_decode($response);
        $rs_code = $rstl->responsecode; 
      $msg = $rstl->message;
      $operatorid = $rstl->operatorid;
      $data = $rstl->data;
      $sta = $data->status;
    //   exit;
      $transaction = $con->query("select * from recharge_transaction where REFERENCE_ID='$refrence'")->fetch_assoc();
      $user = $con->query("select * from user where ID='$usid'")->fetch_assoc();
      $update_bal = $user['MAIN_BAL'] + $transaction['AMOUNT'];
        if($sta== 1){
            $status = "Sucess";
        }else if($sta== 0){
            $status = "Failed";
        }
        else{
            $status = "Pending";
        }
      
        $con->query("update recharge_transaction set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
      if($status == "Failed"){
          $con->query("update user set MAIN_BAL='$update_bal' where ID='$usid' ");
          insert_allreport($usid  ,$refrence , "Recharge Refund" , $user['MAIN_BAL']  , $update_bal , $amount , "Credit" , "Recharge Refund Transaction");      
      }
}

// update transaction status
// if(isset($_POST['check_plan'])){
// $op = $_POST['op'];
// $curl = curl_init();
// // echo "$refrence";
// // exit;
// $data = json_encode(
//             array(
//                 "circle"=> "Delhi NCR",
//                  "op"=> $op
//                 )
//             );
            
//       $tkn = create_token();
//     //   echo $data;
// curl_setopt_array($curl, [
//   CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/recharge/hlrapi/browseplan",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => $data,
//   CURLOPT_HTTPHEADER => [
//         "Accept: application/json",
//         "Content-Type: application/json",
//         "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
//         "Token: ".$tkn
//     ],
// ]);

// $response = curl_exec($curl);
// $err = curl_error($curl);
// curl_close($curl);
// echo $response;
    
// }

// dth info
if(isset($_POST['dth_info'])){
$op = $_POST['op'];
$ca = $_POST['ca'];
$curl = curl_init();

$serch = $con->query("SELECT * FROM switchOperator WHERE PRODUCTNAME='$op' AND SERVICETYPE='DTH' AND DTH_INFO <>'' ORDER BY ID ASC LIMIT 1")->fetch_assoc();

$data = json_encode(
            array(
                "canumber"=>$ca,
                 "op"=> $serch['DTH_INFO']
                )
            );
       $tkn = create_token();
    //   echo $data;
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/recharge/hlrapi/dthinfo",
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

$rstl = json_decode($response, true);
extract($rstl);
if($response_code==1){

  if($info['desc']==null || $info['desc']==""){
      echo $response;
  }
  else{
    echo json_encode(["status"=>false, "response_code"=>5, "message"=>$info['desc']]);
    exit;
  }
    
}
else{
    if($message =="" || $message == null){
        echo json_encode(["status"=>false, "response_code"=>5, "message"=>"No Response From Paysprint for the operator \"$op\" on the number \"$ca\" \nResponse is \n\n$response"]);
        exit;
    }
    else{
        echo $response;
    }
}
    
}


?>