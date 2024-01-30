<?php

include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");
include("function.php");


if(isset($_POST['fastag_list'])){

    $tkn = create_token();
    $curl = curl_init();

    curl_setopt_array($curl, [
      CURLOPT_URL => $paysprint['URL']."/api/v1/service/fastag/Fastag/operatorsList",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
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
}



// fetch single operator data
if(isset($_POST['fetch_operator'])){
    //Passing the id of the operator in this post;
    $operatorId = $_POST['fetch_operator'];
    //calling the function which return all paysprint operator response;
     $op_response = json_decode(GetOperators() , true);
    $op_data = $op_response['data'];
     if($op_data != ""){
      foreach($op_data as $op_details){
          if(strtolower($op_details['id']) == strtolower($operatorId)){
              $operatorinfo = $op_details;
          }
         }
         echo json_encode(["response_code"=>1 , "message"=>"operator info fetched" , "result" => $operatorinfo]);
      }
      else{
         echo json_encode(["response_code"=>500 , "message"=>"Error in fetching " , "result" => ""]);
      }
}


// fetch bill detials
if(isset($_POST['op'])){
    $opData = $_POST['opData'];
    $operator = $_POST['op'];
    $canumber = $_POST['num'];
    if($_POST['ad1'] != ""){
        if($_POST['ad2'] != ""){
            if($_POST['ad3'] != ""){
              $data = json_encode([
                    "operator"=>$operator,
                    "canumber"=>$canumber,
                    "ad1"=>$_POST['ad1'],
                    "ad2"=>$_POST['ad2'],
                    "ad3"=>$_POST['ad3'],
                    "mode"=>"online",
                    ]);
            }
            else{
                $data = json_encode([
                    "operator"=>$operator,
                    "canumber"=>$canumber,
                    "ad1"=>$_POST['ad1'],
                    "ad2"=>$_POST['ad2'],
                    "mode"=>"online",
                    ]);
            }
        }
        else{
            $data = json_encode([
                    "operator"=>$operator,
                    "canumber"=>$canumber,
                    "ad1"=>$_POST['ad1'],
                    "mode"=>"online",
                    ]);
        }
    }
    else{
        $data = json_encode([
                    "operator"=>$operator,
                    "canumber"=>$canumber,
                    "mode"=>"online",
                    ]);
    }
        // echo $data;
    $tkn = create_token();
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => $paysprint['URL']."/api/v1/service/fastag/Fastag/fetchConsumerDetails",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $data,
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
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','FASTAG','$refrence','$tkn','$data','$response')");
}



if(isset($_POST['fetch_fast'])){
    $ca_num = $_POST['ca_num'];
    $fast_id = $_POST['fast_id'];
    
    $refrence =  substr(str_shuffle("123457890QWERTYUIOPASDFGHJKLZXCVBNMasdfghjklqwertyuiopzxcvbnm") , 0 , 10);
    $tkn = create_token();
    
    $curl = curl_init();
    $data = json_encode(array('operator' => $fast_id ,'canumber' =>$ca_num));

            curl_setopt_array($curl, [
              CURLOPT_URL => $paysprint['URL']."/api/v1/service/fastag/Fastag/fetchConsumerDetails",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => $data,
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
            echo trim($response);
            
            $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','FASTAG','$refrence','$tkn','$data','$response')");
}


if(isset($_POST['pay_fastag'])){
    
        echo json_encode(array("response_code"=>  400 , "message"=>"Please update your application to use this services."));
    exit;
    $operator = $_POST['operator'];
    $canumber = $_POST['canumber'];
    

    $long = $_POST['long'];
    $lati = $_POST['lati'];
    $billData = json_decode($_POST['billDetails']);
    $refrence = substr(str_shuffle("234567890qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM") , 0 , 8);

    $amount = $billData->amount;
      $data = json_encode(array(
          "operator"=>$operator,
          "canumber"=>$canumber,
          "amount"=>$amount,
          "referenceid"=>$refrence,
          "latitude"=>$long,
          "longitude"=>$lati,
          "bill_fetch"=> 1
      ));
      
    $tkn = create_token();

$insert_report = "INSERT INTO `fastag_transaction`(`USER_ID`, `USER_TYPE`, `CA_NUM`, `AMOUNT`, `REFFRENCE_ID`, `SEND_DATA`)
VALUES ('$usid','$usertype_id','$canumber','$amount','$refrence','".str_replace("'" , "\'" , $data)."')";
$user_bal = $user['MAIN_BAL']-$amount;
if($user_bal >= 0){
        $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid'";
        if($con->query($insert_report) && $con->query($deduct_bal) ){
            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => $paysprint['URL']."/api/v1/service/fastag/Fastag/recharge",
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
              $rstl = json_decode($response);
              $rs_code = $rstl->response_code; 
              $msg = $rstl->message;
              $st_msg = $rstl->txn_status;

              $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','FASTAG','$refrence','$tkn','$data','$response')");
              
              if($rs_code == 1){
                 $st = "Success";
                insert_allreport($usid  ,$refrence , "LIC" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "Fastag Transaction","Main");
              }
              else if($rs_code == 0){
                  $st = "Pending";
                insert_allreport($usid  ,$refrence , "LIC" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "Fastag Transaction","Main");
              }
              else{
                  $st = "Failed";
                insert_allreport($usid  ,$refrence , "LIC" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $amount , "Failed" , "Fastag Transaction","Main");
              }
              
              $con->query("update `fastag_transaction` set RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st' where REFFRENCE_ID='$refrence' ");
                
              if($rs_code != 1 || $rs_code != 0){
                  $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid'");
              }
              else{


              }
        }
        else{
            echo json_encode(array("response_code"=>  500 , "message"=>"Internel Server Error."));
        }
    }
    else{
        echo json_encode(array("response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
    }
}



?>