<?php

include("../includes/configuration.php");
include("../../Agent/Backend/Functions/all_function.php");
date_default_timezone_set("Asia/Kolkata");


if(isset($_POST['getBeneficairy'])){
    
    $accnum = $_POST['acc'];
    $ifsc = $_POST['ifsc'];
    
    getBeneficiaryId($accnum, $ifsc);
    
    
    
}





function getBeneficiaryId($acc, $ifsc){
    
    $url = "https://payout-api.cashfree.com/payout/v1/getBeneId?bankAccount=$acc&ifsc=$ifsc";
    $token = create_cashfree_token();
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $status = $response['status'];
    $msg = $response['message'];
    $beneId = $response['data']['beneId'];
    echo $beneId;
}


?>