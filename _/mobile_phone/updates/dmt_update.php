<?php

// update transaction status
if(isset($_POST['reference_id'])){

    include("../includes/config.php");
    $type = $_POST['type'];
    $reference_id = $_POST['reference_id'];
    $id = $_POST['user_id'];
    $usertype_id = $_POST['user_type'];
    $ip_address = $_POST['ip_address'];
    $device = $_POST['device'];
    include("../includes/fetch_data.php");
    include("../includes/main_function.php");
    include("../dmt/dmt_function.php");
    $curl = curl_init();
    
    
    $transaction = $con->query("select * from `dmt_transactions` where REFFRENCE_ID='$reference_id'")->fetch_assoc();
    $val = json_decode($transaction['CHECK_RESPONSE']);
    $val2 = json_decode($transaction['RESPONSE']);
    
    if($val2->response_code==1 || $val2->response_code==3){
        $rs = json_encode(array("response_code"=>$val2->response_code , "message"=>$val2->message, "status"=>$val2->status, "txnstatus"=>$val2->txnstatus));
        echo $rs;
        return;
    }
    
    if( $val!=null || $val!=""){
        $rs = json_encode(array("response_code"=>$val->response_code , "message"=>$val->message, "status"=>$val->status, "txnstatus"=>$val->txnstatus));
        echo $rs;
        return;
    }else{
              
    }
    
    
    
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
             
             
          if($rs_code==1){
              
          $all_reports_data = $con->query("SELECT * FROM `report` WHERE REFERENCE_ID='$reference_id'")->fetch_assoc(); 
          $user_bal = $user['MAIN_BAL'];
          $user_bal = $user_bal - $all_reports_data['AMOUNT'];
          $sql = "UPDATE user SET MAIN_BAL='$user_bal' WHERE ID='$id'";
          mysqli_query($con, $sql);
          $report_sql = "UPDATE `report` SET AFTER_AMOUNT='$user_bal' WHERE REFERENCE_ID='$reference_id'";
          mysqli_query($con, $report_sql);
          
          
          give_dmt_com($reference_id , $id ,$usertype_id, $ip_address, $device);
          $con->query("update dmt_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st_msg' where REFFRENCE_ID='$reference_id' ");
          
      }
            
    }
}



?>