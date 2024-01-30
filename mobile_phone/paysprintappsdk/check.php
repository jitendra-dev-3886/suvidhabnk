<?php

    include("../includes/config.php");
    include("func.php");
    $id = $_POST['id'];
    
    function en(){
    $rand = mt_rand(9999 , 100000);
    $time  = time();
    $data = array(
 "timestamp"=>$time, 
  "partnerId"=> "PS00172", 
  "reqid"=> "$rand"

);
  // Create token header as a JSON string
$header = json_encode(['typ' => 'JWT', 'alg' => 'HS256']);

// Create token payload as a JSON string
$payload = json_encode($data);

// Encode Header to Base64Url String
$base64UrlHeader = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

// Encode Payload to Base64Url String
$base64UrlPayload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

// Create Signature Hash
$signature = hash_hmac('sha256', $base64UrlHeader . "." . $base64UrlPayload, 'UFMwMDE3MjBkZDg3NTI4OWM1OGI5MDc3NThhZTFjODRlMzY2M2Iz', true);

// Encode Signature to Base64Url String
$base64UrlSignature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

// Create JWT
$jwt = $base64UrlHeader . "." . $base64UrlPayload . "." . $base64UrlSignature;

return $jwt;
}


 $us = $con->query("select * from aeps_merchant where merchantcode='WAGEINDIA".$id."' and STATUS='1'")->num_rows;
 $us_dt = $con->query("select * from aeps_merchant where merchantcode='WAGEINDIA".$id."'")->fetch_assoc();
// echo $us;
// echo $us_d
if($us == 0 && $us_dt['status'] != 2){
 $us_dt = $con->query("select * from user where ID='".$id."'")->fetch_assoc();
 
$curl = curl_init();

$data = array(
    "merchantcode"=> "WAGEINDIA".$id,
    "mobile" => $us_dt['MOBILE'],
    "is_new" =>0,
    "email"=>$us_dt['EMAIL'],
    "firm"=>"WAGEINDIA",
    "callback"=>"https://paytcash.in/mobile_phone/paysprintappsdk/aeps_trans.php"
    );
    
$data_str = json_encode($data , true);

$token = en();
curl_setopt_array($curl, [
  CURLOPT_URL => "https://paysprint.in/service-api/api/v1/service/onboard/onboard/getonboardurl",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data_str,
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
    "Content-Type: application/json",
    "Authorisedkey:ZjJkMjAwZjJjZjJkZmZkYjAyZTQzN2RiYjEyYzE1NDc=",
    "Token:".$token,
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);

curl_close($curl);
    //   echo $response;

if ($err) {
  echo "cURL Error #:" . $err;
} else {
  $rs = json_decode($response , true);
  $response_code = $rs['response_code'];
      $url = $rs['redirecturl'];
    $msg = $rs['message'];
  if($response_code == 1){
      echo $url;
  }else{
      echo $msg;
  }
}

}
else if($us_dt['status'] == 2){
    echo "Your Kyc is Pending. Please wait some time";
}
else{
    // echo "send it to the file pay_aeps.php";
    echo "Start AEPS";
}

?>