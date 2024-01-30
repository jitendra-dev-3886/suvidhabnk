<?php
include("../../../Db/config.php");
include("../Functions/all_function.php");
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
            if($event == "verify-mobile-otp" && $email!="" && $mobile!=""){
                $mysql_qry = "select * FROM `temp_otp` WHERE MOBILE ='$mobile' AND EMAIL = '$email' AND MOBILE_OTP='$mobile_otp' ORDER BY ID DESC";
                $result = mysqli_query($con ,$mysql_qry);
                if(mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_array($result);
                    $otp_time = $row['TIME'];
                    $timestamp1 = strtotime($current_time);
                    $timestamp2 = strtotime($otp_time);
                    
                    if (abs($timestamp1 - $timestamp2) <= 60 * 5 /* (5 Minutes) */) {
                        echo json_encode(["message"=>"Mobile OTP Verified.", "response_code"=>1, "status"=>true]);
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
                        
                        $userrows = $con->query("select * from user where MOBILE='$mobile' and EMAIL='$email' order by ID desc limit 1 ")->num_rows;
                        if($userrows == 0){
                         $query = $con->query("INSERT INTO `user`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `USER_TYPE`, `PARTNER_ID`,`OWNER_ID`, `SERVICES`, `FIRST_NAME`, `LAST_NAME`, `MOBILE`,
                                    `EMAIL`, `MAIN_BAL`, `AEPS_BAL`, `ADDRESS`, `CITY`, `STATE`, `PIN`, `ADHAAR`, `PAN`, `RC_COMM`, `AEPS_COMM`, `DMT_COMM`, `US_STATUS`, `PASSWORD`, `OTP`, 
                                    `LOGIN_AUTH`, `SUBSCRIPTION`) VALUES ('Admin','1','','47', '','ADMIN','','','','$mobile','$email','0','0',
                                    '','','','','','','','','','Deactive','$pass','1','1','-1')");
                        }
                        $userrow = $con->query("select * from user where MOBILE='$mobile' and EMAIL='$email' order by ID desc limit 1 ")->fetch_assoc();
                        $usid = encrypt_token($userrow['ID']);
                        $con->query("update user set PARTNER_ID='PDDT".$userrow['ID']."' where ID='".$userrow['ID']."' ");
                         


                        echo json_encode(["message"=>"Email OTP Verified.", "response_code"=>1, "status"=>true, "usid"=> $usid]);
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