<?php

$id = $_POST['user_id'];
$token_id = $_POST['token'];
$device = $_POST['device'];
$ip = $_POST['ip'];
include("../includes/config.php");
include("../includes/fetch_data.php");
include("../includes/main_function.php");


$mysql_qry = "select * FROM user WHERE ID ='$id' AND TOKEN_ID = '$token_id'";
$result = mysqli_query($con ,$mysql_qry);
if(mysqli_num_rows($result) > 0) {
    
}else{
    
    $rs = json_encode(array("statuscode"=>  999 ,"responsecode"=>  999 , "message"=>"Session Expired", "response_code"=>999, "status"=>false));
    echo $rs;
    return;
}



if(isset($_POST['history']) && $_POST['history']=="recharge"){

    $response  = array();
    $op = $con->query("SELECT * FROM `recharge_transaction` WHERE USER_ID='$id' ORDER BY ID DESC");
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
             array_push($response,array("id"=>$row["ID"],"number"=>$row['MOBILE'],"amount"=>"₹ ".$row['AMOUNT'],"reference"=>$row['REFERENCE_ID'],"status"=>$row['STATUS'],"response"=>json_decode($row['RESPONSE'])->message));
        }
        
        $details = json_encode($response);
        
    $rs = json_encode(array("statuscode"=>  1 ,"responsecode"=>  1 , "message"=>"History Fetched", "response_code"=>1, "status"=>true, "data"=>$response));
    echo $rs;
        
    }
    else{
        $rs = json_encode(array("statuscode"=>  2 ,"responsecode"=>  2 , "message"=>"No Record", "response_code"=>2, "status"=>true, "data"=>$response));
        echo $rs;
    }
    
}




if(isset($_POST['history']) && $_POST['history']=="fastag"){

    $response  = array();
    $op = $con->query("SELECT * FROM `fastag_transaction` WHERE USER_ID='$id' ORDER BY ID DESC");
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
             array_push($response,array("id"=>$row["ID"],"number"=>$row['CA_NUM'],"amount"=>"₹ ".$row['AMOUNT'],"reference"=>$row['REFFRENCE_ID'],"status"=>$row['STATUS'],"response"=>json_decode($row['RESPONSE'])->message));
        }
        
        $details = json_encode($response);
        
    $rs = json_encode(array("statuscode"=>  1 ,"responsecode"=>  1 , "message"=>"History Fetched", "response_code"=>1, "status"=>true, "data"=>$response));
    echo $rs;
        
    }
    else{
        $rs = json_encode(array("statuscode"=>  2 ,"responsecode"=>  2 , "message"=>"No Record", "response_code"=>2, "status"=>true, "data"=>$response));
        echo $rs;
    }
    
}

if(isset($_POST['history']) && $_POST['history']=="payoutdeposit"){

    $response  = array();
    $op = $con->query("SELECT * FROM `payout_transaction` WHERE USER_ID='$id' ORDER BY ID DESC");
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
             array_push($response,array("id"=>$row["ID"],"number"=>$row['ACCOUNT'],"amount"=>"₹ ".$row['AMOUNT'],"reference"=>$row['REFFRENCE_ID'],"status"=>$row['STATUS'],"response"=>json_decode($row['RESPONSE'])->message,"date_time"=>$row['TIMESTAMP']));
        }
        
        $details = json_encode($response);
        
    $rs = json_encode(array("statuscode"=>  1 ,"responsecode"=>  1 , "message"=>"History Fetched", "response_code"=>1, "status"=>true, "data"=>$response));
    echo $rs;
        
    }
    else{
        $rs = json_encode(array("statuscode"=>  2 ,"responsecode"=>  2 , "message"=>"No Record", "response_code"=>2, "status"=>true, "data"=>$response));
        echo $rs;
    }
    
}


