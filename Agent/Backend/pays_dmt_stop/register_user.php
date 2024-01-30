<?php


include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");
include("dmt_function.php");

$time = date("Y-m-d g:i:s A");


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
    
    $mobile = $_POST['dmt_mobile'];
    $acc_num = $_POST['acc_num'];
    $response  = array();
    $op = $con->query("SELECT * FROM `dmt_transactions` WHERE USER_ID ='$usid' AND ACCOUNT LIKE '%$acc_num%' AND MOBILE='$mobile'  AND APINAME ='PAYSPRINT' ORDER BY ID DESC LIMIT 5000");
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
    $op = $con->query("SELECT * FROM `dmt_transactions` WHERE USER_ID = '$usid' AND REFFRENCE_ID LIKE '%$ref%' AND BENE_ID='$bene_id' AND APINAME ='PAYSPRINT' ORDER BY ID DESC LIMIT 5000");
    
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
    $fname = $_POST['remitter_first_name'];
    $lname= $_POST['remitter_last_name'];
    $addresss = $_POST['remitter_address'];
    $pincode = $_POST['pin_code'];
    $mobile = $_POST['remitter_mobile'];
    $user_type = $user['USER_TYPE'];
    $dob = $_POST['dob'];
    $otp = $_POST['otp'];
    $str = $_POST['str'];

    
    $tkn = create_token();
    $curl = curl_init();
     if($dob== "" || $pincode == "" || $addresss == "" || $lname == "" || $fname == ""){
            echo json_encode(array("response_code"=>  400 , "message"=>"Please enter all fields."));
            exit;
        }
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
        $con->query("INSERT INTO `dmt_user`(`USER_ID`, `USER_TYPE`, `DOB`,`ADDRESS`,`PINCODE`,`MOBILE`, `RESPONSE`, `TIMESTAMP`) VALUES ('$usid','$user_type','$dob','$addresss','$pincode' ,'$mobile'  ,'".str_replace("'" , "\'" , $response)."','$time')");
    } 
}
}

// send otp for registeration
if(isset($_POST['send_otp'])){
$mb = $_POST['mobile'];
$dob = $_POST['dob'];
    $fname = $_POST['fname'];
    $lname= $_POST['lname'];
    $addresss = $_POST['Address'];
    $pincode = $_POST['pincode'];
$tkn = create_token();
$curl = curl_init();
$jsonData =json_encode(array(
    "mobile"=>$mb,
    "bank3_flag"=>"yes"
    ));
    
// "{\"mobile\":\"$mb\",\"bank3_flag\":\"yes\"}"    
    
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

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
  $rstl = json_decode($response);
  $rs_code = $rstl->response_code; 
  $msg = $rstl->message; 
  
  echo $response;
  if($rs_code == 1){
    $usertype_id = $user['USER_TYPE'];  
    $con->query("INSERT INTO `dmt_user`(`USER_ID`, `MOBILE` , `USER_TYPE`, `DOB`, `RESPONSE`, `TIMESTAMP`) VALUES ('$usid','$mb','$usertype_id','$dob','$response','$time')");
  }
}


// register bene
if(isset($_POST['bene_name'])){
    
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
    
    $dmt_user_rows = $con->query("select * from dmt_user where MOBILE='$mb' and RESPONSE<>'' order by ID desc LIMIT 1");
    if($dmt_user_rows->num_rows != 1){
        echo json_encode(array("response_code"=>  500 , "message"=>" Unauthorized access. Your account has been reported to admin and will temporarily block in next few minutes. Please contact to your admin."));
        exit;
    }

        $curl = curl_init();
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
              $usertype_id = $user['USER_TYPE'];
              $con->query("INSERT INTO `dmt_beneficiary`(`NAME`, `MOBILE`, `USER_ID`, `USER_TYPE`, `BANK`, `IFSC`, `ACCOUNT`, `TIMESTAMP`, `PIN`, `ADDRESS`, `DOB`, `RESPONSE`) 
              VALUES ('$name','$mb','$usid','$usertype_id','$bank','$ifsc','$acc','$time','$pin','$address','$dob','".str_replace("'" , "\'" , $response)."')");
            }
        }
}


