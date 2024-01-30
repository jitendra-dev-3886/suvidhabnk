<?php
include("func.php");
    include("../includes/config.php");
// $data = "eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyZWZubyI6IjE2Mjc5Nzg4Njk0NDAiLCJ0eG5pZCI6IjUzODQiLCJzdGF0dXMiOiIxIiwibW9iaWxlIjoiODY0MDAwMDExOCIsInBhcnRuZXJpZCI6IlBTMDAxNzIiLCJtZXJjaGFudGNvZGUiOiJXQUdFMSIsImJhbmsiOnsiQmFuay0xIjoxfX0.qlt81z9rT0tlmUWdijZepNBzNWzJSRCXbezOji3dtVw";
// $ar = decode();

// decode();
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
    $us = $con->query("select * from aeps_merchant where status='1' and mobile='$mobile' and merchantcode='$mc_code'")->num_rows;
    if($us == 0 ){
    $con->query("INSERT INTO `aeps_merchant`(`refno`, `txnid`, `status`, `mobile`, `partnerid`, `merchantcode`, `is_icici_kyc`, `Timestamp`) VALUES ('$ref','$txn',
    '$status','$mobile','$partnerid','$mc_code','$ic_kyc','$time')");
    echo "You successfully registered";
    }else{
        echo "you already registered";
    }
}

?>