<?php

include("../includes/config.php");
$base_url = "https://api.paysprint.in";

$status = false;
$time = date("Y-m-d g:i:s A");
// register user

// send otp for registeration
if(isset($_POST['id'])){
    
$mb = $_POST['mobile'];
$id = $_POST['id'];

include("../includes/fetch_data.php");
include("../includes/main_function.php");

$tkn = create_token();

$curl = curl_init();
// echo $tkn;
// exit;
curl_setopt_array($curl, [
  CURLOPT_URL => "$base_url/api/v1/service/dmt/remitter/queryremitter",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => "{\"mobile\":\"$mb\",\"bank3_flag\":\"yes\"}",
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
if ($err) {
  echo json_encode(array("error"=>"cURL Error #: " . $err));
} else {
  $rstl = json_decode($response);
  $rs_code = $rstl->response_code; 
  $msg = $rstl->message; 
  if($rs_code == 1){
        $sql = "UPDATE `dmt_user` SET RESPONSE='$response' WHERE ID='$id'";
        mysqli_query($con, $sql);
  }
}

}







// if(isset($_POST['id'])){
// $mb = $_POST['mobile'];
// $id = $_POST['id'];


// include("../includes/config.php");
// include("../includes/fetch_data.php");
// include("../includes/main_function.php");

// $tkn = create_token();

// $curl = curl_init();
// // exit;
// curl_setopt_array($curl, [
//   CURLOPT_URL => "$base_url/api/v1/service/dmt/remitter/queryremitter",
//   CURLOPT_RETURNTRANSFER => true,
//   CURLOPT_ENCODING => "",
//   CURLOPT_MAXREDIRS => 10,
//   CURLOPT_TIMEOUT => 30,
//   CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//   CURLOPT_CUSTOMREQUEST => "POST",
//   CURLOPT_POSTFIELDS => "{\"mobile\":\"$mb\",\"bank3_flag\":\"yes\"}",
//   CURLOPT_HTTPHEADER => [
//     "Accept: application/json",
//     "Content-Type: application/json",
//     "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
//     "Token: ".$tkn
//   ],
// ]);

// $response = curl_exec($curl);
// $err = curl_error($curl);

// curl_close($curl);
// echo $response;
// if ($err) {
//   echo json_encode(array("error"=>"cURL Error #: " . $err));
// } else {
//   $rstl = json_decode($response);
//   $rs_code = $rstl->response_code; 
//   $msg = $rstl->message; 
//   if($rs_code == 1){
//         // $sql = "UPDATE `dmt_user` SET RESPONSE='$response' WHERE ID='$id'";
//         // mysqli_query($con, $sql);
//   }
// }

// }



?>