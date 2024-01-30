<?php
session_start();
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../../include/Auth.php");
// exit;
 $us = $con->query("select * from aeps_merchant where MERCHANTCODE='".$paysprint['MERCHANT_CODE'].$usid."' and STATUS='1'")->num_rows;
 $us_dt = $con->query("select * from aeps_merchant where MERCHANTCODE='".$paysprint['MERCHANT_CODE'].$usid."'")->fetch_assoc();
 
if($us_dt['STATUS'] != 1){
 $us_dt = $con->query("select * from user where ID='$usid'")->fetch_assoc();
 
$curl = curl_init();

$data = array(
    "merchantcode"=> $paysprint['MERCHANT_CODE'].$usid,
    "mobile" => $us_dt['MOBILE'],
    "is_new" =>0,
    "email"=>$us_dt['EMAIL'],
    "firm"=>$paysprint['FIRM'],
    "callback"=> "https://".$_SERVER['HTTP_HOST']."/Agent/Backend/AEPS/Paysprint/aeps_trans"
    );
$data_str = json_encode($data , true);
    // echo $data_str;
    // exit;

$token = create_token();

curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/onboard/onboard/getonboardurl",
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
    "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
    "Token:".$token
  ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
// echo $response;exit;
curl_close($curl);
      echo "<h1 style='text-align:center; margin-top:20px;'>Redirecting.. Please do not refresh the page</h1>";

  $rs = json_decode($response , true);
  $response_code = $rs['response_code'];
  $url = $rs['redirecturl'];
    $msg = str_replace("'" ,"\'", $rs['message']);
    $msg = str_replace("\n" ," ", $msg);
  if($response_code == 1){
      header("location:$url");
         echo "<script>
          location.replace('$url');
      </script>";
  }else{
      echo "<script>alert('$msg')
          location.replace('../../../Home');
      </script>";
  }
}

else{
    header("location:../../../AEPS");
}

?>
