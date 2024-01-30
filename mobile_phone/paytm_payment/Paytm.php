<?php

$code = $_POST['code'];  // get sample text for phone auth

$mid = $_POST['MID'];
$orderid = $_POST['ORDER_ID'];
$amount = $_POST['AMOUNT'];

$mid = stripslashes($mid);
$orderid = stripslashes($orderid);
$amount = stripslashes($amount);

if ($code == "12345") {
            
            include("../includes/config.php");
            $merchant = $con->query("SELECT * FROM `paytm_merchant` WHERE STATUS='ACTIVE'")->fetch_assoc(); 
            $merchant_id =  $merchant['MERCHANT_ID'];
            $merchant_key =  $merchant['MERCHANT_KEY'];
            $mid = $merchant_id;
        

    /* import checksum generation utility */

    require_once("./Paytm_CheckSum.php");

  $paytmParams = array();


    //  VALUES TO BE SET ON ARRAY WITH MANDATORY OR OPTIONAL PARAMS
    $paytmParams["body"] = array(


        "requestType"  => "Payment",
        "mid"   => $mid,
        "websiteName" =>  "hrcmulti",
        "orderId"  =>  $orderid,
        "callbackUrl" =>  "https://merchant.com/callback",
        "txnAmount"  => array(

            "value"  => $amount,
            "currency" => "INR",


        ),
        "userInfo"  => array (

            "custId"  => "CUST_001",

        ),

        );

    /**
     * Generate checksum by parameters we have
     * Find your Merchant Key in your Paytm Dashboard at https://dashboard.paytm.com/next/apikeys 
     */

     

    $paytmChecksum = PaytmChecksum::generateSignature(json_encode($paytmParams["body"], JSON_UNESCAPED_SLASHES), $merchant_key);
    // echo sprintf("generateSignature Returns: %s\n", $paytmChecksum);


    $paytmParams["head"] = array (

        "signature" => $paytmChecksum,

    ) ;

// creating post data
$post_data = json_encode($paytmParams,JSON_UNESCAPED_SLASHES);



/* for Staging */
// $url = "https://securegw-stage.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$orderid";

/* for Production */
$url = "https://securegw.paytm.in/theia/api/v1/initiateTransaction?mid=$mid&orderId=$orderid";


$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));  

$responce = curl_exec($ch);


$responce = json_decode($responce);
            $myArr = array(
                "token_res" =>$responce,
                "merchant_id" =>$merchant_id,
                );
            echo json_encode($myArr);


}

?>
