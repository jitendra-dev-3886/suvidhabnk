<?php

    include("../../../Db/config.php");
    include("../Userinfo/getuserinfo.php");
    include("../Functions/all_function.php");
    include("../Auth/userdata.php");


    if(isset($_POST['check_mpin'])){
        
        $mysql_qry = "SELECT * FROM tpin WHERE USER_ID ='$usid' AND STATUS ='active' ORDER BY ID DESC";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            echo json_encode(["message"=>"M-PIN Exists", "response_code"=>1, "status"=>true, "receivableData"=>$row]);
        }
        else{
            echo json_encode(["message"=>"M-PIN Not Created Yet, Create now.", "response_code"=>2, "status"=>false]);
        }
        
    }
    
    if(isset($_POST['verify_mpin'])){
        
        $mpin =  $_POST['mpin'];
        
        $mysql_qry = "SELECT * FROM tpin WHERE USER_ID ='$usid' AND STATUS ='active' and TPIN = '$mpin' ORDER BY ID DESC";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            echo json_encode(["message"=>"M-PIN Exists", "response_code"=>1, "status"=>true, "receivableData"=>$row]);
        }
        else{
            echo json_encode(["message"=>"Inavlid Mpin", "response_code"=>200, "status"=>false]);
        }
        
    }
    
    if(isset($_POST['otp_mpin'])){
        
      
      if($_POST['times'] == null || $_POST['times'] == "" || $_POST['times'] > 4){
        $err = ["response_code"=>5, "message"=>"Maximum try reached, try after sometimes.", "status"=>false, "receivableData"=>null];
        echo json_encode($err);
        exit;
      }
    
      $mb = $user['MOBILE'];
      $otp = mt_rand(99999 , 999999);
      $username = $user['FIRST_NAME']." ".$user['LAST_NAME'];
      $mbmsg = urlencode("$username is your OTP for $otp. Do not share your OTP with anyone. PAYDEER or its employees will never ask for OTP. This OTP will be valid only for next 299 seconds Team PAYDEER");
      $smsrs = json_decode(sendSMS($mb, $mbmsg , 1307164568607363585) , true);
      $receivableData = ["rs_code"=>112 ,  "smsotpst"=> $smsrs['ErrorMessage'] , "OTPHASH"=>encrypt_token($otp) ];
      $err = ["response_code"=>1, "message"=>"Otp has been sent.", "status"=>true, "receivableData"=>$receivableData];
      echo json_encode($err);
      exit;

    }
    
    
    if(isset($_POST['set_mpin'])){
        
            extract($_POST);
            if($otp == ""){

                $err = ["response_code"=>403, "message"=>"OTP Not matched.", "status"=>false];
                echo json_encode($err);
                exit;
            }
            
            if($hash_code == ""){

                $err = ["response_code"=>403, "message"=>"Verification failed.", "status"=>false];
                echo json_encode($err);
                exit;
            }
            
            if($otp != decrypt_token($hash_code)){

                $err = ["response_code"=>403, "message"=>"OTP Not matched.", "status"=>false];
                echo json_encode($err);
                exit;
            }
            
            
            
            $mysql_qry = "SELECT * FROM tpin WHERE USER_ID ='$usid' AND STATUS ='active' ORDER BY ID DESC";
            $result = mysqli_query($con ,$mysql_qry);
            if(mysqli_num_rows($result) > 0) {
                
                $sql = "UPDATE tpin SET `STATUS`='inactive' WHERE USER_ID ='$usid'";
                $finalizationD =  mysqli_query($con, $sql);
                
            }
            
            
            $sqlPin = "INSERT INTO `tpin`( `USER_ID`, `TPIN`, `STATUS`) VALUES ('$usid','$m_pin','active')";
            $finalizationP =  mysqli_query($con, $sqlPin);
            if($finalizationP){
                $err = ["response_code"=>1, "message"=>"Success.", "status"=>true];
                echo json_encode($err);
                    
            }
            else{
                $err = ["response_code"=>5, "message"=>"Some enternal error.", "status"=>false];
                echo json_encode($err);
            }
            
    }
    
    if(isset($_POST['change_mpin'])){
        
            extract($_POST);
            
            if($otp == ""){

                $err = ["response_code"=>403, "message"=>"OTP Not matched.", "status"=>false];
                echo json_encode($err);
                exit;
            }
            
            if($hash_code == ""){

                $err = ["response_code"=>403, "message"=>"Verification failed.", "status"=>false];
                echo json_encode($err);
                exit;
            }
            
            if($otp != decrypt_token($hash_code)){

                $err = ["response_code"=>403, "message"=>"OTP Not matched.", "status"=>false];
                echo json_encode($err);
                exit;
            }
            
        
            $mysql_qry = "SELECT * FROM tpin WHERE USER_ID ='$usid' AND TPIN ='$old_m_pin' AND STATUS ='active' ORDER BY ID DESC";
            $result = mysqli_query($con ,$mysql_qry);
            if(mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_array($result);
                
                if($old_m_pin == $new_m_pin){
                    echo json_encode(["message"=>"New M-Pin cannot be old M-Pin.", "response_code"=>2, "status"=>false]);
                    exit;
                }
                
                $sql = "UPDATE tpin SET `STATUS`='inactive' WHERE USER_ID ='$usid'";
                $finalizationD =  mysqli_query($con, $sql);
                
                $sqlPin = "INSERT INTO `tpin`( `USER_ID`, `TPIN`, `STATUS`) VALUES ('$usid','$new_m_pin','active')";
                $finalizationP =  mysqli_query($con, $sqlPin);
                if($finalizationD && $finalizationP){
                    $err = ["response_code"=>1, "message"=>"Success.", "status"=>true];
                    echo json_encode($err);
                }
                else{
                    $err = ["response_code"=>5, "message"=>"Some enternal error.", "status"=>false];
                    echo json_encode($err);
                }
            }
            else{
                echo json_encode(["message"=>"Invalid M-Pin, Provide right current M-Pin.", "response_code"=>2, "status"=>false]);
            }
            
    }

?>