<?php
session_start();
/*
* import checksum generation utility
* You can get this utility from https://developer.paytm.com/docs/checksum/
*/
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);

include("../../../connection/config.php");
include("../../include/fetch_data.php");
// include("../paysprint/function/main_function.php");
include("../../../security/userInformation.php");
function insert_allreport($user_id  ,$ref , $trans , $opening  , $closing , $amount , $fund , $msg){
    global $con;
date_default_timezone_set('Asia/kolkata');    
$timezone = date_default_timezone_get();    
$date = date("Y-m-d");
$time = date("g:i:s A");
$time_stamp = date("Y-m-d H:i:s");
// $map_location = "https://maps.googleapis.com/maps/api/staticmap?center=".$lat.$lon."&zoom=14&size=400x300&sensor=false&key=YOUR_KEY";
$ip_address = UserInfo::get_ip();
$browser = UserInfo::get_browser();
$os = UserInfo::get_os();
$device = UserInfo::get_device();

// get details via ip using api
$ch=curl_init();
curl_setopt($ch,CURLOPT_URL,"http://ip-api.com/json/$ip_address");
curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
$result=curl_exec($ch);
$result=json_decode($result);
$country =  $result->country;
$region =  $result->regionName;
$city =    $result->city;
$zip =     $result->zip;
$api_ip_address = $result->query;
$isp = $result->isp;
$org = $result->org;


    $user = $con->query("select * from user where ID='$user_id'")->fetch_assoc();
    
    $con->query("INSERT INTO `report`(`OWNER`, `OWNER_ID`, `TRANS_TYPE`, `REFFRENCE_ID` ,`TOKEN_ID`, `USER_ID`, `TRANSFER_USER_ID`, `PREVIOUS_AMOUNT`,
    `AMOUNT`, `AFTER_AMOUNT`, `FUND_TYPE`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, 
    `COUNTRY`, `STATE`, `CITY`, `ZIP`, `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE`, `DATE`) 
    VALUES
    ('".$user['MAIN_OWNER']."','".$user['MAIN_OWNER_ID']."','$trans', '$ref' , '".$_SESSION['token']."','$user_id','','$opening', '$amount' ,'$closing','$fund','$msg',
    '','$ip_address','$browser','$os','$device','','$date','$time','$country','$region',
    '$city','$zip','','','$api_ip_address','$isp','$org','$msg','$time_stamp')");
    
    
}
require_once("PaytmChecksum.php");
if(isset($_POST['amount'])){
    $date1 = date("Y-m-d H:i:s");
    $amount = $_POST['amount'];
    $bank = $_POST['bank'];
    $ifsc = $_POST['ifsc'];
    $date = date("Y-m-d");
    $trans_type = $_POST['trans'];
$paytmParams = array();

$od = substr(str_shuffle("qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890"), 0  , 10);

$paytmParams["subwalletGuid"]      = "aef9d3e6-7e18-40d6-853c-18c79c3d7f62";
$paytmParams["orderId"]            = "$od";
$paytmParams["beneficiaryAccount"] = $bank;
$paytmParams["beneficiaryIFSC"]    = $ifsc;
$paytmParams["amount"]             = $amount;
$paytmParams["purpose"]            = "SALARY_DISBURSEMENT";
$paytmParams["date"]               = $date;
$paytmParams["transferMode"]       = $trans_type;
// echo "<pre>";
// print_r($paytmParams);
$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);

$checksum = PaytmChecksum::generateSignature($post_data, "MZWA2bmZ1xx%@MJT");

$x_mid      = "BARNWA13981805932164";
$x_checksum = $checksum;

$insert_report = "INSERT INTO `paytm_payout`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `USER_ID`, `OWNER_ID`, `AMOUNT`, `ACCOUNT`, `IFSC`, `REFFRENCE_ID`, `TRANS_TYPE`, `DATE`) 
VALUES ('Admin','1','$id','".$user['OWNER_ID']."','$amount','$bank','$ifsc','$od','DMT,$trans_type','$date1')";

$user_bal = $user['MAIN_BAL']-$amount;
if($user_bal >= 0){
        $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$id' and USER_TYPE='$usertype_id'";
        if($con->query($insert_report) && $con->query($deduct_bal) ){
           $url = "https://dashboard.paytm.com/bpay/api/v1/disburse/order/bank";
                $ch = curl_init($url);
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "x-mid: " . $x_mid, "x-checksum: " . $x_checksum)); 
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
                $response = curl_exec($ch);
                echo $response;
                
              $rstl = json_decode($response);
            //   $rs_code = $rstl->response_code; 
              $status = $rstl->status; 
              $msg = $rstl->statusMessage;
             
              $con->query("update paytm_payout set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status $msg' where REFFRENCE_ID='$od' ");
                insert_allreport($id  ,$od , "Payout" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "Payout Transaction");
                
              if(strtolower($status) == "failure"){
                  $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$id' and USER_TYPE='$usertype_id' ");
              }
        }
        else{
            echo json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
        }
    }
    else{
        echo json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
    }




}


// update transaction status
if(isset($_POST['check_status'])){
$refrence = $_POST['ref_id'];
$curl = curl_init();
$paytmParams = array();
$paytmParams["orderId"] = "$refrence";

$post_data = json_encode($paytmParams, JSON_UNESCAPED_SLASHES);
$checksum = PaytmChecksum::generateSignature($post_data, "MZWA2bmZ1xx%@MJT");

$x_mid      = "BARNWA13981805932164";
$x_checksum = $checksum;

/* for Production */
$url = "https://dashboard.paytm.com/bpay/api/v1/disburse/order/query";

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json", "x-mid: " . $x_mid, "x-checksum: " . $x_checksum)); 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
$response = curl_exec($ch);
echo $response;
      $rstl = json_decode($response);
            //   $rs_code = $rstl->response_code; 
              $status = $rstl->status; 
              $msg = $rstl->statusMessage;
             
           $con->query("update paytm_payout set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status $msg' where REFFRENCE_ID='$refrence' ");
}
