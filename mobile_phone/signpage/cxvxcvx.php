<?php
    
    include("../includes/config.php");
    include("../mail/index.php"); 
    
    $companyname = "HRC  MULTI";    
    $subject = "One time Password";
    $companymobile = "+91 700224 69765";
    $companyemail = "support@paytoindia.in";
    
    
        if(isset($_POST['mobile'])){
        $mobile = $_POST['mobile'];
        $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
        
            $row = mysqli_fetch_array($result);
            
            $email = $row['EMAIL'];
            $otp = generateRandomString(6);
            $msg = "OTP $otp to Reset Password of your Account. Please report unauthorised access to customer care.Do not share your login OTP with anyone. Powered by HRCMULTI";
            // $msg = "Dear User, your OTP is: $otp. for reset password.";
            
            $sql = "UPDATE user SET OTP='$otp' WHERE MOBILE='$mobile'";
            mysqli_query($con, $sql);
            
        
            
                $myArr = array(
                "status" =>true,
                "message" =>$otp,
                "response_code"=>1
            );
            echo json_encode($myArr);
             smtp_mailer($email,$subject,$msg);
            //run mail query here...
            
            
        }else{
            
            $myArr = array(
                "status" =>false,
                "message" =>"User Not Found",
                "response_code"=>999
            );
            echo json_encode($myArr);     
            
            
        }
        
    
        }else{
            
            $myArr = array(
                "status" =>false,
                "message" =>"User Not Found",
                "response_code"=>999
            );
            echo json_encode($myArr);   
            
        }

    function generateRandomString($length) {
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
        return $randomString;
    }

?>