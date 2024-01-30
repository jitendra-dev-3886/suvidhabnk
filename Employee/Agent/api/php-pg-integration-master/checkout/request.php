<?php
include_once("../../../../Db/config.php");
?>


<!DOCTYPE html>
<html>
<head>
  <title>Cashfree - Signature Generator</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body onload="document.frm1.submit()">


<?php 


$n=20;
function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}
 
$a=getName($n);
$orderIdd="SUVID".mt_rand(1000,9999);


$orderId=$orderIdd.$a;


$mode = "PROD"; //<------------ Change to TEST for test server, PROD for production

$clientID = "218328201f9655106e2614470e823812";
// $clientID = "1793681c587d04b3e094b57758863971";
$appId=$clientID;
// $orderId="SUVID".mt_rand(1000,9999);
$orderCurrency="INR";
// $orderNote="Payment for Recharge Wallet.";
$returnUrl="https://suvidhabnk.com/Agent/api/php-pg-integration-master/checkout/response.php";
$notifyUrl="https://suvidhabnk.com/Agent/api/php-pg-integration-master/checkout/response.php";

extract($_POST);
  $secretKey = "ce6d2be6d1c250f8c77b727abcc1839e3696b98c";
//   $secretKey = "03aad79a42df46d8e0145c5b1ff76512ec3440ec";
  $postData = array( 
  "appId" => $appId, 
  "orderId" => $orderId,
  "orderAmount" => $orderAmount, 
  "orderCurrency" => $orderCurrency, 
  "orderNote" => $orderNote, 
  "customerName" => $customerName, 
  "customerPhone" => $customerPhone, 
  "customerEmail" => $customerEmail,
  "returnUrl" => $returnUrl, 
  "notifyUrl" => $notifyUrl,
);
ksort($postData);
$signatureData = "";
foreach ($postData as $key => $value){
    $signatureData .= $key.$value;
}
$signature = hash_hmac('sha256', $signatureData, $secretKey,true);
$signature = base64_encode($signature);

if ($mode == "PROD") {
  $url = "https://www.cashfree.com/checkout/post/submit";
  $con->query("INSERT INTO `wallet_cashfree`(`USER_ID`, `NAME`, `MOBILE`, `EMAIL`, `ORDER_ID`, `ORDER_AMOUNT`, `ORDER_NOTE`, `REFERENCE_ID`, `TRANSACTION_STATUS`, `PAYMENT_MODE`, `MESSAGE`, `TRANSACTION_TIME`) VALUES ('$usid' , '$customerName', '$customerPhone', '$customerEmail', '$orderId', '$orderAmount', '$orderNote', '', 'Pending', '', '', '')");
} else {
  $url = "https://test.cashfree.com/billpay/checkout/post/submit";
  $con->query("INSERT INTO `wallet_cashfree`(`USER_ID`, `NAME`, `MOBILE`, `EMAIL`, `ORDER_ID`, `ORDER_AMOUNT`, `ORDER_NOTE`, `REFERENCE_ID`, `TRANSACTION_STATUS`, `PAYMENT_MODE`, `MESSAGE`, `TRANSACTION_TIME`) VALUES ('$usid' , '$customerName', '$customerPhone', '$customerEmail', '$orderId', '$orderAmount', '$orderNote', '', 'Pending', '', '', '')");
}



?>
  <form action="<?php echo $url; ?>" name="frm1" method="post">
      <p>Please wait.......</p>
      <input type="hidden" name="signature" value='<?php echo $signature; ?>'/>
      <input type="hidden" name="orderNote" value='<?php echo $orderNote; ?>'/>
      <input type="hidden" name="orderCurrency" value='<?php echo $orderCurrency; ?>'/>
      <input type="hidden" name="customerName" value='<?php echo $customerName; ?>'/>
      <input type="hidden" name="customerEmail" value='<?php echo $customerEmail; ?>'/>
      <input type="hidden" name="customerPhone" value='<?php echo $customerPhone; ?>'/>
      <input type="hidden" name="orderAmount" value='<?php echo $orderAmount; ?>'/>
      <input type ="hidden" name="notifyUrl" value='<?php echo $notifyUrl; ?>'/>
      <input type ="hidden" name="returnUrl" value='<?php echo $returnUrl; ?>'/>
      <input type="hidden" name="appId" value='<?php echo $appId; ?>'/>
      <input type="hidden" name="orderId" value='<?php echo $orderId; ?>'/>
  </form>
</body>
</html>
