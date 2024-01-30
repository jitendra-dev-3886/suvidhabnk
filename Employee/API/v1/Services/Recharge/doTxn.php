<?php
session_start();

require("../../../../Db/config.php");

include("../../Backend/Userinfo/getuserinfo.php");
require("../../Backend/Functions/all_function.php");
require("../../Auth/Auth.php");
include("recharge_function.php");


// error_reporting(E_ALL);
// ini_set("display_errors", 1);

// From auth.php check request;

$reqBodyAr = json_decode($reqBody , true);

    $time = date("g:i:s A");
    $timestamp = date("Y-m-d g:i:s A");

    $mb = $reqBodyAr['Mobile'];
    $am = $reqBodyAr['Amount'];
    $op = $reqBodyAr['Operator'];
    $refrence = $reqBodyAr['refId'];

    $serch = $con->query("SELECT * FROM switchOperator WHERE LONGCODE='$op' and APICOMPANY='paysprint' ")->fetch_assoc();
      $serchApi = $serch['APICOMPANY'];
      $op_name = $serch['PRODUCTNAME'];
      $backup_api = $serch['BACKUP_API'];
      $opId = $serch['ID'];
      if(strtolower($serchApi) == "paysprint"){
          paysprint_recharge($op , $mb , $am , $refrence , $op_name , $opId ,  $serch['SERVICETYPE']);
      }
      else{
           $rspns = json_encode(array("response_code"=>  500 , "message"=>"Operator Not Found", "RequestId"=> $refId));
             echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
                exit;
      }


function paysprint_recharge($op , $mb , $am , $refrence , $op_name , $opId ,$serviceType){
    global $con ,$paysprint,$data, $time , $ustypeid , $usid , $user;
     $reqdata = json_encode(
            array(
              "operator"=>$op,  
              "canumber"=>$mb,    
              "amount"=>$am,     
              "referenceid"=>$refrence
                )
            );


$tkn = create_token();
    
$curl = curl_init();
$insert_report = "INSERT INTO `recharge_transaction`(`USER_ID`, `USER_TYPE`, `MOBILE`, `AMOUNT`, `OPERATOR`, `TIMESTAMP` , `REFERENCE_ID`, `SERVICE` , `LONG_CODE` , `FILTER_DATE`) 
VALUES ('$usid','API','$mb','$am','$op_name, paysprint','$time' , '$refrence', '$serviceType' , '$op' , '".date("Y-m-d")."' )";
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
                      CURLOPT_POSTFIELDS => $reqdata,
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
                $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','Recharge','$refrence','$tkn','$data','$response')");
 
                    $rstl = json_decode($response , true);
                  $rs_code = $rstl['response_code']; 
                  $msg = $rstl['message'];
                  $operatorid = $rstl['operatorid'];
                  $st = $rstl['status']; 
                  
                    if($st === true || $rs_code == 1){
                        $status = "success";
                        $rspnscode = 111;
                    }
                    else if($rs_code == 2 ||$rs_code == 3 ||$rs_code == 4){
                        $status = "pending";
                        $rspnscode = 112;
                    }
                    else{
                        $rspnscode = 113;
                        $status = "failed";   
                        $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid'");
                    }
                    
                      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
                      if($rs_code == 1){
                             insert_allreport($usid  ,$refrence , "Recharge" , $user['MAIN_BAL']  , $user_bal , $am , "Debit" , "Recharge Transaction", "MAIN");
                             if($status == "success"){
                                // retailer commission
                                  if($ustypeid == 46){
                                      give_com($refrence , $usid ,$ustypeid);
                                  } 
                                }
                      }
                      
                   $rspns = json_encode(array("response_code"=>  $rspnscode , "message"=>$msg, "status"=>$status, "RequestId"=> $refId , "data"=>$rstl ));
                    echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
                    exit;
                }else{
              $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' "); 
                    $rspns = json_encode(array("response_code"=>  400 , "message"=>"Error in deducting balance", "RequestId"=> $refId));
                   echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
                    exit;
                }
            }
        else{
              $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
                $rs = json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it", "RequestId"=> $refId));
                 echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
                    exit;
        }
    }
    else{
      $con->query("update recharge_transaction set RESPONSE='".str_replace("'" , "\'" , $rs)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
        $rs = json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance.", "RequestId"=> $refId));
         echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
                    exit;
    }
    
}


?>