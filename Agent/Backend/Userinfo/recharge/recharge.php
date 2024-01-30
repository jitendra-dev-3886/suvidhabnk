<?php

error_reporting(0);

include("../../../Db/config.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");
include("recharge_function.php");

// error_reporting(E_ALL);


$time = date("Y-m-d g:i:s A");


if(isset($_POST['recharge_mobile'])){
    $mb = $_POST['recharge_mobile'];
    $am = $_POST['recharge_amount'];
    $op = $_POST['recharge_operator'];
    
    $refrence =  substr(str_shuffle("123457890QWERTYUIOPASDFGHJKLZXCVBNMasdfghjklqwertyuiopzxcvbnm") , 0 , 10);
    
      $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$op' AND (SERVICETYPE = '10' OR SERVICETYPE = '8') ")->fetch_assoc();
      $serchApi = $serch['APICOMPANY'];
      $op_name = $serch['PRODUCTNAME'];
      $backup_api = $serch['BACKUP_API'];
      $serviceType = $serch['SERVICETYPE'];
      $opId = $serch['ID'];
      echo "work";
      exit;
        //check if this req is in custom rule or not
        $custumRule = $con->query("select * from rech_transfer where ID='1' ")->fetch_assoc();
        $amArr = explode(","  , $custumRule['AMOUNT']);
        $opArr = explode(","  , $custumRule['OPERATOR']);
  
      if(strtolower($serchApi) == "paysprint"){
          paysprint_recharge($op , $mb , $am , $refrence , $op_name , $opId);
        //echo "paysprint";
      }
      else if(strtolower($serchApi) != ""){
        //echo "other";
          recharge($serchApi , $mb , $op , $am , $backup_api , $op_name , $refrence , $opId);
      }
      else{
           $rs = json_encode(array("response_code"=>  500 , "message"=>"Operator Not Found"));
           echo $rs;
      }
      
}


// update transaction status
if(isset($_POST['check_status'])){
    
$refrence = $_POST['ref_id'];

$rech_detail = $con->query("select * from recharge_transaction where REFERENCE_ID='$refrence' ")->fetch_assoc();
 $rcOp = explode("," ,$rech_detail['OPERATOR']);
 $api = $rcOp[1];
 
 if(strtolower($api) == "paysprint"){
     paysprint_refund($refrence);
 }
 else{
      $rs = json_encode(array("response_code"=>  500 , "message"=>"Something Wrong"));
      echo $rs;
 }
 
}

function recharge($api_name ,$mb , $op , $am , $backup_api , $op_name , $txn_id , $opId){
    global $con , $time , $usertype_id , $usid , $user; // use connection in function 
    
    //search api from db 
    $api = $con->query("SELECT * FROM `rechargeApi` WHERE NAME='$api_name'")->fetch_assoc();
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
            if($optional_p != ""){$req_url.= "&$optional_p";}
        //     echo $req_url;
        //   exit();
            
            $insert_report = "INSERT INTO `recharge_transaction`(`USER_ID`, `USER_TYPE`, `MOBILE`, `AMOUNT`, `OPERATOR`, `TIMESTAMP` , `REFERENCE_ID`, `LONG_CODE`, `APINAME`, `ROWID`) 
            VALUES ('$usid','$usertype_id','$mb','$am','$op_name,$api_name' ,'$time' , '$txn_id', '$op', '$api_name', '$opId')";
            $user_bal = $user['MAIN_BAL']-$am;
            if($con->query($insert_report)){
                if($user_bal >= 0){
                    $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid' and USER_TYPE='$usertype_id'";
                    if($con->query($deduct_bal)){
                        //start curl request 
                        // echo "work";
                        //   give_com($txn_id ,$usid ,$usertype_id);
                        //     exit;
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
                         CURLOPT_HTTPHEADER => array(
                                'Authorization: Basic TU0wMDA5MDA6Z2o5MGZ2YiNAJQ=='
                              ),
                        ));
                        // echo $req_url." ";
                        $response = curl_exec($curl);
                        curl_close($curl);
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
                          }
                          else if($status_r == $pending_response && $status_r!=""){
                              $status_r = "Pending";
                          }
                          $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status_r,$error_r' , OPERATOR_ID='$operator_id_r' where REFERENCE_ID='$txn_id' ");
                          if( $status_r == "Success" || $status_r == "Pending"){
                               insert_allreport($usid  ,$txn_id , "Recharge" , $user['MAIN_BAL']  , $user_bal , $am , "Debit" , "Recharge Transaction");
                               give_com($txn_id ,$usid ,$usertype_id , $opId);
                                  echo json_encode(array(
                                            "response_code"=> 1,
                                            "message"=>$error_r
                                          ));
                           }
                          else{
                              $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid'");
                               insert_allreport($usid  ,$txn_id , "Recharge" , $user['MAIN_BAL']  ,  $user['MAIN_BAL']  , $am , "Failed" , "Recharge Transaction");
                               echo json_encode(array(
                                            "response_code"=> 2,
                                            "message"=>$error_r
                                          ));
                            //   if($backup_api != ""){
                            //       $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='$backup_api'")->fetch_assoc();
                            //       $backup_op_longcode = $backup_op['PRODUCTCODE'];
                            //       backup_api($backup_api , $mobile , $backup_op_longcode , $amount , $op_name);
                            //   }
                            }
                   
                    }else{
                            $rs = json_encode(array("response_code"=>  400 , "message"=>"Error in deducting balance"));
                        echo $rs;
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' "); 
                        }
                    }
                    else{
                        $rs = json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
                        echo $rs;
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
                    }
                }
            else{
                    $rs = json_encode(array("response_code"=>  500 , "message"=>"Some internel server error in data. We are fixing it okay"));
                    echo $rs;
                  $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
            }
        }else{
              $rs = json_encode(array("response_code"=>  500 , "message"=>"Something Not Good. Contact admin"));
                    echo $rs;
        }
    }
 

