<?php

include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");


date_default_timezone_set('Asia/kolkata');    
$timezone = date_default_timezone_get();    

$reference_id = $_POST['reference_id'];
$transactionType = $_POST['transactionType'];

$validity = $con->query("select * from `report` where REFERENCE_ID='$reference_id' ORDER BY ID ASC LIMIT 1")->fetch_assoc();
$commitDate = $validity['TRANS_DATE'];

$now = time();
$commitDate = strtotime($commitDate);
$datediff = $now - $commitDate;

$daysGone =  round($datediff / (60 * 60 * 24));

if($daysGone > 46){
    echo json_encode(["status"=>false, "response_code"=>222, "responsecode"=>222, "message"=>"You can't check status after 45 days"]);
    exit;
}

if($transactionType =="RECHARGE"){
    

$transaction = $con->query("select * from recharge_transaction where REFERENCE_ID='$reference_id'")->fetch_assoc();

$rs  = $transaction['RESPONSE'];
$rsData = json_decode($rs, true);
extract($rsData);

if($response_code == 1){
    echo $rs;
    exit;
}
$detstat = strtolower($transaction['STATUS']);
                    
if (strpos($detstat, 'success') !== false) {
    echo $rs;
    exit;
}    
    
    
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

      $transaction = $con->query("select * from recharge_transaction where REFERENCE_ID='$reference_id'")->fetch_assoc();
      $user = $con->query("select * from user where ID='$usid'")->fetch_assoc();
      $update_bal = $user['MAIN_BAL'] + $transaction['AMOUNT'];
        if($response_code== 1 || $rs_code ==1){
            $status = "Success";
        }else if($sta== 0){
            $status = "Failed";
        }
        else{
            $status = "Pending";
        }
      
        $con->query("update recharge_transaction set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$status,$msg' , OPERATOR_ID='$operatorid' where REFERENCE_ID='$reference_id' ");
      if($status == "Failed"){
          $con->query("update user set MAIN_BAL='$update_bal' where ID='$usid' ");
          insert_allreport($usid  ,$reference_id , "Recharge Transaction" , $user['MAIN_BAL']  , $update_bal , $amount , "Failed" , "Recharge Transaction", "Main");
      }
}

