<?php
session_start();

// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../../../Db/config.php");
include("../Functions/all_function.php");



if(isset($_POST["pageid"]) && $_POST["pageid"] == 1){
    
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
    $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true , "otp" => $otp,"number"=>$number]; 
    
  }
  else{
      $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false];   
  }
  
}else{
    $err = ["response_code"=>4, "message"=>"User Not Exist!", "status"=>false];
}

 echo json_encode($err);

}


if(isset($_POST["pageid"]) && $_POST["pageid"] == 2){


$otp = $_POST["uotp"];
$smsotp = $_POST["sotp"];

if($smsotp == $otp){
    $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true]; 
   
  }
  else{
      $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false];   
  }
  
  echo json_encode($err);

}


if(isset($_POST["pageid"]) && $_POST["pageid"] == 3){
    
    $user_num = $_POST["usernum"];
    $newpass = $_POST["npass"];
    
    $changepass = $con->query("UPDATE user SET PASSWORD='$newpass' WHERE MOBILE = '$user_num'");
    
    if($changepass){
       $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true];
        
    }else{
       $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false]; 
    }
    
     echo json_encode($err);
}












?>