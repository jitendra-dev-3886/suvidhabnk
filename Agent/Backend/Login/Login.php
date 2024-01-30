<?php
session_start();
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("handler/mail/index.php");
// include("../../../test_api/whatsapp_api.php");
include("../../../test_api/msg91api.php");



// error_reporting(E_ALL);
// ini_set("display_errors" , 1);

function send_otp($type , $mobile , $email){
    $otp = mt_rand(99999 , 1000000);
    // $mobile_msg  = "Do not share your login OTP with anyone.$otp OTP to accessing your Account. Please report unauthorised access to customer care. Powered by ARO TRADING & FINANCIAL CONSULTING";
    $msg="Your OTP for Suvidha BANKio is $otp. Never share your OTP or account details with anyone.Regard Suvidha BANKio Team";
    $reciver="91$mobile";
    // echo $reciver;
    $tempid = "1007164023804988435";
    $e_smg  = "Dear user your otp for login is : $otp";
    $subject = "Login OTP";
    switch($type){
        case 1 :
            // API_Functions::send_sms_otp($mobile,$mobile_msg,$tempid);
        //     smtp_mailer($email,$subject, $e_smg);
        //   SendMail($email,$e_smg,$subject);
           login_otp_msg($reciver,$msg);
           sendSMS91($mobile,$otp,$usid);
           
        break;
        case 2 : 
            // smtp_mailer($email,$subject, $e_smg);
            // SendMail($email,$e_smg,$subject);
             login_otp_msg($reciver,$msg);
             sendSMS91($mobile,$otp,$usid);
        break;
        case 3 : 
        //   API_Functions::send_sms_otp($mobile,$mobile_msg,$tempid);
        //   smtp_mailer($email,$subject, $e_smg);
        //   SendMail($email,$e_smg,$subject);
           login_otp_msg($reciver,$msg);
           sendSMS91($mobile,$otp,$usid);
        break;
    }
    return hash("SHA512", $otp);
}

function store_session($id , $token){
    global $con;
     $_SESSION["UsId"] = $id;
    $update_token = $con->query("UPDATE `user` SET `TOKEN_ID`='$token' WHERE ID ='$id' ");
    $_SESSION["Token"] = $token;
}

date_default_timezone_set('Asia/kolkata');    
$timezone = date_default_timezone_get();    
$login_date = date("Y-m-d");
$login_time = date("g:i:s A");

if(!isset($_POST['long']) && !isset($_POST['lati'])){
    // $map_location = "https://maps.googleapis.com/maps/api/staticmap?center=".$lat.$lon."&zoom=14&size=400x300&sensor=false&key=YOUR_KEY";
    $ip_address = UserInfo::get_ip();
    $browser = UserInfo::get_browser();
    $os = UserInfo::get_os();
    $device = UserInfo::get_device();
    
    // get details via ip using api
    $ch=curl_init();
    curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
    curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
    $result             =   curl_exec($ch);
    $result             =   json_decode($result);
    $country            =   $result->country;
    $region             =   $result->regionName;
    $city               =   $result->city;
    $zip                =   $result->zip;
    $api_ip_address     =   $result->query;
    $isp                = $result->isp;
    $org                = $result->org;
    
}

