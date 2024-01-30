<?php
    
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
    $url = "https://api.paysprint.in/api/v1/service/recharge/recharge/status";
    
    
    $transaction = $con->query("select * from `recharge_transaction` where REFERENCE_ID='$reference_id'")->fetch_assoc();
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
    
    
    $tkn = create_token();
    $data = json_encode(
    array(
        "referenceid"=>$reference_id
        )
    );                    
    $curl = curl_init();
    curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => $data,
    CURLOPT_HTTPHEADER => [
    "Content-Type: application/json",
    "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
     "Token:".$tkn
     ],
     ]);
    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);
    echo $response;
    
      $rstl = json_decode($response);
      $rs_code = $rstl->response_code; 
      $msg = $rstl->message;
      $data = $rstl->data;
      $sta = $rstl->status;
      
      
      
      if($sta == true && ($rs_code==1 || $rs_code==3)){
          $all_reports_data = $con->query("SELECT * FROM `report` WHERE REFERENCE_ID='$reference_id'")->fetch_assoc(); 
          $comm_reports_data = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$reference_id'")->fetch_assoc(); 
          $user_bal = $user['MAIN_BAL']+(int)$all_reports_data['AMOUNT'];
          $user_bal = $user_bal-$comm_reports_data['COMMISSION'];
          $sql = "UPDATE user SET MAIN_BAL='$user_bal' WHERE ID='$id'";
          mysqli_query($con, $sql);

          $commsql = "UPDATE commission_report SET COMMISSION='0' WHERE REFFRENCE='$reference_id'";
          mysqli_query($con, $commsql);
          
          $new_after = $all_reports_data['PREVIOUS_AMOUNT'];
          
          $report_sql = "UPDATE report SET AFTER_AMOUNT='$new_after' WHERE REFERENCE_ID='$reference_id'";
          mysqli_query($con, $report_sql);
          $trans_sql = "UPDATE recharge_transaction SET RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='Refunded' WHERE REFERENCE_ID='$reference_id'";
          mysqli_query($con, $trans_sql);
          
          
      }
}

?>