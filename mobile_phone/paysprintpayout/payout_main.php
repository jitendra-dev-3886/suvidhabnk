<?php

$id = $_POST['user_id'];
$token_id = $_POST['token'];
$ip = $_POST['ip'];
$device = $_POST['device'];
include("../includes/config.php");
include("../includes/fetch_data.php");
include("payout_function.php");



$mysql_qry = "select * FROM user WHERE ID ='$id' AND TOKEN_ID = '$token_id'";
$result = mysqli_query($con ,$mysql_qry);
if(mysqli_num_rows($result) > 0) {
    
}else{
    
    $rs = json_encode(array("statuscode"=>  999 ,"responsecode"=>  999 , "message"=>"Session Expired", "response_code"=>999, "status"=>false));
    echo $rs;
    return;
}


if(isset($_POST['list']))
{
    
    
    $response  = array();
    $op = $con->query("SELECT * FROM `payout_users` WHERE US_ID='$id' ORDER BY ID DESC");
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
            
            $res = json_decode($row['RESPONSE']);
            $send = json_decode($row['SEND_DATA']);
            $bene_id = $res->bene_id;
            $merchantcode = $send->merchantcode;
            $account = $send->account;
            $ifsc = $send->ifsc;
            $name = $send->name;
            $account_type = $send->account_type;
            $status = strtolower($row['STATUS']);
             array_push($response,array("id"=>$row['ID'],"beneid"=>strval($bene_id),"bankname"=>$row['BANK_NAME'],"merchantcode"=>$merchantcode,"account"=>$account,"ifsc"=>$ifsc,"name"=>$name,"account_type"=>$account_type,"status"=>$status));
        }
        
        $details = json_encode($response);
        
    $rs = json_encode(array("statuscode"=>  1 ,"responsecode"=>  1 , "message"=>"Payout Users fetched", "response_code"=>1, "status"=>true, "data"=>$response));
    echo $rs;
        
    }
    else{
        $rs = json_encode(array("statuscode"=>  101 ,"responsecode"=>  101 , "message"=>"No Record", "response_code"=>101, "status"=>true, "data"=>$response));
        echo $rs;
    }
}

if(isset($_POST['add_acc']))
{
 
$bank_name = $_POST['bank_name'];    
$bankid = $_POST['bank_id'];
$account =  $_POST['acc'];
$ifsc = $_POST['ifsc'];
$name = $_POST['name'];    


$merchant_mobile = $user['MOBILE'];
$merchants = $con->query("SELECT * FROM `aeps_merchant` WHERE MOBILE='$merchant_mobile'")->fetch_assoc();
$merchant_code = $merchants['MERCHANTCODE'];

 $data = array(
   "bankid"=>$bankid,
   "merchant_code"=>$merchant_code,
   "account"=>$account,
   "ifsc"=>$ifsc,
   "name"=>$name,
   "account_type"=>"PRIMARY",
  );
  $token = create_token();
  $data_str = json_encode($data , true); 
  $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => $paysprint['URL']."/api/v1/service/payout/payout/add",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>$data_str,
              CURLOPT_HTTPHEADER => [
                  "Accept: application/json",
                "Content-Type: application/json",
                 "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                "Token: ".$token
               ],
            ]);
            
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        echo $response;  
        
        
    $rslt = json_decode($response);
    $rs_code = $rslt->response_code;
    $bene_code = $rslt->bene_id;
        
    if($rs_code == 1 || $rs_code == 2){
        $con->query("INSERT INTO `payout_users`(`NAME`,`BANK_NAME`, `ACCOUNT`, `BENE_ID` , `IFSC`, `SEND_DATA`, `RESPONSE`,`STATUS`, `US_ID`) 
        VALUES ('$name','$bank_name','$acc','$bene_code','$ifsc','$data_str','".str_replace("'" , "\'" ,$response)."','Unverified','$id')");
    }
}


