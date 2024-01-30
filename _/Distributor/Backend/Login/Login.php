<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");

function send_otp($type , $mobile , $email){
    $otp = mt_rand(99999 , 1000000);
    $sub = "OTP for Login";
      $mbmsg = urlencode("Your OTP verification code is $otp. Do not share it with anyone. TEAM CYBDEER");
    $e_smg  = "Dear user your otp for login is : $otp";
    switch($type){
        case 1 :
            sendSMS($mobile, $mbmsg , 1307162488475711397);
        break;
        case 2 : 
            SendMail($email,$e_smg , $sub);
        break;
        case 3 : 
            sendSMS($mobile, $mbmsg , 1307162488475711397);
            SendMail($email,$e_smg , $sub);
            ;
        break;
    }
    return hash("SHA512", $otp);
}

function store_session($id , $token){
    global $con;
     $_SESSION["dtid"] = $id;
    $update_token = $con->query("UPDATE `user` SET `TOKEN_ID`='$token' WHERE ID ='$id' ");
    $_SESSION["Token"] = $token;
}

date_default_timezone_set('Asia/kolkata');    
$timezone = date_default_timezone_get();    
$login_date = date("Y-m-d");
$login_time = date("g:i:s A");
// $map_location = "https://maps.googleapis.com/maps/api/staticmap?center=".$lat.$lon."&zoom=14&size=400x300&sensor=false&key=YOUR_KEY";
$ip_address = UserInfo::get_ip();
$browser = UserInfo::get_browser();
$os = UserInfo::get_os();
$device = UserInfo::get_device();

// get details via ip using api
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result=curl_exec($ch);
$result=json_decode($result);
$country =  $result->country;
$region =  $result->regionName;
$city =    $result->city;
$zip =     $result->zip;
$api_ip_address = $result->query;
$isp = $result->isp;
$org = $result->org;



if(isset($_POST['mobile'])){
    $str_rand=rand();
    $post_error = [];
    $mobile = filterVal($_POST['mobile']);
    $password = filterVal($_POST['password']);
    $lon = filterVal($_POST['long']);
    $lat = filterVal($_POST['lati']);
    
        $query = $con->query("select * FROM user WHERE MOBILE='$mobile' AND PASSWORD ='$password' AND USER_TYPE = '47' AND US_STATUS='ACTIVE'");
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
                $msg = "Login Success witout OTP";
                $response= json_encode(array("rs_code"=> "200" , "User_Exist"=>"Yes" , "Status"=> true , "Login_Auth"=> 1 , "User_ID"=>$user_id , "User_Type"=> $user_auth , "Token" => $token));
            }
            else if($user_auth == 2){
                // $dual_verification = "Yes In Every New Device";
                $old_login = $con->query("select * from login_history where IP_ADDRESS='$ip_address' and BROWSER='$browser' and OPERATING_SYSTEM='$os' and DEVICE='$device' and USER_ID='$user_id' and USER_TYPE='$user_type' ORDER BY ID DESC")->num_rows;
                if($old_login >= 1){
                    $token = encrypt_token(json_encode(["ID" => $user_id , "Timestamp" => date("Ymdgis") , "UniqeId" => mt_rand(9999 , 9999999)]));
                    store_session($user_id , $token);
                    $msg = "Login into old device";
                    $response= json_encode(array("rs_code"=> "200" , "User_Exist"=>"Yes" , "Status"=> true , "Login_Auth"=> 2 , "User_ID"=>$user_id , "User_Type"=> $user_auth , "Token" => $token));
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
}

if(isset($_POST['otp_verify'])){
    $str_rand=rand();
    $otp = filterVal($_POST['enteredOtp']);
    $mobile = filterVal($_POST['otp_mobile']);
    $pass = filterVal($_POST['otp_password']);
    $lat = filterVal($_POST['long']);
    $lon = filterVal($_POST['lati']);
    $otp_hash = filterVal($_POST['otp_store']);
    $hash_otp = hash("SHA512" , $otp);
    
     $query = $con->query("select * FROM user WHERE MOBILE = '$mobile' AND PASSWORD = '$pass' AND USER_TYPE = '47' AND US_STATUS='ACTIVE'");
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
                $response= json_encode(array("rs_code"=> "200" , "User_Exist"=>"Yes" ,  "OTP_VERIFY"=>$hash_otp ,"msg"=>$msg, "Status"=> true , "Token" => $token));
            }else{
                $msg = "Wrong Detials while entering OTP. Sucpicious activity";
                $response= json_encode(array("rs_code"=> "404" , "User_Exist"=>"Yes" , "OTP_VERIFY"=>$hash_otp , "msg"=>$msg, "Status"=> false));
            }
        }else{
            $msg = "Wrong OTP ";
            $response= json_encode(array("rs_code"=> "400" , "User_Exist"=>"Yes" , "OTP_VERIFY"=>$hash_otp , "msg"=>$msg, "Status"=> false));
        }
     $con->query("INSERT INTO `login_history`(`TOKEN_ID`,`IP_ADDRESS`, `BROWSER`, `OPERATING_SYSTEM`, `DEVICE`, `LOCATION`, `LOGIN_DATE`, `LOGIN_TIME`, 
    `LOGOUT_DATE`, `LOGOUT_TIME`, `USER_TYPE`, `USER_ID`, `MOBILE`, `PASSWORD`,`COUNTRY`, `REGION`, `CITY`, `ZIP`, `LATITUDE`, `LONGITUDE`, `API_IP`,
    `API_TIMEZONE`, `ISP`, `ORG`, `DUAL_VERIFICATION`, `MESSAGE`) VALUES ('$token','$ip_address','$browser','$os','$device','','$login_date',
    '$login_time','','','$user_type','$user_id','$mobile','$pass','$country','$region','$city','$zip','$lat','$lon','$api_ip_address',
    '$timezone','$isp','$org','$dual_verification','$msg')");
	echo $response;
}




?> 