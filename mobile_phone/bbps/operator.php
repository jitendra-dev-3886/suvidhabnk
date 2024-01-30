<?php

require("sample.php");
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
 
// include("../../../connection/config.php");
// this line
// $key ='UFMwMDE5MTAwYTFmNjRlODRiY2ViZDc1NjcwMmI1NGUyYzk4Y2M2'; //  (provided by PAYSPRINT)
// $iv=   '4e5f0de7f9578c68';            //  (provided by PAYSPRINT)
// $datapost = $post;
// $cipher  =   openssl_encrypt(json_encode($datapost,true), 'AES-128-CBC', $key, $options=OPENSSL_RAW_DATA, $iv);
// $body=  base64_encode($cipher);

// requ
// GetOperators();
$base_url = "https://api.paysprint.in";

function GetOperators(){
// global $con;
$response = requestUrl(
  "$base_url/api/v1/service/bill-payment/bill/getoperator", 
  "{\"mode\":\"online\"}"
    );
// $responseArr = json_decode($response, true);
// $_SESSION['operators'] = $responseArr;
    return $response;
    // echo $response;
// $op_response = json_decode($response);
//  $op_data = $op_response->data;
// foreach($op_data as $op_details){
// $con->query("INSERT INTO `operator_list`(`OPERATOR_CODE`, `NAME`, `SERVICE`) VALUES ('".$op_details->id."','".$op_details->name."','".$op_details->category."')");
// }
}

// echo(GetOperators());


?>