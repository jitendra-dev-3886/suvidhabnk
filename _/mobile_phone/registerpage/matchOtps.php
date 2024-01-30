<?php
    
    $json = file_get_contents('php://input');
    // Converts it into a PHP object
    $data = json_decode($json);
    date_default_timezone_set('Asia/Kolkata');
    $current_time = date('Y-m-d H:i', time());

    if($data!=null || $data!=""){
            $email =  $data->information->email;
            $mobile =  $data->information->mobile;
            $email_otp =  $data->information->email_otp;
            $mobile_otp =  $data->information->mobile_otp;
            $event = $data->event;
            include("../includes/configuration.php");
            include("../../Agent/Backend/Functions/all_function.php");
            
            
            if($event == "verify-mobile-otp" && $email!="" && $mobile!=""){
                $mysql_qry = "select * FROM `temp_otp` WHERE MOBILE ='$mobile' AND EMAIL = '$email' AND MOBILE_OTP='$mobile_otp' ORDER BY ID DESC";
                $result = mysqli_query($con ,$mysql_qry);
                if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    $otp_time = $row['TIME'];
                    $timestamp1 = strtotime($current_time);
                    $timestamp2 = strtotime($otp_time);
                    
                    if (abs($timestamp1 - $timestamp2) <= 60 * 5 /* (5 Minutes) */) {
                        
                        
                    $verify_day = date('Ymd');
                    $registrationToken = encrypt_token(json_encode(["mobile" => $mobile , "email" => $email , "mobile_otp" => $mobile_otp, "verify_day"=>$verify_day]));
                        
                        echo json_encode(["message"=>"Mobile OTP Verified.", "response_code"=>1, "status"=>true, "receivableData"=>$registrationToken]);
                    }
                    else{
                        echo json_encode(["message"=>"Invalid Otp", "response_code"=>3, "status"=>false]);
                    }
                    
                    
                }
                else{
                    echo json_encode(["message"=>"Invalid Otp", "response_code"=>3, "status"=>false]);
                }
            }
            else if($event == "verify-email-otp" && $email!="" && $mobile!=""){
                
                $mysql_qry = "select * FROM `temp_otp` WHERE MOBILE ='$mobile' AND EMAIL = '$email' AND EMAIL_OTP='$email_otp' ORDER BY ID DESC";
                $result = mysqli_query($con ,$mysql_qry);
                if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    $otp_time = $row['TIME'];
                    $timestamp1 = strtotime($current_time);
                    $timestamp2 = strtotime($otp_time);
                    
                    if (abs($timestamp1 - $timestamp2) <= 60 * 5 /* (5 Minutes) */) {
                        echo json_encode(["message"=>"Email OTP Verified.", "response_code"=>1, "status"=>true]);
                    }
                    else{
                        echo json_encode(["message"=>"Invalid Otp", "response_code"=>3, "status"=>false]);
                    }
                    
                }
                else{
                    echo json_encode(["message"=>"Invalid Otp", "response_code"=>3, "status"=>false]);
                }
                
            }
            else{
                echo json_encode(["message"=>"Access Denied", "response_code"=>5, "status"=>false]);
            }
    }


?>