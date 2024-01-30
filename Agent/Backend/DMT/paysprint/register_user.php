<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
include("dmt_function.php");

$time = date("Y-m-d g:i:s A");


// give_dmt_com("NSD1IMPS18475585" , 1 ,46);


//fetch_dmt_accounts
if(isset($_POST['dmt_acc'])){
    
    $person = $_POST['person'];
    $response  = array();  
    $op = $con->query("SELECT * FROM `dmt_user` WHERE USER_ID = '$usid' AND MOBILE LIKE '%$person%' ORDER BY ID DESC LIMIT 5000");
    if($op->num_rows > 0)
    { 
        while($row = $op->fetch_assoc()){
                $manage = json_decode($row['RESPONSE']);
                $details = $manage;
                $manage = $manage->data;
                if($manage!=null){
                array_push($response,array("status"=>$details->status,"response_code"=>$details->response_code,"message"=>$details->message,"fname"=>$manage->fname,"lname"=>$manage->lname,"mobile"=>$manage->mobile,"my_status"=>$manage->status,"bank3_limit"=>$manage->bank3_limit,"bank2_limit"=>$manage->bank2_limit,"bank1_limit"=>$manage->bank1_limit,"id"=>$row['ID']));
                }
        }
        echo stripslashes(json_encode($response,JSON_UNESCAPED_SLASHES));
    }else{
        echo stripslashes(json_encode($response,JSON_UNESCAPED_SLASHES));
    }
}


//fetch_beneficiary
if(isset($_POST['get_beneficiaries'])){
    
    $mobile = $_POST['mobile'];
    $acc_num = $_POST['acc_num'];
    
    echo fetch_bene($mobile);
    exit;
    $response  = array();
    $op = $con->query("SELECT * FROM `dmt_beneficiary` WHERE NAME LIKE '%$acc_num%' AND MOBILE= '$mobile' AND USER_ID='$usid' ORDER BY ID DESC LIMIT 5000");
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
                $myData = $row['RESPONSE'];
                $myData1 = json_decode($myData);
                $rawData = $myData1->data;  
                array_push($response,array("bene_id"=>$rawData->bene_id,"bankid"=>$rawData->bankid,"bankname"=>$rawData->bankname,"name"=>$rawData->name,"accno"=>$rawData->accno,"ifsc"=>$rawData->ifsc,"verified"=>$rawData->verified,"banktype"=>$rawData->banktype,"paytm"=>""));
        }
        
        echo json_encode($response);
    }
    else{
        echo json_encode($response);
    }  
    
    
}


//fetch_beneficiary
if(isset($_POST['all_histories'])){
    
    $mobile = $_POST['senderMobile'];
    $acc_num = $_POST['acc_num'];
    $response  = array();
    $op = $con->query("SELECT * FROM `dmt_transactions` WHERE USER_ID ='$usid' AND ACCOUNT LIKE '%$acc_num%' AND MOBILE='$mobile' ORDER BY ID DESC LIMIT 5000");
    if($op->num_rows > 0)
    {   
        while($row = $op->fetch_assoc()){
                
                $manage = json_decode($row['RESPONSE']);
                // if($manage!=null){
                    array_push($response,array("time"=>$row['TIMESTAMP'],"amount"=>$row['AMOUNT'],"trans_type"=>$row['TRANS_TYPE'],"data"=>$manage,"status"=>$row['STATUS'],"reference_id"=>$row['REFFRENCE_ID']));
                // }
        }
        
        echo stripslashes(json_encode($response,JSON_UNESCAPED_SLASHES));
    
    }else{
        
        echo stripslashes(json_encode($response,JSON_UNESCAPED_SLASHES));
    
    }
    
    
}


