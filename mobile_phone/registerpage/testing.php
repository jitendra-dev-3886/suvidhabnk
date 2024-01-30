<?php


include("../includes/configuration.php");
include("../../Agent/Backend/Functions/all_function.php");

$mobile = "8240193509";
$email = "iamalsksamar@gmail.com";

$mobile_otp = "12345";

$verify_day = date('Ymd');



$registrationToken = encrypt_token(json_encode(["mobile" => $mobile , "email" => $email , "mobile_otp" => $mobile_otp, "verify_day"=>$verify_day]));

echo $verify_day."<br>".$registrationToken;

?>