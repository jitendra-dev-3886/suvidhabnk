<?php
    

// if(isset($_POST['reference_id'])){
    
//     include("recon.php");
//     include("../includes/config.php");
//     $type = $_POST['type'];
//     $reference_id = $_POST['reference_id'];
//     $id = $_POST['user_id'];
//     $usertype_id = $_POST['user_type'];
//     $ip_address = $_POST['ip_address'];
//     $device = $_POST['device'];
    

//     include("../includes/fetch_data.php");
//     include("../includes/main_function.php");
//     $url = "https://api.paysprint.in/api/v1/service/aeps/aepsquery/query";

    
//     $transaction = $con->query("select * from `aeps_transactions` where REFFRENCE_ID='$reference_id'")->fetch_assoc();
//     $val = json_decode($transaction['CHECK_RESPONSE']);
//     $val2 = json_decode($transaction['RESPONSE']);
//     if($val2->response_code==1 || $val2->response_code==3){
//         $rs = json_encode(array("response_code"=>$val2->response_code , "message"=>$val2->message, "status"=>$val2->status, "txnstatus"=>$val2->txnstatus));
//         echo $rs;
//         return;
//     }
    
//     if( $val!=null || $val!=""){
//         $rs = json_encode(array("response_code"=>$val->response_code , "message"=>$val->message, "status"=>$val->status, "txnstatus"=>$val->txnstatus));
//         echo $rs;
//         return;
//     }else{
              
//     }
    

//     $curl = curl_init();
//     $arr = array(
//         "reference"=>"$reference_id",
//     );
            
//         $data_tkn = encrypt($arr);
//         $sendData = array(
//             "body"=>$data_tkn,
//             );
//         $main_body = json_encode($sendData , true);
//     $tkn = create_token();
    
    
//     curl_setopt_array($curl, [
//     CURLOPT_URL => $url,
//     CURLOPT_RETURNTRANSFER => true,
//     CURLOPT_ENCODING => "",
//     CURLOPT_MAXREDIRS => 10,
//     CURLOPT_TIMEOUT => 30,
//     CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
//     CURLOPT_CUSTOMREQUEST => "POST",
//     CURLOPT_POSTFIELDS => $main_body,
//     CURLOPT_HTTPHEADER => [
//     "Content-Type: application/json",
//     "Authorisedkey:".$paysprint['AUTHORISED_KEY'],
//      "Token:".$tkn
//      ],
//      ]);
//     $response = curl_exec($curl);
//     $err = curl_error($curl);
//     curl_close($curl);
//     echo $response;
 
 
//           $status = $rslt->status;
//           $rrn = $rslt->bankrrn;
//           $msg = $rslt->message;
//           $rs_code = $rslt->response_code; 
//           $txn_st = $rslt->txnstatus; 
          
//           if($txn_st == 1){
//               $st  = "Success";
//           }
//           else if($txn_st == 2){
//               $st  = "Pending";
//           }
//           else{
//               $st = "Failed";
//           }
          
          
//           callToRecon($reference_id , $st);
          
//           if($transaction['TRANS_TYPE'] == "CW" || $transaction['TRANS_TYPE'] == "M"){
//           if($sta == true && $txn_st==1){
//           $all_reports_data = $con->query("SELECT * FROM `report` WHERE REFERENCE_ID='$reference_id'")->fetch_assoc(); 
//           $comm_reports_data = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$reference_id'")->fetch_assoc(); 
//           $user_bal = $user['MAIN_BAL']+(int)$all_reports_data['AMOUNT'];
//           $user_bal = $user_bal-$comm_reports_data['COMMISSION'];
//           $sql = "UPDATE user SET MAIN_BAL='$user_bal' WHERE ID='$id'";
//           mysqli_query($con, $sql);

//           $commsql = "UPDATE commission_report SET COMMISSION='0' WHERE REFFRENCE='$reference_id'";
//           mysqli_query($con, $commsql);
          
//           $new_after = $all_reports_data['PREVIOUS_AMOUNT'];
//           $report_sql = "UPDATE report SET AFTER_AMOUNT='$new_after' WHERE REFERENCE_ID='$reference_id'";
//           mysqli_query($con, $report_sql);
//           $trans_sql = "UPDATE `aeps_transactions` SET STATUS='Refunded' WHERE REFERENCE_ID='$reference_id'";
//           mysqli_query($con, $trans_sql);
          
          
//       }
//     }
// }

//update transaction status
if(isset($_POST['reference_id'])){
$refrence = $_POST['reference_id'];

include("recon.php");
include("../includes/config.php");
$type = $_POST['type'];
$id = $_POST['user_id'];
$usertype_id = $_POST['user_type'];
$ip_address = $_POST['ip_address'];
$device = $_POST['device'];
    

include("../includes/fetch_data.php");
include("../includes/main_function.php");



$curl = curl_init();

      $arr = array(
            "reference"=>"$refrence",
            );
            
        $data_tkn = encrypt($arr);
        $sendData = array(
            "body"=>$data_tkn,
            );
        $main_body = json_encode($sendData , true);
       $tkn = create_token();
    //   echo $data;
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
        //   echo "<br>".$txn_st;
          if($txn_st == 1){
              $st  = "Success";
          }
          else if($txn_st == 2){
              $st  = "Pending";
          }
          else{
              $st = "Failed";
          }
    //   exit;
      $transaction = $con->query("select * from aeps_transactions where REFFRENCE_ID='$refrence'")->fetch_assoc();
      $user = $con->query("select * from user where ID='$id'")->fetch_assoc();
      $update_bal = $user['AEPS_BAL'] + $transaction['AMOUNT'];
      
          // Response for cash withdrawl
          $con->query("update aeps_transactions set CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , STATUS='$st,$msg' where REFFRENCE_ID='$refrence' ");
          if($transaction['TRANS_TYPE'] == "CW"){
              if($txn_st == 1){
                  $user_bal = $user['AEPS_BAL']+$transaction['AMOUNT'];
                  $deduct_bal = "update user set AEPS_BAL='$user_bal' where ID='$id' and USER_TYPE='$usertype_id'";
                  $con->query($deduct_bal);
                  insert_allreport($id  ,$refrence , "AEPS" , $user['AEPS_BAL']  , $user_bal , $transaction['AMOUNT'] , "Credit" , "Aeps Transaction", $ip_address, $device);
                  give_aeps_com($refrence , $id , $usertype_id, $ip_address, $device);
              }
          }
         callToRecon($refrence , $st);
}


function callToRecon($ref , $status){
    global $con , $base_url , $paysprint;
    
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
          CURLOPT_URL => $base_url."/api/v1/service/aeps/threeway/threeway",
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
        
      //echo $response;
      $con->query("INSERT INTO `aeps_recon_response`(`DATA`, `RESPONSE`) VALUES ('".json_encode($arr)."','$response')");
}

?>