<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);

// include("../../../../security/userInformation.php");

// used to decrypt values
function decrypt_token($encryption){
    $ciphering = "AES-128-CTR";
     $decryption_iv = 'ThisIsSecretKeyForEncrytionByJisneYeBnaya!@#$%^&*()';
    $decryption_key = "WebSpidy";
    // Using openssl_decrypt() function to decrypt the data 
    $decryption = openssl_decrypt(base64_decode($encryption), $ciphering, $decryption_key, 0, $decryption_iv);
    return $decryption;
}

// for create paysprint token 
function create_token(){
    global $paysprint;
    $rand = "NSD".date("ds").mt_rand(9999 , 100000);
    $time  = time();
    $data = array(
     "timestamp"=>$time, 
      "partnerId"=> $paysprint['PARTNER_ID'], 
      "reqid"=> "$rand"
    
    );
      // Create token header as a JSON string
    $header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);
    $payload = json_encode($data);
    $base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));
    $base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));
    $signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, $paysprint['JWT_KEY'] , true);
    $base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));
    $jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;
    return $jwt;
    // echo $paysprint['JWT_KEY'] ;
}





// encrypt data
    function encrypt($data){
      global $paysprint;
$key = $paysprint['KEY'];  
$iv=   $paysprint['KEY_IV'];            
$datapost = $data;
$cipher  =   openssl_encrypt(json_encode($datapost,true), 'AES-128-CBC', $key, $options=OPENSSL_RAW_DATA, $iv);
$body=       base64_encode($cipher);
return $body;
}

    


// insert_allreport(2  ,3232 , "AEPS" , 100  , 200 , 100 , "Add" , "Aeps Success");


function insert_allreport($user_id  ,$ref , $trans , $opening  , $closing , $amount , $fund , $msg , $wallet = "MAIN"){
    global $con;
    
date_default_timezone_set('Asia/kolkata');    
$timezone = date_default_timezone_get();    
$date = date("Y-m-d");
$time = date("g:i:s A");
$time_stamp = date("Y-m-d H:i:s");
// $map_location = "https://maps.googleapis.com/maps/api/staticmap?center=".$lat.$lon."&zoom=14&size=400x300&sensor=false&key=YOUR_KEY";
$ip_address = UserInfo::get_ip();
$browser = UserInfo::get_browser();
$os = UserInfo::get_os();
$device = UserInfo::get_device();

// get details via ip using api
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


    $user = $con->query("select * from user where ID='$user_id'")->fetch_assoc();
    
     $total_main = $con->query("SELECT  SUM(MAIN_BAL) FROM `user` ")->fetch_assoc();
     $total_aeps = $con->query("SELECT  SUM(AEPS_BAL) FROM `user` ")->fetch_assoc();
    $overallmainbal = $total_main['SUM(MAIN_BAL)'];
    $overallaepsbal = $total_aeps['SUM(AEPS_BAL)'];
    
    
    $con->query("INSERT INTO `report`(`OWNER`, `OWNER_ID`, `TRANS_TYPE`, `REFERENCE_ID` ,`TOKEN_ID`, `USER_ID`, `TRANSFER_USER_ID`, `PREVIOUS_AMOUNT`,
    `AMOUNT`, `AFTER_AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, 
    `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`, `DATE` , `WALLET`, `ALL_MAIN`, `ALL_AEPS`) 
    VALUES
    ('".$user['MAIN_OWNER']."','".$user['MAIN_OWNER_ID']."','$trans', '$ref' , '".$_SESSION['token']."','$user_id','','$opening', '$amount' ,'$closing','$fund','$msg',
    '','$ip_address','$browser','$os','$device','','$date','$time','$country','$region',
    '$city','$zip','','','$api_ip_address','$isp','$org','$msg','$time_stamp' , '$wallet', '$overallmainbal' ,  '$overallaepsbal')");
    
    
}

?>