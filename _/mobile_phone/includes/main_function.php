<?php
error_reporting(0);
    

include("userInformation.php");
    
function encrypt($data){
      global $paysprint;
$key = $paysprint['KEY'];  
$iv=   $paysprint['KEY_IV'];            
$datapost = $data;
$cipher  =   openssl_encrypt(json_encode($datapost,true), 'AES-128-CBC', $key, $options=OPENSSL_RAW_DATA, $iv);
$body=       base64_encode($cipher);
return $body;
}

    
    

   function SendMessage($mobile, $message){
            $curl = curl_init();
                global $con;
            date_default_timezone_set('Asia/Kolkata');
            $date = date("Y-m-d");
            $time = date("g:i:s A"); 
          $s_api = $con->query("select * from smsApi where STATUS='Activate'")->fetch_assoc();
          $s_url = $s_api['APIURL'];
          $s_snder = $s_api['SENDERNAME'];
          $s_apikey = $s_api['APIKEY'];
          
          
        $tlv = "{%22PE_ID%22:%221201159419457163977%22,%22Template_ID%22:%221207161932657830662%22}";
         
        $live_url = "https://bulksms.tekhook.in/smsapi/index?key=5588A28204EDB2&routeid=288&type=text&contacts=$mobile&senderid=HRCSMS&msg=$message&tlv=$tlv";
        
        // $live_url = "http://sms.afgoparrot.com/app/smsapi/mobile-recharge.php?key=2606C3C0920662&campaign=12625&routeid=101011&type=text&contacts=$mobile&senderid=TESTIN&msg=$message";
            // set our url with curl_setopt()
            curl_setopt($curl, CURLOPT_URL, $live_url);
            
            // return the transfer as a string, also with setopt()
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($curl, CURLOPT_HTTPGET, 1);
            
            // curl_exec() executes the started curl session
            // $output contains the output string
            $output = curl_exec($curl);
            // echo $output;
            if($output == FALSE){
                die('Failed'.curl_error($curl));
            }
            $outputObj = json_decode($output, true);
            // print_r($outputObj);
            // close curl resource to free up system resources
            // (deletes the variable made by curl_init)
            curl_close($curl);
                    // print_r($data);
          }
          
          
// mail funtion
function SendMail($email,$message){

    $subject = "Password Details";
    
    // mail id to be changed to server mail id
    $headers = 'From: no-reply@hrcmulti.in' . "\r\n" . // your mail id
      'Reply-To: no-reply@hrcmulti.in' . "\r\n" . //  your mail id
      'X-Mailer: PHP/' . phpversion();
    
    // Send the email
    try{
              mail($email, $subject, $message, $headers);
            // echo "<script> alert('The email was sent.')</script>";
        return true;
    }
    catch(exception $e){
            // echo "<script> alert('The email fail to sent. $e')</script>";
        return $e;
    }
}


function create_token(){
    global $paysprint;
    $rand = "PDR".date("ds").mt_rand(9999 , 100000);
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


function insert_allreport($user_id  ,$ref , $trans , $opening  , $closing , $amount , $fund , $msg, $ip_address, $device, $wallet_type = "MAIN"){
    global $con;
    
date_default_timezone_set('Asia/kolkata');    
$timezone = date_default_timezone_get();    
$date = date("Y-m-d");
$time = date("g:i:s A");
$time_stamp = date("Y-m-d H:i:s");


$browser = "Mobile App";
$os = "Android OS";


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
  
     $total_main = $con->query("SELECT  SUM(MAIN_BAL) FROM `user`")->fetch_assoc();
     $total_aeps = $con->query("SELECT  SUM(AEPS_BAL) FROM `user`")->fetch_assoc();
    $overallmainbal = $total_main['SUM(MAIN_BAL)'];
    $overallaepsbal = $total_aeps['SUM(AEPS_BAL)'];
    
    
    $con->query("INSERT INTO `report`(`OWNER`, `OWNER_ID`, `TRANS_TYPE`, `REFERENCE_ID` ,`TOKEN_ID`, `USER_ID`, `TRANSFER_USER_ID`, `PREVIOUS_AMOUNT`,
    `AMOUNT`, `AFTER_AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, 
    `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`, `DATE` , `WALLET`, `ALL_MAIN`, `ALL_AEPS`) 
    VALUES
    ('".$user['MAIN_OWNER']."','".$user['MAIN_OWNER_ID']."','$trans', '$ref' , '".$_SESSION['token']."','$user_id','','$opening', '$amount' ,'$closing','$fund','$msg',
    '','$ip_address','$browser','$os','$device','','$date','$time','$country','$region',
    '$city','$zip','','','$api_ip_address','$isp','$org','$msg','$time_stamp' , '$wallet_type', '$overallmainbal' ,  '$overallaepsbal')");
    
    //INSERT INTO `report`(`OWNER`, `OWNER_ID`, `TRANS_TYPE`, `REFERENCE_ID` ,`TOKEN_ID`, `USER_ID`, `TRANSFER_USER_ID`, `PREVIOUS_AMOUNT`, `AMOUNT`, `AFTER_AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`) VALUES ('','','$trans', '$ref' , '','$user_id','','$opening', '$amount' ,'$closing','$fund','$msg', '','$ip_address','$browser','$os','$device','','$date','$time','$country','$region', '$city','$zip','','','$api_ip_address','$isp','$org','$msg')
    
    
}


function insert_allreport_for_admin($user_id  ,$ref , $trans , $opening  , $closing , $amount , $fund , $msg, $ip_address, $device){
    global $con;
    
date_default_timezone_set('Asia/kolkata');    
$timezone = date_default_timezone_get();    
$date = date("Y-m-d");
$time = date("g:i:s A");
$time_stamp = date("Y-m-d H:i:s");

$browser = "Mobile App";
$os = "Android OS";


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

     $total_main = $con->query("SELECT  SUM(MAIN_BAL) FROM `user`")->fetch_assoc();
     $total_aeps = $con->query("SELECT  SUM(AEPS_BAL) FROM `user`")->fetch_assoc();
    $overallmainbal = $total_main['SUM(MAIN_BAL)'];
    $overallaepsbal = $total_aeps['SUM(AEPS_BAL)'];

$user = $con->query("select * from admin where ID='$user_id'")->fetch_assoc();
        $con->query("INSERT INTO `report`(`OWNER`, `OWNER_ID`, `TRANS_TYPE`, `REFERENCE_ID` ,`TOKEN_ID`, `USER_ID`, `TRANSFER_USER_ID`, `PREVIOUS_AMOUNT`,
    `AMOUNT`, `AFTER_AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, 
    `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`, `DATE`) 
    VALUES
    ('Admin','1','$trans', '$ref' , '".$user['TOKEN_ID']."','$user_id','','$opening', '$amount' ,'$closing','$fund','$msg',
    '','$ip_address','$browser','$os','$device','','$date','$time','$country','$region',
    '$city','$zip','','','$api_ip_address','$isp','$org','$msg','$time_stamp', '$wallet', '$overallmainbal' ,  '$overallaepsbal')");
}


?>