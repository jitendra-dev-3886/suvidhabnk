<?php
// error_reporting(E_ALL);
// // ini_set("display_errors" , 1);


include("../includes/fetch_data.php");
include("../includes/config.php");
include("../includes/main_function.php");
include("recharge_function.php");

$time = date("Y-m-d g:i:s A");
$status_r = "Failed";

if(isset($_POST['recharge_mobile'])){
    $mb = $_POST['recharge_mobile'];
    $am = $_POST['recharge_amount'];
    $op = $_POST['recharge_operator'];
    
    $ip_address = $_POST['ipaddress'];
    $device = $_POST['mobile'];
    $id = $_POST['id'];
    $usertype_id = $_POST['usertypeid'];
     $refrence =  substr(str_shuffle("123457890QWERTYUIOPASDFGHJKLZXCVBNMasdfghjklqwertyuiopzxcvbnm") , 0 , 10);
 
    $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$op'")->fetch_assoc();
      $serchApi = $serch['APICOMPANY'];
      $op_name = $serch['PRODUCTNAME'];
      $backup_api = $serch['BACKUP_API'];
    //   echo json_encode(array("responsecode"=>  300 , "message"=>"Operator $op Found", "response"=>"Failed"));
    //   exit;
      if(strtolower($serchApi) == "paysprint"){
          paysprint_recharge($op , $mb , $am , $refrence , $op_name, $id, $usertype_id, $ip_address, $device);
      
        //   echo "paysprint";
      }
      else if(strtolower($serchApi) != ""){
        //   echo "other";
          recharge($serchApi , $mb , $op , $am , $backup_api , $op_name , $refrence, $id, $usertype_id, $ip_address, $device);
      }
      else{
           $rs = json_encode(array("responsecode"=>  300 , "message"=>"Operator Not Found", "response"=>"Failed"));
           echo $rs;
      }
      
}

function paysprint_recharge($op , $mb , $am , $refrence , $op_name, $id, $usertype_id, $ip_address, $device){
    global $con ,$paysprint, $time;
    
    $user = $con->query("select * from user where ID='$id' ")->fetch_assoc();
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
$insert_report = "INSERT INTO `recharge_transaction`(`USER_ID`, `USER_TYPE`, `MOBILE`, `AMOUNT`, `OPERATOR`, `TIMESTAMP` , `REFERENCE_ID`,`LONG_CODE`) 
VALUES ('$id','$usertype_id','$mb','$am','$op_name, paysprint','$time' , '$refrence','$op')";
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
                    //   echo $response;
                    $rstl = json_decode($response);
                  $rs_code = $rstl->response_code; 
                  $msg = $rstl->message;
                  $operatorid = $rstl->operatorid;
                  $st = $rstl->status; 
                  $status = "failed";
                    if($st === true || $rs_code == 1){
                        $status = "success";
                    }
                    else if($rs_code == 2 ||$rs_code == 3 ||$rs_code == 4){
                        $status = "pending";
                    }
                    else{
                        $status = "failed";   
                        $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$id'");
                    }
                    
                    
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
                      if($rs_code == 1){
                          
                             $rs = json_encode(array("responsecode"=>  100 , "message"=>$msg, "response"=>$status));
                             echo $rs;
                             insert_allreport($id  ,$refrence , "Recharge" , $user['MAIN_BAL']  , $user_bal , $am , "Debit" , "Recharge Transaction", $ip_address, $device);
                             give_com($refrence ,$id, $usertype_id);
                             
                      }else{
                            $rs = json_encode(array("responsecode"=>  400 , "message"=>$msg, "response"=>$status));
                            echo $rs;
                             insert_allreport($id  ,$refrence , "Recharge" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $am , "Failed" , "Recharge Transaction", $ip_address, $device);
                      }
                }else{
                    $rs = json_encode(array("responsecode"=>  400 , "message"=>"Error in deducting balance", "response"=>"Failed"));
                    echo $rs;
              $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' "); 
                }
            }
            else{
                $rs = json_encode(array("responsecode"=>  400 , "message"=>"You have not sufficient balance.. Please add balance.", "response"=>"Failed"));
                echo $rs;
              $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
            }
        }
    else{

            $rs = json_encode(array("responsecode"=>  300 , "message"=>"Some internel server error. We are fixing it", "response"=>"Failed"));
            echo $rs;
            
          $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
    }
    
}


