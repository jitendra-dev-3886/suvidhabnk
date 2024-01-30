<?php
ob_start();
// require('func.php');
include("../../../../Db/config.php");

if(isset($_GET['data'])){
    $data  = $_GET['data'];
    
    $arr = json_decode(base64_decode(str_replace('_', '/', str_replace('-','+',explode('.', $data)[1]))));
    $ref = $arr->refno;
    $txn = $arr->txnid;
    $status = $arr->status;
    $mobile = $arr->mobile;
    $partnerid = $arr->partnerid;
    $mc_code = $arr->merchantcode;
    $ic_kyc = $arr->is_icici_kyc;
    $time = date("Y-m-d g:i:s A");
    if($ic_kyc == ""){
        $ic_kyc = 0;
    }
    $con->query("INSERT INTO `aeps_merchant`(`REF_NO`, `TXN_ID`, `STATUS`, `MOBILE`, `PARTNERID`, `MERCHANTCODE`, `IS_ICICI_KYC`, `TIMESTAMP`) VALUES ('$ref','$txn',
    '$status','$mobile','$partnerid','$mc_code','$ic_kyc','$time')");
    if($status == 1){
        $us = $con->query("select * from aeps_merchant where status='1' and mobile='$mobile' and merchantcode='$mc_code'")->num_rows;
        if($us == 0 ){
        header("location: ../../../Home?msg=You successfully registered");
        }else{
            // echo "you already registered";
        header("location: ../../../Home?msg=You already registered");
        }
    }
    else{
         header("location: ../../../Home?msg=You onboarding is pending. Please try again.");
    }
}

?>