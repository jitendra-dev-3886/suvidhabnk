<?php
error_reporting(0);
session_start();
include("../../../../../Db/config.php");

require("../../../Backend/Userinfo/getuserinfo.php");
require("../../../Backend/Functions/all_function.php");
// require("../../../Auth/Auth.php");

$time = date("Y-m-d g:i:s A");
if(isset($_GET['api_key'])){
    
    $api_key = $_GET['api_key'];
    $register_mobile = $_GET['register_mobile'];
    $mobile_no = $_GET['mobile'];
    $op_code = $_GET['op_id'];
    $amount = $_GET['amount'];
    $txn_id = $_GET['txn_id'];
    $circle = $_GET['circle'];
    
    $ip = $_SERVER['REMOTE_ADDR'];


        // check api key validation 
        if($con->query("select * from user where API_KEY='$api_key'")->num_rows != 1){
             echo json_encode(["HTTPCode" => 404 , "ResponseCode" => 1 , "Message" => "Unauthorized Access." , "Status"=>"Access Denied"]);
             exit;
        }
        
        $api_user = $con->query("select * from user where API_KEY='$api_key' ORDER BY ID DESC LIMIT 1")->fetch_assoc();
        $api_user_bal = $api_user['MAIN_BAL'];
        $api_userMobile = $api_user['MOBILE'];
        
        
        //check ip validation 
        if($ip !=$api_user['IP']){
            echo json_encode(["HTTPCode" => 403 , "ResponseCode" => 2 , "Message" => "Unauthorized IP Address. Update your ip : $ip" , "Status"=>"Access Denied"]);
            exit;
        }
        
        //check mobile validation
        if($api_userMobile != $register_mobile){
            echo json_encode(["HTTPCode" => 404 , "ResponseCode" => 3 , "Message" => "Mobile number not matched." , "Status"=>"Access Denied"]);
            exit;
        }
        
        // check user status validation 
        if(strtolower($api_user['US_STATUS']) != "active"){
             echo json_encode(["HTTPCode" => 200 , "ResponseCode" => 4 , "Message" => "Your account has been suspended. Contact to Api Provider." , "Status"=>"Account Suspended"]);
            exit;
        }
        
        //check callback url present or not 
        if($api_user['CALLBACK_URL'] ==""){
            echo json_encode(["HTTPCode" => 200 , "ResponseCode" => 5 , "Message" => "Callback url is not set." , "Status"=>"Access Denied"]);
            exit;
        }
        
        //chekc amount validation 
        if($amount > $api_user['MAIN_BAL']){
            echo json_encode(["HTTPCode" => 200 , "ResponseCode" => 6 , "Message" => "Not sufficient balance in your account." , "Status"=>"Failed"]);
            exit;
        }
        
        //  check for duplicatie refrence id 
        $rechRows  = $con->query("select * from recharge_transaction where REFERENCE_ID='$txn_id'")->num_rows;
          if($rechRows >= 1){
            echo json_encode(["HTTPCode" => 200 , "ResponseCode" => 15 , "Message" => "Duplicate recharge transaction ID. Please pass unique transaction ID" , "Status"=>"Failed"]);
            exit;
          }
        
          $op_rows = $con->query("select * from switchOperator where API_USER_CODE='$op_code'");
          // check weather operator code is right or not 
          if($op_rows->num_rows != 1){
              echo json_encode(["HTTPCode" => 200 , "ResponseCode" => 8 , "Message" => "Operator code provided by you is not found." , "Status"=>"Failed"]);
              exit;
           }
          
          // get operator detials
          $op = $con->query("select * from switchOperator where API_USER_CODE='$op_code'")->fetch_assoc();
            $row_id = $op['ID'];
            $op_lng_code = $op['LONGCODE'];
            $op_name = $op['PRODUCTNAME'];
            $serchApi = $op['APICOMPANY'];
            $backup_api = $op['BACKUP_API'];
          $serviceType = $op['SERVICETYPE'];
            
            //check weather operator long code is setted by admin or not 
            if($op_lng_code == ""){
                echo json_encode(["HTTPCode" => 200 , "ResponseCode" => 9 , "Message" => "Operator is not managed by admin. Please contact api provider." , "Status"=>"Failed"]);
                exit;
            }
            
            // check proper api is setted by admin or not 
            if($serchApi == ""){
                echo json_encode(["HTTPCode" => 200 , "ResponseCode" => 10 , "Message" => "Some internel error occuerd. Please contact api provider." , "Status"=>"Failed"]);
                exit;
            }
            
            $user = $api_user;
            $id= $user['ID'];
            $usertype_id= $user['USER_TYPE'];
             

                
            //finalize procced to the recharge 
              if(strtolower($serchApi) == "paysprint"){
                  paysprint_recharge($op_lng_code , $mobile_no , $amount , $txn_id , $op_name, trim($row_id));
              }
              else if(strtolower($serchApi) != ""){
                  recharge($serchApi , $mobile_no , $op_lng_code , $amount , $backup_api , $op_name , $txn_id, trim($row_id));
              }
        }
