<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
require("function.php");
// error_reporting(E_ALL);
// ini_set("display_errors" , 1);
$time = date("Y-m-d g:i:s A");



if(isset($_POST['pan'])){
      $timestamp = date("Y-m-d H:i:s");
      $time = date("g:i:s A");
      $date  = date("Y-m-d");
      $pan = strip_tags($_POST['pan']);
      $long = strip_tags($_POST['long']);
      $lati = strip_tags($_POST['lat']);
    
    $rtData = $con->query("select * from user where ID='".$usid."'")->fetch_assoc();
    $merchnt =$rtData['MOBILE'];
      
    $refrence = "SVDH".$usid.date("md").date("is");

    $time = date("Y-m-d g:i:s A");
    
    $arr = '{
    "username":"Suvidhaad",
    "password":"'.md5("1234d").'",
    "supermerchantId":969,
    "latitude":"'.$long.'",
    "longitude":"'.$lati.'",
    "merchants":[
        {
            "merchantLoginId":"SVDH'.$merchnt.'",
            "merchantLoginPin":"SVDH'.$merchnt.'",
            "merchantName":"'.$rtData['FIRST_NAME'].' '.$rtData['LAST_NAME'].'",
            "merchantPhoneNumber":"'.$merchnt.'",
            "companyLegalName":"",
            "companyMarketingName":"",
            "merchantBranch":"",
            "emailId":"",
            "merchantPinCode":"'.$rtData['PIN'].'",
            "tan":"",
            "merchantCityName":"'.$rtData['CITY'].'",
            "merchantDistrictName":"",
            "cancellationCheckImages":"",
            "shopAndPanImage":"",
            "ekycDocuments":"",
            "merchantAddress":{
                "merchantAddress":"'.$rtData['ADDRESS'].'",
                "merchantState": 8
            },
            "kyc":{
                "userPan":" '.$pan.' ",
                "aadhaarNumber":"",
                "gstInNumber":"",
                "companyOrShopPan":""
            },
            "settlement":{
                "companyBankAccountNumber":"",
                "bankIfscCode":"",
                "companyBankName":"",
                "bankBranchName":"",
                "bankAccountName":""
            }
        }
    ]
}';
            // echo $arr;
        $user = $con->query("select * from user  where ID='$usid' ")->fetch_assoc();
        // $insert_report = "INSERT INTO `aeps_transactions`(`USER_ID`, `USER_TYPE`, `MOBILE`, `TIMESTAMP`, `TRANS_TYPE`, `REFFRENCE_ID`, `ACCESS_MODE`, `MERCHANT_ID`,
        // `ADHAAR_NUM`, `AMOUNT`, `FILTER_DATE`) VALUES ('$usid','$ustypeid','$mobile', '$time ','$trans','$refrence','$accessmodetype','$mc_id','".encrypt_token(substr($adhar , 8 , 12))."', '$am' , '".date("Y-m-d")."')";
            // if($con->query($insert_report)){
                        
                        $response = hit('https://fingpayap.tapits.in/fpaepsweb/api/onboarding/merchant/creation/php/m1' , $arr , 132412344563);
                        
                        echo $response;
                        // exit;
                          $rslt = json_decode($response , true);
                          $status = $rslt['status'];
                          $mcid = $rslt['data']['merchants'][0]['merchantLoginId'];
                          $mrchntid = $rslt['data']['merchants'][0]['merchantId'];
                          $password = $rslt['data']['password'];
                          
                          if($status == 1){
                              $st  = "Success";
                                $con->query("INSERT INTO `fing_aeps_merchant`(`REF_NO`, `TXN_ID`, `STATUS`, `MOBILE`, `PARTNERID`, `MERCHANTCODE`,`PASSWORD`, `IS_ICICI_KYC`, `TIMESTAMP` , `PAN`) VALUES ('$refrence','$txn',
                            'Pending','$merchnt','$mrchntid','$mcid','$password','','$time' , '$pan' )");
                          }
            //     }
            // else{
            //     echo json_encode(array("response_code"=>  500 , "message"=>"Some internel server error. We are fixing it"));
            // }
}


//send otp for ekyc

