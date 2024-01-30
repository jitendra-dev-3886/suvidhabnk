<?php
    $json = file_get_contents('php://input');
    // Converts it into a PHP object
    $data = json_decode($json);
    if($data!=null || $data!=""){
        $email =  $data->information->email;
        $mobile =  $data->information->mobile;
        $event = $data->event;
        if($event == "areAllCredentialsFine" && $email!="" && $mobile!=""){
            include("../includes/configuration.php");
            include("../../Agent/Backend/Functions/all_function.php");
            
            $Mrows = $con->query("select * from user where MOBILE='$mobile' ")->num_rows;
            $Erows = $con->query("select * from user where EMAIL='$email' ")->num_rows;
            
            if($Mrows > 0){
                echo json_encode(["message"=>"Mobile Already Exists", "response_code"=>2, "status"=>false]);
            }
            else if($Erows > 0){
                echo json_encode(["message"=>"Email Already Exists", "response_code"=>3, "status"=>false]);
            }
            else{
                $email_otp = mt_rand(99999 , 1000000);
                $mobile_otp = mt_rand(99999 , 1000000);
                $query = "INSERT INTO `temp_otp`(`MOBILE`, `EMAIL`, `MOBILE_OTP`, `EMAIL_OTP`) VALUES ('$mobile', '$email', '$mobile_otp', '$email_otp')";
                $run_query = mysqli_query($con , $query);
                
                
                $sub = "OTP for Registration";
                 $mbmsg = urlencode("$mobile_otp is your OTP for Login. Do not share your OTP with anyone. PayDeer or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds. Team Paydeer");
                $e_smg  = "Dear user your otp for Registration is : $email_otp";
                
                echo json_encode(["message"=>"OTP has been sent to the credentials..", "response_code"=>1, "status"=>true]);
                sendSMS($mobile, $mbmsg , 1307164568458158148);
                SendMail($email,$e_smg , $sub);
                exit;
            }
            
        }
        else{
            echo json_encode(["message"=>"Bad Response", "response_code"=>300, "status"=>false]);
        }
    }
    
?>