if($transactionType =="BBPS"){
    
$txn = $con->query("select * from `pay_bill_api` where REFFRENCE_ID='$reference_id'")->fetch_assoc();    

if(strtolower($txn['MODE']) == "offline" && strtolower($txn['STATUS']) == "pending"){
    
    echo $txn['RESPONSE'];
    exit;
}
    
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
include('../DMT/cashfree/dmt_function.php');    
$reference_id = $reference_id;
$txn = $con->query("select * from dmt_transactions where REFFRENCE_ID='$reference_id'")->fetch_assoc();
$rsRefId = $txn['RES_REFID'];
$usid = $txn['USER_ID'];
if($rsRefId == ""){
    echo json_encode(array("response_code"=>  400 , "message"=>"Transaction not found for check status."));
    exit;
}
if(strtolower($txn['STATUS']) == "success" || strtolower($txn['STATUS']) == "rejected"){
    echo json_encode(array("response_code"=>  400 , "message"=>"Transaction status already confirmed. "));
    exit;
}
$curl = curl_init();
    $url = "https://payout-api.cashfree.com/payout/v1.1/getTransferStatus?referenceId=$rsRefId";
    // echo $url;
    // exit;
    $token = create_cashfree_token();
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    // echo $result;
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $status = $response['data']['transfer']['status'];
    $msg = $response['data']['transfer']['reason'];
    
    if(strtolower($status) == "success"){
          echo json_encode(array("response_code"=>  1 , "message"=>$status, "status">true, "receivableData"=>json_decode($result)));
    }
    else{
          echo json_encode(array("response_code"=>  400 , "message"=>$status, "status">false, "receivableData"=>json_decode($result)));
    }
    
    
    if(strtolower($status) == "success"){
          give_dmt_com($reference_id , $usid ,46);
    }
    else if(strtolower($status) == "rejected"){
        $user = $con->query("select * from user where ID='$usid' ")->fetch_assoc();
        $refundBal = $user['MAIN_BAL']+$txn['AMOUNT'];
          $con->query("update user set MAIN_BAL='$refundBal' where ID='$usid'");
          
        //  insert_allreport($usid  ,$reference_id , "DMT Failed" , $user['MAIN_BAL']  , $refundBal , $txn['AMOUNT'] , "Credit" , "DMT Transaction Failed", "MAIN");
    }
   $con->query("update dmt_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $result)."'   , STATUS='$status'  where REFFRENCE_ID='$reference_id' ");


}


if($transactionType =="XDMT"){
include('../XDMT/cashfree/dmt_function.php');    
$reference_id = $reference_id;
$txn = $con->query("select * from xdmt_transactions where REFFRENCE_ID='$reference_id'")->fetch_assoc();
$rsRefId = $txn['RES_REFID'];
$usid = $txn['USER_ID'];
if($rsRefId == ""){
    echo json_encode(array("response_code"=>  400 , "message"=>"Transaction not found for check status."));
    exit;
}
if(strtolower($txn['STATUS']) == "success" || strtolower($txn['STATUS']) == "rejected"){
    echo json_encode(array("response_code"=>  400 , "message"=>"Transaction status already confirmed. "));
    exit;
}
$curl = curl_init();
    $url = "https://payout-api.cashfree.com/payout/v1.1/getTransferStatus?referenceId=$rsRefId";
    // echo $url;
    // exit;
    $token = create_cashfree_token();
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    // echo $result;
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $status = $response['data']['transfer']['status'];
    $msg = $response['data']['transfer']['reason'];
    
    if(strtolower($status) == "success"){
          echo json_encode(array("response_code"=>  1 , "message"=>$status, "status">true, "receivableData"=>json_decode($result)));
    }
    else{
          echo json_encode(array("response_code"=>  400 , "message"=>$status, "status">false, "receivableData"=>json_decode($result)));
    }
    
    
    if(strtolower($status) == "success"){
          give_dmt_com($reference_id , $usid ,46);
    }
    else if(strtolower($status) == "rejected"){
        $user = $con->query("select * from user where ID='$usid' ")->fetch_assoc();
        $refundBal = $user['MAIN_BAL']+$txn['AMOUNT'];
          $con->query("update user set MAIN_BAL='$refundBal' where ID='$usid'");
          
        //  insert_allreport($usid  ,$reference_id , "DMT Failed" , $user['MAIN_BAL']  , $refundBal , $txn['AMOUNT'] , "Credit" , "DMT Transaction Failed", "MAIN");
    }
   $con->query("update xdmt_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $result)."'   , STATUS='$status'  where REFFRENCE_ID='$reference_id' ");


}

if($transactionType =="DEPOSIT"){
        
        echo json_encode(["status"=>false, "response_code"=>5, "message"=>"This faciliy is not provided by the company as of now", "responsecode"=>5]);
}

if($transactionType =="AEPS"){
    
include("../aeps/aeps_function.php");  

$transaction = $con->query("select * from aeps_transactions where REFFRENCE_ID='$reference_id'")->fetch_assoc();
$rs  = $transaction['RESPONSE'];
$rsData = json_decode($rs, true);
extract($rsData);

if($response_code == 1){
    echo $rs;
    exit;
}
$detstat = strtolower($transaction['STATUS']);
                    
if (strpos($detstat, 'success') !== false) {
    echo $rs;
    exit;
}    
    
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
      $user = $con->query("select * from user where ID='$usid'")->fetch_assoc();
      $update_bal = $user['AEPS_BAL'] + $transaction['AMOUNT'];
      
          // Response for cash withdrawl
          $con->query("update aeps_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st,$msg' where REFFRENCE_ID='$reference_id' ");
          if($transaction['TRANS_TYPE'] == "CW"){
              if($txn_st == 1){
                  $user_bal = $user['AEPS_BAL']+$transaction['AMOUNT'];
                  $deduct_bal = "update user set AEPS_BAL='$user_bal' where ID='$usid'";
                  $con->query($deduct_bal);
                  insert_allreport($usid  ,$reference_id , "AEPS" , $user['AEPS_BAL']  , $user_bal , $transaction['AMOUNT'] , "Credit" , "Aeps Transaction", "Main");
                //   give_aeps_com($reference_id , $usid , $usertype_id);
              }
          }
         callToRecon($reference_id , $status);


}

if($transactionType =="PAYOUT"){
include('../PAYOUT/cashfree/payout_function.php'); 
$reference_id = $reference_id;
$txn = $con->query("select * from payout_transaction where REFFRENCE_ID='$reference_id'")->fetch_assoc();
$rsRefId = $txn['RES_REFID'];
$usid = $txn['USER_ID'];


if($rsRefId == ""){
    echo json_encode(array("response_code"=>  400 , "message"=>"Transaction not found for check status. $reference_id", "status"=>false));
    exit;
}
if(strtolower($txn['STATUS']) == "success" || strtolower($txn['STATUS']) == "rejected"){
    echo json_encode(array("response_code"=>  400 , "message"=>"Transaction status already confirmed. ", "status"=>false));
    exit;
}
$curl = curl_init();
    $url = "https://payout-api.cashfree.com/payout/v1.1/getTransferStatus?referenceId=$rsRefId";
    // echo $url;
    // exit;
    $token = create_cashfree_token();
    $headers = array(
        'Content-Type:application/json',
        'Authorization: Bearer ' . $token
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POST, false);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
    $result = curl_exec($ch);
    // echo $result;
    $response = json_decode($result, true);
    $subCode = $response['subCode'];
    $status = $response['data']['transfer']['status'];
    $msg = $response['data']['transfer']['reason'];
    
    if($msg==null || $msg ==""){
        $msg = $status;
    }
    
    if(strtolower($status) == "success"){
        echo json_encode(array("response_code"=>1 , "message"=>$msg, "status"=>true, "receivableData"=>json_decode($result)));    
    }
    else{
        echo json_encode(array("response_code"=>2 , "message"=>$msg, "status"=>false, "receivableData"=>json_decode($result)));    
    }
    
    
   $con->query("update payout_transaction set CHECK_RESPONSE='".str_replace("'" , "\'" , $result)."'   , STATUS='$status'  where REFFRENCE_ID='$reference_id' ");
    if(strtolower($status) == "success"){
          give_payout_com($reference_id , $usid ,46);
    }
    else if(strtolower($status) == "rejected"){
        $user = $con->query("select * from user where ID='$usid' ")->fetch_assoc();
        $refundBal = $user['AEPS_BAL']+$txn['AMOUNT'];
          $con->query("update user set AEPS_BAL='$refundBal' where ID='$usid'");
        //  insert_allreport($usid  ,$reference_id , "Payout Failed" , $user['AEPS_BAL']  , $refundBal , $txn['AMOUNT'] , "Credit" , "Payout Transaction Failed");
    }

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

$con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','LIC STATUS','LIC STATUS','$tkn','$data','$response')");


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