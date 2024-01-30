<?php


/*
* import checksum generation utility
* You can get this utility from https://developer.paytm.com/docs/checksum/
*/




require_once("PaytmChecksum.php");
if(isset($_POST['amount'])){
    $date1 = date("Y-m-d H:i:s");
    $amount = $_POST['amount'];
    $bank = $_POST['bank'];
    $ifsc = $_POST['ifsc'];
    $date = date("Y-m-d");
    $time = date("Y-m-d g:i:s A");
    $trans_type = $_POST['trans'];
    $id = $_POST['id'];
    $usertype_id = $_POST['usertype_id'];
    $ip_address = $_POST['ip_address'];
    $device = $_POST['device'];
    include("../includes/fetch_data.php");
    // echo $_POST['ifsc'];
    
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

include("../includes/config.php");
include("../dmt/dmt_function.php");
include("../includes/main_function.php");
include("../includes/fetch_data.php");


// $insert_report = "INSERT INTO `paytm_payout`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `USER_ID`, `OWNER_ID`, `AMOUNT`, `ACCOUNT`, `IFSC`, `REFFRENCE_ID`, `TRANS_TYPE`, `DATE`) 
// VALUES ('Admin','1','$id','".$user['OWNER_ID']."','$amount','$bank','$ifsc','$od','$trans_type','$date1')";

$ownerMy = $user['MAIN_OWNER'];
$ownerIdmy = $user['OWNER_ID'];
$insert_report = "INSERT INTO `dmt_transactions`(`OWNER`,`OWNER_ID`,`USER_ID`, `USER_TYPE`, `MOBILE`, `BENE_ID`, `ACCOUNT`, `TIMESTAMP`, `AMOUNT`, `TRANS_TYPE`, `REFFRENCE_ID`)
VALUES ('$ownerMy','$ownerIdmy','$id','$usertype_id','$mobile','$id','$bank','$time','$amount','$trans_type','$od')";

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
              $status = $rstl->status; 
              $msg = $rstl->statusMessage;
              $code = $rstl->statusCode;
             
             
             
             
             
             if($code=="DE_002"){
                 
             $myArr = array(
                "status" =>true,
                "message" =>"Success",
                "response_code"=>1
            );
            $detail = json_encode($myArr);
                 
                        $con->query("update dmt_transactions set RESPONSE='".str_replace("'" , "\'" , $detail)."'  , STATUS='$msg' where REFFRENCE_ID='$od' ");
                        give_dmt_com($od , $id ,$usertype_id, $ip_address, $device);
                        insert_allreport($id  ,$od , "DMT" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "DMT Transaction", $ip_address, $device);
             }else{
                 
                $myArr = array(
                "status" =>false,
                "message" =>"Failed",
                "response_code"=>999
                    );
            $detail = json_encode($myArr);
                 
                 
                 $con->query("update dmt_transactions set RESPONSE='".str_replace("'" , "\'" , $detail)."'  , STATUS='$msg' where REFFRENCE_ID='$od' ");
                $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$id' and USER_TYPE='$usertype_id' ");
                insert_allreport($id  ,$od , "DMT" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $amount , "Debit" , "DMT Transaction", $ip_address, $device);
             }
             
    }
    else{
        echo json_encode(array("status"=>"Failed","statusCode"=>"102", "statusMessage"=>"You have not sufficient balance.. Please add balance."));
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
}
