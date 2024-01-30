<?php
session_start();

include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
include('payout_function.php');

// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
// check service status
$srst = $con->query("select * from service_status where ID='1'")->fetch_assoc();
if($srst['PAYOUT'] != "ON"){
    echo json_encode(array("status"=>false ,"response_code"=>  403 , "message"=>"This service is temporarily down." ,  "receivableData"=>["status"=>false, "response_code"=>  403 , "message"=>"This service is temporarily down."]));
    exit;
}


if(isset($_POST['getBanks'])){
    
$response  = array();
$op = $con->query("SELECT * FROM `paysprint_bank_list`");

if($op->num_rows > 0)
{
    while($row = $op->fetch_assoc()){
        
         array_push($response,array("bankid"=>$row['BANKID'],"bankname"=>$row['BANK_NAME'],"ifsccode"=>$row['IFSC_CODE'],"pennny"=>$row['pennydrop_0_not_allowed_1_allowed'],"column"=>$row['Column_0_NEFT_1_NEFT_and_IMPS_both'],"logo"=>"abc"));
                                                                        
    }
}
echo json_encode($response);

}



if(isset($_POST['list'])){
    
$merchant_mobile = $user['MOBILE'];
$merchants = $con->query("SELECT * FROM `aeps_merchant` WHERE MOBILE='$merchant_mobile'")->fetch_assoc();
$merchant_code = $merchants['MERCHANTCODE'];
    
 $data = array(
   "merchantid"=>$merchant_code,
  );
  $token = create_token();
  $data_str = json_encode($data , true); 
  $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => $paysprint['URL']."/api/v1/service/payout/payout/list",
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

}