//selected History
if(isset($_POST['selectedHistory'])){
    
    $bene_id = strip_tags($_POST['bene_id']);
    $ref = $_POST['reference'];
 
    $response  = array();
    $op = $con->query("SELECT * FROM `dmt_transactions` WHERE USER_ID = '$usid' AND REFFRENCE_ID LIKE '%$ref%' AND BENE_ID='$bene_id' ORDER BY ID DESC LIMIT 5000");
    
    if($op->num_rows > 0)
    {   
        while($row = $op->fetch_assoc()){
                
                $manage = json_decode($row['RESPONSE']);    
                if($manage!=null){
                    array_push($response,array("time"=>$row['TIMESTAMP'],"amount"=>$row['AMOUNT'],"trans_type"=>$row['TRANS_TYPE'],"data"=>$manage,"status"=>$row['STATUS'],"reference_id"=>$row['REFFRENCE_ID']));
                }
        }
        
        echo stripslashes(json_encode($response,JSON_UNESCAPED_SLASHES));
    
    }else{
            echo stripslashes(json_encode($response,JSON_UNESCAPED_SLASHES));
    }
}


// register user
if(isset($_POST['str'])){
    $fname = $_POST['fname'];
    $lname= $_POST['lname'];
    $addresss = $_POST['Address'];
    $pincode = $_POST['pincode'];
    $mobile = $_POST['mobile'];
    $user_id = $user['ID'];
    $user_type = $user['USER_TYPE'];
    $dob = $_POST['dob'];
    $otp = $_POST['otp'];
    $str = $_POST['str'];
    
     if($dob == "" || $mobile == ""|| $fname == ""|| $lname == ""|| $addresss == "" || $pincode == ""){
        echo json_encode(array("response_code"=>  400 , "message"=>"Please enter all fields."));
        exit;
    }
    if($str == 111){
            if($con->query("INSERT INTO `dmt_user`(`USER_ID` , `F_NAME`, `L_NAME`, `USER_TYPE`, `DOB`,`ADDRESS`,`PINCODE`,`MOBILE`, `RESPONSE`, `TIMESTAMP`) 
            VALUES ('$user_id','$fname','$lname','$user_type','$dob','$addresss','$pincode' ,'$mobile'  ,'".str_replace("'" , "\'" , "Alerady register. so register without otp")."','$time')")){
                echo json_encode(array("response_code"=>  1 , "message"=>"You are register with us.", 'status'=>true));
                exit;
            }
            else{
                echo json_encode(array("response_code"=>  500 , "message"=>"Server Error."));
                exit;
            }
    }
     
    $data = json_encode(array(
        "mobile"=>"$mobile",  
        "firstname"=>"$fname",  
        "lastname"=>"$lname", 
        "address"=>"$addresss", 
        "otp"=>"$otp", 
        "pincode"=>"$pincode",  
        "stateresp"=>"$str",  
        "bank3_flag"=>"no", 
        "dob"=>"$dob",  
        "gst_state"=>"07"
    ));
    
    
    $tkn = create_token();
    $curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/remitter/registerremitter",
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

if ($err) {
  echo "cURL Error #:" . $err;
} else {
    $rstl = json_decode($response);
    $rs_code = $rstl->response_code; 
    $msg = $rstl->message; 
    if($rs_code == 1){
        $con->query("INSERT INTO `dmt_user`(`USER_ID`, `USER_TYPE`, `DOB`,`ADDRESS`,`PINCODE`,`MOBILE`, `RESPONSE`, `TIMESTAMP`) VALUES ('$user_id','$user_type','$dob','$addresss','$pincode' ,'$mobile'  ,'".str_replace("'" , "\'" , $response)."','$time')");
    } 
}
}

// send otp for registeration query remmitter
if(isset($_POST['send_otp'])){
$mb = $_POST['mobile'];
$tkn = create_token();

$curl = curl_init();
// echo $tkn;
// exit;
$jsonData =json_encode(array(
    "mobile"=>$mb,
    "bank3_flag"=>"no"
    ));
    // echo $jsonData;
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/remitter/queryremitter",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $jsonData,
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
    "Token: ".$tkn
  ],
]);
// echo $paysprint['URL']."/api/v1/service/dmt/remitter/queryremitter";

$response = curl_exec($curl);
$err = curl_error($curl); 