function recharge($api_name ,$mb , $op , $am , $backup_api , $op_name , $txn_id, $id, $usertype_id, $ip_address, $device){
    global $con , $time; // use connection in function 
    $user = $con->query("select * from user where ID='$id' ")->fetch_assoc();
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
            
            $insert_report = "INSERT INTO `recharge_transaction`(`USER_ID`, `USER_TYPE`, `MOBILE`, `AMOUNT`, `OPERATOR`, `TIMESTAMP` , `REFERENCE_ID`, `LONG_CODE`) 
            VALUES ('$id','$usertype_id','$mb','$am','$op_name,$api_name' ,'$time' , '$txn_id' ,'$op')";
            $user_bal = $user['MAIN_BAL']-$am;
            if($con->query($insert_report)){
                if($user_bal >= 0){
                    $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$id' and USER_TYPE='$usertype_id'";
                    if($con->query($deduct_bal)){
                        //start curl request 
                        // echo "work";
                        //   give_com($txn_id ,$id ,$usertype_id);
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
                    
                        
                        
                        $status_r = "FAIL";
                        $response = curl_exec($curl);
                        curl_close($curl);
                        
                        $self = null;
                        
                        $fetsil  = json_decode($response);
                        
                        $resp =  $fetsil->status;
                        $error_r = $fetsil->message;
                        
                        
                        
                        
                          if($resp == "SUCCESS"){
                              $status_r = "Success";
                              $self = array(
                                  "status"=>true,
                                  "response_code"=>1,
                                  "message"=>"Succcess"
                                  );
                              
                          }
                          else if($resp == "FAIL"){
                              $status_r = "Failed";
                              $self = array(
                                  "status"=>false,
                                  "response_code"=>0,
                                  "message"=>"Failed"
                                  );
                          }
                          else{
                              $status_r = "Pending";
                              
                              $self = array(
                                  "status"=>true,
                                  "response_code"=>2,
                                  "message"=>"Pending"
                                  );
                          }
                          
                          $en = json_encode($self);
                          
                          $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $en)."'  , STATUS='$status_r,$error_r' , OPERATOR_ID='$operator_id_r' where REFERENCE_ID='$txn_id' ");
                          if( $status_r == "Success" || $status_r == "Pending"){
                             
                              $rs = json_encode(array("responsecode"=>  100 , "message"=>"$error_r", "response"=>$status_r));
                              echo $rs;
                              insert_allreport($id  ,$txn_id , "Recharge" , $user['MAIN_BAL']  , $user_bal , $am , "Debit" , "Recharge Transaction", $ip_address, $device);
                              give_com($txn_id ,$id ,$usertype_id, $ip_address, $device);
            
                               
                          }
                          else{
                              $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$id'");
                              insert_allreport($id  ,$txn_id , "Recharge" , $user['MAIN_BAL']  ,  $user['MAIN_BAL']  , $am , "Debit" , "Recharge Transaction", $ip_address, $device);
                        $rs = json_encode(array("responsecode"=>  200 , "message"=>$error_r, "response"=>$status_r));
                        echo $rs;
                            
                            }
                   
                    }else{

                        $rs = json_encode(array("responsecode"=>  400 , "message"=>"Error in deducting balance", "response"=>$status_r));
                        echo $rs;
                        
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' "); 
                        }
                    }
                    else{
                        $rs = json_encode(array("responsecode"=>  400 , "message"=>"You have not sufficient balance.. Please add balance.","response"=>$status_r));
                        echo $rs;
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
                    }
                }
            else{
                    $rs = json_encode(array("responsecode"=>  300 , "message"=>"Some internel server error in data. We are fixing it", "response"=>$status_r));
                    echo $rs;
                  $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status_r,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$txn_id' ");
            }
        }else{
              $rs = json_encode(array("responsecode"=>  300 , "message"=>"Something Not Good. Contact admin", "response"=>$status_r));
                    echo $rs;
        }
    }
 
 
?>