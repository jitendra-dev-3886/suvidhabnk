<?php

include("../includes/config.php");
$base_url = "https://api.paysprint.in";

$status = false;
$time = date("Y-m-d g:i:s A");
// register user
if(isset($_POST['str'])){
    
$id = $_POST['id'];
$usertype_id = $_POST['usertype_id'];
include("../includes/fetch_data.php");
include("../includes/main_function.php");
    
    $fname = $_POST['remitter_first_name'];
    $lname= $_POST['remitter_last_name'];
    $addresss = $_POST['remitter_address'];
    $pincode = $_POST['pin_code'];
    $mobile = $_POST['remitter_mobile'];
    $user_id = $id;
    $user_type = $usertype_id;
    
    $dob = $_POST['dob'];
    $otp = $_POST['otp'];
    $str = $_POST['str'];
    
    $tkn = create_token();
    $curl = curl_init();
    $data = json_encode(array(
        "mobile"=>"$mobile",  
        "firstname"=>"$fname",  
        "lastname"=>"$lname", 
        "address"=>"$addresss", 
        "otp"=>"$otp", 
        "pincode"=>"$pincode",  
        "stateresp"=>"$str",  
        "bank3_flag"=>"yes", 
        "dob"=>"$dob",  
        "gst_state"=>"07"
    ));
// echo $data;
// exit;
curl_setopt_array($curl, [
  CURLOPT_URL => "$base_url/api/v1/service/dmt/remitter/registerremitter",
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
    $my_data = $rstl->data;
    if($rs_code == 1){
        if($my_data!=null){
            $con->query("INSERT INTO `dmt_user`(`USER_ID`, `USER_TYPE`, `DOB`, `RESPONSE`, `TIMESTAMP`) VALUES ('$id','$usertype_id','$dob','".str_replace("'" , "\'" , $response)."','$time')");
        }
    } 
}
}

// send otp for registeration
if(isset($_POST['send_otp'])){
$mb = $_POST['MOBILE'];
$dob = $_POST['dob'];
$id = $_POST['id'];
$pin_code = $_POST['pin_code'];
$usertype_id = $_POST['usertype_id'];

include("../includes/fetch_data.php");
include("../includes/main_function.php");

$tkn = create_token();

$curl = curl_init();
// echo $tkn;
// exit;
curl_setopt_array($curl, [
  CURLOPT_URL => "$base_url/api/v1/service/dmt/remitter/queryremitter",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"mobile\":\"$mb\",\"bank3_flag\":\"yes\"}",
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
  echo json_encode(array("error"=>"cURL Error #: " . $err));
} else {
  $rstl = json_decode($response);
  $rs_code = $rstl->response_code; 
  $msg = $rstl->message; 
  if($rs_code == 1){
    $con->query("INSERT INTO `dmt_user`(`USER_ID`, `USER_TYPE`, `MOBILE`, `DOB`, `RESPONSE`, `TIMESTAMP`) VALUES ('$id','$usertype_id', '$mb' ,'$dob','$response','$time')");
  }
}

}



// register bene
if(isset($_POST['bene_name'])){
    
    $id = $_POST['id'];
    $usertype_id = $_POST['usertype_id'];
    include("../includes/fetch_data.php");
    include("../includes/main_function.php");
    
    
    $nick_name = $_POST['nick_name'];
    $optional_num = $_POST['op_mobile'];
    $mb =    $_POST['dmt_mobile'];
    $name = $_POST['bene_name'];
    $acc =  $_POST['bene_acc'];
    $ifsc = $_POST['bene_ifsc'];
    $bank = $_POST['bene_bank'];
    $dob =  $_POST['dob'];
    $address =  $_POST['address'];
    $pin =  $_POST['pin'];
    
    
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
            // echo $data;
            // exit;
        $tkn = create_token();
        curl_setopt_array($curl, [
          CURLOPT_URL => "$base_url/api/v1/service/dmt/beneficiary/registerbeneficiary",
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
              $con->query("INSERT INTO `dmt_beneficiary`(`NAME`, `MOBILE`, `USER_ID`, `USER_TYPE`, `BANK`, `IFSC`, `ACCOUNT`, `TIMESTAMP`, `PIN`, `ADDRESS`, `DOB`, `RESPONSE`) 
              VALUES ('$name','$mb','$id','$usertype_id','$bank','$ifsc','$acc','$time','$pin','$address','$dob','".str_replace("'" , "\'" , $response)."')");
            }
        }
}


// delete bene
if(isset($_POST['bene_delete'])){
    
    $id = $_POST['id'];
    $usertype_id = $_POST['usertype_id'];
    include("../includes/fetch_data.php");
    include("../includes/main_function.php");

    
$id = $_POST['bene_id'];
$acc = $_POST['bene_acc'];
$mb =    $_POST['dmt_mobile'];
$curl = curl_init();
// echo "work";
// exit;
       $tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL => "$base_url/api/v1/service/dmt/beneficiary/registerbeneficiary/deletebeneficiary",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"mobile\":\"$mb\",\"bene_id\":\"$id\"}",
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


// send amount
if(isset($_POST['send_amount'])){
    
    $id = $_POST['id'];
    $usertype_id = $_POST['usertype_id'];
    $device = $_POST['device'];
    $ip = $_POST['ip'];
    
    include("../includes/fetch_data.php");
    include("../includes/main_function.php");
    include("dmt_function.php");
    
$dmt_mobile = strip_tags($_POST['dmt_mobile']);    
$bene_id = strip_tags($_POST['bene_id']);
$acc = strip_tags($_POST['send_am_acc']);
$txn_type = strip_tags($_POST['txn_type']);
$send_amount = strip_tags($_POST['send_amount']);
$ifsc = strip_tags($_POST['ifsc']);



$beneDetails = $con->query("SELECT * FROM `dmt_beneficiary` WHERE ACCOUNT='$acc' and IFSC='$ifsc' AND MOBILE='$dmt_mobile'")->fetch_assoc(); 

$mb =   $dmt_mobile;
$dob =  $beneDetails['DOB'];
$address =  $beneDetails['ADDRESS'];
$pin =  $beneDetails['PIN'];

$refrence =  substr(str_shuffle("123457890QWERTYUIOPASDFGHJKLZXCVBNMasdfghjklqwertyuiopzxcvbnm") , 0 , 10);
 
$tkn = create_token();
$curl = curl_init();
  $data = json_encode(
            array(
                "mobile"=>"$mb",
                "referenceid"=>"$refrence",
                "pipe"=>"bank1",
                "bene_id"=>"$bene_id",
                "txntype"=>"$txn_type",
                "amount"=>"$send_amount",
                "gst_state"=>"07",
                "dob"=>   $dob,
                "address"=> $address,
                "pincode"=> $pin
                )
            );
    
    // echo $data;
    // exit;
    
$ownerMy = $user['MAIN_OWNER'];
$ownerIdmy = $user['OWNER_ID'];
$insert_report = "INSERT INTO `dmt_transactions`(`OWNER`,`OWNER_ID`,`USER_ID`, `USER_TYPE`, `MOBILE`, `BENE_ID`, `ACCOUNT`, `TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID`)
VALUES ('$ownerMy','$ownerIdmy','$id','$usertype_id','$mb','$bene_id','$acc','$time','$send_amount','$txn_type','$refrence')";
$user_bal = $user['MAIN_BAL']-(int)$send_amount;
if($user_bal >= 0){
        $deduct_bal = "UPDATE `user` SET MAIN_BAL='$user_bal' WHERE ID='$id'";
        if($con->query($insert_report) && $con->query($deduct_bal) ){
            curl_setopt_array($curl, [
              CURLOPT_URL => "$base_url/api/v1/service/dmt/transact/transact",
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
            
            curl_close($curl);
            
              $rstl = json_decode($response);
              $rs_code = $rstl->response_code; 
              $msg = $rstl->message;
              $status = $rstl->txn_status;
              $remarks = $rstl->remarks;
              $result = $rstl->status;
              
              if($result==true && $rs_code==1){
                  echo json_encode(array("status"=>$result,"response_code"=>$rs_code,"message"=>$msg,"remarks"=>$remarks));
              }
              else{
                  echo json_encode(array("status"=>false,"response_code"=>$rs_code,"message"=>$msg,"remarks"=>$remarks));
              }
              
    
              $con->query("update dmt_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$msg' where REFFRENCE_ID='$refrence' ");
              if($status == 1){
                give_dmt_com($refrence , $id ,$usertype_id, $ip, $device);
                insert_allreport($id  ,$refrence , "DMT" , $user['MAIN_BAL']  , $user_bal , $send_amount , "Debit" , "DMT Transaction", $ip, $device); 
              }
              else{
                 $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$id' and USER_TYPE='$usertype_id' ");
                insert_allreport($id  ,$refrence , "DMT" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $send_amount , "Debit" , "DMT Transaction", $ip, $device);
              }
        }
        else{
            echo json_encode(array("status"=>$status,"response_code"=>  500 , "message"=>"Some internel server error. We are fixing it","remarks"=>"No Remarks"));
        }
    }
    else{
        echo json_encode(array("status"=>$status,"response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance.","remarks"=>"No Remarks"));
    }
}



// update transaction status
if(isset($_POST['check_dmt_status'])){
$refrence = $_POST['ref_id'];


    include("../includes/fetch_data.php");
    include("../includes/main_function.php");

$curl = curl_init();
// echo "$refrence";
// exit;
$data = json_encode(
            array(
                "referenceid"=>"$refrence",
                )
            );
       $tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL => "$base_url/api/v1/service/dmt/transact/transact/querytransact",
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
        if($rs_code==1){
           $con->query("update dmt_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
        }
    
}
}