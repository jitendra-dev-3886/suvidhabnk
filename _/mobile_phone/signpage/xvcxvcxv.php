<?php

include("../mail/index.php"); 
    
    $companyname = "HRC  MULTI";    
    $subject = "One time Password";
    $companymobile = "+91 700224 69765";
    $companyemail = "support@paytoindia.in";

    if(isset($_POST['mobile']))
    {
        include("../includes/config.php");
        $otp = $_POST['otp'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        
        $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile' AND OTP='$otp'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            $sql = "UPDATE user SET PASSWORD='$password' WHERE MOBILE='$mobile' AND OTP='$otp'";
            if(mysqli_query($con, $sql)){
             
                $myArr = array(
                "status" =>true,
                "message" =>"Password has been reset",
                "response_code"=>1
            );
            echo json_encode($myArr);
            
            $row = mysqli_fetch_array($result);
            $email = $row['EMAIL'];
            $msg = "Dear User, You Password is Successfully Changed. Please report unauthorised access to customer care. Do not share your login credential with anyone. Powered by HRCMULTI";
            //inform that password has been changed
            smtp_mailer($email,$subject,$msg);
            
                
            }else{
                
                $myArr = array(
                "status" =>false,
                "message" =>"Failed due to insufficient data",
                "response_code"=>999
            );
            echo json_encode($myArr);    
                
        }
            $msg = "Dear User, You Password is Successfully Changed. Please report unauthorised access to customer care. Do not share your login credential with anyone. Powered by HRCMULTI";
            //inform that password has been changed
            smtp_mailer($email,$subject,$msg);
            //run mail query here...
            
            
        }
        else
        {
            
            $myArr = array(
                "status" =>false,
                "message" =>"Failed due to insufficient data",
                "response_code"=>999
            );
            echo json_encode($myArr);     
            
            
        }
        
    }
    else{
                $myArr = array(
                "status" =>false,
                "message" =>"Failed due to insufficient data",
                "response_code"=>999
            );
            echo json_encode($myArr);   
    }

?>