// delete bene
if(isset($_POST['bene_delete'])){
$usid = $_POST['bene_id'];
$acc = $_POST['bene_acc'];
$mb =    $_POST['dmt_mobile'];
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
    
    $dmt_mb = $_POST['dmt_mobile'];
    $acc=  $_POST['acc'];
    $bene = $con->query("SELECT * FROM `dmt_beneficiary` WHERE ACCOUNT='$acc' AND MOBILE = '$dmt_mb'")->fetch_assoc();
    
    $details =  json_decode($bene['RESPONSE']);
    $details = $details->data;

   $mobile = $dmt_mb;
   $accno = $acc;
   $bankid = $details->bankid;
   $benename = $details->name;
   $referenceid = rand();
   $pincode = $bene['PIN'];
   $addresss = $bene['ADDRESS'];
   $dob = $bene['DOB'];
   $bene_id = $details->bene_id;
    
    $tkn = create_token();
    $curl = curl_init();
    $data = json_encode(array(
        "mobile"=>"$mobile",
        "accno"=>"$accno",
        "bankid"=>"$bankid",
        "benename"=>"$benename",
        "referenceid"=>"$referenceid",
        "pincode"=>"$pincode", 
        "address"=>"$addresss", 
        "dob"=>"$dob",  
        "gst_state"=>"07",
        "bene_id"=>"$bene_id"
    ));
$user_bal = $user['MAIN_BAL']-3;
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
                   $update_bal = $user['MAIN_BAL'] - 3;
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


//delete
if(isset($_POST['delete_dmt_user'])){

$select =  $_POST['delete_id'];
$op = $con->query("DELETE FROM `dmt_user` WHERE ID='$select'");
if ($op) {
  echo json_encode(["status"=>true, "response_code"=>1, "message"=>"Succcess"]);
} else {
  echo json_encode(["status"=>false, "response_code"=>4, "message"=>"Failed to delete"]);
}

$con->close();
        
        
}


if(isset($_POST['refresh_dmt_user'])){
    
$mb = $_POST['mobile'];
$gid = $_POST['refresh_id'];


$tkn = create_token();

$curl = curl_init();
curl_setopt_array($curl, [
  CURLOPT_URL => $paysprint['URL']."/api/v1/service/dmt/remitter/queryremitter",
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
        $sql = "UPDATE `dmt_user` SET RESPONSE='$response' WHERE ID='$gid'";
        mysqli_query($con, $sql);
  }
}

}



// send amount
if(isset($_POST['send_amount'])){
$bene_id = strip_tags($_POST['bene_id']);
$acc = strip_tags($_POST['send_am_acc']);
$send_amount = strip_tags($_POST['send_amount']);

$txn_type = strip_tags($_POST['txn_type']);
$mb =    $_POST['dmt_mobile'];
 
$dmtUs = $con->query("select * from dmt_beneficiary where ACCOUNT='$acc' and USER_ID='$usid' order by ID desc LIMIT 1")->fetch_assoc();

$dob =  $dmtUs['DOB'];
$address =  $dmtUs['ADDRESS'];
$pin =  $dmtUs['PIN'];
$usertype_id = $user['USER_TYPE']; 
$mySum = 0;
 $refrence = "PDR".$usid.date("Ymd").mt_rand(999, 9999);
 $comonRefID =   "PDRDT".$usid.$txn_type.date("Ymd").mt_rand(999, 9999);
    $tpin = strip_tags($_POST['mpin']);
    // validation of user tpin  
$userPin = $con->query("select * from tpin where USER_ID='$usid' and STATUS ='Active' ORDER BY ID DESC LIMIT 1");

if($userPin->num_rows == 0){
     echo json_encode(array("response_code"=>  400 , "responseReason" => "Error", "message" => "Your Pin is not set. Please set tpin first then continue the transaction."));
     exit;
}
else{
    $pinData =$userPin->fetch_assoc();
    $Tpin = $pinData['TPIN'];
    if($Tpin == ""){
      echo json_encode(array("response_code"=>  400 , "responseReason" => "Error", "message" => "Your Pin is Blank. Please set tpin first then continue the transaction."));
      exit;
    }
    if($Tpin != $tpin){
      echo json_encode(array("response_code"=>  400 , "responseReason" => "Error", "message" => "Your Tpin is wrong. Please try again later. 3 Unsuccessfull attemps will temporarily block your account."));
      exit;
    }
}


if($send_amount < 100){
      echo json_encode(array("response_code"=>  400 , "responseReason" => "Error", "message" => "Amount should be atleast 100"));
      exit;
}

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
                 $refrence =  date("Ymdgis").substr(str_shuffle("123457890QWERTYUIOPASDFGHJKLZXCVBNMasdfghjklqwertyuiopzxcvbnm") , 0 , 8);
                $snd = 5000;
                if($send_amount > 5000){
                    $am = $send_amount-$snd;
                }
                else{
                    $snd = $send_amount;
                }
                $insert_report = "INSERT INTO `dmt_transactions`(`USER_ID`, `USER_TYPE`, `MOBILE`, `BENE_ID`, `ACCOUNT`, `TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID`, `COMM_REFID`, `APINAME`)
                VALUES ('$usid','$usertype_id','$mb','$bene_id','$acc','$time','$snd','$txn_type','$refrence' , '$comonRefID', 'PAYSPRINT')";
                $user_bal = $usBal-$snd;
                $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid' and USER_TYPE='$usertype_id'";
                if($con->query($insert_report) && $con->query($deduct_bal) ){
                    $tkn = create_token();
                    $curl = curl_init();
                      $data = json_encode(
                                array(
                                    "mobile"=>"$mb",
                                    "referenceid"=>"$refrence",
                                    "pipe"=>"bank1",
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
                              $st_msg = "Failed";
                          }
                          $con->query("update dmt_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
                          if($rs_code != 1 && $status == 0){
                              $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid' and USER_TYPE='$usertype_id' ");
                          }
                          else if($rs_code == 1){
                              $mySum +=$snd;
                              insert_allreport($usid  ,$refrence , "DMT" , $user['MAIN_BAL']  , $user_bal , $snd , "Debit" , "DMT Transaction");
                               // retailer commission
                                  if($usertype_id == 46){
                                      give_dmt_com($refrence , $usid ,$usertype_id);
                                  }
                          }
                    }
                    else{
                        $gotrsnps = json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
                    }
                
                $send_amount =  $am;
                $usBal = $user_bal;
                
                $resP = json_decode($response)->message;
                $my_message = "$sm Transaction and Amount sent $mySum\n".$resP;
            }
           echo json_encode(array("response_code"=>  1 , "txncount"=>  $sm , "TxnType"=>"111" , "response" => $gotrsnps, "message"=>$my_message));  
        }
        else{
          $insert_report = "INSERT INTO `dmt_transactions`(`USER_ID`, `USER_TYPE`, `MOBILE`, `BENE_ID`, `ACCOUNT`, `TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID` , `COMM_REFID`, `APINAME`)
            VALUES ('$usid','$usertype_id','$mb','$bene_id','$acc','$time','$send_amount','$txn_type','$refrence' , '$comonRefID', 'PAYSPRINT')";
            $user_bal = $user['MAIN_BAL']-$send_amount;
            $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid' and USER_TYPE='$usertype_id'";
            if($con->query($insert_report) && $con->query($deduct_bal) ){
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
                      $st_msg = "Failed";
                  }
                  $con->query("update dmt_transactions set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
                  if($rs_code != 1 || $status == 0){
                      $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid' and USER_TYPE='$usertype_id' ");
                  }
                  else if($rs_code == 1){
                      insert_allreport($usid  ,$refrence , "DMT" , $user['MAIN_BAL']  , $user_bal , $send_amount , "Debit" , "DMT Transaction");
                       // retailer commission
                          if($usertype_id == 46){
                              give_dmt_com($refrence , $usid ,$usertype_id);
                          }
                  }
                  $resP = json_decode($response)->message;
                  $my_message = "1 Transaction\n".$msg;
                 
                echo json_encode(array("response_code"=>$rs_code ,"txncount"=>1 , "TxnType"=>"112" , "response" => json_decode($response , true), "message"=>$my_message));  
                }
            else{
                    echo json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it last ine", "status"=>false));
                }
        }
    }
    else{
        echo json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance.", "status"=>false));
    }
}



