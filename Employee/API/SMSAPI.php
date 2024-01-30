<?php

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

          
  $num = 6289195314;
  $message = urlencode("Your OTP verification code is 4265. Do not share it with anyone. TEAM CYBDEER");
  $tempid = 1307162488475711397;

sendSMS($num,$message,$tempid);
?>