else{
            echo json_encode(["HTTPCode" => 400 , "ResponseCode" => 7 , "Message" => "Please pass proper parameters. Bad request fomrat." , "Status"=>"Bad Request"]);
            exit;
}


function paysprint_recharge($op , $mb , $am , $refrence , $op_name, $row_id){
    global $con ,$paysprint, $time , $usertype_id , $id , $user;

     $data = json_encode(
            array(
              "operator"=>$op,  
              "canumber"=>$mb,    
              "amount"=>$am,     
              "referenceid"=>$refrence
                )
            );


$tkn = create_token();
    
$curl = curl_init();
$insert_report = "INSERT INTO `recharge_transaction`(`USER_ID`, `USER_TYPE`, `MOBILE`, `AMOUNT`, `OPERATOR`, `TIMESTAMP` , `REFERENCE_ID`, `LONG_CODE`, `APINAME`, `ROWID` ) 
VALUES ('$id','$usertype_id','$mb','$am','$op_name' ,'paysprint','$time' , '$refrence', '$op' ,'PAYSPRINT', '$row_id' )";
$user_bal = $user['MAIN_BAL']-$am;
if($con->query($insert_report)){
    if($user_bal >= 0){
                $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$id' and USER_TYPE='$usertype_id'";
                if($con->query($deduct_bal)){
                    curl_setopt_array($curl, [
                      CURLOPT_URL => "https://api.paysprint.in/api/v1/service/recharge/recharge/dorecharge",
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
                    $rstl = json_decode($response);
                  $rs_code = $rstl->response_code; 
                  $msg = $rstl->message;
                  $operatorid = $rstl->operatorid;
                  $st = $rstl->status; 
                    if($st === true || $rs_code == 1){
                        $status = "Success";
                    }
                    else if($rs_code == 2 ||$rs_code == 3 ||$rs_code == 4){
                        $status = "Pending";
                    }
                    else{
                        $status = "Failed";   
                        $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$id'");
                    }
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
                      if($rs_code == 1){
                             insert_allreport($id  ,$refrence , "Recharge" , $user['MAIN_BAL']  , $user_bal , $am , "Debit" , "Recharge Transaction");
                             give_com($refrence ,$id ,$usertype_id);
                              $rs = json_encode(["HTTPCode" => 200 , "ResponseCode" => 111 , "Message" => "Transaction Success." , "Status"=>"$status" , "OperatorId" => $operatorid , "TransactionId"=> $txn_id, "Description"=>$msg ]);
                                echo $rs;
                      }else{
                            $rs = json_encode(["HTTPCode" => 200 , "ResponseCode" => 112 , "Message" => "Transaction Failed." , "Status"=>"$status" ,  "TransactionId"=> $txn_id,  "Description"=>$msg ]);
                                echo $rs;
                             insert_allreport($id  ,$refrence , "Recharge" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $am , "Failed" , "Recharge Transaction");
                      }
                }else{
                    $rs = json_encode(["HTTPCode" => 200 , "ResponseCode" => 11 , "Message" => "Error in deducting balance." , "Status"=>"Failed"]);
                    echo $rs;
              $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' "); 
                    exit;
                }
            }
            else{
                 $rs = json_encode(["HTTPCode" => 200 , "ResponseCode" => 12 , "Message" => "You have not sufficient balance.. Please add balance." , "Status"=>"Failed"]);
                 echo $rs;
              $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
                    exit;
            }
        }
    else{
          $rs = json_encode(["HTTPCode" => 500 , "ResponseCode" => 13 , "Message" => "Some internel server error. We are fixing it." , "Status"=>"Failed"]);
          echo $rs;
          $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
            exit;
    }
    
}


function recharge($api_name ,$mb , $op , $am , $backup_api , $op_name , $txn_id, $row_id){
    global $con , $time , $usertype_id , $id , $user; // use connection in function 
    
    //search api from db 
    

    
    $api = $con->query("SELECT * FROM `rechargeApi` WHERE ID='$api_name'")->fetch_assoc();
    // $api = $con->query("SELECT * FROM `rechargeApi` WHERE NAME='$api_name'")->fetch_assoc();
    
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
            
            
            $insert_report = "INSERT INTO `recharge_transaction`(`USER_ID`, `USER_TYPE`, `MOBILE`, `AMOUNT`, `OPERATOR`, `TIMESTAMP` , `REFERENCE_ID`, `LONG_CODE`, `APINAME`) 
            VALUES ('$id','$usertype_id','$mb','$am','$op_name' ,'$time' , '$txn_id' , '$op' ,'$api_name')";
            $user_bal = $user['MAIN_BAL']-$am;
            if($con->query($insert_report)){
                if($user_bal >= 0){
                    $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$id'";
                    if($con->query($deduct_bal)){
                        
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
                        
                        $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES 
                        ('$id','Recharge','$txn_id','$api_key','$req_url','$response')");
                        
                        // print_r($result);
                        // check wheater status is success or pending
                          if($status_r == $success_response && $status_r != ""){
                              $status_r = "Success";
                          }
                          else if($status_r == $pending_response && $status_r!=""){
                              $status_r = "Pending";
                          }
                          else{
                              $status_r = "Failed";
                          }
                          
                          $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status_r' , MESSAGE='$error_r',  OPERATOR_ID='$operator_id_r' where REFERENCE_ID='$txn_id' ");
                          
                          if($status_r == "Success" || $status_r == "Pending"){
                              insert_allreport($id  ,$txn_id , "Recharge" , $user['MAIN_BAL']  , $user_bal , $am , "Debit" , "Recharge Transaction");
                            //   give_com($txn_id ,$id ,$usertype_id);
                                $rs = json_encode(["HTTPCode" => 200 , "ResponseCode" => 111 , "Message" => "Transaction Success." , "Status"=>"$status_r" , "OperatorId" => $operator_id_r , "TransactionId"=> $txn_id, "Description"=>$error_r ]);
                                echo $rs;
                          }
                          else{
                              $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$id'");
                              insert_allreport($id  ,$txn_id , "Recharge" , $user['MAIN_BAL']  ,  $user['MAIN_BAL']  , $am , "Failed" , "Recharge Transaction");
                                $rs = json_encode(["HTTPCode" => 200 , "ResponseCode" => 112 , "Message" => "Transaction Failed." , "Status"=>"$status_r" , "OperatorId" => $operator_id_r , "Description"=>$error_r ]);
                                echo $rs;
                          }
                            }
                    else{
                          $rs = json_encode(["HTTPCode" => 200 , "ResponseCode" => 11 , "Message" => "Error in deducting balance." , "Status"=>"Failed"]);
                            echo $rs;
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' "); 
                        }
                    }
                    else{
                        $rs = json_encode(["HTTPCode" => 200 , "ResponseCode" => 12 , "Message" => "You have not sufficient balance.. Please add balance." , "Status"=>"Failed"]);
                         echo $rs;
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
                    }
                }
            else{
                  $rs = json_encode(["HTTPCode" => 500 , "ResponseCode" => 13 , "Message" => "Internel Server Error." , "Status"=>"Failed"]);
                  echo $rs;
                  $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
            }
        }
        else{
          $rs = json_encode(["HTTPCode" => 500 , "ResponseCode" => 13 , "Message" => "Internel Server Error. " , "Status"=>"Failed"]);
          echo $rs;
          $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
          exit;
        }
    }
    
    
    
function docustomRech($op_name , $am , $mb ,$txn_id , $op , $serviceType, $row_id)
{
      global $con , $time , $usertype_id , $id , $user; // use connection in function 
      $api_name = "NDRech";
    $insert_report = "INSERT INTO `recharge_transaction`(`USER_ID`, `USER_TYPE`, `MOBILE`, `AMOUNT`, `OPERATOR`, `TIMESTAMP` , `REFERENCE_ID`, `LONG_CODE`, `APINAME`, `ROWID`) 
      VALUES ('$id','$usertype_id','$mb','$am','$op_name,$api_name' ,'$time' , '$txn_id', '$op' ,'$api_name', '$row_id')";
    $user_bal = $user['MAIN_BAL'] - $am;
    if ($con->query($insert_report)) {
        if ($user_bal >= 0) {
            $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$id' and USER_TYPE='$usertype_id'";
            if ($con->query($deduct_bal)) {
                $req_url = "https://nkrecharge.in/dashboard/includes/api.php?api_key=Jh0n8jVIFgOvDskSZ7G1axqedXALENt5r4blWPKHBMu6TQUCRpi3mfywcozY92&mobile=$mb&amount=$am&operator=$op_name&rctype=$serviceType&order_id=$txn_id";
                         $curl = curl_init();
                        curl_setopt_array($curl, array(
                          CURLOPT_URL => $req_url,
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => '',
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 0,
                          CURLOPT_FOLLOWLOCATION => true,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "GET",
                         CURLOPT_HTTPHEADER => array(
                                'Authorization: Basic TU0wMDA5MDA6Z2o5MGZ2YiNAJQ=='
                              ),
                        ));
                        // echo $req_url." ";
                        $response = curl_exec($curl);
                        curl_close($curl);
                        $result = json_decode($response , true);
                        $status_r = $result['rcstatus'];
                        $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status_r' where REFERENCE_ID='$txn_id' ");
                          if(strtolower($status_r) == "success" || strtolower($status_r) == "pending"){
                                echo json_encode(["HTTPCode" => 200 , "ResponseCode" => 111 , "Message" => "Transaction Success." , "Status"=>"$status_r" , "OperatorId" => "" , "TransactionId"=> $txn_id, "Description"=>"Transaction Sucess." ]);
                               insert_allreport($id  ,$txn_id , "Recharge" , $user['MAIN_BAL']  , $user_bal , $am , "Debit" , "Recharge Transaction");
                              give_com($txn_id ,$id ,$usertype_id , $opId);
                                exit;
                           }
                          else{
                              $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$id'");
                               insert_allreport($id  ,$txn_id , "Recharge" , $user['MAIN_BAL']  ,  $user['MAIN_BAL']  , $am , "Failed" , "Recharge Transaction");
                                $rs = json_encode(["HTTPCode" => 200 , "ResponseCode" => 112 , "Message" => "Transaction Failed." , "Status"=>"Failed" , "OperatorId" => "" , "Description"=>"Failed" ]);
                                echo $rs;
                                exit;
                            }
                    }else{
                          $rs = json_encode(["HTTPCode" => 200 , "ResponseCode" => 11 , "Message" => "Error in deducting balance." , "Status"=>"Failed"]);
                            echo $rs;
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' "); 
                        }
                    }
                    else{
                        $rs = json_encode(["HTTPCode" => 200 , "ResponseCode" => 12 , "Message" => "You have not sufficient balance.. Please add balance." , "Status"=>"Failed"]);
                         echo $rs;
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
                    }
                }
            else{
                  $rs = json_encode(["HTTPCode" => 500 , "ResponseCode" => 13 , "Message" => "Internel Server Error." , "Status"=>"Failed"]);
                  echo $rs;
                  $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
            }
}

?>