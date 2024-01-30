<?php
session_start();

// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../../../Db/config.php");
include("../Functions/all_function.php");

      $_SESSION["token_id"] = $token_id;
      $usid = $_SESSION['UsId'];
      $otp = mt_rand(100000,999999);

//create mpin code

if(isset($_POST["pid"]) && $_POST["pid"] == 1){
    
    $id = $_POST["id"];
    $fetchuser = $con->query("SELECT * FROM user WHERE ID = '$usid'")->fetch_assoc();
    if(!empty($fetchuser)){
    $email = $fetchuser["EMAIL"];
    $number = $fetchuser["MOBILE"];
    $username = $fetchuser["FIRST_NAME"].' '.$fetchuser["LAST_NAME"];
    $encryptotp = hash("sha512",$otp);
    $msg = urlencode("$username is your OTP for $otp. Do not share your OTP with anyone. PAYDEER or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds Team PAYDEER");
    $emsg = "$username is your OTP for $otp. Do not share your OTP with anyone. PAYDEER or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds Team PAYDEER";
   

 SendMail($email,$emsg , "Create mPIN OTP");
  $smsrs = json_decode(sendSMS($number, $msg , 1307164568607363585) , true);
  
  if($smsrs['ErrorMessage']=="Success"){
    $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true, "otp"=>$otp]; 
    
  }
  else{
      $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false];   
  }
  
}else{
    $err = ["response_code"=>4, "message"=>"User Not Exist!", "status"=>false];
}

 echo json_encode($err);

}


if(isset($_POST["pid"]) && $_POST["pid"] == 2){


$totp = $_POST["tpinotp"];
$smsotp = $_POST["ajaxotp"];

if($totp == $smsotp){
    $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true]; 
   
  }
  else{
      $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false];   
  }
  
  echo json_encode($err);

}


if(isset($_POST["pid"]) && $_POST["pid"] == 3){
    
    $tpin = $_POST["utpin"];
    $ctpin = $_POST["uctpin"];
    
    $creatempin = $con->query("INSERT INTO `tpin`(`USER_ID`, `TPIN`, `STATUS`) VALUES ('$usid','$tpin','active')");
    
    if($creatempin){
       $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true];
        
    }else{
       $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false]; 
    }
    
     echo json_encode($err);
}


//change mpin code

if(isset($_POST["pid"]) && $_POST["pid"] == 4){
    
    $id = $_POST["id"];
    $fetchuser = $con->query("SELECT * FROM user WHERE ID = '$usid'")->fetch_assoc();
    if(!empty($fetchuser)){
    $email = $fetchuser["EMAIL"];
    $number = $fetchuser["MOBILE"];
    $username = $fetchuser["FIRST_NAME"].' '.$fetchuser["LAST_NAME"];
    $encryptotp = hash("sha512",$otp);
    $msg = urlencode("$username is your OTP for $otp. Do not share your OTP with anyone. PAYDEER or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds Team PAYDEER");
    $emsg = "$username is your OTP for $otp. Do not share your OTP with anyone. PAYDEER or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds Team PAYDEER";
   

 SendMail($email,$emsg , "Change mPIN OTP");
  $smsrs = json_decode(sendSMS($number, $msg , 1307164568607363585) , true);
  
  if($smsrs['ErrorMessage']=="Success"){
    $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true, "otp"=>$otp]; 
    
  }
  else{
      $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false];   
  }
  
}else{
    $err = ["response_code"=>4, "message"=>"User Not Exist!", "status"=>false];
}

 echo json_encode($err);

}


if(isset($_POST["pid"]) && $_POST["pid"] == 5){


$cmpinotp = $_POST["cmotp"];
$userotp = $_POST["userotp"];

if($cmpinotp == $userotp){
    $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true]; 
   
  }
  else{
      $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false];   
  }
  
  echo json_encode($err);

}


if(isset($_POST["pid"]) && $_POST["pid"] == 6){
    
    $cmpin = $_POST["crrntmin"];
    $nmpin = $_POST["newmpin"];
    
    $changempin = $con->query("UPDATE tpin SET TPIN='$nmpin' WHERE TPIN = '$cmpin' AND USER_ID = '$usid'");
    
    if($changempin){
       $err = ["response_code"=>1, "message"=>"Response Recieved", "status"=>true];
        
    }else{
       $err = ["response_code"=>3, "message"=>"Bad Response", "status"=>false]; 
    }
    
     echo json_encode($err);
}





?>

