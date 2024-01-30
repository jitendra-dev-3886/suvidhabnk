<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
require("function.php");
error_reporting(E_ALL);
ini_set("display_errors" , 1);
$time = date("Y-m-d g:i:s A");


//submit capture finger data
if(isset($_POST['aadhar'])){
    // echo "work";
          $timestamp = date("Y-m-d H:i:s");
      $time = date("g:i:s A");
      $date  = date("Y-m-d");
      $fptid = strip_tags($_POST['fptid']);
      $pkeyid = strip_tags($_POST['pkeyid']);
      $otp = strip_tags($_POST['otp']);
      $long = strip_tags($_POST['long']);
      $lati = strip_tags($_POST['lat']);
    
    $rtData = $con->query("select * from user where ID='".$usid."'")->fetch_assoc();
    $merchnt =$rtData['MOBILE'];
      
    $refrence = "SVDAP".$usid.date("md").date("is");

    $time = date("Y-m-d g:i:s A");
    
    $apuser = $con->query("select * from fing_aeps_merchant where MOBILE='$merchnt' and STATUS='pending' order by ID DESC limit 1")->fetch_assoc();
    
    //finger data decoding 
      $finger = $_POST['fingerData'];
         $xml = simplexml_load_string($finger , "SimpleXMLElement", LIBXML_NOCDATA);
        $json = json_encode($xml);
        $fingerar = json_decode($json , true);
        // echo $finger;
        if($finger == ""){
              echo json_encode(array("statuscode"=>  500 , "status"=>"Finger Not Scanned."));
              exit;
        }
        foreach($xml->Data as $obj){
            $datatype = $obj->attributes()->type;
        }
         $datatypejsn = json_encode($datatype);
        $datatypear = json_decode($datatypejsn , true);
        
        foreach($xml->Skey as $obj){
            $citype = $obj->attributes()->ci;
        }
             $citypejsn = json_encode($citype);
        $citypear = json_decode($citypejsn , true);
    
    
    
    $arr = '{
             "superMerchantId": 969,
             "merchantLoginId": "'.$apuser['MERCHANTCODE'].'",
             "otp" : "'.$otp.'" ,
             "primaryKeyId" : '.$pkeyid.' ,
             "encodeFPTxnId" : "'.$fptid.'",
             "requestRemarks": "test",
             "cardnumberORUID":
                 {
                     "nationalBankIdentificationNumber": null,
                     "indicatorforUID": "0",
                     "adhaarNumber": "'.$apuser['AADHAAR'].'"
                 },
             "captureResponse": 
                     {
                         "errCode": "'.$fingerar['Resp']['@attributes']['errCode'].'",
                         "errInfo": "'.$fingerar['Resp']['@attributes']['errInfo'].'",
                         "fCount": "'.$fingerar['Resp']['@attributes']['fCount'].'",
                         "fType": "'.$fingerar['Resp']['@attributes']['fType'].'",
                         "iCount": "0",
                         "iType": null,
                         "pCount": "0",
                         "pType": "0",
                         "nmPoints": "'.$fingerar['Resp']['@attributes']['nmPoints'].'",
                         "qScore": "'.$fingerar['Resp']['@attributes']['qScore'].'",
                         "dpID": "'.$fingerar['DeviceInfo']['@attributes']['dpId'].'",
                         "rdsID": "'.$fingerar['DeviceInfo']['@attributes']['rdsId'].'",
                         "rdsVer": "'.$fingerar['DeviceInfo']['@attributes']['rdsVer'].'",
                         "dc": "'.$fingerar['DeviceInfo']['@attributes']['dc'].'",
                         "mi": "'.$fingerar['DeviceInfo']['@attributes']['mi'].'",
                         "mc":"'.$fingerar['DeviceInfo']['@attributes']['mc'].'",
                         "ci": "'.$citypear[0].'",
                         "sessionKey":"'.$fingerar['Skey'].'",
                         "hmac": "'.$fingerar['Hmac'].'",
                         "PidDatatype": "'.$datatypear[0].'",
                         "Piddata":"'.$fingerar['Data'].'"
                     }
            }';
    // echo $arr;
//   echo "https://fpuat.tapits.in/fpekyc/api/ekyc/merchant/php/biometric";
        $response = hit("https://fpekyc.tapits.in/fpekyc/api/ekyc/merchant/php/biometric" , $arr , 132412344563);
        
        $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','AepsEKYC','$refrence','$token','$arr','$response')");
        echo $response;
        // exit;
        $rslt = json_decode($response , true);
        $status = $rslt['status'];
        $stcode = $rslt['statusCode'];
        
        if($stcode == 10000){
            $con->query("update fing_aeps_merchant set  STATUS='Active' where MOBILE='$merchnt' and MERCHANTCODE='".$apuser['MERCHANTCODE']."'");
        }
}
