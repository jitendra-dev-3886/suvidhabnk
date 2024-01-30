<?php
    $json = file_get_contents('php://input');
    // Converts it into a PHP object
    $data = json_decode($json);
    if($data!=null || $data!=""){
        $email =  $data->information->email;
        $mobile =  $data->information->mobile;
        $event = $data->event;
        if($event != "" && $email!="" && $mobile!=""){
            include("../includes/configuration.php");
            include("../../Agent/Backend/Functions/all_function.php");
            
            $Mrows = $con->query("select * from user where MOBILE='$mobile' and US_STATUS='Active'")->num_rows;
            $Erows = $con->query("select * from user where EMAIL='$email' and US_STATUS='Active'")->num_rows;
            
            if($Mrows > 0){
                echo json_encode(["message"=>"Mobile Already Exists", "response_code"=>2, "status"=>false]);
            }
            else if($Erows > 0){
                echo json_encode(["message"=>"Email Already Exists", "response_code"=>3, "status"=>false]);
            }
            else{
                
                
                $timeStamp = date('Y-m-d H:i', time());
                
                if($event == "resendMobileOTP"){
                    
                    $mobile_otp = mt_rand(99999 , 1000000);
                    
                    $sql = "UPDATE temp_otp SET `MOBILE_OTP`='$mobile_otp',`TIME`='$timeStamp' WHERE MOBILE='$mobile' AND EMAIL ='$email' ORDER BY ID DESC LIMIT 1";
                    $run_query = mysqli_query($con , $sql);
                    echo json_encode(["message"=>"OTP has been sent to the credentials..", "response_code"=>1, "status"=>true]);
                    sendSMS($mobile, $mbmsg , 1307164568458158148);
                    exit;
                }
                
                if($event == "resendEmailOTP"){
            
                    $email_otp = mt_rand(99999 , 1000000);
                    $sql = "UPDATE temp_otp SET `EMAIL_OTP`='$email_otp',`TIME`='$timeStamp' WHERE MOBILE='$mobile' AND EMAIL ='$email' ORDER BY ID DESC LIMIT 1";
                    $run_query = mysqli_query($con , $sql);
                    $sub = "OTP for Registration";
                    $mbmsg = urlencode("$mobile_otp is your OTP for Login. Do not share your OTP with anyone. PayDeer or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds. Team Paydeer");
                    $e_smg  = "Dear user your otp for Registration is : $email_otp";
                    SendMail($email,$e_smg , $sub);
                    echo json_encode(["message"=>"OTP has been sent to the credentials..", "response_code"=>1, "status"=>true]);
                    exit;
            
                }
                
            
            }
            
        }
        else{
            echo json_encode(["message"=>"Bad Response", "response_code"=>300, "status"=>false]);
        }
    }
    
?>