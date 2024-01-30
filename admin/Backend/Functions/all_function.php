<?php


//Filter the post value
function filterVal($value){
        global $con;
        $filterVal = trim($value);
        $filterVal = strip_tags($filterVal);
        $filterVal = mysqli_real_escape_string($con , $filterVal);
        $filterVal = substr($filterVal  , 0 , 15);
        return $filterVal;
}

function SendMail($email,$message , $subject){
    // Mailid from email will send
    $headers = 'From: do-not-reply@suvidhabnk.com' . "\r\n" .
      'Reply-To: do-not-reply@suvidhabnk.com' . "\r\n" .
      'X-Mailer: PHP/' . phpversion();
    
    // Send the email
    if(mail($email, $subject, $message, $headers)) {
      return true;
    }
    else {
        return false;
    }
}
// send sms to mobile 
function sendSMS($mobile, $message , $tmp_id){
$curl = curl_init();
curl_setopt_array($curl, array(
  CURLOPT_URL => "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=dGWLwo1U5EeBbUyyYk8HHA&senderid=PYDEER&channel=2&DCS=0&flashsms=0&number=$mobile&text=$message&route=31&EntityId=1701159490022304950&dlttemplateid=$tmp_id",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'GET',
));
$response = curl_exec($curl);
curl_close($curl);
return $response;
}
// used to encrypt values
function encrypt_token($simple_string){
    $ciphering = "AES-128-CTR";
    $options   = 0;
    $encryption_iv = 'ThisIsSecretKeyForEncrytionByJisneYeBnaya!@#$%^&*()';
    $encryption_key = "WebSpidy";
    $encryption = openssl_encrypt($simple_string, $ciphering, $encryption_key, $options, $encryption_iv);
    return base64_encode($encryption);
}

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
    $rand = mt_rand(9999 , 100000);
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

// for create cashfree token
function create_cashfree_token()
{
    $url = "https://payout-api.cashfree.com/payout/v1/authorize";
    $clinetsecret = "4bf64704ae5bea311f93605806b901c6c3323676";
    $clinetkey = "CF172708C7SGG3HQE0NUFQ6GCLR0";

    $headers = array(
        'Content-Type:application/json',
        'X-Client-Secret:'.$clinetsecret,
        'X-Client-Id:'.$clinetkey
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $rspns = json_decode($result , true);
    $token  = $rspns['data']['token'];
    return $token;
    // echo $token;
    // //verify token
    // $url = "https://payout-api.cashfree.com/payout/v1/verifyToken";
    // $headers = array(
    //     'Content-Type:application/json',
    //     'Authorization: Bearer '.$token
    // );
    // $ch = curl_init();
    // curl_setopt($ch, CURLOPT_URL, $url);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_POST, true);
    // curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    // $result = curl_exec($ch);
    // echo $result;
}

function create_cashfree_token_cac()
{

    $url = "https://cac-api.cashfree.com/cac/v1/authorize";
    $clinetsecret = "8bcab1d5a9ec7814de14c2580b62b059d2992060";
    $clinetkey = "CF172708L80NZWPSF4AEA2Y";

    $headers = array(
        'Content-Type:application/json',
        'X-Client-Secret:'.$clinetsecret,
        'X-Client-Id:'.$clinetkey
    );
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $rspns = json_decode($result , true);
    $token  = $rspns['data']['token'];
    // return $result;
    return $token;
    
}



// signzy authentication funciton 
function getsignzyAuth()
{
    global $paysprint;

    $url = "https://preproduction.signzy.tech/api/v2/patrons/login";
    $username = "cybdeer_test";
    $password = "WCmn351vEoQjgmMFTlgI";
    
     $data = json_encode([
        "username" => $username,
        "password" => $password
    ]);
    
    $headers = array(
        'Content-Type:application/json'
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $rspns = json_decode($result , true);
    $token  = $rspns['id'];
    return $rspns;
}

function getsignzyAuthLive()
{
    global $con;
    global $paysprint;
    
    $url = "https://signzy.tech/api/v2/patrons/login";
    $username = "cybdeer_prod";
    $password = "jE27ydof7K2yC415F8iS";
    
     $data = json_encode([
        "username" => $username,
        "password" => $password
    ]);
    
    $headers = array(
        'Content-Type:application/json'
    );
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $rspns = json_decode($result , true);
    $token  = $rspns['id'];
    return $rspns;
}


//insert all report of the txn


function insert_allreport($user_id  ,$ref , $trans , $opening  , $closing , $amount , $fund , $msg , $wallet){
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
    '$city','$zip','','','$api_ip_address','$isp','$org','$msg','$time_stamp' , '$wallet', '$overallmainbal' ,  '$overallaepsbal')");
    
    
}


?>