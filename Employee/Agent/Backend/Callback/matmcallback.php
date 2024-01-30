<?php

include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");

$json = file_get_contents('php://input');

// $json = '{"ipaddress":"172.20.3.94","amount":100.0,"transactionStatus":"S","merchantRefNo":"SUV5eWqJ6flZh1668251950756","fpTransactionId":"MACB4305778121122165012082S","aadhaarNumber":null,"typeOfTransaction":"MATMCW","latitude":28.6292069,"longitude":77.3840361,"mobile":"9266166776","errorMessage":"Success","bankRRN":"231616058315","merchantName":"KUNDAN PRASAD SINGH","terminalID":"NSD41889","bankName":"State Bank of India","requestedTimestamp":"12/11/2022 16:50:12","merchantID":"SVDH9266166776","deviceIMEI":"6f6064412fc305a6","cardNumber":"459155******7606","cardType":"VISA","balance":178591.54,"mposSerialNumber":"63201021905347"}';

$data = json_decode($json, true);
$data['transactionDate'] = date('d-m-Y');


if($json!=""){
    $con->query("INSERT INTO `aeps_callback_rspns`(`RESPONSE`) VALUES ('$json')");
}



if(strtolower($data['errorMessage'])=='success' && strtolower($data['transactionStatus'])=='s'){

    $transactionID = $data['merchantRefNo'];
    $merchantId = $data['merchantID'];
    
    $response = $data['transactionStatus'];
    $message = $data['errorMessage'];
    $transAmount = $data['amount'];
    $balAmount = $data['amount'];
    $bankRrn = $data['bankRRN'];
    $txnid = $data['merchantRefNo'];
    $transType = $data['typeOfTransaction'];
    $bankName = $data['bankName'];
    $type = $data['typeOfTransaction'];
    $cardNumber = $data['cardNumber'];
    $cardType = $data['cardType'];
    $terminalId = $data['terminalID'];
    $reference = $data['merchantRefNo'];

    if(strtolower($response)=="i" || strtolower($response)=="l"){
        $message = "Pending";
        $response = 9;
    }
    else if(strtolower($response)=="s"){
        $message = "Success";
        $response = 1;
    }
    else{
        $message = "Failed";
        $response = 78;
    }

    $microAtmReport = $con->query("SELECT * FROM `micro_atm` where TXNID='$reference' ")->fetch_assoc();
    if($microAtmReport['RESPONSE']==9){
        if($type == "MATMCW"){
            $mytxntype = "ATMCW";
            $mytype = "WDLS";
            $data['serviceType'] = "CW";
        $con->query("UPDATE `micro_atm` SET `RESPONSE`='$response',`TRANSAMOUNT`='$transAmount',`BALAMOUNT`='$balAmount',`BANKRRN`='$bankRrn',`TRANSTYPE`='$mytxntype',`TYPE`='$mytype',`CARDNUMBER`='$cardNumber',`CARDTYPE`='$cardType',`TERMINALLD`='$terminalId',`BANKNAME`='$bankName' WHERE TXNID='$reference' ");
            
        }else if($type == "MATMBE"){
            $transAmount = "0";
            $mytxntype = "ATMBE";
            $mytype = "BAL";
            $data['serviceType'] = "BE";
            $con->query("UPDATE `micro_atm` SET `RESPONSE`='$response',`TRANSAMOUNT`='0',`BALAMOUNT`='$balAmount',`BANKRRN`='$bankRrn',`TRANSTYPE`='$mytxntype',`TYPE`='$mytype',`CARDNUMBER`='$cardNumber',`CARDTYPE`='$cardType',`TERMINALLD`='$terminalId',`BANKNAME`='$bankName' WHERE TXNID='$reference' ");
        }
        
        
        
        
        $microAtmReport = $con->query("SELECT * FROM `micro_atm` where TXNID='$reference' ")->fetch_assoc();  
        $user_id = $microAtmReport['USER_ID'];
        $user_status = $microAtmReport['USER_STATUS'];
        
        
        $user = $con->query("select * from user where ID='$user_id' ")->fetch_assoc();
        if($type == "MATMCW" && $response ==1 ){
                
                $checkResult  = checkStatus($merchantId ,$reference);
                if($checkResult){    
                    $old_bal = $user['AEPS_BAL'];
                    $new_bal = $old_bal + $transAmount;
                    $sql = "UPDATE user SET AEPS_BAL='$new_bal' WHERE ID='$user_id'";
                    mysqli_query($con, $sql);
                    insert_allreport($user_id  ,$reference , "ATM" , $old_bal  , $new_bal , $transAmount , "Atm Withdraw" , "Micro Atm Transaction");
                    give_matm_com($reference , $user_id , $user_status);
                }
        
        }else if($type == "MATMBE"){
             // fetch user to update balance
            insert_allreport($user_id  ,$reference , "ATM" , $user['AEPS_BAL']  , $user['AEPS_BAL'] , $transAmount , "Enquiry" , "Micro Atm Transaction");
        }
        
        
        $requestBody = '[{"merchantTransactionId":'.$data['merchantRefNo'].',"fingpayTransactionId":'.$data['fpTransactionId'].',"transactionRrn":'.$data['bankRRN'].',"responseCode":"00","transactionDate":'.$data['transactionDate'].',"serviceType":'.$data['serviceType'].'}]';
        hitrecon($requestBody);
        
    }
}




