<?php
// session_start();
include("../Db/config.php");
// $usid=$_SESSION["UsId"];




// OTP Send Message

function sendSMS91($mobile,$otp){
    global $con;
    $url = "https://api.msg91.com/api/v5/otp?template_id=634ff801d6fc0518e35cb622&mobile=91$mobile&authkey=382881At0Bq1YDLu4j632c2325P1&otp=$otp";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        )
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`)
        VALUES ('SMS','SMS API','$tmp_id','Registration','$url','$response')");
    // return $response;
}


// $mobile=7003660613;
// $otp="1234567989";
// print_r(sendSMS91($mobile,$otp));













// Passwrord  change otp from profile

function send_pass_profile($mobile,$otp){
    global $con;
    $url = "https://api.msg91.com/api/v5/otp?template_id=634ff801d6fc0518e35cb622&mobile=91$mobile&authkey=382881At0Bq1YDLu4j632c2325P1&otp=$otp";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        )
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`)
        VALUES ('SMS','SMS API','$tmp_id','Registration','$url','$response')");
    // return $response;
}







function send_login_ip($mobile,$otp){
    global $con;
    $url = "https://api.msg91.com/api/v5/otp?template_id=634ff801d6fc0518e35cb622&mobile=91$mobile&authkey=382881At0Bq1YDLu4j632c2325P1&otp=$otp";

    $curl = curl_init();
    curl_setopt_array($curl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
        )
    ));
    $response = curl_exec($curl);
    curl_close($curl);

    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`)
        VALUES ('SMS','SMS API','$tmp_id','Registration','$url','$response')");
    // return $response;
}

?>