curl_close($curl);
// echo $response;
  $rstl = json_decode($response);
  $rs_code = $rstl->response_code; 
  $msg = $rstl->message; 
   if($rs_code == 1){
    //   $row  = $con->query("select * from dmt_user where MOBILE='$mb' and DOB<>''and ADDRESS<>''and PINCODE<>'' ")->num_rows;
    $row  = $con->query("select * from dmt_user where MOBILE='$mb'")->num_rows;
      if($row == 0){
          
        $usertype_id = $user['USER_TYPE'];  
        $con->query("INSERT INTO `dmt_user`(`USER_ID`, `MOBILE` , `USER_TYPE`, `DOB`, `RESPONSE`, `TIMESTAMP`) VALUES ('$usid','$mb','$usertype_id','$dob','$response','$time')");  
          
        echo json_encode(array("response_code"=>  111 , "message"=>"You are register for DMT. Please enter additional data."));
     
      }
      else{
        echo $response;
      }
  }
  else{
    echo $response;
  }
}

// register bene
if(isset($_POST['bene_name'])){
    $mb =    $_POST['senderMobile'];
    $acc =  $_POST['bene_acc'];
    $ifsc = $_POST['bene_ifsc'];
    $bank = $_POST['bene_bank'];
    $verifybene = $_POST['verifybene'];
     $albenename = $con->query("SELECT * FROM user WHERE ACCOUNT = '$acc'");
     if($albenename->num_rows > 0){
          
          if($albenename["VERIFY_RESPONSE"] != ''){
             $vres = json_decode($albenename["VERIFY_RESPONSE"],true);
             $name = $vres['benename'];
          }else{
         $name = $_POST['bene_name']; 
     }
     }else{
         $name = $_POST['bene_name']; 
     }
    
     
      $dmt_user_rows = $con->query("select * from dmt_user where MOBILE='$mb' and DOB<>''and ADDRESS<>''and PINCODE<>'' order by ID desc LIMIT 1");
    if($dmt_user_rows->num_rows == 0){
        echo json_encode(array("response_code"=>  500 , "message"=>"You are not register with us. Please regiser again. "));
        exit;
    }
    $dmt_userData = $dmt_user_rows->fetch_assoc();
    $dob =  $dmt_userData['DOB'];
    $address =  $dmt_userData['ADDRESS'];
    $pin =  $dmt_userData['PIN'];
    
        $curl = curl_init();
        $data = json_encode(
            array(
                "mobile"=>"$mb",
                "benename"=>"$name",
                "bankid"=>"$bank",
                "accno"=>"$acc",
                "ifsccode"=>"$ifsc",
                "verified"=>"1",
                "gst_state"=>"07",
                "dob"=>   $dob,
                "address"=> $address,
                "pincode"=> $pin
                )
            );
            //  echo $data;
            //  exit;
        $tkn = create_token();
        curl_setopt_array($curl, [
          CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/beneficiary/registerbeneficiary",
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
        
        if ($err) {
          echo "cURL Error #:" . $err;
        } else {
          $rstl = json_decode($response);
          $rs_code = $rstl->response_code; 
          $msg = $rstl->message; 
          if($rs_code == 1){
              
            //   if($verifybene != ""){
                  
            //   }
              $con->query("INSERT INTO `dmt_beneficiary`(`NAME`, `MOBILE`, `USER_ID`, `USER_TYPE`, `BANK`, `IFSC`, `ACCOUNT`, `TIMESTAMP`, `PIN`, `ADDRESS`, `DOB`, `RESPONSE`) 
              VALUES ('$name','$mb','$usid','$usertype_id','$bank','$ifsc','$acc','$time','$pin','$address','$dob','".str_replace("'" , "\'" , $response)."')");
            }
        }
}


// delete bene
if(isset($_POST['bene_delete'])){
$usid = $_POST['bene_id'];
$acc = $_POST['bene_acc'];
 $mb =    $_POST['senderMobile'];
$curl = curl_init();
       $tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/beneficiary/registerbeneficiary/deletebeneficiary",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"mobile\":\"$mb\",\"bene_id\":\"$usid\"}",
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

if ($err) {
  echo "cURL Error #:" . $err;
} else { 
    $rstl = json_decode($response);
          $rs_code = $rstl->response_code; 
          $msg = $rstl->message; 
          if($rs_code == 1){
              $con->query("delete from `dmt_beneficiary` where ACCOUNT='$acc' ");
            }
        }
}



// verify bene
if(isset($_POST['verify_bene'])){
    
$beneid = $_POST['beneid'];
$acc = $_POST['bene_acc'];
$bakncode = $_POST['bank_code'];
$benename = $_POST['benename'];
$mobile = $_POST['senderMobile'];
              
$dmt_user = $con->query("select * from dmt_user where MOBILE='$mobile' and DOB<>''and ADDRESS<>''and PINCODE<>'' order by ID desc LIMIT 1")->fetch_assoc();




$ref = "NSD".date("dgis").mt_rand(999 , 9999);
 $data = json_encode(
            array(
                "referenceid"=> $ref,
                "bene_id"=> $beneid,
                "mobile"=>"$mobile",
                "accno"=>"$acc",
                "benename"=>"$benename",
                "bankid"=>"$bakncode",
                "gst_state"=>"07",
                "dob"=>   $dmt_user['DOB'],
                "address"=> $dmt_user['ADDRESS'],
                "pincode"=> $dmt_user['PINCODE'],
                )
            );


$user_bal = $user['MAIN_BAL']-4;
if($user_bal >= 0){
$curl = curl_init();
$tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/beneficiary/registerbeneficiary/benenameverify",
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

if ($err) {
  echo "cURL Error #:" . $err;
} else { 
          $rstl = json_decode($response);
          $rs_code = $rstl->response_code; 
          $msg = $rstl->message;
        if($rs_code == 1){
              $user = $con->query("select * from user where ID='$usid'")->fetch_assoc();
                   $update_bal = $user['MAIN_BAL'] - 4;
                   $con->query("update user set MAIN_BAL='$update_bal' where ID='$usid' ");
                   insert_allreport($usid  ,$refrence , "DMT Account Verify" , $user['MAIN_BAL']  , $update_bal ,3 , "Debit" , "DMT Account verification charge");
              $con->query("update `dmt_beneficiary` set VERIFY_RESPONSE='".str_replace("'" , "\'" , $response)."'  where ACCOUNT='$acc' ");
            }
        }
}
    else{
        echo json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
    }
}


// send amount
if(isset($_POST['send_amount'])){
$bene_id = strip_tags($_POST['bene_id']);
$acc = strip_tags($_POST['send_am_acc']);
$send_amount = strip_tags($_POST['send_amount']);

$bankname = strip_tags($_POST['bankname']);




$hash_code = strip_tags($_POST['smhash_code']);

// $otp = strip_tags($_POST['agentOTP']);
    
// validation of agent otp
// if($otp == ""){
//     $response = array("response_code"=>  403 , "message" => "Enter Agent  OTP");
//      echo json_encode($response);  
//     exit;
// }

// if($hash_code == ""){
//     $response = array("response_code"=>  403 , "message" => "Agent Verification failed" );
//      echo json_encode($response);  
//     exit;

// }

// if($otp != decrypt_token($hash_code)){
    
//     // echo json_encode(array("response_code"=>  403 , "message" => "Agent OTP Not matched ".decrypt_token($hash_code2) ));
//      $response = array("response_code"=>  403 , "message" => "Incorrect OTP" );
//       echo json_encode($response);  
//     exit;
// }



$txn_type = strip_tags($_POST['txn_type']);
$mb =    $_POST['senderMobile'];
 
 
 $remit = json_decode(getRemit($mb) , true);
 if($remit['data']['bank1_limit'] >= $send_amount){
     $bankname = "bank1";
 }
 else if($remit['data']['bank2_limit'] >= $send_amount){
     $bankname = "bank2";
 }
 else if($remit['data']['bank3_status'] == "yes"){
     if($remit['data']['bank3_limit'] >= $send_amount){
         $bankname = "bank3";
     }
     else{
         $bankname = "bank1";
     }
 }
 else{
         $bankname = "bank1";
 }
//  exit;
 
 
$dmtUs = $con->query("select * from dmt_user where MOBILE='$mb' and DOB<>''and ADDRESS<>''and PINCODE<>'' order by ID desc LIMIT 1")->fetch_assoc();
  $dob =  $dmtUs['DOB'];
$address =  $dmtUs['ADDRESS'];
    $pin =  $dmtUs['PINCODE'];
    
$refrence = "SUV".$txn_type.date("ygis");
 
 $comonRefID = "SUV".$txn_type.date("ygis");
    // $tpin = strip_tags($_POST['tpin']);
    // validation of user tpin  
// $userPin = $con->query("select * from tpin where USER_ID='$usid'");

// if($userPin->num_rows == 0){
//      echo json_encode(array("response_code"=>  400 , "responseReason" => "Error", "message" => "Your Pin is not set. Please set tpin first then continue the transaction."));
//      exit;
// }
// else{
//     $pinData =$userPin->fetch_assoc();
//     $Tpin = $pinData['TPIN'];
//     if($Tpin == ""){
//       echo json_encode(array("response_code"=>  400 , "responseReason" => "Error", "message" => "Your Pin is Blank. Please set tpin first then continue the transaction."));
//       exit;
//     }
//     if($Tpin != $tpin){
//       echo json_encode(array("response_code"=>  400 , "responseReason" => "Error", "message" => "Your Tpin is wrong. Please try again later. 3 Unsuccessfull attemps will temporarily block your account."));
//       exit;
//     }
// }

if($send_amount > 25000){
      echo json_encode(array("response_code"=>  400 , "responseReason" => "Error", "message" => "Amount should be less than 25001"));
      
      exit;
}
$usBal = $user['MAIN_BAL'];
if($usBal > $send_amount){
      
        //spillt the transaction is amount is greater than 5000
        if($send_amount > 5000){
            $sm = ceil($send_amount/5000);
            for($i=0; $i<$sm; $i++)
            {   
                $user = $con->query("select * from user where ID='$usid'")->fetch_assoc();
                $usBal = $user['MAIN_BAL'];
                $refrence =  "SUV".$txn_type.date("ygis");
                $snd = 5000;
                if($send_amount > 5000){
                    $am = $send_amount-$snd;
                }
                else{
                    $snd = $send_amount;
                }
                $insert_report = "INSERT INTO `dmt_transactions`(`USER_ID`, `USER_TYPE`, `MOBILE`, `BENE_ID`, `ACCOUNT`, `TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID`, `COMM_REFID`)
                VALUES ('$usid','$usertype_id','$mb','$bene_id','$acc','$time','$snd','$txn_type','$refrence' , '$comonRefID')";
                $user_bal = $usBal-$snd;
                $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid'";
                if($con->query($insert_report) && $con->query($deduct_bal) ){
                    $tkn = create_token();
                    $curl = curl_init();
                      $data = json_encode(
                                array(
                                    "mobile"=>"$mb",
                                    "referenceid"=>"$refrence",
                                    "pipe"=>$bankname,
                                    "bene_id"=>"$bene_id",
                                    "txntype"=>"$txn_type",
                                    "amount"=>"$snd",
                                    "gst_state"=>"07",
                                    "dob"=>   $dob,
                                    "address"=> $address,
                                    "pincode"=> $pin
                                    )
                                );
                        // echo "work";
                        curl_setopt_array($curl, [
                          CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/transact/transact",
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 30,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "POST",
                          CURLOPT_POSTFIELDS => $data ,
                          CURLOPT_HTTPHEADER => [
                              "Accept: application/json",
                                "Content-Type: application/json",
                              "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                                "Token: ".$tkn
                            ],
                        ]);
                        
                        $response = curl_exec($curl);
                        $err = curl_error($curl);
                        $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','DMT','$refrence','$token','$data','$response')");

                        curl_close($curl);
                          $gotrsnps[] = json_decode($response , true);
                          $rstl = json_decode($response);
                          $rs_code = $rstl->response_code; 
                          $msg = $rstl->message;
                          $status = $rstl->txn_status;
                          if($rs_code ==1){
                              switch($status){
                                   case 0  : $st_msg = "Failed and Refunded";
                                   break;
                                   case 1  : $st_msg = "Transaction Successfull";
                                   break;
                                   case 2  : $st_msg = "Transaction In Process";
                                   break;
                                   case 3  : $st_msg = "Transaction Sent To Bank";
                                   break;
                                   case 4  : $st_msg = "Transaction on Hold";
                                   break;
                                   case 5  : $st_msg = "Transaction Failed";
                                   break;
                              }
                          }else{
                              $st_msg = "Pending";
                          }
                          $con->query("update dmt_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
                          if($rs_code != 1 || $status == 0){
                              $con->query("update user set MAIN_BAL='$usBal' where ID='$usid' ");
                              insert_allreport($usid  ,$refrence , "DMT" , $usBal  , $usBal , $snd , "Failed" , "DMT Transaction");
                          }
                          else if($status != 0 && $rs_code==1  || $response == ""){
                              insert_allreport($usid  ,$refrence , "DMT" , $usBal  , $user_bal , $snd , "Debit" , "DMT Transaction");
                               // retailer commission
                                //   if($usertype_id == 46){
                                      give_dmt_com($refrence , $usid ,46);
                                //   }
                          }
                    }
                    else{
                        $gotrsnps = json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
                    }
                $send_amount =  $am;
            }
           echo json_encode(array("response_code"=>  1 , "txncount"=>  $sm , "TxnType"=>"111" , "response" => $gotrsnps, "message"=>$st_msg));  
        }
        else{
          $insert_report = "INSERT INTO `dmt_transactions`(`USER_ID`, `USER_TYPE`, `MOBILE`, `BENE_ID`, `ACCOUNT`, `TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID` , `COMM_REFID`)
            VALUES ('$usid','$usertype_id','$mb','$bene_id','$acc','$time','$send_amount','$txn_type','$refrence' , '$comonRefID')";
            $user_bal = $user['MAIN_BAL']-$send_amount;
            $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid' ";
            if($con->query($insert_report) && $con->query($deduct_bal) ){
            $tkn = create_token();
            $curl = curl_init();
              $data = json_encode(
                        array(
                            "mobile"=>"$mb",
                            "referenceid"=>"$refrence",
                            "pipe"=>"$bankname",
                            "bene_id"=>"$bene_id",
                            "txntype"=>"$txn_type",
                            "amount"=>"$send_amount",
                            "gst_state"=>"07",
                            "dob"=>   $dob,
                            "address"=> $address,
                            "pincode"=> $pin
                            )
                        );
                // echo "work";
                curl_setopt_array($curl, [
                  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/transact/transact",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS => $data ,
                  CURLOPT_HTTPHEADER => [
                      "Accept: application/json",
                        "Content-Type: application/json",
                      "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                        "Token: ".$tkn
                    ],
                ]);
                
                $response = curl_exec($curl);
                $err = curl_error($curl);
                $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','DMT','$refrence','$token','$data','$response')");

                curl_close($curl);
                  $rstl = json_decode($response);
                  $rs_code = $rstl->response_code; 
                  $msg = $rstl->message;
                  $status = $rstl->txn_status;
                  if($rs_code ==1){
                      switch($status){
                           case 0  : $st_msg = "Failed and Refunded";
                           break;
                           case 1  : $st_msg = "Transaction Successfull";
                           break;
                           case 2  : $st_msg = "Transaction In Process";
                           break;
                           case 3  : $st_msg = "Transaction Sent To Bank";
                           break;
                           case 4  : $st_msg = "Transaction on Hold";
                           break;
                           case 5  : $st_msg = "Transaction Failed";
                           break;
                      }
                  }else{
                      $st_msg = "Pending";
                  }
                    //   echo "work";
                  $con->query("update dmt_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
                    //   echo "work0";
                  if($rs_code != 1 || $status == 0 ){
                    //   echo "work1";
                      $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid'");
                      
                      insert_allreport($usid  ,$refrence , "DMT" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $send_amount , "Failed" , "DMT Transaction");
                  }
                  else {
                    //   echo "work2";
                      insert_allreport($usid  ,$refrence , "DMT" , $user['MAIN_BAL']  , $user_bal , $send_amount , "Debit" , "DMT Transaction");
                       // retailer commission
                          if($status != 0 && $status !=5){
                              give_dmt_com($refrence , $usid ,46);
                          }
                  }
                  
                  
               echo json_encode(array("response_code"=>  1 ,"txncount"=>1 , "TxnType"=>"112" , "response" => json_decode($response , true), "message"=>$st_msg));  
                }
            else{
                    echo json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
                }
        }
    }
    else{
        echo json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
    }
}



// update transaction status
if(isset($_POST['check_dmt_status'])){
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
    // exit;
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/transact/transact/querytransact",
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
if ($err) {
  echo "cURL Error #:" . $err;
} else { 
    $rstl = json_decode($response);
          $rs_code = $rstl->response_code; 
          $msg = $rstl->message; 
             $status = $rstl->txn_status;
              switch($status){
                   case 0  : $st_msg = "Failed and Refunded";
                   break;
                   case 1  : $st_msg = "Transaction Successfull";
                   break;
                   case 2  : $st_msg = "Transaction In Process";
                   break;
                   case 3  : $st_msg = "Transaction Sent To Bank";
                   break;
                   case 4  : $st_msg = "Transaction on Hold";
                   break;
                   case 5  : $st_msg = "Transaction Failed";
                   break;
              }
            if($rs_code == 1){
                $txn = $con->query0("select * from dmt_transactions where REFFRENCE_ID='$refrence'  ")->fetch_assoc();
                if($txn['RESPONSE'] == ""){
                   $con->query("update dmt_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  ,CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
                }
                else{
                   $con->query("update dmt_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
                }
            }
        }
}


// resend otp for transaction 
if(isset($_POST['resendRefundOTP'])){
$refrence = $_POST['ref_id'];
$akno = $_POST['akno'];
$curl = curl_init();
// echo "$refrence";
// exit;
$data = json_encode(
            array(
                "referenceid"=> $refrence,
                 "ackno"=> $akno,
                )
            );
       $tkn = create_token();
       
    //   echo $data;
    // exit;
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/refund/refund/resendotp",
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
if ($err) {
  echo "cURL Error #:" . $err;
} else { 
    // $rstl = json_decode($response);
    //       $rs_code = $rstl->response_code; 
    //       $msg = $rstl->message; 
    //          $status = $rstl->txn_status;
    //           switch($status){
    //               case 0  : $st_msg = "Failed and Refunded";
    //               break;
    //               case 1  : $st_msg = "Transaction Successfull";
    //               break;
    //               case 2  : $st_msg = "Transaction In Process";
    //               break;
    //               case 3  : $st_msg = "Transaction Sent To Bank";
    //               break;
    //               case 4  : $st_msg = "Transaction on Hold";
    //               break;
    //               case 5  : $st_msg = "Transaction Failed";
    //               break;
    //           }
        }
}


// update transaction status
if(isset($_POST['refundDmt'])){
$refrence = $_POST['ref_id'];
$akno = $_POST['akno'];
$otp = $_POST['refund_otp'];
$curl = curl_init();
// echo "$refrence";
// exit;
$trans_data = $con->query("select * from dmt_transactions  where REFFRENCE_ID='$refrence' ")->fetch_assoc();

$data = json_encode(
            array(
                "referenceid"=> $refrence,
                 "ackno"=> $akno,
                 "otp"=> $otp
                )
            );
       $tkn = create_token();
       
    //   echo $data;
    // exit;
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/refund/refund",
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
if ($err) {
  echo "cURL Error #:" . $err;
} else { 
    $rstl = json_decode($response);
      $rs_code = $rstl->response_code;
      if($rs_code == 1){
           $user = $con->query("select * from user where ID='$usid'")->fetch_assoc();
           $update_bal = $user['MAIN_BAL'] + $trans_data['AMOUNT'];
           $con->query("update user set MAIN_BAL='$update_bal' where ID='$usid' ");
           insert_allreport($usid  ,$refrence , "DMT Refund" , $user['MAIN_BAL']  , $update_bal , $trans_data['AMOUNT'] , "Credit" , "DMT Transaction Refund");
       $con->query("update dmt_transactions set REFUND_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='Refunded' where REFFRENCE_ID='$refrence' ");
      }else{
          insert_allreport($usid  ,$refrence , "DMT Refund" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $trans_data['AMOUNT'] , "Failed" , "DMT Transaction Refund");
      }
    }
}




if(isset($_POST['getbankIfsc'])){
    $bankcode = $_POST['bankcode'];
    $bank = $con->query("select * from paysprint_bank_list where BANKID='$bankcode'")->fetch_assoc();
    echo trim($bank['IFSC_CODE']);
    
}



// send otp for transaction 
// if(isset($_POST['sendotp'])){
//     extract($_POST);
//     if($send_am == ""){
//         $err = ["response_code"=>3, "message"=>"Amount cannot be empty", "status"=>false];
//         echo json_encode($err);
//         exit;
//     }
//       if($_POST['otpSendTime'] > 3){
        
//         $receivableData = ["response_code"=>500 , "smsotpst" => "OTP Send Limit exceeds. Please try again after some time."];
//         echo json_encode($receivableData);
//         exit;
//     }
    
//     $usmb = $user['MOBILE'];
//     $email = $user['EMAIL'];
    
//     $otp = mt_rand(999 , 9999);
// 	$message =urlencode("Do not share your login OTP with anyone.$otp OTP to accessing your Account. Please report unauthorised access to customer care. Powered by ARO TRADING & FINANCIAL CONSULTING");
// 	$emag ="Do not share your login OTP with anyone.$otp OTP to accessing your Account. Please report unauthorised access to customer care. Powered by ARO TRADING & FINANCIAL CONSULTING";
//   SendEMail($email,$emag , "Transaction OTP");
//   $smsrs = json_decode(smscall($usmb, $message) , true);
//   echo  json_encode(["response_code"=> 1, "smsotpst"=> "Success" , "OTPHASH"=>encrypt_token($otp) ]);
  
// }




// function smscall($mobile,$message){

// $curl = curl_init();

// curl_setopt_array($curl, array(
//   CURLOPT_URL => "http://sms.bulksmsind.in/v2/sendSMS?username=aropay&message=$message&sendername=AROCSP&smstype=TRANS&numbers=$mobile&apikey=e0b04669-e4f2-4d36-ae5c-a3adf5c61427&peid=1201160075655012053&templateid=1007164023804988435",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => '',
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 0,
//   CURLOPT_FOLLOWLOCATION => true,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => 'POST',
// ));

// $response = curl_exec($curl);
// // echo $response;
// curl_close($curl);
// }


// mail funtion
// function SendEMail($email,$message){

// $subject = "Password Details";

// // mail id to be changed to server mail id
// $headers = 'From: info@aropay.in' . "\r\n" .
//   'Reply-To:  info@aropay.in' . "\r\n" .
//   'X-Mailer: PHP/' . phpversion();

// // Send the email
// if ($error == FALSE) {
//   if(mail($email, $subject, $message, $headers)) {

//     // echo "<script> alert('The email was sent.')</script>";
    
//     }
//     else {
//     echo "<script> alert('The email fail to sent.')</script>";
//     $error = TRUE;
//     }
// }
// }

?>