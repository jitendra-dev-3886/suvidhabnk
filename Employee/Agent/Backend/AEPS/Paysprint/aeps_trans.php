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
    
    $olddt = $con->query("select * from aeps_merchant where MERCHANTCODE='$mc_code' ");
    if($olddt->num_rows != 0){
        $con->query("update `aeps_merchant` set `REF_NO`='$ref' , `TXN_ID`='$txn' , `STATUS`='$status' , `PARTNERID`='$partnerid' , `IS_ICICI_KYC`='$ic_kyc' , `TIMESTAMP`='$time' where  MERCHANTCODE='$mc_code' ");
        $apmr = $olddt->fetch_assoc();
    }
    else{
         $con->query("INSERT INTO `aeps_merchant`(`REF_NO`, `TXN_ID`, `STATUS`, `MOBILE`, `PARTNERID`, `MERCHANTCODE`, `IS_ICICI_KYC`, `TIMESTAMP`) VALUES ('$ref','$txn',
    '$status','$mobile','$partnerid','$mc_code','$ic_kyc','$time')");
    
        $olddt = $con->query("select * from aeps_merchant where MERCHANTCODE='$mc_code' ");
        $apmr = $olddt->fetch_assoc();
    }
    
    if($apmr['TYPE'] == "API"){
        $rdurl = $apmr['URL'];
         header("location: $rdurl?data=$data");
    }
    else{
        if($status == 1){
            $us = $con->query("select * from aeps_merchant where status='1' and mobile='$mobile' and merchantcode='$mc_code'")->num_rows;
            if($us == 0 ){
                header("location: ../../../Home?msg=You successfully registered");
            }else{
                header("location: ../../../Home?msg=You already registered");
            }
        }
        else{
             header("location: ../../../Home?msg=You onboarding is pending. Please try again.");
        }
    }
}

?>