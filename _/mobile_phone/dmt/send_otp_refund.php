<?php

include("../includes/config.php");
$base_url = "https://api.paysprint.in";

if(isset($_POST['refrence'])){
    
    $refrence = $_POST['refrence'];
    $ackno = $_POST['ackno'];
    
    
    include("../includes/fetch_data.php");
    include("../includes/main_function.php");

$curl = curl_init();

$data = json_encode(
            array(
                "referenceid"=>"$refrence",
                "ackno"=>"$ackno"
                )
            );
$tkn = create_token();
   

$curl = curl_init();
$tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL => "$base_url/api/v1/service/dmt/refund/refund/resendotp",
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
echo $response;
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else { 
    $rstl = json_decode($response);
    $rs_code = $rstl->response_code; 
    $msg = $rstl->message;
}
    
}



?>