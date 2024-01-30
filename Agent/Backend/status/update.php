<?php

include("../includes/config.php");
include("../includes/fetch_data.php");
include("../includes/main_function.php");


$reference_id = $_POST['reference_id'];
$transactionType = $_POST['transactionType'];

if($transactionType =="RECHARGE"){
    
$curl = curl_init();
$data = json_encode(
            array(
                "referenceid"=>"$reference_id",
                )
            );
       $tkn = create_token();
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
echo $response;
curl_close($curl);
     $rstl = json_decode($response);
     $rs_code = $rstl->responsecode; 
     $response_code =  $rstl->response_code;
      $msg = $rstl->message;
      $operatorid = $rstl->operatorid;
      $data = $rstl->data;
      $sta = $data->status;

      $transaction = $con->query("select * from recharge_transaction where REFERENCE_ID='$refrence'")->fetch_assoc();
      $user = $con->query("select * from user where ID='$id'")->fetch_assoc();
      $update_bal = $user['MAIN_BAL'] + $transaction['AMOUNT'];
        if($response_code== 1 || $rs_code ==1){
            $status = "Sucess";
        }else if($sta== 0){
            $status = "Failed";
        }
        else{
            $status = "Pending";
        }
      
        $con->query("update recharge_transaction set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$refrence' ");
      if($status == "Failed"){
          $con->query("update user set MAIN_BAL='$update_bal' where ID='$id' ");
          insert_allreport($id  ,$refrence , "Recharge Transaction" , $user['MAIN_BAL']  , $update_bal , $amount , "Failed" , "Recharge Transaction");
      }
}

if($transactionType =="BBPS"){
    
$curl = curl_init();
$data = json_encode(
            array(
                "referenceid"=>"$reference_id",
                )
            );
       $tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/bill-payment/bill/status",
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
echo $response;
curl_close($curl);
$rstl = json_decode($response);


}

if($transactionType =="DMT"){
    
$curl = curl_init();
$data = json_encode(
            array(
                "referenceid"=>"$reference_id",
                )
            );
       $tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/dmt/transact/transact/querytransact",
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
echo $response;
curl_close($curl);
if ($err) {
  echo "cURL Error #:" . $err;
} else { 
    $rstl = json_decode($response);
          $rs_code = $rstl->response_code; 
          $msg = $rstl->message; 
             $status = $rstl->txn_status;
              switch($status){
                   case 0  : $st_msg = "Failed and Refunded";
                   break;
                   case 1  : $st_msg = "Transaction Successfull";
                   break;
                   case 2  : $st_msg = "Transaction In Process";
                   break;
                   case 3  : $st_msg = "Transaction Sent To Bank";
                   break;
                   case 4  : $st_msg = "Transaction on Hold";
                   break;
                   case 5  : $st_msg = "Transaction Failed";
                   break;
              }
           $con->query("update dmt_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$refrence' ");
        }


}

if($transactionType =="DEPOSIT"){
        
        echo json_encode(["status"=>false, "response_code"=>5, "message"=>"This faciliy is not provided by the company as of now", "responsecode"=>5]);
}