// payout verify acount.
if(isset($_POST['verification'])){
    $row_id = $_POST['row_id'];
    $bene_id = (int)$_POST['bene_id']; 
    $doctype= $_POST['doc_type'];
    $pan = $_POST['pan'];
    $aback = $_POST['back_aadhaar'];
    $afront = $_POST['front_aadhaar'];
    $passbook = $_POST['passbook'];
    
    $passbook_ex = explode('/', getMIMETYPE($passbook))[1];
    $pan_ex = explode('/', getMIMETYPE($pan))[1];
    $afront_ex = explode('/', getMIMETYPE($afront))[1];
    $aback_ex = explode('/', getMIMETYPE($aback))[1];
    
    
    $valid_img = ['jpg' , 'jpeg', 'png'];
    $path = '../../Dashboard/User/assets/images/payoutVerify/';
    
    //check Passbook validation
    if(!in_array($passbook_ex , $valid_img)){
        echo json_encode(['response_code'=>400 , 'message'=>'Passbook image must be jpg, jpeg or png']);
        exit;
    }
    //upload passbook and convert it into base 64 format.
    $passName = uploadImage($passbook);
    
    
   //get payout user details
   $payoutUser = $con->query("select * from payout_users where US_ID='$row_id'");
   $usData = $payoutUser->fetch_assoc();
   $response = json_decode($usData['RESPONSE'],true);
   
   
    if($doctype == "PAN"){
        //check pan validation
          if(!in_array($pan_ex , $valid_img)){
                echo json_encode(['response_code'=>400 , 'message'=>'Pan image must be jpg, jpeg or png']);
                exit;
            }
            //upload pan img and convert it into base 64
          
          $panName = uploadImage($pan);
          
    $psspath = realpath("../../Dashboard/User/assets/images/payoutVerify/".$passName);
    $panPath = realpath("../../Dashboard/User/assets/images/payoutVerify/".$panName);
    
        $data = array(
       "bene_id"=>$bene_id,
       "doctype"=>"PAN",
       "passbook"=>new CURLFILE($psspath),
       "panimage"=>new CURLFILE($panPath),
      );
      
    }
    else{
        //check aadhaar validation 
         if(!in_array($afront_ex , $valid_img)){
                echo json_encode(['response_code'=>400 , 'message'=>'Aadhaar Front image must be jpg, jpeg or png']);
                exit;
        }
         if(!in_array($aback_ex , $valid_img)){
            echo json_encode(['response_code'=>400 , 'message'=>'Aadhaar Back image must be jpg, jpeg or png']);
            exit;
        }
        //upload adhaar imgs and convert them into base 64;
        $afrontName = uploadImage($afront);
        $abackName = uploadImage($aback);

        $psspath = realpath("../../Dashboard/User/assets/images/payoutVerify/".$passName);
        $adhFpth  = "../../Dashboard/User/assets/images/payoutVerify/".$afrontName;
        $adhbpth = "../../Dashboard/User/assets/images/payoutVerify/".$abackName;
         $data = array(
       "bene_id"=>$bene_id,
       "doctype"=>"AADHAAR",
       "passbook"=>new CURLFILE($psspath),
       "front_image"=>new CURLFILE($adhFpth),
       "back_image"=>new CURLFILE($adhbpth),
       );
    }
      $token = create_token();
      $curl = curl_init();
                curl_setopt_array($curl, [
                  CURLOPT_URL => $paysprint['URL']."/api/v1/service/payout/payout/uploaddocument",
                  CURLOPT_RETURNTRANSFER => true,
                  CURLOPT_ENCODING => "",
                  CURLOPT_MAXREDIRS => 10,
                  CURLOPT_TIMEOUT => 30,
                  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                  CURLOPT_CUSTOMREQUEST => "POST",
                  CURLOPT_POSTFIELDS =>$data,
                  CURLOPT_FOLLOWLOCATION => true,
                  
                  CURLOPT_HTTPHEADER => [
                     "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                    "Token: ".$token
                   ],
                ]);
                
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        echo $response;  
    $rslt = json_decode($response);
    $rs_code = $rslt->response_code;
    if($rs_code == 1 &&  $rslt->status == "true"){
       $con->query("update `payout_users` set STATUS='Verified' where ID='$row_id'");
    }
    else if($rs_code == 2){
       $con->query("update `payout_users` set STATUS='Process' where ID='$row_id'");
    }
  $con->query("update payout_users set VERIFY_RESPONSE='".str_replace("'" , "\'" , $response)."' where ID='$row_id'");
    
}