if(isset($_POST['history']) && $_POST['history']=="cashdeposit"){

    $response  = array();
    $op = $con->query("SELECT * FROM `cash_deposit_transaction` WHERE USER_ID='$id' ORDER BY ID DESC");
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
             array_push($response,array("id"=>$row["ID"],"number"=>$row['ACC_NUM'],"amount"=>"₹ ".$row['AMOUNT'],"reference"=>$row['REFFRENCE_ID'],"status"=>$row['STATUS'],"response"=>json_decode($row['RESPONSE'])->message));
        }
        
        $details = json_encode($response);
        
    $rs = json_encode(array("statuscode"=>  1 ,"responsecode"=>  1 , "message"=>"History Fetched", "response_code"=>1, "status"=>true, "data"=>$response));
    echo $rs;
        
    }
    else{
        $rs = json_encode(array("statuscode"=>  2 ,"responsecode"=>  2 , "message"=>"No Record", "response_code"=>2, "status"=>true, "data"=>$response));
        echo $rs;
    }
    
}

if(isset($_POST['history']) && $_POST['history']=="creditcard"){

    $response  = array();
    $op = $con->query("SELECT * FROM `credit_card_transaction` WHERE USER_ID='$id' ORDER BY ID DESC");
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
             array_push($response,array("id"=>$row["ID"],"number"=>$row['CARD_NUM'],"amount"=>"₹ ".$row['AMOUNT'],"reference"=>$row['REFFRENCE_ID'],"status"=>$row['STATUS'],"response"=>json_decode($row['RESPONSE'])->message));
        }
        
        $details = json_encode($response);
        
    $rs = json_encode(array("statuscode"=>  1 ,"responsecode"=>  1 , "message"=>"History Fetched", "response_code"=>1, "status"=>true, "data"=>$response));
    echo $rs;
        
    }
    else{
        $rs = json_encode(array("statuscode"=>  2 ,"responsecode"=>  2 , "message"=>"No Record", "response_code"=>2, "status"=>true, "data"=>$response));
        echo $rs;
    }
    
}




if(isset($_POST['history']) && $_POST['history']=="lic"){

    $response  = array();
    $op = $con->query("SELECT * FROM `lic_transaction` WHERE USER_ID='$id' ORDER BY ID DESC");
    if($op->num_rows > 0)
    {
        while($row = $op->fetch_assoc()){
             array_push($response,array("id"=>$row["ID"],"number"=>$row['CA_NUM'],"amount"=>"₹ ".$row['AMOUNT'],"reference"=>$row['REFFRENCE_ID'],"status"=>$row['STATUS'],"response"=>json_decode($row['RESPONSE'])->message));
        }
        
        $details = json_encode($response);
        
    $rs = json_encode(array("statuscode"=>  1 ,"responsecode"=>  1 , "message"=>"History Fetched", "response_code"=>1, "status"=>true, "data"=>$response));
    echo $rs;
        
    }
    else{
        $rs = json_encode(array("statuscode"=>  2 ,"responsecode"=>  2 , "message"=>"No Record", "response_code"=>2, "status"=>true, "data"=>$response));
        echo $rs;
    }
    
}


