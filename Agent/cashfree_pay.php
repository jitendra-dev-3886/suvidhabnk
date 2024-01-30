<?php
session_start();
include("../Db/config.php");
$my_id = $_SESSION["UsId"];
$amount=100;
$usid=12345;
$username='Samrat Sahana';
$usemail='samrat@gmail.com';
$usnumber="7003660613";
// $amount=$_POST['amount'];
// $usid=$_POST['usid'];
// $username=$_POST['usname'];
// $usemail=$_POST['usemail'];
// $usnumber=$_POST['usnumber'];

$random=rand(1000,9999);
$url = "https://sandbox.cashfree.com/pg/orders";
$clientID = "1793681c587d04b3e094b57758863971" ;
$secret = "03aad79a42df46d8e0145c5b1ff76512ec3440ec";

$data = json_encode([
  "order_id"=> "SUVIDHA$random",
  "order_amount"=> $amount,
  "order_currency"=> "INR",
  "order_note"=> "Additional order info",
  "customer_details"=> [
  "customer_id"=> "SUVIDA$usid",
  "customer_name"=> "$username",
  "customer_email"=> "$usemail",
   "returnUrl" => "https://suvidhabnk.com/Agent/index", 
  "notifyUrl" => "https://suvidhabnk.com/Agent/index",
  "customer_phone"=> "$usnumber"
  ]
  
],true);

// echo $data;
 
//dikhate hai
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    "Content-Type: application/json",
    "x-api-version: 2022-01-01",
    "x-client-id: $clientID",
    "x-client-secret: $secret"

));

$response=curl_exec($ch);
echo $response; 

// $decode=json_decode($response);


?>