if(isset($_POST['ekycotp'])){
          $timestamp = date("Y-m-d H:i:s");
      $time = date("g:i:s A");
      $date  = date("Y-m-d");
      $adhar = strip_tags($_POST['adhar']);
      $long = strip_tags($_POST['long']);
      $lati = strip_tags($_POST['lat']);
    
    $rtData = $con->query("select * from user where ID='".$usid."'")->fetch_assoc();
    $merchnt =$rtData['MOBILE'];
      
    $refrence = "SVDH".$usid.date("md").date("is");

    $time = date("Y-m-d g:i:s A");
    
    $apuser = $con->query("select * from fing_aeps_merchant where MOBILE='$merchnt' and STATUS='pending' order by ID DESC limit 1")->fetch_assoc();
     
    $arr = '{
             "superMerchantId": 969,
             "merchantLoginId": "'.$apuser['MERCHANTCODE'].'",
             "transactionType": "EKY",
             "mobileNumber": "'.$apuser['MOBILE'].'",
             "aadharNumber": "'.$adhar.'",
             "panNumber": "'.$apuser['PAN'].'",
             "matmSerialNumber": "",
             "latitude":'.$long.',
             "longitude":'.$lati.'
            }';
    // echo $arr;
   
        $response = hit("https://fpekyc.tapits.in/fpekyc/api/ekyc/merchant/php/sendotp" , $arr , 132412344563);
        
        echo $response;
        // exit;
}

//Resend otp for ekyc

if(isset($_POST['reekycotp'])){
          $timestamp = date("Y-m-d H:i:s");
      $time = date("g:i:s A");
      $date  = date("Y-m-d");
      $adhar = strip_tags($_POST['adhar']);
      $long = strip_tags($_POST['long']);
      $lati = strip_tags($_POST['lat']);
    
      $fptid = strip_tags($_POST['fptid']);
      $pkeyid = strip_tags($_POST['pkeyid']);
      
    $rtData = $con->query("select * from user where ID='".$usid."'")->fetch_assoc();
    $merchnt =$rtData['MOBILE'];
      
    $refrence = "SVDH".$usid.date("md").date("is");

    $time = date("Y-m-d g:i:s A");
    
    $apuser = $con->query("select * from fing_aeps_merchant where MOBILE='$merchnt' and STATUS='pending' order by ID DESC limit 1")->fetch_assoc();
     
    $arr = '{
             "superMerchantId": 969,
             "merchantLoginId": "'.$apuser['MERCHANTCODE'].'",
             "primaryKeyId" : '.$pkeyid.' ,
             "encodeFPTxnId" : "'.$fptid.'"
            }';
    // echo $arr;
   
        $response = hit("https://fpekyc.tapits.in/fpekyc/api/ekyc/merchant/php/resendotp" , $arr , 132412344563);
        
        echo $response;
}

//validate otp for ekyc
if(isset($_POST['validateOTP'])){
          $timestamp = date("Y-m-d H:i:s");
      $time = date("g:i:s A");
      $date  = date("Y-m-d");
      $adhar = strip_tags($_POST['aadhar']);
      $fptid = strip_tags($_POST['fptid']);
      $pkeyid = strip_tags($_POST['pkeyid']);
      $otp = strip_tags($_POST['otp']);
      $long = strip_tags($_POST['long']);
      $lati = strip_tags($_POST['lat']);
    
    $rtData = $con->query("select * from user where ID='".$usid."'")->fetch_assoc();
    $merchnt =$rtData['MOBILE'];
      
    $refrence = "SVDH".$usid.date("md").date("is");

    $time = date("Y-m-d g:i:s A");
    
    $apuser = $con->query("select * from fing_aeps_merchant where MOBILE='$merchnt' and STATUS='pending' order by ID DESC limit 1")->fetch_assoc();
     
    $arr = '{
             "superMerchantId": 969,
             "merchantLoginId": "'.$apuser['MERCHANTCODE'].'",
             "otp" : "'.$otp.'" ,
             "primaryKeyId" : '.$pkeyid.' ,
             "encodeFPTxnId" : "'.$fptid.'"
            }';
    // echo $arr;
   
        $response = hit("https://fpekyc.tapits.in/fpekyc/api/ekyc/merchant/php/validateotp" , $arr , 132412344563);
        echo $response;
        $con->query("update fing_aeps_merchant set  AADHAAR='$adhar' where MOBILE='$merchnt'  and MERCHANTCODE='".$apuser['MERCHANTCODE']."'");
}