if($transactionType =="AEPS"){
$usertype_id = $user['USER_TYPE'];    
$curl = curl_init();
      $arr = array(
            "reference"=>"$reference_id",
            );
            
        $data_tkn = encrypt($arr);
        $sendData = array(
            "body"=>$data_tkn,
            );
        $main_body = json_encode($sendData , true);
       $tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/aeps/aepsquery/query",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $main_body,
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
        "Content-Type: application/json",
        "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
        "Token: ".$tkn
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
echo $response;
curl_close($curl);
       $rslt = json_decode($response);
          $status = $rslt->status;
          $rrn = $rslt->bankrrn;
          $msg = $rslt->message;
          $rs_code = $rslt->response_code; 
          $txn_st = $rslt->txnstatus; 
          if($txn_st == 1 || $rs_code == 1){
              $st  = "Success";
          }
          else if($txn_st == 2){
              $st  = "Pending";
          }
          else{
              $st = "Failed";
          }
    //   exit;
      $transaction = $con->query("select * from aeps_transactions where REFFRENCE_ID='$reference_id'")->fetch_assoc();
      $user = $con->query("select * from user where ID='$id'")->fetch_assoc();
      $update_bal = $user['AEPS_BAL'] + $transaction['AMOUNT'];
      
          // Response for cash withdrawl
          $con->query("update aeps_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st,$msg' where REFFRENCE_ID='$reference_id' ");
          if($transaction['TRANS_TYPE'] == "CW"){
              if($txn_st == 1){
                  $user_bal = $user['AEPS_BAL']+$transaction['AMOUNT'];
                  $deduct_bal = "update user set AEPS_BAL='$user_bal' where ID='$id' and USER_TYPE='$usertype_id'";
                  $con->query($deduct_bal);
                  insert_allreport($id  ,$reference_id , "AEPS" , $user['AEPS_BAL']  , $user_bal , $transaction['AMOUNT'] , "Credit" , "Aeps Transaction");
                  give_aeps_com($reference_id , $id , $usertype_id);
              }
          }
         callToRecon($reference_id , $status);


}

if($transactionType =="PAYOUT"){
    
$payout_data = $con->query("select * from `payout_transaction` where REFFRENCE_ID='$reference_id'")->fetch_assoc();

$ackno = json_decode($payout_data['RESPONSE'])->ackno; 
$curl = curl_init();
      $arr = array(
            "refid"=>"$reference_id",
            "ackno"=>"$ackno"
            );
            
        $data_tkn = encrypt($arr);
        $sendData = array(
            "body"=>$data_tkn,
            );
        $main_body = json_encode($sendData , true);
       $tkn = create_token();
  curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/payout/payout/status",
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => "",
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 30,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => "POST",
  CURLOPT_POSTFIELDS => $main_body,
  CURLOPT_HTTPHEADER => [
    "Accept: application/json",
        "Content-Type: application/json",
        "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
        "Token: ".$tkn
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
echo $response;
curl_close($curl);

}

if($transactionType =="CREDIT"){
    
$curl = curl_init();
$data = json_encode(
            array(
                "refid"=>"$reference_id",
                )
            );
       $tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/cc-payment/ccpayment/status",
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
echo $response;
curl_close($curl);
$rstl = json_decode($response);


}

if($transactionType =="FASTAG"){
    
$curl = curl_init();
$data = json_encode(
            array(
                "referenceid"=>"$reference_id",
                )
            );
       $tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/fastag/Fastag/status",
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
echo $response;
curl_close($curl);
$rstl = json_decode($response);


}

if($transactionType =="ATM"){
    
$data = json_encode(array("reference"=>"$reference_id"));
 $data_tkn = encrypt($data);
 $sendData = array("body"=>$data_tkn);
 $main_body = json_encode($sendData , true);
 $token = create_token();         
 $url = $paysprint['URL']."/api/v1/service/matm/matmquery/query";
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

if($transactionType =="LIC"){
    
$curl = curl_init();
$data = json_encode(
            array(
                "referenceid"=>"$reference_id",
                )
            );
       $tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/bill-payment/bill/licstatus",
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
echo $response;
curl_close($curl);
$rstl = json_decode($response);


}

if($transactionType =="FUND"){
    
    echo json_encode(["status"=>false, "response_code"=>5, "message"=>"This faciliy is not provided by the company as of now", "responsecode"=>5]);
}

function callToRecon($ref , $status){
    global $con , $paysprint;
    
        $arr = array(
            "reference"=>"$ref",
            "status"=>"$status",
            );
            
        $data_tkn = encrypt($arr);
        $sendData = array(
            "body"=>$data_tkn,
            );
        $main_body = json_encode($sendData , true);
        $token = create_token();
        
        $curl = curl_init();
        curl_setopt_array($curl, [
          CURLOPT_URL => $paysprint['URL']."/api/v1/service/aeps/threeway/threeway",
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
      $con->query("INSERT INTO `aeps_recon_response`(`DATA`, `RESPONSE`) VALUES ('".json_encode($arr)."','$response')");
}

function refundSystemRecharge($reference_id){
    
}


?>