<?php

include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");


$json = file_get_contents('php://input');
$data = json_decode($json, true);
if($data!="" || $data!=null){
    extract($data);
}


$requestBody = '[{"merchantTransactionId":"SUV5eWqJ6flZh1668251950756","fingpayTransactionId":"MACB4305778121122165012082S","transactionRrn":"231616058315","responseCode":"00","transactionDate":"21-11-2022","serviceType":"CW"}]';




hitrecon($requestBody);
exit();

function hitrecon($requestBody){
        $method = "POST"; // Method

        $simpleString = "Suvidhaad322d8298cdc16350fdc6d7cb0d9835e67354b87c93a427b602b44f069e0d875f";
        $hashgen = base64_encode(hash("sha256", $requestBody.$simpleString, TRUE));
        $header = ['txnDate:'.date('Y/m/d H:i:s'),
            'hash:'.$hashgen,
            'superMerchantLoginId:Suvidhaad',
            'superMerchantid:969',
            'Content-Type: text/plain'];
        


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fpanalytics.tapits.in/fpcollectservice/api/ma/threeway/aggregators",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $requestBody,
            CURLOPT_HTTPHEADER => $header
        ));
        $result = curl_exec($curl);
        $array = json_decode($result, true);
        
        echo json_encode(['header'=>$header, 'request'=>$requestBody, 'response'=>$array ,'hash'=>$hashgen, 'concatstr'=>$requestBody.$simpleString]);
        exit;
        
        return $result;
        
}
?>