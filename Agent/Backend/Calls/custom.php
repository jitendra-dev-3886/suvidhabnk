<?php
    
    include("../../../Db/config.php");
    include("../Userinfo/getuserinfo.php");
    include("../Functions/all_function.php");
    include("../Auth/userdata.php");
    
    if(isset($_POST['event']) && $_POST['event']=="paysprint_onboard"){
        
        
        
    }
    
    if(isset($_POST['event']) && $_POST['event']=="onboard_status"){
        
        
        $url =  $paysprint['URL']."/api/v1/service/onboard/onboard/getonboardstatus";
        
        $merchantcode = $_POST['merchantcode'];
        $mobile = $user['MOBILE'];
        $token = create_token();
        
        
        $arr = array(
            "merchantcode"=>"$merchantcode",
            "mobile"=>"$mobile",
            "pipe"=>"bank1",
            );
        
        
            //  $arr = array(
            // "merchantcode"=>"PDR2",
            // "mobile"=>"9660706047",
            // "pipe"=>"bank1",
            // );
        
            $main_body = json_encode($arr , true);
        
            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $main_body,
              CURLOPT_HTTPHEADER => [
                 "Content-Type: application/json",
                "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                "Token:".$token
                ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            echo $response;

    }
    
    

    if(isset($_POST['initiate_atm_txn']) && $_POST['initiate_atm_txn']=="initiate_atm_txn"){

    $response = 9;
    $transAmount = $_POST['amount'];
    $balAmount = $_POST['balAmount'];
    $bankRrn = $_POST['bankRrn'];
    $txnid = $_POST['reference'];
    $transType = $_POST['txnType'];
    $type = $_POST['txnType'];
    $cardNumber = $_POST['cardNumber'];
    $cardType = $_POST['cardType'];
    $terminalId = $_POST['terminalId'];
    $bankName = $_POST['bankName'];
    $message = $_POST['message'];
    
    $user_id = $user['ID'];
    
    $reference = $_POST['reference'];
    $date = date("Y-m-d H:i:s");
    
    
    $user_status = $user['USER_TYPE'];
    
    $insert_report = "INSERT INTO `micro_atm`(`USER_ID`, `USER_STATUS`, `RESPONSE`, `TRANSAMOUNT`, `BALAMOUNT`, `BANKRRN`, `TXNID`, `TRANSTYPE`, `TYPE`, `CARDNUMBER`, `CARDTYPE`, `TERMINALLD`, `BANKNAME`, `DATE`) 
                VALUES ('$user_id','$user_status','$response','$transAmount','$balAmount','$bankRrn','$txnid','$transType','$type','$cardNumber','$cardType','$terminalId','$bankName','$date')";
    if($con->query($insert_report)){
     
        $rs = json_encode(array("statuscode"=>  1 ,"responsecode"=>  1 , "message"=>"Proceedable", "response_code"=>1, "status"=>true));
        echo $rs;
        exit;
     
    }
    else{
    
        $rs = json_encode(array("statuscode"=>  200 ,"responsecode"=>  200 , "message"=>"Server Side report issue, contact admin and get it fixed.", "response_code"=>200, "status"=>false));
        echo $rs;
        exit;
    
    }
}

?>