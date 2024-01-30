<?php

include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");
    
$usertype_id = $user['USER_TYPE'];

if(isset($_POST['fetch_lic'])){
    $email = $_POST['email'];
    $canumber = $_POST['num'];
    $tkn = create_token();
    $curl = curl_init();
    $jsonData = json_encode(array(
   "canumber"=>$canumber,
   "ad1"=>"$email",
   "mode"=>"online"

        ));
        

    curl_setopt_array($curl, [
      CURLOPT_URL => $paysprint['URL']."/api/v1/service/bill-payment/bill/fetchlicbill",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $jsonData,
      CURLOPT_HTTPHEADER => [
          "Accept: application/json",
        "Content-Type: application/json",
        "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
        "Token: ".$tkn
       ],
    ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','LIC BILL FETCH','LIC FETCH','$tkn','$jsonData','$response')");
    echo $response;
}


if(isset($_POST['pay_lic'])){
    $ad1 = $_POST['email'];
    $canumber = $_POST['num'];
    $long = $_POST['long'];
    $lati = $_POST['lati'];
    $mode = $_POST['mode'];
    
    $billData = json_decode($_POST['billDetails']);
    
    $refrence = substr(str_shuffle("234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM") , 0 , 8);

    $amount = $billData->amount;
      $data = json_encode(array(
          "canumber"=>$canumber,
          "mode"=>"online",
          "amount"=>$amount,
          "ad1"=>$ad1,
          "ad2"=>$billData->ad2,
          "ad3"=>$billData->ad3,
          "referenceid"=>$refrence,
          "latitude"=>$long,
          "longitude"=>$lati,
          "bill_fetch"=> $billData->bill_fetch
      ));
    $tkn = create_token();

$insert_report = "INSERT INTO `lic_transaction`(`USER_ID`, `USER_TYPE`, `CA_NUM`, `AMOUNT`, `REFFRENCE_ID`, `SEND_DATA`, `MODE`)
VALUES ('$usid','$usertype_id','$canumber','$amount','$refrence','".str_replace("'" , "\'" , $data)."', '$mode')";
$user_bal = $user['MAIN_BAL']-$amount;
if($user_bal >= 0){
        $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid'";
        if($con->query($insert_report) && $con->query($deduct_bal) ){
            
        if($mode == "OFFLINE"){
    
            insert_allreport($usid  ,$refrence , "LIC" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "Lic bill Transaction", "MAIN");
            $inf = json_encode(["status"=>true, "response_code"=>1,"responsecode"=>1, "message"=>"Request Accepted"]);
            $con->query("update lic_transaction set RESPONSE='".str_replace("'" , "\'" , $inf)."'  , STATUS='Pending' where REFFRENCE_ID='$refrence' ");
            echo $inf;
            exit;
        }
            
            
            
            
            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => $paysprint['URL']."/api/v1/service/bill-payment/bill/paylicbill",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS =>$data,
              CURLOPT_HTTPHEADER => [
                  "Accept: application/json",
                "Content-Type: application/json",
                "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
                "Token: ".$tkn
               ],
            ]);
            
            $response = curl_exec($curl);
            $err = curl_error($curl);
            
            curl_close($curl);
            echo $response;
            
            $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','LIC PAYEMENT','$refrence','$tkn','$data','$response')");
            // exit;
              $rstl = json_decode($response);
              $rs_code = $rstl->response_code; 
              $msg = $rstl->message;
              $st_msg = $rstl->txn_status;
              if($rs_code == 1){
                  $st = "Success";
                insert_allreport($usid  ,$refrence , "LIC" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "Lic bill Transaction", "MAIN");
              }
              else if($rs_code == 0){
                  $st = "Pending";
                insert_allreport($usid  ,$refrence , "LIC" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "Lic bill Transaction");
              }
              else{
                  $st = "Failed";
                  $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid'  ");
                insert_allreport($usid  ,$refrence , "LIC" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $amount , "Failed" , "Lic bill Transaction", "MAIN");
              }
              
              $con->query("update lic_transaction set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st' where REFFRENCE_ID='$refrence' ");
            
             
        }
        else{
            echo json_encode(array("status"=>false, "response_code"=>  500 , "message"=>"Internel Server Error."));
        }
    }
    else{
        echo json_encode(array("status"=>false, "response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
    }
}



?>