if(isset($_POST['historystatus']) && $_POST['historystatus']=="rechargestatus"){

    $refrence =  $_POST['reference'];
    $tkn = create_token();
    $curl = curl_init();
    $data = json_encode(
            array(
                "referenceid"=>"$refrence",
                )
            );
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/recharge/recharge/status",
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
     $rstl = json_decode($response);
        $rs_code = $rstl->responsecode; 
      $msg = $rstl->message;
      $operatorid = $rstl->operatorid;
      $data = $rstl->data;
      $sta = $data->status;

      $rs = json_encode(array("statuscode"=>  $rstl->responsecode ,"responsecode"=>  $rstl->responsecode , "message"=>$rstl->message, "response_code"=>$rstl->responsecode, "status"=>$rstl->status));
      echo $rs;
    
    
    
      $transaction = $con->query("select * from recharge_transaction where REFERENCE_ID='$refrence'")->fetch_assoc();
      $user = $con->query("select * from user where ID='$id'")->fetch_assoc();
      $update_bal = $user['MAIN_BAL'] + $transaction['AMOUNT'];
        if($sta== 1){
            $status = "Success";
        }else if($sta== 0){
            $status = "Failed";
        }
        else{
            $status = "Pending";
        }
      
        $con->query("update recharge_transaction set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
      if($status == "Failed"){
          $con->query("update user set MAIN_BAL='$update_bal' where ID='$id' ");
          insert_allreport($id  ,$refrence , "Recharge Transaction" , $user['MAIN_BAL']  , $update_bal , $amount , "Failed" , "Recharge Transaction", $ip , $device);
      }
    
}

if(isset($_POST['historystatus']) && $_POST['historystatus']=="creditcardstatus"){

    $refrence =  $_POST['reference'];
    $tkn = create_token();
    
    $curl = curl_init();
    $data = json_encode(array('refid' => $refrence));

            curl_setopt_array($curl, [
              CURLOPT_URL => $paysprint['URL']."/api/v1/service/cc-payment/ccpayment/status",
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
            
            
      $rstl = json_decode($response);
      $rs_code = $rstl->response_code; 
      $msg = $rstl->message;
      $st_msg = $rstl->txn_status;
      $transaction = $con->query("select * from credit_card_transaction where REFFRENCE_ID='$refrence'")->fetch_assoc();
      $user = $con->query("select * from user where ID='$id'")->fetch_assoc();
      $update_bal = $user['MAIN_BAL'] + $transaction['AMOUNT'];
    
      if($rs_code == 1){
          $st = "Success";
        // insert_allreport($id  ,$refrence , "Credit Card Bill" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "Credit Card Bill Transaction", $ip , $device);
      }
      else if($rs_code == 0){
          $st = "Refunded";
        // insert_allreport($id  ,$refrence , "Credit Card Bill" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $amount , "Refunded" , "Credit Card Bill Transaction", $ip , $device);
      }
      else if($rs_code == 5){
          $st = "Failed";
      }
      else{
          $st = "Pending";
        // insert_allreport($id  ,$refrence , "Credit Card Bill" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "Credit Card Bill Transaction", $ip , $device);
      }
      
      $con->query("update credit_card_transaction set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st' where REFFRENCE_ID='$refrence'");
      if($rs_code == 5 || $rs_code == 0){
          $con->query("update user set MAIN_BAL='$update_bal' where ID='$id' ");
          insert_allreport($id  ,$refrence , "Credit Card Bill" , $user['MAIN_BAL']  , $update_bal , $amount , "Failed" , "Credit Card Bill Transaction", $ip , $device);
      }  
            
            
            
            
            
            
            
    
}



if(isset($_POST['historystatus']) && $_POST['historystatus']=="fastagstatus"){

    $refrence =  $_POST['reference'];
    $tkn = create_token();
    
    $curl = curl_init();
    $data = json_encode(array('referenceid' => $refrence));

            curl_setopt_array($curl, [
              CURLOPT_URL => $paysprint['URL']."/api/v1/service/fastag/Fastag/status",
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
    
}



if(isset($_POST['historystatus']) && $_POST['historystatus']=="licstatus"){

    $refrence =  $_POST['reference'];
    $tkn = create_token();
    
    $curl = curl_init();
    $data = json_encode(array('referenceid' => $refrence));

            curl_setopt_array($curl, [
              CURLOPT_URL => $paysprint['URL']."/api/v1/service/fastag/Fastag/status",
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
    
}

if(isset($_POST['historystatus']) && $_POST['historystatus']=="payoutdepositstatus"){

    $refrence =  $_POST['reference'];
    $tkn = create_token();
    
    $curl = curl_init();
    $data = json_encode(array('referenceid' => $refrence));

            curl_setopt_array($curl, [
              CURLOPT_URL => $paysprint['URL']."/api/v1/service/payout/payout/status",
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
    
}


?>