<?php
error_reporting(0);
$time = date("Y-m-d g:i:s A");

function encrypt__adhar($simple_string){
$ciphering = "AES-128-CTR";
$options   = 0;
$encryption_iv = 'ThisIsSecretKeyForEncrytionByJisneYeBnaya!@#$%^&*()';
$encryption_key = "WebSpidy";
$encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
return base64_encode($encryption);

}
function decrypt__adhar($encryption){
    $ciphering = "AES-128-CTR";
     $decryption_iv = 'ThisIsSecretKeyForEncrytionByJisneYeBnaya!@#$%^&*()';
    $decryption_key = "WebSpidy";
    // Using openssl_decrypt() function to decrypt the data 
    $decryption = openssl_decrypt(base64_decode($encryption), $ciphering, $decryption_key, 0, $decryption_iv);
    return $decryption;
}






    
if(isset($_POST['aadhar'])){
    include("../includes/config.php");
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
      $id = strip_tags($_POST['id']);
      $usertype_id = strip_tags($_POST['userTypeId']);
      
      $ip_address = strip_tags($_POST['ipaddress']);
      $device = strip_tags($_POST['device']);
      
      
    
      
      include("../includes/fetch_data.php");
      include("../includes/main_function.php");
      include("aeps_function.php");
      

     if($trans == "CW"){
          $url = "https://api.paysprint.in/api/v1/service/aeps/cashwithdraw/index";
          $msg = "Cash Withdrawl";
      }
      else if($trans == "BE"){
          $url = "https://api.paysprint.in/api/v1/service/aeps/balanceenquiry/index";
          $msg = "Balance Enquiry";
      
      }
      else if($trans == "MS"){
          $url = "https://api.paysprint.in/api/v1/service/aeps/ministatement/index";
          $msg = "Mini Statement";
      }
    else if($trans == "M"){
          $url = "https://api.paysprint.in/api/v1/service/aadharpay/aadharpay/index";
          $msg = "Aadhaar Pay";
     }
      
      
      $rtData = $con->query("select * from user where ID='".$id."'")->fetch_assoc();
    $merchnt =$rtData['MOBILE'];
      
      $data = $con->query("select * from aeps_merchant where MOBILE='".$merchnt."'")->fetch_assoc();
      
        $refrence = substr(str_shuffle("234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM") , 0 , 8);
        // $mc_id = $paysprint['MERCHANT_CODE'].$id;
      
      $mc_id = $data['MERCHANTCODE'];
      
      if($trans == "CW" || $trans == "M"){
          $arr = array(
            "latitude"=>"$lat",
            "longitude"=>"$long",
            "mobilenumber"=>"$mobile",
            "referenceno"=>$refrence,
            "ipaddress"=> $_SERVER['REMOTE_ADDR'],
            "adhaarnumber"=>$adhar,
            "accessmodetype"=>"APP",
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
            "accessmodetype"=>"APP",
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

            $data_tkn = encrypt($arr);
        
            $sendData = array(
                "body"=>$data_tkn,
                );
        
        
            $main_body = json_encode($sendData , true);
        
            $token = create_token();
        
    
        
             
        $user = $con->query("select * from user  where ID='$id' and USER_TYPE='$usertype_id'")->fetch_assoc();
        if($user['AEPS_BAL'] >= 0){
           
            $myOwner = $user['MAIN_OWNER'];
            $myOwnerID = $user['MAIN_OWNER_ID'];
            $insert_report = "INSERT INTO `aeps_transactions`(`OWNER`,`OWNER_ID`,`USER_ID`, `USER_TYPE`, `MOBILE`, `TIMESTAMP`, `TRANS_TYPE`, `REFFRENCE_ID`, `ACCESS_MODE`, `MERCHANT_ID`,
            `ADHAAR_NUM`, `AMOUNT`) VALUES ('$myOwner','$myOwnerID','$id','$usertype_id','$mb', '$time ','$trans','$refrence','Android','$mc_id','".encrypt__adhar(substr($adhar , 8 , 12))."', '$am' )";
            
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
            
                          $rslt = json_decode($response);
                          $status = $rslt->status;
                          $rrn = $rslt->bankrrn;
                        
                          $rs_code = $rslt->response_code;
                        
                             echo $response; 
                        
                          $con->query("update aeps_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status,$st_msg' where REFFRENCE_ID='$refrence' ");


                        $myres = json_decode($response);
                        $rs_code = $myres->response_code;
                         
                         
                         //
                         
                         
                        if($trans == "CW"){
                              if($rs_code == 1){

                                callToRecon($refrence , "success");

                                $old_bal = $user['AEPS_BAL'];
                                $new_bal = $old_bal + (int)$am;
                                    $sql = "UPDATE user SET AEPS_BAL='$new_bal' WHERE ID='$id'";
                                    mysqli_query($con, $sql);
                                    insert_allreport($id  ,$refrence , "AEPS" , $old_bal  , $new_bal , $am , "Credit" , "Aeps Transaction",$ip_address, $device);           
                                    give_aeps_com($refrence , $id , $usertype_id, $ip_address, $device);
                                  
                              }else{
                                  callToRecon($refrence , "failed");
                                    insert_allreport($id  ,$refrence , "AEPS" , $user['AEPS_BAL']  , $user['AEPS_BAL'] , $am , "Credit" , "Aeps Cash Withdrwal Transaction",$ip_address, $device);
                                    //   give_aeps_com($refrence , $id , $usertype_id, $ip_address, $device);  //it will comment after test
                              }
                          }
                          else if($trans == "M"){
                              if($rs_code == 1){
                                    
                                    callToRecon($refrence , "success");
                                    
                                $old_bal = $user['AEPS_BAL'];
                                $new_bal = $old_bal + (int)$am;
                                $sql = "UPDATE user SET AEPS_BAL='$new_bal' WHERE ID='$id'";
                                mysqli_query($con, $sql);
                                  insert_allreport($id  ,$refrence , "AEPS" , $old_bal  , $new_bal , $am , "Credit" , "Aeps adhaarpay Transaction",$ip_address, $device);
                                  aadhar_com($refrence , $id , $usertype_id, $ip_address, $device);
                                //   give_adharpay_com($refrence , $id , $usertype_id, $ip_address, $device); We Will use aeps function in adhaar pay because both are same but commission will be debit - opposite to aeps comm
                                
                              }else{
                                  callToRecon($refrence , "failed");
                                    insert_allreport($id  ,$refrence , "AEPS" , $user['AEPS_BAL']  , $user['AEPS_BAL'] , $am , "Credit" , "Aeps adhaarpay Transaction",$ip_address, $device);
                                    // give_aeps_com($refrence , $id , $usertype_id, $ip_address, $device);  //it will comment after test
                              }
                          }
                          else{
                              
                              callToRecon($refrence , "failed");
                                insert_allreport($id  ,$refrence , "AEPS" , $user['AEPS_BAL']  , $user['AEPS_BAL'] , "0" , "Credit" , "Aeps Transaction",$ip_address, $device);
                              
                          }
                         

                }
            else{

                if($trans == "MS"){
                $myArr = array(
                "status" =>false,
                "message" =>"Some internel server error. We are fixing it",
                "ackno"=>00,
                "datetime"=>"XX",
                "balanceamount"=>"XX",
                "bankrrn"=>"XX",
                "bankiin"=>"XX",
                "response_code"=>"XX",
                "errorcode"=>"XX",
                "clientrefno"=>"XX",
                "ministatement"=>[]
            
                );
                    
                }
            else{
                 $myArr = array(
                "status" =>false,
                "message" =>"Some internel server error. We are fixing it",
                "ackno"=>00,
                "amount"=>00,
                "balanceamount"=>"XX",
                "bankrrn"=>"XX",
                "bankiin"=>"XX",
                "response_code"=>00,
                "errorcode"=>"XX",
                "clientrefno"=>"XX",
                "last_aadhar"=>"XX",
                "name"=>"XX"
                );
            }
                echo json_encode($myArr);
                
            }
        }
        else{


            if($trans == "MS"){
                $myArr = array(
                "status" =>false,
                "message" =>"You have no sufficient balance to use AEPS..",
                "ackno"=>00,
                "datetime"=>"XX",
                "balanceamount"=>"XX",
                "bankrrn"=>"XX",
                "bankiin"=>"XX",
                "errorcode"=>"XX",
                "clientrefno"=>"XX",
                "ministatement"=>[]
            
                );
                    
                }
            else{
                $myArr = array(
                "status" =>false,
                "message" =>"You have no sufficient balance to use AEPS..",
                "ackno"=>00,
                "amount"=>00,
                "balanceamount"=>"XX",
                "bankrrn"=>"XX",
                "bankiin"=>"XX",
                "response_code"=>00,
                "errorcode"=>"XX",
                "clientrefno"=>"XX",
                "last_aadhar"=>"XX",
                "name"=>"XX"
                );
            }
                echo json_encode($myArr);
        }
}
else{
            

                if($trans == "MS"){
                $myArr = array(
                "status" =>false,
                "message" =>"Not Access internally",
                "ackno"=>00,
                "datetime"=>"XX",
                "balanceamount"=>"XX",
                "bankrrn"=>"XX",
                "bankiin"=>"XX",
                "response_code"=>"XX",
                "errorcode"=>"XX",
                "clientrefno"=>"XX",
                "ministatement"=>[]
            
                );
                    
                }
            else{
                 $myArr = array(
                "status" =>false,
                "message" =>"Not Access internally",
                "ackno"=>00,
                "amount"=>00,
                "balanceamount"=>"XX",
                "bankrrn"=>"XX",
                "bankiin"=>"XX",
                "response_code"=>00,
                "errorcode"=>"XX",
                "clientrefno"=>"XX",
                "last_aadhar"=>"XX",
                "name"=>"XX"
                );
            }
                echo json_encode($myArr);
                
        
}


function callToRecon($ref , $status){
    global $con , $base_url , $paysprint;
    
        $arr = array(
            "reference"=>"$ref",
            "status"=>"$status",
            );
            
        $data_tkn = encrypt($arr);
        $sendData = array(
            "body"=>$data_tkn,
            );
        $main_body = json_encode($sendData , true);
        $token = create_token();
        
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => $base_url."/api/v1/service/aeps/threeway/threeway",
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
        
      //echo $response;
      $con->query("INSERT INTO `aeps_recon_response`(`DATA`, `RESPONSE`) VALUES ('".json_encode($arr)."','$response')");
}

?>