if(isset($_POST['mobile'])){
    $str_rand=rand();
    $post_error = [];
    $mobile = filterVal($_POST['mobile']);
    $password = filterVal($_POST['password']);
    $lon = filterVal($_POST['long']);
    $lat = filterVal($_POST['lati']);
    
        // $query = $con->query("select * FROM user WHERE MOBILE='$mobile' AND PASSWORD ='$password' AND USER_TYPE = '46' AND US_STATUS='ACTIVE'");
        
        $headers = getallheaders();
        if($headers['Device'] == "" || $headers['Device'] == null){
            $query = $con->query("select * FROM user WHERE MOBILE='$mobile' AND PASSWORD ='$password'");
        }
        else{
            $query = $con->query("select * FROM user WHERE MOBILE='$mobile' AND PASSWORD ='$password' AND USER_TYPE = '46'");
        }
        
        $row = $query->num_rows;
        if($row!=0){
                $fetch_row=$query->fetch_assoc();
                $user_id = $fetch_row['ID'];
                $user_type = $fetch_row['USER_TYPE'];
                $user_auth = $fetch_row['LOGIN_AUTH'];
                $dual_verification = $fetch_row['OTP'];
            // check login authority
            if($user_auth == 1){
                
                $token = encrypt_token(json_encode(["ID" => $user_id , "Timestamp" => date("Ymdgis") , "UniqeId" => mt_rand(9999 , 9999999)]));
                store_session($user_id , $token);
                $mobile1="91$mobile";
                $msgg="You Are Login to Suvidhabnk at  with IP : {#var#} - Suvidha BANKio Team";
                // Login_msg($mobile1,$msgg);
                $msg = "Login Success witout OTP";
                $response= json_encode(array("rs_code"=> "200" , "User_Exist"=>"Yes" , "Status"=> true , "Login_Auth"=> 1 , "User_ID"=>$user_id , "User_Type"=> $user_type , "Token" => $token));
            }
            else if($user_auth == 2){
                // $dual_verification = "Yes In Every New Device";
                $old_login = $con->query("select * from login_history where IP_ADDRESS='$ip_address' and BROWSER='$browser' and OPERATING_SYSTEM='$os' and DEVICE='$device' and USER_ID='$user_id' and USER_TYPE='$user_type' ORDER BY ID DESC")->num_rows;
                if($old_login >= 1){
                    $token = encrypt_token(json_encode(["ID" => $user_id , "Timestamp" => date("Ymdgis") , "UniqeId" => mt_rand(9999 , 9999999)]));
                    store_session($user_id , $token);
                    $msg = "Login into old device";
                    $response= json_encode(array("rs_code"=> "200" , "User_Exist"=>"Yes" , "Status"=> true , "Login_Auth"=> 2 , "User_ID"=>$user_id , "User_Type"=> $user_type , "Token" => $token));
                }
                else{
                    $msg = "OTP Sent To New Device";
                    $otp = send_otp($fetch_row['OTP'] , $fetch_row['MOBILE'] , $fetch_row['EMAIL']);
                    $response= json_encode(array("rs_code"=> "201" , "User_Exist"=>"Yes" , "Status"=> true ,"OTP_AUTH"=>$dual_verification, "Login_Auth"=> 2 ,"msg"=>$msg, "OTP"=>"$otp" , "User_ID"=>$user_id , "User_Type"=> $user_auth));
                }
            }
            else if($user_auth == 3){
                    $msg = "OTP Sent for every device";
                    $otp = send_otp($fetch_row['OTP'] , $fetch_row['MOBILE'] , $fetch_row['EMAIL']);
                    
                    $response= json_encode(array("rs_code"=> "201" , "User_Exist"=>"Yes" , "Status"=> true ,"OTP_AUTH"=>$dual_verification, "Login_Auth"=> 3 ,"msg"=>$msg, "OTP"=>"$otp" , "User_ID"=>$user_id , "User_Type"=> $user_auth));
            }
    	}else{
            $msg = "Login Failed";
            $response =  json_encode(array("rs_code"=> "404" , "User_Exist"=>"No" , "Status"=> false));
    	}
    	
        $con->query("INSERT INTO `login_history`(`TOKEN_ID`,`IP_ADDRESS`, `BROWSER`, `OPERATING_SYSTEM`, `DEVICE`, `LOCATION`, `LOGIN_DATE`, `LOGIN_TIME`, 
        `LOGOUT_DATE`, `LOGOUT_TIME`, `USER_TYPE`, `USER_ID`, `MOBILE`, `PASSWORD`,`COUNTRY`, `REGION`, `CITY`, `ZIP`, `LATITUDE`, `LONGITUDE`, `API_IP`,
        `API_TIMEZONE`, `ISP`, `ORG`, `DUAL_VERIFICATION`, `MESSAGE`) VALUES ('$token','$ip_address','$browser','$os','$device','','$login_date',
        '$login_time','','','$user_type','$user_id','$mobile','$password','$country','$region','$city','$zip','$lat','$lon','$api_ip_address',
        '$timezone','$isp','$org','$dual_verification','$msg')");
    	echo $response;
    	$ipadd=$con->query("select * from login_history where MOBILE='7003660613' ORDER BY ID DESC")->fetch_assoc();
    	$ippad=$ipadd['IP_ADDRESS'];
    	$msgg="You Are Login to Suvidhabnk at  with IP : $ip_address - Suvidha BANKio Team";
    // 	Login_msg($mobile1,$msgg);
    	$otp=$ip_address;
    // 	send_login_ip($mobile,$otp);
    	
    	if($mobile == " "){
            $response =  json_encode(array("rs_code"=> "302" , "Please Insert mobile number and password"=>"No" , "Status"=> false));
    	}
    	
}

