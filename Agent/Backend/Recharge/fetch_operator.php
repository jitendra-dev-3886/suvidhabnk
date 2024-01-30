<?php

include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");

$curl = curl_init();

       $tkn = create_token();
    //   echo $tkn;
    //   exit;
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/recharge/recharge/getoperator",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $data,
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
        "Content-Type: application/json",
        "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
        "Token: ".$tkn
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);
echo $response;


?>