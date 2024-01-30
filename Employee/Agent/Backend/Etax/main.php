<?php
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");


if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
  
    $mobile = $_POST["mobile"];
    $otp = mt_rand(100000,999999);
    $msg = urlencode("$otp is your OTP for $type. Do not share your OTP with anyone. PAYDEER or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds Team PAYDEER");
    $otpHash = encrypt_token($otp);
    if(sendSMS($mobile, $msg , 1307164568607363585)){
        echo json_encode(["status"=>true, "response_code"=>1, "message"=>"OTP Sent Successfully..!","otp"=>$otpHash]);
        exit;
    }else{
         echo json_encode(["status"=>false, "response_code"=>3, "message"=>"OTP Sent Unsuccessfull..!"]);
        exit;
    }
    
}
    
    
if(isset($_POST['applyEtax'])){
    
    
    $hash = $_POST['otphash'];
    $otp = $_POST['otp'];
    if(!decrypt_token($hash)==$otp){
        echo json_encode(["status"=>false, "response_code"=>430, "message"=>"Invalid OTP ! Please Enter Correct OTP."]);
        exit; 
    }
        
    $refrence =  "PDRET".date("Ymd").mt_rand(999 , 9999);
     $name = $_POST['name'];
        $mobile = $_POST['mobile'];
        $type = $_POST['type'];
    
        $cuser = $con->query("SELECT * FROM `user` WHERE ID = '$usid'")->fetch_assoc();
        $charge = $con->query("SELECT * FROM `etax_commission` WHERE SERVICE='$type'")->fetch_assoc();
        $chargeamt = $charge["CHARGE"];
       
    $user_bal = $user['MAIN_BAL']-$chargeamt;
    if($user_bal >= 0){
        
    $insert_report = "INSERT INTO `etax`(`USER_ID` , `REFERENCE_ID` , `NAME` , `MOBILE`, `TYPE` ,`STATUS`) VALUES ('$usid' , '$refrence' , '$name', '$mobile', '$type', 'in Progress')";
     $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid'";
    
      if($con->query($insert_report) && $con->query($deduct_bal) ){
            
        $con->query("update etax set STATUS='Pending' where REFERENCE_ID='$refrence' ");
        
        insert_allreport($usid  ,$refrence , "ETAX $type" , $user['MAIN_BAL']  , $user_bal , $chargeamt , "Debit" , "ETAX Transaction" , "MAIN");
        $inf = json_encode(["status"=>true, "response_code"=>1, "message"=>"Applied Successfully"]);
        
        echo $inf;
        exit;
            
      }
      else{
        
        echo json_encode(["status"=>false, "response_code"=>430, "message"=>"Something went wrong, we are fixing it."]);
        exit; 
      }
    
    
        
    }
    else{
        echo json_encode(["status"=>false, "response_code"=>12, "message"=>"Insuficient Balance to make this transaction."]);
        exit;
    }


}


?>