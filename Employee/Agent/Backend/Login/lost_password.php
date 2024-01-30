<?php

include("../../../Db/config.php");
include("../Functions/all_function.php");



if(isset($_POST["pageid"]) && $_POST["pageid"] == 1){
    
    $otp_sent = $_POST['otpSendTime'];
    
    if($otp_sent ==null || $otp_sent =="" || $otp_sent > 3){
        $receivableData = ["rs_code"=>500 , "smsotpst" => "OTP Send Limit exceeds. Please try again after some time."];
        $err = ["response_code"=>500, "message"=>"OTP Send Limit exceeds. Please try again after some time.", "status"=>false, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
    }
    
    
    $number = $_POST["forgotnum"];
    $fetchuser = $con->query("SELECT * FROM user WHERE MOBILE = '$number'")->fetch_assoc();
    if(!empty($fetchuser)){
    $email = $fetchuser["EMAIL"];
    $username = $fetchuser["FIRST_NAME"].' '.$fetchuser["LAST_NAME"];
    $otp = mt_rand(10000,99999);
    $msg = urlencode("$username is your OTP for $otp. Do not share your OTP with anyone. PAYDEER or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds Team PAYDEER");
    $emsg = "$username is your OTP for $otp. Do not share your OTP with anyone. PAYDEER or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds Team PAYDEER";
   

  SendMail($email,$emsg , "Reset Password OTP");
  $smsrs = json_decode(sendSMS($number, $msg , 1307164568607363585) , true);
  
  if($smsrs['ErrorMessage']=="Success"){
      
        $receivableData = ["rs_code"=>1 ,  "smsotpst"=> $smsrs['ErrorMessage'] , "OTPHASH"=>encrypt_token($otp) ];
        $err = ["response_code"=>1, "message"=>"Otp has been sent.", "status"=>true, "receivableData"=>$receivableData];
        echo json_encode($err);
        exit;
  }
  else{
      $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false];   
  }
  
}else{
    $err = ["response_code"=>4, "message"=>"User Not Exist!", "status"=>false];
}
echo json_encode($err);

}




if(isset($_POST["pageid"]) && $_POST["pageid"] == 3){
    
    $user_num = $_POST["usernum"];
    $newpass = $_POST["npass"];
    $otp = $_POST["otp"];
    $hash_code = $_POST["hash_code"];
    
    if($otp == ""){
        $err = ["response_code"=>403, "message"=>"OTP Not matched.", "status"=>false];
        echo json_encode($err);
        exit;
    }

    if($hash_code == ""){
    
        $err = ["response_code"=>403, "message"=>"Verification failed.", "status"=>false];
        echo json_encode($err);
        exit;
    }

    if($otp != decrypt_token($hash_code)){

        $err = ["response_code"=>403, "message"=>"OTP Not matched.", "status"=>false];
        echo json_encode($err);
        exit;
    }

    
    
    $changepass = $con->query("UPDATE user SET PASSWORD='$newpass' WHERE MOBILE = '$user_num'");
    
    if($changepass){
       $err = ["response_code"=>1, "message"=>"Success.", "status"=>true];
        
    }else{
       $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false]; 
    }
    
     echo json_encode($err);
}


?>