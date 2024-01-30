<?php


include("../includes/config.php");
include("../includes/fetch_data.php");
include("../includes/main_function.php");

$base_url = "https://api.paysprint.in";


if(isset($_POST['op'])){
    $operator = $_POST['op'];
    $canumber = $_POST['num'];
    $data = json_encode(array(
         "operator"=>$operator,
         "canumber"=> $canumber,
         "mode"=>"online"
    ));
     
    $tkn = create_token();
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => $paysprint['URL']."/api/v1/service/bill-payment/bill/fetchbill",
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
}



?>