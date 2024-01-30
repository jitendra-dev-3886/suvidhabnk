<?php

include("../includes/config.php");
$base_url = "https://api.paysprint.in";
$time = date("Y-m-d g:i:s A");

if(isset($_POST['dmt_mobile'])){


$id = $_POST['id'];
$usertype_id = $_POST['usertype_id'];
include("../includes/fetch_data.php");
include("../includes/main_function.php");
    

    $dmt_mb = $_POST['dmt_mobile'];
    $user_id = $_POST['user_id'];
    $acc=  $_POST['acc'];
    
    
    $bene = $con->query("SELECT * FROM `dmt_beneficiary` WHERE ACCOUNT='$acc' AND MOBILE = '$dmt_mb'")->fetch_assoc();
    
    $details =  json_decode($bene['RESPONSE']);
    $details = $details->data;

   $mobile = $dmt_mb;
   $accno = $acc;
   $bankid = $details->bankid;
   $benename = $details->name;
   $referenceid = rand();
   $pincode = $bene['PIN'];
   $addresss = $bene['ADDRESS'];
   $dob = $bene['DOB'];
   $bene_id = $details->bene_id;
    
    $tkn = create_token();
    $curl = curl_init();
    $data = json_encode(array(
        "mobile"=>"$mobile",
        "accno"=>"$accno",
        "bankid"=>"$bankid",
        "benename"=>"$benename",
        "referenceid"=>"$referenceid",
        "pincode"=>"$pincode", 
        "address"=>"$addresss", 
        "dob"=>"$dob",  
        "gst_state"=>"07",
        "bene_id"=>"$bene_id"
    ));
    


curl_setopt_array($curl, [
  CURLOPT_URL => "$base_url/api/v1/service/dmt/beneficiary/registerbeneficiary/benenameverify",
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
    $my_data = $rstl->data;
}


}


?>