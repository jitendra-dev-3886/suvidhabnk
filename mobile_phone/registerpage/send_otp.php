<?php

include("../includes/configuration.php");
include("../includes/main_function.php");
include("../mail/index.php"); 
    
    $companyname = "HRC  MULTI";    
    $subject = "One time Password";
    $companymobile = "+91 700224 69765";
    $companyemail = "support@hrcmulti.in";
    
    
    $mobile = $_POST['mobile'];
    $email = $_POST['email'];
    $otp = mt_rand(99999 , 1000000);
    if($mobile!=""){
        
        $rows = $con->query("select * from user where MOBILE='$mobile' and US_STATUS='Active'")->num_rows;
        if($rows < 1){
        
                // $msg = "Dear $fname $lname,\n Your one time password (OTP) for online registration of $companyname is: $otp.\n Thanks & Regards, \n Team $companyname \n M: $companyemail \n E: $companyemail";
                $msg = "OTP $otp to accessing your Account. Please report unauthorised access to customer care. Do not share your login OTP with anyone. Powered by HRCMULTI";
                $message = urlencode("Dear partner, Rs $otp has been credited to your balance. Thanks");
                // $Mobile_sms = urlencode("Dear $fname $lname, Your one time password (OTP) for online registration of $companyname is: $otp. Thank You, By Team $companyname.");
                
                //  SendMessage($mobile, $message);
                if($email != ""){
                    // SendMail($email,$Email_message);
                    
                        $myArr = array(
                        "status" =>true,
                        "message" =>$otp,
                        "response_code"=>1
                        );
                    echo json_encode($myArr);
                    smtp_mailer($email,$subject,$msg);
                    
                }else{
                    
                        $myArr = array(
                        "status" =>false,
                        "message" =>"Failed",
                        "response_code"=>999
                        );
                    echo json_encode($myArr);
                    
                }
        
        }
        
        else{
            
                        $myArr = array(
                        "status" =>false,
                        "message" =>"Failed",
                        "response_code"=>999
                        );
                    echo json_encode($myArr);
        }
        
    }


?>