//checkStatus("SVDH9266166776", "SUV5eWqJ6flZh1668251950756");


function checkStatus($merchantLoginId, $transactionId){
    global $con;
    $fingpayMerchant = $con->query("SELECT * FROM `fing_aeps_merchant` WHERE MERCHANTCODE='$merchantLoginId' and STATUS='ACTIVE'")->fetch_assoc();
    
    $simplestring = $transactionId.strtolower($fingpayMerchant['MERCHANTCODE'].'969');
  
    $hashgen = base64_encode(hash("sha256", $simplestring, TRUE));
    
    $data = '{
        "merchantLoginId": "'.$fingpayMerchant['MERCHANTCODE'].'",
        "merchantPassword": "'.$fingpayMerchant['MERCHANTCODE'].'",
        "superMerchantId": 969,
        "superMerchantPassword": "'.md5("1234d").'",
        "merchantTranId": "'.$transactionId.'",
        "hash": "'.$hashgen.'"
    }';

    $curl = curl_init();
    
    curl_setopt_array($curl, array(
      CURLOPT_URL => 'https://fpma.tapits.in/fpcardwebservice/api/ma/statuscheck/cw',
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS =>$data,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json'
      ),
    ));
    
    $response = curl_exec($curl);
    curl_close($curl);
    $result = json_decode($response, true);
    echo $response;
    if($result['status'] == true){
        return true;
    }
    else{
        return false;
    }

}






function hitrecon($requestBody){
        $method = "POST"; // Method

        $simpleString = "Suvidhaad322d8298cdc16350fdc6d7cb0d9835e67354b87c93a427b602b44f069e0d875f";
        $hashgen = base64_encode(hash("sha256", $requestBody.$simpleString, TRUE));
        $header = ['txnDate:'.date('Y/m/d H:i:s'),
            'hash:'.$hashgen,
            'superMerchantLoginId:Suvidhaad',
            'superMerchantid:969',
            'Content-Type: text/plain'];
        


        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://fpanalytics.tapits.in/fpcollectservice/api/ma/threeway/aggregators",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $method,
            CURLOPT_POSTFIELDS => $requestBody,
            CURLOPT_HTTPHEADER => $header
        ));
        $result = curl_exec($curl);
        $array = json_decode($result, true);
        
        // echo json_encode(['header'=>$header, 'request'=>$requestBody, 'response'=>$array ,'hash'=>$hashgen, 'concatstr'=>$requestBody.$simpleString]);
        // exit;
        
        // return $result;
        
}



?>