<?php
session_start();

// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../../../Db/config.php");
include("../Functions/all_function.php");
include("../../../test_api/whatsapp_api.php");
include("../../../test_api/msg91api.php");
include("../../handler/mail/index.php");

 $uid = $_SESSION["UsId"];

if(isset($_POST["pid"]) && $_POST["pid"] == 1){
    
    $fetchuser = $con->query("SELECT * FROM user WHERE ID = '$uid'")->fetch_assoc();
    
    $number = $fetchuser["MOBILE"];
    $email_id = $fetchuser["EMAIL"];
    $reciver="91$number";
    $mobile=$number;
    // echo $reciver;
    $username = $fetchuser["FIRST_NAME"].' '.$fetchuser["LAST_NAME"];
    $otp = mt_rand(100000,999999);
    // $msg = urlencode("$otp is your OTP for Change Password. Do not share your OTP with anyone. PayDeer or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds. Team Paydeer");
    // $emsg = "$otp is your OTP for Change Password. Do not share your OTP with anyone. PayDeer or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds. Team Paydeer";
   $msg="Your OTP for Suvidha BANKio is $otp. Never share your OTP or account details with anyone.Regard Suvidha BANKio Team";
   $wp_otp=pass_otp_msg($reciver,$msg);
   
   $to="$email_id";
   $subject="Change Password OTP";
   
   smtp_mailer($to,$subject, $msg);
   whatsapp_msg($reciver,$msg);
   
   send_pass_profile($mobile,$otp);

  $smsrs = json_decode(sendSMS($number, $msg , 1307164568607363585) , true);
  
//   if($smsrs['ErrorMessage']=="Success" or $wp_otp){
  if(1==1){
      $con->query("UPDATE user SET OTP = '$otp' WHERE ID = '$uid'");
    $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true]; 
    
  }
  else{
      $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false];   
  }

 $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true]; 
  

 echo json_encode($err);

}


if(isset($_POST["pid"]) && $_POST["pid"] == 2){
    
    $aotp = $_POST["uotp"];
    
    $fetchotp = $con->query("SELECT * FROM user WHERE ID = '$uid'")->fetch_assoc();
    $userotp = $fetchotp["OTP"];
    
  
  if($aotp == $userotp){
    $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true]; 
    
  }
  else{
      $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false];   
  }
  

 echo json_encode($err);

}




if(isset($_POST["pid"]) && $_POST["pid"] == 3){
    
    $cpass = $_POST["crrntpass"];
    $npass = $_POST["newpass"];
    
    $usercheck = $con->query("SELECT * FROM user WHERE PASSWORD = '$cpass' AND ID = '$uid'")->fetch_assoc();
     
    
  
  if(!empty($usercheck)){
    $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true]; 
    $con->query("UPDATE user SET PASSWORD = '$npass' WHERE PASSWORD = '$cpass' AND ID = '$uid'");
  }
  else{
      $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false];   
  }
  

 echo json_encode($err);

}








?>