// function paysprint_recharge($op , $mb , $am , $refrence , $op_name , $opId){
//     global $con ,$paysprint, $time , $usertype_id , $usid , $user;

//      $data = json_encode(
//             array(
//               "operator"=>$op,  
//               "canumber"=>$mb,    
//               "amount"=>$am,     
//               "referenceid"=>$refrence
//                 )
//             );


// $tkn = create_token();
// $curl = curl_init();
// $insert_report = "INSERT INTO `recharge_transaction`(`USER_ID`, `USER_TYPE`, `MOBILE`, `AMOUNT`, `OPERATOR`, `TIMESTAMP` , `REFERENCE_ID`, `LONG_CODE`, `APINAME`, `ROWID`) 
// VALUES ('$usid','$usertype_id','$mb','$am','$op_name, paysprint','$time' , '$refrence', '$op', '$api_name', '$opId')";
// $user_bal = $user['MAIN_BAL']-$am;
// if($con->query($insert_report)){
//     if($user_bal >= 0){
//                 $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid' and USER_TYPE='$usertype_id'";
//                 if($con->query($deduct_bal)){
//                     curl_setopt_array($curl, [
//                       CURLOPT_URL => $paysprint['URL']."/api/v1/service/recharge/recharge/dorecharge",
//                       CURLOPT_RETURNTRANSFER => true,
//                       CURLOPT_ENCODING => "",
//                       CURLOPT_MAXREDIRS => 10,
//                       CURLOPT_TIMEOUT => 30,
//                       CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//                       CURLOPT_CUSTOMREQUEST => "POST",
//                       CURLOPT_POSTFIELDS => $data,
//                       CURLOPT_HTTPHEADER => [
//                         "Accept: application/json",
//                         "Content-Type: application/json",
//                         "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
//                         "Token: ".$tkn
//                       ],
//                     ]);
//                     $response = curl_exec($curl);
//                     $err = curl_error($curl);
                    
//                     curl_close($curl);
//                       echo $response;
//                     $rstl = json_decode($response);
//                   $rs_code = $rstl->response_code; 
//                   $msg = $rstl->message;
//                   $operatorid = $rstl->operatorid;
//                   $st = $rstl->status; 
//                     if($st === true || $rs_code == 1){
//                         $status = "success";
//                     }
//                     else if($rs_code == 2 ||$rs_code == 3 ||$rs_code == 4){
//                         $status = "pending";
//                     }
//                     else{
//                         $status = "failed";   
//                         $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid'");
//                     }
//                       $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
//                       if($rs_code == 1){
//                              insert_allreport($usid  ,$refrence , "Recharge" , $user['MAIN_BAL']  , $user_bal , $am , "Debit" , "Recharge Transaction");
//                              give_com($refrence ,$usid ,$usertype_id ,$opId);
//                       }else{
//                              insert_allreport($usid  ,$refrence , "Recharge" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $am , "Failed" , "Recharge Transaction");
//                       }
//                 }else{
//                     $rs = json_encode(array("response_code"=>  400 , "message"=>"Error in deducting balance"));
//                     echo $rs;
//               $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' "); 
//                 }
//             }
//             else{
//                 $rs = json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
//                 echo $rs;
//               $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
//             }
//         }
//     else{
//             $rs = json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
//             echo $rs;
//           $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
//     }
    
// }


// function paysprint_refund($refrence){
    
// $curl = curl_init();
// // echo "$refrence";
// // exit;
// $data = json_encode(
//             array(
//                 "referenceid"=>"$refrence",
//                 )
//             );
//       $tkn = create_token();
//     //   echo $data;
// curl_setopt_array($curl, [
//   CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/recharge/recharge/status",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => $data,
//   CURLOPT_HTTPHEADER => [
//     "Accept: application/json",
//         "Content-Type: application/json",
//         "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
//         "Token: ".$tkn
//     ],
// ]);

// $response = curl_exec($curl);
// $err = curl_error($curl);
// echo $response;
// curl_close($curl);
//      $rstl = json_decode($response);
//         $rs_code = $rstl->responsecode; 
//       $msg = $rstl->message;
//       $operatorid = $rstl->operatorid;
//       $data = $rstl->data;
//       $sta = $data->status;
//     //   exit;
//       $transaction = $con->query("select * from recharge_transaction where REFERENCE_ID='$refrence'")->fetch_assoc();
//       $user = $con->query("select * from user where ID='$usid'")->fetch_assoc();
//       $update_bal = $user['MAIN_BAL'] + $transaction['AMOUNT'];
//         if($sta== 1){
//             $status = "Sucess";
//         }else if($sta== 0){
//             $status = "Failed";
//         }
//         else{
//             $status = "Pending";
//         }
      
//         $con->query("update recharge_transaction set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
//       if($status == "Failed"){
//           $con->query("update user set MAIN_BAL='$update_bal' where ID='$usid' ");
//           insert_allreport($usid  ,$refrence , "Recharge Refund" , $user['MAIN_BAL']  , $update_bal , $amount , "Failed" , "Recharge failed Transaction");
//       }
// }
?>