//do transaction 
if(isset($_POST['do_transaction'])){
    
$bene_id = $_POST['bene_id'];
$amount = $_POST['amount'];
$mode = $_POST['mode'];
    
  // get payout user details
   $payoutUser = $con->query("select * from payout_users where US_ID='$id' and BENE_ID='$bene_id'");
   $usData = $payoutUser->fetch_assoc();
   $response = json_decode($usData['RESPONSE'],true);
   
    $refrence =  substr(str_shuffle("123457890QWERTYUIOPASDFGHJKLZXCVBNMasdfghjklqwertyuiopzxcvbnm") , 0 , 10);

   
   $data = array(
       "bene_id"=>$bene_id,
       "mode"=>$mode,
       "refid"=> $refrence,
       "amount"=> $amount,
      );
      
      $token = create_token();
      //send data
      $data_str = json_encode($data , true); 
    //   echo $data_str;
    //   exit();
$insert_report = "INSERT INTO `payout_transaction`(`USER_ID`, `BENE_ID`,`TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID` ,`FILTER_DATE`)
VALUES ('$id','$bene_id','".date("Y-m-d g:i:s A")."','$amount','$mode','$refrence' , '".date("Y-m-d")."')";
$user_bal = $user['AEPS_BAL']-$amount;

if($user_bal >= 0){
        $deduct_bal = "update user set AEPS_BAL='$user_bal' where ID='$id'";
        if($con->query($insert_report) && $con->query($deduct_bal) ){
            // echo "work";
              $curl = curl_init();
                        curl_setopt_array($curl, [
                          CURLOPT_URL => $paysprint['URL']."/api/v1/service/payout/payout/dotransaction",
                          CURLOPT_RETURNTRANSFER => true,
                          CURLOPT_ENCODING => "",
                          CURLOPT_MAXREDIRS => 10,
                          CURLOPT_TIMEOUT => 30,
                          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                          CURLOPT_CUSTOMREQUEST => "POST",
                          CURLOPT_POSTFIELDS =>$data_str,
                          CURLOPT_HTTPHEADER => [
                              "Accept: application/json",
                            "Content-Type: application/json",
                             "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                            "Token: ".$token
                           ],
                        ]);
                        
                $response = curl_exec($curl);
                $err = curl_error($curl);
                curl_close($curl);
                echo $response;
                
            $rslt = json_decode($response);
            $rs_code = $rslt->response_code;
            $st_msg = $rslt->message;
              $con->query("update payout_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
            if($rs_code == 1){
                // fsdfsdf
               insert_allreport($id  ,$refrence , "PAYOUT" , $user['AEPS_BAL']  , $user_bal , $amount , "Debit" , "PAYOUT Transaction", $ip, $device);
               give_payout_com($refrence , $id , $user['USER_TYPE'], $ip, $device);
            }
        }
        else{
            echo json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
        }
    }
    else{
        echo json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
    }
    
}


function uploadImage($imageString){
    $InsertProfilePath = "../../Dashboard/User/assets/images/payoutVerify/";
    $data = base64_decode($imageString);
    $extension = explode('/', getMIMETYPE($imageString))[1];
    $imageName = generateRandomString(12).".".$extension;
    $insertion = $InsertProfilePath.$imageName;
    file_put_contents("$insertion" ,$data);
    return $imageName;
}

function getMIMETYPE($base64string){
    $imgdata = base64_decode($base64string);
    $f = finfo_open();
    $mime_type = finfo_buffer($f, $imgdata, FILEINFO_MIME_TYPE);   
    return $mime_type;
}

function generateRandomString($length) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>