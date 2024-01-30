<?php

include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");



if(isset($_POST['addWallet'])){
    
            
        $txnId =  "SUV".date("ds").mt_rand(9999 , 100000);
        $user = $con->query("SELECT * FROM `user` WHERE ID='$usid' ORDER BY ID DESC LIMIT 1 ")->fetch_assoc();
        $name = $user['FIRST_NAME'];
        $mobile = $user['MOBILE'];
        $email = $user['EMAIL'];
        $amount = (float)$_POST['amount'];
        $amount = number_format($amount, 2, '.', '');
        
        $ID = $user['ID'];
        $mobile = $user['MOBILE'];
        
  
        
        $query = "INSERT INTO `wallet_cashfree`(`USER_ID`, `NAME`, `MOBILE`, `EMAIL`, `ORDER_ID`, `ORDER_AMOUNT`, `ORDER_NOTE`, `REFERENCE_ID`, `TRANSACTION_STATUS`, `PAYMENT_MODE`, `MESSAGE`, `TRANSACTION_TIME`)
        VALUES ('$usid' , '$name', '$mobile', '$email', '$txnId', '$amount', '$orderNote', '', 'Pending', '', '', '')";
        $run_query = mysqli_query($con , $query);
        
        
        
        if($run_query){
         
         $postData = json_encode([
            "order_id"=> $txnId,
            "order_amount"=> $amount,
            "order_currency"=> "INR",
            "customer_details"=> [
                "customer_id"=> $user['ID'],
                "customer_email"=> $user['EMAIL'],
                "customer_phone"=> $user['MOBILE']
            ],
            "order_meta"=> [
                "notify_url"=> "https://suvidhabnk.com/Agent/Backend/cashfreeaddwallet/cashfreeCallback.php"
            ]
        ]);
         
         
        
        
         $curl = curl_init();

         curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api.cashfree.com/pg/orders',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>$postData,
          CURLOPT_HTTPHEADER => array(
            'x-client-id: 218328201f9655106e2614470e823812',
            'x-client-secret: ce6d2be6d1c250f8c77b727abcc1839e3696b98c',
            'x-api-version: 2022-01-01',
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        
        curl_close($curl);
        $rcData = json_decode($response, true);
        extract($rcData);
        extract($customer_details);
        extract($order_meta);
        extract($order_meta);
        

        
        //Not used anymore
        // $sql = "UPDATE cf_addwallet SET `INITIATE_RESPONSE`='$response' WHERE USER_ID='$id' AND MC_TXN='$txnId' ORDER BY ID DESC LIMIT 1";
        // $finalizationD =  mysqli_query($con, $sql);
    

        if($payment_link!=""){
            echo json_encode(["message"=>"Success", "response_code"=>1, "status"=>true, "receivableData"=>$rcData]);
            exit;
        }
        else{
            echo json_encode(["status"=>false, "response_code"=>233, "message"=>"Failed, ".$message]);
            exit;
        }
        
        }
        else{
            echo json_encode(["status"=>false, "response_code"=>233, "message"=>"Some internal error, contact admin"]);
            exit;
        }
}


?>