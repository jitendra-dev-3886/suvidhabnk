<?php
session_start();

require("../../../../Db/config.php");
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);

include("../../Backend/Userinfo/getuserinfo.php");
require("../../Backend/Functions/all_function.php");
require("../../Auth/Auth.php");
require("function.php");

$time = date("Y-m-d g:i:s A");



$reqBodyAr = json_decode($reqBody , true);


      $timestamp = date("Y-m-d H:i:s");
      $time = date("g:i:s A");
      $date  = date("Y-m-d");
      
      $adhar = strip_tags($reqBodyAr['adhaarnumber']);
      $finger = $reqBodyAr['data'];
      $mobile = strip_tags($reqBodyAr['mobilenumber']);
      $trans = strip_tags($reqBodyAr['transactiontype']);
      $bank = strip_tags($reqBodyAr['nationalbankidentification']);
      $long = $reqBodyAr['longitude'];
      $lat = $reqBodyAr['latitude'];
      $am = $reqBodyAr['amount'];
      $merchnt =$reqBodyAr['mobilenumber'];
     $refrence = $reqBodyAr['referenceno'];
        $mc_id = $reqBodyAr['submerchantid'];
      $accessmodetype = $reqBodyAr['accessmodetype'];
        
    
      if($trans == "CW"){
          $url =  $paysprint['URL']."/api/v1/service/aeps/cashwithdraw/index";
          $msg = "Cash Withdrawl";
          if($am <= 101){
                echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code"=>  500 , "message"=>"Please enter amount greater than 101. ", "RequestId"=> $refId]) , $refId);
                exit;
          }
          else if($am > 10000){
                echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code"=>  500 , "message"=>"Please enter amount less than or equal to 10000. ", "RequestId"=> $refId]) , $refId);
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
                echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code"=>  500 , "message"=>"Please enter amount greater than 101. ", "RequestId"=> $refId]) , $refId);
                exit;
          }
          else if($am > 10000){
                echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code"=>  500 , "message"=>"Please enter amount less than or equal to 10000. ", "RequestId"=> $refId]) , $refId);
                exit;
          }
      }
      
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
            "is_iris" => $reqBodyAr['is_iris'],
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
            "is_iris" => $reqBodyAr['is_iris'],
            );
      }
            // echo json_encode($arr);
            // exit;
            $data_tkn = encryptaeps($arr);
            $sendData = array(
                "body"=>$data_tkn,
                );
                
                
            $main_body = json_encode($sendData , true);

            $token = create_token();
        $user = $con->query("select * from api_user  where ID='$usid' ")->fetch_assoc();
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
                            // echo $response;
                            
                          $rslt = json_decode($response , true);
                          $status = $rslt['status'];
                          $rrn = $rslt['bankrrn'];
                          $msg = $rslt['message'];
                          $rs_code = $rslt['response_code'];
                          
                          if($rs_code == 1){
                              $st  = "Success";
                              $rsstcd = 111;
                          }
                          else{
                              $st = "Failed";
                              $rsstcd = 113;
                          }
                            $rspns = json_encode(["response_code" => $rsstcd , "status"=>$st , "message"=>$msg, "RequestId"=> $refId , "data" => $rslt]);
                            echo ApiHit($reqBody ,  $data['Token'] , $rspns , $refId);
                            
                           callToRecon($refrence , $st);
                          // Response for cash withdrawl
                          $con->query("update aeps_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st,$msg' where REFFRENCE_ID='$refrence' ");
                          if($trans == "CW"){
                              if($rs_code == 1){
                                  $user_bal = $user['AEPS_BAL']+$am;
                                  $deduct_bal = "update api_user set AEPS_BAL='$user_bal' where ID='$usid' ";
                                  $con->query("update api_user set AEPS_BAL='$user_bal' where ID='$usid'  ");
                                  insert_allreport($usid  ,$refrence , "AEPS" , $user['AEPS_BAL']  , $user_bal , $am , "Credit" , "Aeps Transaction", "AEPS");
                                  give_aeps_com($refrence , $usid ,"46");
                              }
                          }
                          else if($trans == "M"){
                              if($rs_code == 1){
                                  $user_bal = $user['AEPS_BAL']+$am;
                                //   $deduct_bal = "update api_user set AEPS_BAL='$user_bal' where ID='$usid' ";
                                  $con->query("update api_user set AEPS_BAL='$user_bal' where ID='$usid'  ");
                                  insert_allreport($usid  ,$refrence , "AEPS ADHAAR_PAY" , $user['AEPS_BAL']  , $user_bal , $am , "Credit" , "Aeps adhaarpay Transaction" , "AEPS");
                                  aadhar_com($refrence , $usid , "46");
                              }
                          }
                        //   else if($trans == "MS"){
                        //       if($rs_code == 1){
                        //           $comm =$con->query("SELECT * FROM `etax_commission` WHERE SERVICE='Mini Statement'")->fetch_assoc();
                        //                 $rtcom = $comm['RT_COMM'];
                        //                 $dtcom = $comm['DT_COMM'];
                        //                  $user = $con->query("select * from user  where ID='$usid' ")->fetch_assoc();
                        //                 $ds_id = $user['OWNER_ID'];
                        //                 $ds_data =  $con->query("select * from user  where ID='$ds_id' and USER_TYPE='47'")->fetch_assoc();
                                        
                        //                     $us_main_bal = $user['MAIN_BAL'];
                        //                     $ds_main_bal = $ds_data['MAIN_BAL'];
                                            
                        //                     $update_bal = $us_main_bal+$rtcom;
                        //                     $ds_update_bal = $ds_main_bal+$dtcom;
                                            
                                            
                        //                 $con->query("update api_user set MAIN_BAL='$update_bal'  where ID='$usid' ");
                                       
                        //                 insert_allreport($usid  ,$refrence , "Aeps MS Commission"  ,$us_main_bal , $update_bal , $rtcom , "Credit" , "Aeps MS Transaction Commission" , "MAIN");
                                        
                        //                 $con->query("update api_user set MAIN_BAL='$ds_update_bal'  where ID='$ds_id' ");
                                        
                        //                 insert_allreport($ds_id  ,$refrence , "Aeps MS Commission"  ,$ds_main_bal , $ds_update_bal , $dtcom ,  "Credit" , "Aeps MS Transaction Commission" , "MAIN");
                                        
                        //       }
                        //   }
                }
            else{
                echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code"=>  500 , "message"=>"Some internel server error. We are fixing it", "RequestId"=> $refId]) , $refId);
                exit;
            }
        }
        else{
              echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code"=>  500 , "message"=>"Balance could not fetched. Please retry or Relogin your account ..", "RequestId"=> $refId]) , $refId);
              exit;
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


?>