<?php

include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
// include("../Auth/userdata.php");


// ********country list show code here*******
$tkn = get_travel_token();
$enduserip = $_SERVER["REMOTE_ADDR"];

function countrylist(){

$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.tektravels.com/SharedServices/SharedData.svc/rest/CountryList',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
  "TokenId": "'.$tkn.'",
  "ClientId": "ApiIntegrationNew",
  "EndUserIp": "'.$enduserip.'"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
// echo $response;

$xml = simplexml_load_string($response);
$json = json_encode($xml);

return $json;
}

// ********city list show code here*******

if(isset($_POST["type"]) && $_POST["type"] == "citylist"){
    
    $curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'http://api.tektravels.com/SharedServices/StaticData.svc/rest/GetDestinationSearchStaticData',
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS =>'{
"EndUserIp":"101.53.133.96" ,
"TokenId":"1053e0d3-2e28-4a28-ae63-7a2fa8aa1ef8",
"CountryCode" :"IN",
"SearchType"  :"1"
}',
  CURLOPT_HTTPHEADER => array(
    'Content-Type: application/json'
  ),
));

$response = curl_exec($curl);

curl_close($curl);
echo $response;
}

?>