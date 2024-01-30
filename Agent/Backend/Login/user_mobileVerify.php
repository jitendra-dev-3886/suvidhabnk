<?php
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../../../test_api/msg91api.php");
// include("../Auth/userdata.php");
include("function.php");
// error_reporting(E_ALL);
// ini_set("display_errors",1);

// Verification Mobile otp

if(isset($_POST["action"]) && $_POST["action"] == 1){
    
    $otp = mt_rand(100000,999999);
    $number = $_POST["mobile_number"];
    $encryptotp = hash("sha512",$otp);
   
 $mobile=$number;
 $user_fetch = $con->query("SELECT * FROM user WHERE MOBILE='$number' ORDER BY ID DESC LIMIT 1")->fetch_assoc();
 $mobile_user = $user_fetch['MOBILE'];
 if($mobile_user == $mobile){
     echo json_encode(array("response_code"=>2,"status"=>false));
     exit;
 }else{
      $response = sendSMS91($mobile,$otp);
      echo json_encode(array("response_code"=>1,"status"=>true, "otp"=>$encryptotp, "response"=>json_decode($response, true)));
      exit;
 }

}
//verify sms otp
if(isset($_POST["action"]) && $_POST["action"] == 2){

$cmpinotp = hash("sha512",$_POST["cmotp"]);
$userotp = $_POST["userotp"];

if($cmpinotp == $userotp){
    echo json_encode(array("response_code"=>1, "message"=>"Mobile Number Verified Successfully", "status"=>true));
  }
  else{
       echo json_encode(array("response_code"=>3, "message"=>"Incorret OTP", "status"=>false));
  }
  
}
?>