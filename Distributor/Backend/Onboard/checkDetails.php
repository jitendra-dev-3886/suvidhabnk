<?php
include("../../../Db/config.php");
include("../Functions/all_function.php");
    $json = file_get_contents('php://input');
    // Converts it into a PHP object
    $data = json_decode($json);
    if($data!=null || $data!=""){
        $email =  $data->information->email;
        $mobile =  $data->information->mobile;
        $event = $data->event;
        if($event == "areAllCredentialsFine" && $email!="" && $mobile!=""){
            
            //check account created already or not with deactive
             $alreadyus = $con->query("select * from user where MOBILE='$mobile' and EMAIL='$email'  and US_STATUS='Deactive' order by ID desc limit 1 ");
             if($alreadyus->num_rows == 1){
                 $alreadyusdata = $alreadyus->fetch_assoc();
                $usid = encrypt_token($alreadyusdata['ID']);
                
                 $reguser_rows = $con->query("select * from register_user_data where AADHAAR_DATA<>'' and REQ_ID<>'' and MOBILE='$mobile' and EMAIL='$email' and USER_ID='".$alreadyusdata['ID']."' ");
                 if($reguser_rows->num_rows == 1){
                     $reguser = $reguser_rows->fetch_assoc();
                     if($reguser['AADHAAR_DATA'] == ""){
                         echo json_encode(["message"=>"User founded with incomplete kyc redirecting", "response_code"=>1123, "status"=>true , "reqid" => $reguser['REQ_ID'] ,  "usid"=> $usid]);
                         exit;
                     }
                     if($reguser['PAN_DATA'] == ""){
                         echo json_encode(["message"=>"User founded with incomplete kyc redirecting", "response_code"=>1223, "status"=>true , "reqid" => $reguser['REQ_ID'] ,  "usid"=> $usid]);
                         exit;
                     }
                     if($reguser['ACCOUNT_VERIFICATION'] == ""){
                         echo json_encode(["message"=>"User founded with incomplete kyc redirecting", "response_code"=>1323, "status"=>true , "reqid" => $reguser['REQ_ID'] ,  "usid"=> $usid]);
                         exit;
                     }
                     if($alreadyusdata['PASSWORD'] == ""){
                         echo json_encode(["message"=>"User founded with incomplete kyc redirecting", "response_code"=>1423, "status"=>true , "reqid" => $reguser['REQ_ID'] ,  "usid"=> $usid]);
                         exit;
                     }
                     if($alreadyusdata['VIRTUAL_ACC'] == "" || $alreadyusdata['VIRTUAL_UPI'] == ""){
                         echo json_encode(["message"=>"User founded with incomplete kyc redirecting", "response_code"=>1423, "status"=>true , "reqid" => $reguser['REQ_ID'] ,  "usid"=> $usid]);
                         exit;
                     }
                 }
                 else{
                      echo json_encode(["message"=>"User founded with incomplete kyc redirecting", "response_code"=>1123, "status"=>true , "reqid" => $reguser['REQ_ID'] ,  "usid"=> $usid ]);
                     exit;
                 }
             }
            
            
            $Mrows = $con->query("select * from user where MOBILE='$mobile' and US_STATUS='Active'")->num_rows;
            $Erows = $con->query("select * from user where EMAIL='$email' and US_STATUS='Active'")->num_rows;
            
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
            
            // if(isset($_POST["action"]) && $_POST["action"] == 2){
                
            //     $rotpmb = $_POST["rmb"];
            //     $rmobile_otp = mt_rand(99999 , 1000000);
            //     $query = $con->query("UPDATE temp_otp SET MOBILE_OTP='$mobile_otp' WHERE MOBILE='$rotpmb'");
            //     $run_query = mysqli_query($con , $query);
                
            //     $rmbmsg = urlencode("$rmobile_otp is your OTP for Login. Do not share your OTP with anyone. PayDeer or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds. Team Paydeer");
            
            //     sendSMS($rotpmb, $rmbmsg , 1307164568458158148);
            //     echo json_encode(["message"=>"Resend OTP has been sent to the credentials..", "response_code"=>1, "status"=>true]);

            // }
            
            // if(isset($_POST["action"]) && $_POST["action"] == 3){
                
            //     $rotpem = $_POST["rem"];
            //     $remail_otp = mt_rand(99999 , 1000000);
            //     $query = $con->query("UPDATE temp_otp SET EMAIL_OTP='$email_otp' WHERE EMAIL='$rotpem'");
            //     $run_query = mysqli_query($con , $query);
                
            //     $rsub = "Resend OTP for Registration";
            //     $re_smg  = "Dear user your Resend otp for Registration is : $remail_otp";
                
            //     SendMail($rotpem,$re_smg , $rsub);
            //     echo json_encode(["message"=>"Resend OTP has been sent to the credentials..", "response_code"=>1, "status"=>true]);

            // }
        }
        else{
            echo json_encode(["message"=>"Bad Response", "response_code"=>300, "status"=>false]);
        }
    }
    
?>