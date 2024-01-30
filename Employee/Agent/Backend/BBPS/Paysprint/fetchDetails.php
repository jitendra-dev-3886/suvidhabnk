<?php
session_start();
include("../../../../Db/config.php");
include("../../Userinfo/getuserinfo.php");
include("../../Functions/all_function.php");
include("../../Auth/userdata.php");
include("bbps_function.php"); // for use of GetOperators 


$srst = $con->query("select * from service_status where ID='1'")->fetch_assoc();
if($srst['BBPS'] != "ON"){
    echo json_encode(array("status"=>false ,"response_code"=>  403 , "message"=>"This service is temporarily down." ,  "receivableData"=>["status"=>false, "response_code"=>  403 , "message"=>"This service is temporarily down."]));
    exit;
}


if(isset($_POST['op'])){
    $opData = $_POST['opData'];
    $operator = $_POST['op'];
    $billingUnit = $_POST['billingUnit'];
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
    // $data = json_encode([
    //     "operator"=>$operator,
    //     "canumber"=>$canumber,
    //     "ad1"=>$billingUnit,
    //     "mode"=>"online",
    //     ]);
        // echo $data;
    $tkn = create_token();
    $curl = curl_init();
    curl_setopt_array($curl, [
      CURLOPT_URL => $paysprint['URL']."/api/v1/service/bill-payment/bill/fetchbill",
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
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','BBPS FETCH BILL','BBPS FETCH BILL','$tkn','$data','$response')");
}

if(isset($_POST['fetch_operators'])){
    $tkn = create_token();
    $curl = curl_init();
    
    $data = json_encode([
            "mode"=>"online"
        ]);
    
    curl_setopt_array($curl, [
      CURLOPT_URL => $paysprint['URL']."/api/v1/service/bill-payment/bill/getoperator",
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
}

if(isset($_POST['fetch_service_operators'])){
    //Passing the category value in this post;
    $service = $_POST['fetch_service_operators'];
    //calling the function which return all paysprint operator response;
     $op_response = json_decode(GetOperators() , true);
    //  echo GetOperators();
    //  exit;
    $op_data = $op_response['data'];
     if($op_data != ""){
      foreach($op_data as $op_details){
          if(strtolower($op_details['category']) == strtolower($service)){
              $getop['ID'] = $op_details['id'];
              $getop['NAME'] = $op_details['name'];
              $allOperator[] = $getop;
          }
         }
         echo json_encode(["response_code"=>1 , "message"=>"operator fetched" , "result" => $allOperator]);
      }
      else{
         echo json_encode(["response_code"=>500 , "message"=>"Error in fetching " , "result" => ""]);
      }
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



if(isset($_POST['check_status'])){
$refrence = $_POST['ref_id'];

$transaction = $con->query("select * from pay_bill_api where REFFRENCE_ID='$refrence'")->fetch_assoc();
if(strtolower($transaction['STATUS']) != "pending"){
    echo json_encode(array("status"=>false,"response_code"=>  500 , "message"=>"Status already checked."));
      exit;
}


$curl = curl_init(); 
      $arr = array(
            "referenceid"=>"$refrence",
            );

        $main_body = json_encode($arr , true);
       $tkn = create_token();
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/bill-payment/bill/status",
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
 $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','BBPS Check Status','$refrence','$tkn','$main_body','$response')");

       $rslt = json_decode($response);
          $status = $rslt->status;
          $stcode = $rslt->data->status;
          $akno = $rslt->data->txnid;
          $opid = $rslt->data->operatorid;
          
              
        //   echo "<br>".$txn_st;
          if($stcode == 1){
              $st  = "Success";
             give_bbps_com($refrence , $usid , 46 , strtoupper(str_replace(" " , "" , $transaction['CATEGORY'] )));
          }
          else if($stcode == 0){
              $st = "Failed";
              $update_bal = $user['MAIN_BAL'] + $transaction['AMOUNT'];
              $deduct_bal = $con->query("update user set MAIN_BAL='$update_bal' where ID='$usid' ");
              insert_allreport($usid  ,$refrence , "BBPS Refund" , $user['MAIN_BAL']  , $update_bal , $transaction['AMOUNT'] , "Credit" , "BBPS Transaction Refund" , "MAIN");
          }
          else{
              $st  = "Pending";
          }
        $con->query("update pay_bill_api set STATUS='$st',  CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , ACKNO='$akno' ,OPERATORID='$opid'  where REFFRENCE_ID='$refrence' ");
          
          
}



?>