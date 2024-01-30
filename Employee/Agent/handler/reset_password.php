<?php
error_reporting(E_ALL);
ini_set("display_errors" , 1);
include("../../Db/config.php");
include("userInformation.php");
include("mail/index.php");
include("main_function.php");
include("../../test_api/whatsapp_api.php");
//require_once '../Dashboard/User/include/API_Functions.php';
//$api = new API_Functions();

date_default_timezone_set('Asia/kolkata');    
$timezone = date_default_timezone_get();    
$login_date = date("Y-m-d");
$login_time = date("h:i:sA");
if(isset($_POST['mobile'])){
      $mobile= $_POST['mobile'];
    $rt = $con->query("select * FROM user WHERE MOBILE ='$mobile' and US_STATUS='Active' ");
    $token = str_shuffle(substr("QWERTYUIOP1234567890asdfghjklZXCVBNMqwertyuiopzxcvbnm" , 0 , 40));
    if($rt->num_rows == 1){
        $user_dt = $rt->fetch_assoc();
        $email = $user_dt['EMAIL'];
        $mobile = $user_dt['MOBILE'];
         $name = $user_dt['FIRST_NAME'];
        $subject = "Reset Password OTP";
        $user_found = "Yes";
        $otp = mt_rand(99999 , 1000000);
        $message = "Your OTP for Reset Password Suvidha BANKio is $otp. Never share your OTP or account details with anyone.Regard Suvidha BANKio Team";
        $mobile_msg  = "Your OTP for Suvidha BANKio is $otp. Never share your OTP or account details with anyone.Regard Suvidha BANKio Team";
        $tempid = "1007164017100082711";
       // API_Functions::send_sms_otp($mobile,$mobile_msg,$tempid);
        smtp_mailer($email,$subject, $message);
        SendMail($email,$message , $subject);
        $reciver="91$mobile";
        $msg="$message";
        whatsapp_msg($reciver,$msg);
        $_SESSION['otp'] = $otp;
    }
    else{
        $user_found = "No";
    }

        echo json_encode(array("User_exist"=> "$user_found" , "User"=> "$user" , "otp"=> md5($otp), "user_id" => $user_dt['ID']));
        // exit;
}
if(isset($_POST['otp'])){
   $mobile= $_POST['verifymobile'];
    $otp = $_POST['otp'];
    $otp2 = $_POST['verify'];

            $ip_address = UserInfo::get_ip();
            $browser = UserInfo::get_browser();
            $os = UserInfo::get_os();
            $device = UserInfo::get_device();
            $ch=curl_init();
            curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json/$ip_address");
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
        
    if(md5($otp) == $otp2){
            $rt = $con->query("select * FROM user WHERE  MOBILE ='$mobile' and US_STATUS='Active' ");
            $user_dt = $rt->fetch_assoc();
            $status = "Sucess";
             echo json_encode(array("code"=> 200, "User_exist"=> "$user_found" ,"otp"=>md5($otp)) );
     }else{
            $status = "Failed";
            echo json_encode(array("code"=> 404, "User_exist"=> "No" , "User"=> "" , "token" => "" , "msg" => "OTP not matched"));
    }
      $con->query("INSERT INTO `login_history`(`TOKEN_ID`,`IP_ADDRESS`, `BROWSER`, `OPERATING_SYSTEM`, `DEVICE`, `LOCATION`, `LOGIN_DATE`, `LOGIN_TIME`,
      `LOGOUT_DATE`, `LOGOUT_TIME`, `USER_TYPE`, `USER_ID`, `MOBILE`, `PASSWORD`,`COUNTRY`, `REGION`, `CITY`, `ZIP`, `LATITUDE`, `LONGITUDE`, `API_IP`,
      `API_TIMEZONE`, `ISP`, `ORG`, `DUAL_VERIFICATION`, `MESSAGE`) VALUES ('$token','$ip_address','$browser','$os','$device','$map_location','$login_date',
      '$login_time','$logout_date','$logout_time','$user','".$user_dt['ID']."','$mobile','$password','$country','$region','$city','$zip','$lat','$lon','$api_ip_address',
      '$timezone','$isp','$org','$dual_verification','Reset Via OTP $status')");

}