// update transaction status
if(isset($_POST['check_dmt_status'])){

$refrence = $_POST['ref_id'];
$curl = curl_init();
$data = json_encode(
            array(
                "referenceid"=>"$refrence",
                )
            );
       $tkn = create_token();
       
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
           $con->query("update dmt_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
        }
}


// resend otp for transaction 
if(isset($_POST['resendRefundOTP'])){
$refrence = $_POST['ref_id'];
$akno = $_POST['akno'];
$curl = curl_init();
$data = json_encode(
            array(
                "referenceid"=> $refrence,
                 "ackno"=> $akno,
                )
            );
       $tkn = create_token();
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
}

// update transaction status
if(isset($_POST['refundDmt'])){
    
$refrence = $_POST['ref_id'];
$akno = $_POST['akno'];
$otp = $_POST['refund_otp'];
$curl = curl_init();

$data = json_encode(
            array(
                "referenceid"=> $refrence,
                 "ackno"=> $akno,
                 "otp"=> $otp
                )
            );
       $tkn = create_token();
       
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
       $con->query("update dmt_transactions set REFUND_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='Refunded' where REFFRENCE_ID='$refrence' ");
      }
    }
}

if(isset($_POST['getbankIfsc'])){
    $bankcode = $_POST['bankcode'];
    $bank = $con->query("select * from paysprint_bank_list where BANKID='$bankcode'")->fetch_assoc();
    echo trim($bank['IFSC_CODE']);
    
}