if(isset($_POST['otp_verify'])){
      $str_rand=rand();
    $otp = filterVal($_POST['enteredOtp']);
    $mobile = filterVal($_POST['otp_mobile']);
    $pass = filterVal($_POST['otp_password']);
    $lat = filterVal($_POST['long']);
    $lon = filterVal($_POST['lati']);
    $otp_hash = $_POST['otp_store'];
    $hash_otp = hash("SHA512" , $otp);
    
     $query = $con->query("select * FROM user WHERE MOBILE = '".$mobile. "' AND PASSWORD = '".$pass."' AND US_STATUS='ACTIVE'");
        $row = $query->num_rows;
        $fetch_row=$query->fetch_assoc();
        $user_id = $fetch_row['ID'];
        $user_type = $fetch_row['USER_TYPE'];
        $user_auth = $fetch_row['LOGIN_AUTH'];
        $dual_verification = $fetch_row['OTP'];
        if($hash_otp == $otp_hash){
            if($row!=0){
                $token = encrypt_token(json_encode(["ID" => $user_id , "Timestamp" => date("Ymdgis") , "UniqeId" => mt_rand(9999 , 9999999)]));
                store_session($user_id , $token); 
                $msg = "Login Success with OTP";
                $response= json_encode(array("rs_code"=> "200" , "User_Exist"=>"Yes" ,  "OTP_VERIFY"=>$hash_otp ,"msg"=>$msg, "Redirect"=> true, "Token" => $token, "User_Exist"=>"Yes" , "Status"=> true));
        //      $con->query("INSERT INTO `login_history`(`TOKEN_ID`,`IP_ADDRESS`, `BROWSER`, `OPERATING_SYSTEM`, `DEVICE`, `LOCATION`, `LOGIN_DATE`, `LOGIN_TIME`, 
        // `LOGOUT_DATE`, `LOGOUT_TIME`, `USER_TYPE`, `USER_ID`, `MOBILE`, `PASSWORD`,`COUNTRY`, `REGION`, `CITY`, `ZIP`, `LATITUDE`, `LONGITUDE`, `API_IP`,
        // `API_TIMEZONE`, `ISP`, `ORG`, `DUAL_VERIFICATION`, `MESSAGE`) VALUES ('$token_id','$ip_address','$browser','$os','$device','','$login_date',
        // '$login_time','','','$user_type','$user_id','$mobile','$password','$country','$region','$city','$zip','$lat','$lon','$api_ip_address',
        // '$timezone','$isp','$org','$dual_verification','$msg')");
                
            }else{
                $msg = "Wrong Detials while entering OTP. Sucpicious activity";
                $response= json_encode(array("rs_code"=> "404" , "User_Exist"=>"Yes" , "OTP_VERIFY"=>$hash_otp , "msg"=>$msg, "Redirect"=> false, "Status"=> false));
            }
        }else{
            $msg = "Wrong OTP ";
            $response= json_encode(array("rs_code"=> "400" , "User_Exist"=>"Yes" , "OTP_VERIFY"=>$hash_otp , "msg"=>$msg, "Redirect"=> false, "Status"=> false));
        }
        /*
     $con->query("INSERT INTO `login_history`(`TOKEN_ID`,`IP_ADDRESS`, `BROWSER`, `OPERATING_SYSTEM`, `DEVICE`, `LOCATION`, `LOGIN_DATE`, `LOGIN_TIME`, 
    `LOGOUT_DATE`, `LOGOUT_TIME`, `USER_TYPE`, `USER_ID`, `MOBILE`, `PASSWORD`,`COUNTRY`, `REGION`, `CITY`, `ZIP`, `LATITUDE`, `LONGITUDE`, `API_IP`,
    `API_TIMEZONE`, `ISP`, `ORG`, `DUAL_VERIFICATION`, `MESSAGE`) VALUES ('$token_id','$ip_address','$browser','$os','$device','','$login_date',
    '$login_time','','','$user_type','$user_id','$mobile','$pass','$country','$region','$city','$zip','$lat','$lon','$api_ip_address',
    '$timezone','$isp','$org','$dual_verification','$msg')");
    */
	echo $response;
}




?> 