if(isset($_POST['pass'])){
    $pass = strip_tags($_POST['pass']);
    $c_pass = strip_tags($_POST['c_pass']);
    $mobile= $_POST['verifymobile'];
  
    $rt = $con->query("select * FROM user WHERE MOBILE ='$mobile' and US_STATUS='Active'");
    $rt1 = $con->query("select * FROM user WHERE MOBILE ='$mobile' and US_STATUS='Active'")->fetch_assoc();
    $namee=$rt1['FIRST_NAME']." ".$rt1['LAST_NAME'];
    $token = str_shuffle(substr("QWERTYUIOP1234567890asdfghjklZXCVBNMqwertyuiopzxcvbnm" , 0 , 40));
    if($rt->num_rows == 1){
        $user_dt = $rt->fetch_assoc();
        $user_found = "Yes";
    }
    else{
        $user_found = "No";
    }
    if($user_found == "Yes"){
        if($con->query("update user set PASSWORD='$pass' where MOBILE='$mobile' and US_STATUS='Active'")){
            $reciver= "$mobile";
            $mobile="91$mobile";
            $msg="Dear $namee, Your password has been changed. New Password. $pass from, Suvidha BANKio Team";
            print_r(whatsapp_msg($reciver,$msg));
            $lon = $_POST['long'];
                $lat = $_POST['lati'];
                $map_location = "https://maps.googleapis.com/maps/api/staticmap?center=".$lat.$lon."&zoom=14&size=400x300&sensor=false&key=YOUR_KEY";
                
                $ip_address = UserInfo::get_ip();
                $browser = UserInfo::get_browser();
                $os = UserInfo::get_os();
                $device = UserInfo::get_device();
                
                
                
                $ch=curl_init();
                curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json/$ip_address");
                
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

              if($con->query("INSERT INTO `login_history`(`TOKEN_ID`,`IP_ADDRESS`, `BROWSER`, `OPERATING_SYSTEM`, `DEVICE`, `LOCATION`, `LOGIN_DATE`, `LOGIN_TIME`,
              `LOGOUT_DATE`, `LOGOUT_TIME`, `USER_TYPE`, `USER_ID`, `MOBILE`, `PASSWORD`,`COUNTRY`, `REGION`, `CITY`, `ZIP`, `LATITUDE`, `LONGITUDE`, `API_IP`,
              `API_TIMEZONE`, `ISP`, `ORG`, `DUAL_VERIFICATION`, `MESSAGE`) VALUES ('$token','$ip_address','$browser','$os','$device','$map_location','$login_date',
              '$login_time','$logout_date','$logout_time','$user','".$user_dt['ID']."','$mobile','$password','$country','$region','$city','$zip','$lat','$lon','$api_ip_address',
              '$timezone','$isp','$org','$dual_verification','$user_found')"))
              {
                //   $con->query("Update $table set LOGGED_IN='Yes' , LOGGED_ID='$token' where ID='".$user_dt['ID']."'");
                echo json_encode(array("User_exist"=> "$user_found" , "User"=> "$user" , "token" => "$token" , "active"=>"No" , "user_id" => $user_dt['ID']));
              }
              else
              {
                  session_destroy(); 
                  setcookie("token" , "");
                echo json_encode(array("User_exist"=> "No" , "User"=> "" , "token" => ""));
              }
              print_r(New_Passsword_msg($mobile,$msg));
        }else{
                echo json_encode(array("User_exist"=> "No" , "User"=> "" , "token" => ""));
        }
    }
     else{
                echo json_encode(array("User_exist"=> "No" , "User"=> "" , "token" => ""));         
     }  
}








?>