// payout verify account from mobile.
if(isset($_POST['verification'])){
    $row_id = $_POST['row_id'];
    $bene_id = $_POST['bene_id']; 
    $doctype= $_POST['doc_type'];
    $pan = $_POST['pan'];
    $aback = $_POST['back_aadhaar'];
    $afront = $_POST['front_aadhaar'];
    $passbook = $_POST['passbook'];
    

    $path = '../../../assets/images/payoutVerify/';
    //upload passbook and convert it into base 64 format.
    
    $passName = uploadImage($passbook);
    
    if($doctype == "PAN"){
    $panName = uploadImage($pan);
          
    $psspath = realpath("../../../assets/images/payoutVerify/".$passName);
    $panPath = realpath("../../../assets/images/payoutVerify/".$panName);
    
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

        $psspath = realpath("../../../assets/images/payoutVerify/".$passName);
        $adhFpth  = "../../../assets/images/payoutVerify/".$afrontName;
        $adhbpth = "../../../assets/images/payoutVerify/".$abackName;
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
  exit;
    
}


if(isset($_POST['Name'])){
    $bankid = $_POST['bankName'];
    $acc = $_POST['acc'];
    $ifsc = $_POST['ifsc'];
    // $amount = $_POST['amount'];
    $name = $_POST['Name'];
     $aepsuser = $con->query("select * from aeps_merchant where MOBILE='".$user['MOBILE']."' and STATUS='1' ")->fetch_assoc();
     
    $merchant_code = $aepsuser['MERCHANTCODE'];
        $data = array(
       "bankid"=>$bankid,
       "merchant_code"=>$merchant_code,
       "account"=>$acc,
       "ifsc"=>$ifsc,
       "name"=>$name,
       "account_type"=>"PRIMARY",
      );
      $token = create_token();
      $data_str = json_encode($data , true); 
    //   echo $data_str;
    //   exit;
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
        if($response == ""){
                    echo json_encode(array("response_code"=>  505 , "message"=>"Server error."));
        }
    $rslt = json_decode($response , true);
    $rs_code = $rslt['response_code'];
    $bndid = $rslt['bene_id'];
    
    if($rs_code == 1 || $rs_code == 2){
        $con->query("INSERT INTO `payout_users`(`NAME`, `ACCOUNT`, `IFSC`, `SEND_DATA`, `RESPONSE`,`STATUS`, `US_ID` , `BENEID` ) 
        VALUES ('$name','$acc','$ifsc','$data_str','".str_replace("'" , "\'" ,$response)."','Unverified','$usid' , '$bndid' )");
    }
    
}


// payout verify acount. for website
if(isset($_POST['doctype'])){
    $doctype= $_POST['doctype'];
    $accid= $_POST['accID'];
    $pan = $_FILES['pan'];
    $aback = $_FILES['aback'];
    $afront = $_FILES['afront'];
    $passbook = $_FILES['passbook'];
    $passbook_ex = pathinfo($passbook['name'], PATHINFO_EXTENSION);
    $pan_ex = pathinfo($pan['name'], PATHINFO_EXTENSION);
    $afront_ex = pathinfo($afront['name'], PATHINFO_EXTENSION);
    $aback_ex = pathinfo($aback['name'], PATHINFO_EXTENSION);
    $valid_img = ['jpg' , 'jpeg', 'png'];
    $path = '../../../assets/images/payoutVerify/';
    
    //check Passbook validation
    if(!in_array($passbook_ex , $valid_img)){
        echo json_encode(['response_code'=>400 , 'message'=>'Passbook image must be jpg, jpeg or png']);
        exit;
    }
    //upload passbook and convert it into base 64 format.
    move_uploaded_file($passbook['tmp_name'] , $path.$passbook['name']);
    
    // $passImgData = file_get_contents($path.$passbook['name']);
    // $pass_base64 = 'data:image/' . $passbook_ex . ';name=' . $passbook['name'] . ';base64,' . base64_encode($passImgData);
    
//     // get payout user details
//   $payoutUser = $con->query("select * from payout_users where US_ID='$usid'");
//   $usData = $payoutUser->fetch_assoc();
//   $response = json_decode($usData['RESPONSE'],true);
   
   
    if($doctype == "PAN"){
        //check pan validation
          if(!in_array($pan_ex , $valid_img)){
                echo json_encode(['response_code'=>400 , 'message'=>'Pan image must be jpg, jpeg or png']);
                exit;
            }
            //upload pan img and convert it into base 64
          move_uploaded_file($pan['tmp_name'] , $path.$pan['name']);
          
        // $panImgData = file_get_contents($path.$pan['name']);
        // $pan_base64 = 'data:image/' . $pan_ex . ';name=' . $pan['name'] . ';base64,' . base64_encode($panImgData);
    $psspath = realpath("../../../assets/images/payoutVerify/".$passbook['name']);
    $panPath = realpath("../../../assets/images/payoutVerify/".$pan['name']);
    
        $data = array(
       "bene_id"=>$accid,
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
          move_uploaded_file($afront['tmp_name'] , $path.$afront['name']);
          move_uploaded_file($aback['tmp_name'] , $path.$aback['name']);
        
        // $afImgData = file_get_contents($path.$afront['name']);
        // $abImgData = file_get_contents($path.$aback['name']);
        // $af_base64 = 'data:image/' . $afront_ex . ';name=' . $afront['name'] . ';base64,' . base64_encode($afImgData);
        // $ab_base64 = 'data:image/' . $aback_ex . ';name=' . $aback['name'] . ';base64,' . base64_encode($abImgData);
        $psspath = realpath("../../../assets/images/payoutVerify/".$passbook['name']);
        $adhFpth  = "../../../assets/images/payoutVerify/".$afront['name'];
        $adhbpth = "../../../assets/images/payoutVerify/".$aback['name'];
         $data = array(
       "bene_id"=>$accid,
       "doctype"=>"AADHAAR",
       "passbook"=>new CURLFILE($psspath),
       "front_image"=>new CURLFILE($adhFpth),
       "back_image"=>new CURLFILE($adhbpth),
       );
    }
    
    // print_r($data);
    // exit;
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
       $con->query("update `payout_users` set STATUS='Verified' where US_ID='$usid' and BENEID='$accid' ");
    }
    else if($rs_code == 2){
       $con->query("update `payout_users` set STATUS='Process' where US_ID='$usid'  and BENEID='$accid' ");
    }
  $con->query("update payout_users set VERIFY_RESPONSE='".str_replace("'" , "\'" , $response)."' where US_ID='$usid'  and BENEID='$accid' ");
    
    
}


// payout Transactiono acount.
if(isset($_POST['amount'])){
    $amount= $_POST['amount'];
    $mode= $_POST['mode'];
    $acc= $_POST['Account'];
    $ifsc= $_POST['IFSC'];
    
    $accid= $_POST['accID'];
    //verify the otp 
    $verify = strip_tags($_POST['verify']);
    $otp = strip_tags($_POST['otp']);

// if($otp == ""){
    
//     $err = ["response_code"=>3, "message"=>"OTP Not matched", "status"=>false];
//     echo json_encode($err);
//     exit;
// }

// if($verify == ""){
    
//     $err = ["response_code"=>3, "message"=>"Verification failed", "status"=>false];
//     echo json_encode($err);
//     exit;
// }


// if($otp != decrypt_token($verify)){
    
//     $err = ["response_code"=>3, "message"=>"OTP Not matched ", "status"=>false];
//     echo json_encode($err);
//     exit;
// }


    // get payout user details
  $bene_id = $accid;
   
    $refrence =  "YSPY".$usid."PYT".date("ds").mt_rand(999 , 9999);
   
   $data = array(
       "bene_id"=> $bene_id,
       "mode"=>$mode,
       "refid"=> $refrence,
       "amount"=> $amount,
      );
      
      $token = create_token();
      //send data
      $data_str = json_encode($data , true); 
    //   echo $data_str;
    //   exit();
$insert_report = "INSERT INTO `payout_transaction`(`USER_ID`, `BENE_ID`, `ACCOUNT` , `TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID` ,`FILTER_DATE`)
VALUES ('$usid','$bene_id', '$acc' , '".date("Y-m-d g:i:s A")."','$amount','$mode','$refrence' , '".date("Y-m-d")."')";
$user_bal = $user['AEPS_BAL']-$amount;

if($user_bal >= 0){
        $deduct_bal = "update user set AEPS_BAL='$user_bal' where ID='$usid'";
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
            if($rs_code == 1){
            $st_msg = "Success,".$rslt->message;
              $con->query("update payout_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
              insert_allreport($usid  ,$refrence , "PAYOUT" , $user['AEPS_BAL']  , $user_bal , $amount , "Debit" , "PAYOUT Transaction");
                     give_payout_com($refrence , $usid ,$usertype_id);
            }
            else{
              $st_msg = "Failed,".$rslt->message;
              $con->query("update user set AEPS_BAL='".$user['AEPS_BAL']."' where ID='$usid' and USER_TYPE='$usertype_id'");
              $con->query("update payout_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
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



// check Transactiono statasu.
if(isset($_POST['check_status'])){
    $ack= $_POST['ack_no'];
    $refrence = $_POST['ref_id'];
    
   $data = array(
       
       "refid"=>$refrence,
       "ackno"=> $ack,
       
      );
      
      $token = create_token();
      //send data
      $data_str = json_encode($data , true); 
    //   echo $data_str;
    //   exit;
              $curl = curl_init();
                        curl_setopt_array($curl, [
                          CURLOPT_URL => $paysprint['URL']."/api/v1/service/payout/payout/status",
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
            if($rs_code == 1){
            $st_msg = "Success,".$rslt->message;
              $con->query("update payout_transaction set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
            //   insert_allreport($usid  ,$refrence , "PAYOUT" , $user['AEPS_BAL']  , $user_bal , $send_amount , "Debit" , "PAYOUT Transaction");
            }
            else{
              $st_msg = "Failed,".$rslt->message;
              $con->query("update payout_transaction set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
            }
    
}

// send otp for transaction 
/*if(isset($_POST['sendotp'])){
    extract($_POST);
    if($send_am == ""){
        $err = ["response_code"=>3, "message"=>"Amount cannot be empty", "status"=>false];
        echo json_encode($err);
        exit;
    }
      if($_POST['otpSendTime'] > 3){
        
        $receivableData = ["response_code"=>500 , "smsotpst" => "OTP Send Limit exceeds. Please try again after some time."];
        echo json_encode($receivableData);
        exit;
    }
    
    $usmb = $user['MOBILE'];
    $email = $user['EMAIL'];
    
    $otp = mt_rand(999 , 9999);
	$message =urlencode("Do not share your login OTP with anyone.$otp OTP to accessing your Account. Please report unauthorised access to customer care. Powered by ARO TRADING & FINANCIAL CONSULTING");
	$emag ="Do not share your login OTP with anyone.$otp OTP to accessing your Account. Please report unauthorised access to customer care. Powered by ARO TRADING & FINANCIAL CONSULTING";
  SendEMail($email,$emag , "Transaction OTP");
  $smsrs = json_decode(smscall($usmb, $message) , true);
  echo  json_encode(["response_code"=> 1, "smsotpst"=> "Success" , "OTPHASH"=>encrypt_token($otp) ]);
  
}




function smscall($mobile,$message){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => "http://sms.bulksmsind.in/v2/sendSMS?username=aropay&message=$message&sendername=AROCSP&smstype=TRANS&numbers=$mobile&apikey=e0b04669-e4f2-4d36-ae5c-a3adf5c61427&peid=1201160075655012053&templateid=1007164023804988435",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
));

$response = curl_exec($curl);
// echo $response;
curl_close($curl);
}


// mail funtion
function SendEMail($email,$message){

$subject = "Password Details";

// mail id to be changed to server mail id
$headers = 'From: info@ethhub.in' . "\r\n" .
  'Reply-To:  info@ethhub.in' . "\r\n" .
  'X-Mailer: PHP/' . phpversion();

// Send the email
if ($error == FALSE) {
    // print_r(mail($email, $subject, $message, $headers));
  if(mail($email, $subject, $message, $headers)) {
    // echo "<script> alert('The email was sent.')</script>";
    
    }
    else {
    echo "<script> alert('The email fail to sent.')</script>";
    $error = TRUE;
    }
}
*/

function uploadImage($imageString){
    $InsertProfilePath = "../../../assets/images/payoutVerify/";
    $data = base64_decode($imageString);
    // $extension = explode('/', getMIMETYPE($imageString))[1];
    $extension = "png";
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