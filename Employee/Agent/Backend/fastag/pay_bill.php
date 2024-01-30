<?php
session_start();
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");
include("function.php");


// send otp for registeration
if(isset($_POST['op'])){
    $operator = $_POST['op'];
    $canumber = $_POST['num'];
    $opname = $_POST['op_name'];
    $category = $_POST['category'];
    $amount = $_POST['amount'];
    $billData = json_decode($_POST['billdata']);
    // $amount = $billData->amount;
    $billfetch = $billData->bill_fetch;
    // $check = $_POST['billdata'];
     $tpin = strip_tags($_POST['tpin']);
     
    $typeMode = strip_tags($_POST['typeMode']);

// validation of user tpin
$userPin = $con->query("select * from tpin where USER_ID='$usid' AND STATUS='active'");

if($userPin->num_rows == 0){
          echo json_encode(array("response_code"=>  400 , "message" => "Your M-Pin is Blank. Please set tpin first then continue the transaction."));
             exit;
        }
        else{
            $pinData =$userPin->fetch_assoc();
            $Tpin = $pinData['TPIN'];
            if($Tpin == ""){
              echo json_encode(array("response_code"=>  400 , "message" => "Your M-Pin is Blank. Please set tpin first then continue the transaction."));
              exit;
            }
            if($Tpin != $tpin){
              echo json_encode(array("response_code"=>  400 , "message" => "Your M-Pin is wrong. Please try again later. 3 Unsuccessfull attemps will temporarily block your account."));
              exit;
            }
        }
 $refrence =  "PDR".date("Ymd").mt_rand(999 , 9999);
    
            
$user_bal = $user['MAIN_BAL']-$amount;
if($user_bal >= 0){
    
    
    $insert_report = "INSERT INTO `fastag_transaction`(`MESSAGE`, `STATUS`, `CATEGORY`, `OP_NAME`, `RESPONSE_CODE`, `RESPONSE`,`OPERATORID`, `ACKNO` , `USER_ID` , `REFFRENCE_ID` , `CA_NUM` , `OPERATOR` ,`AMOUNT`, `MODE`) VALUES 
('".$responseJson['message']."' ,'Pending' ,'Fastag' ,'$opname' ,'','','', '',  '$usid' , '$refrence'  ,'$canumber'  , '$operator' , '$amount' , '$typeMode')";
    
    
        $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$usid'";
        if($con->query($insert_report) && $con->query($deduct_bal) ){
      $data = json_encode(array(
        "operator" =>$operator,
        "canumber" => $canumber,
        "amount" => $amount,
        "referenceid" => $refrence,
        "latitude" => $_POST['long'],
        "longitude" => $_POST['lati'],
        "mode" => "online",
        "bill_fetch" => $billfetch
      ));



    if($typeMode == "OFFLINE"){
        
        insert_allreport($usid  ,$refrence , "FASTAG" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "FASTAG Transaction" , "MAIN");
        $inf = json_encode(["status"=>true, "response_code"=>1,"responsecode"=>1, "message"=>"Request Accepted"]);
        
        $con->query("update fastag_transaction set STATUS='Pending',RESPONSE_CODE='1' ,  RESPONSE='".str_replace("'" , "\'" , $inf)."' where REFFRENCE_ID='$refrence' ");
        echo $inf;
        exit;
    }

// echo $data;
    $tkn = create_token();
    
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
             $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','Aeps','$refrence','$tkn','$data','$response')");
          $rstl = json_decode($response);
              $rs_code = $rstl->response_code; 
              $msg = $rstl->message;
              $akno = $rstl->ackno;
              $opid = $rstl->operatorid;
              
                
              if($rs_code == 1){
                  $st = "Success";
                insert_allreport($usid  ,$refrence , "FASTAG" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "FASTAG Transaction" , "MAIN");
                
                  //send sms of the txn
                $sndam = number_format($amount , 2);
                $usbl = number_format($user_bal , 2);
                $usermb = substr($user['MOBILE'] , 7 , 10);
                $mbmsg = urlencode("INR $sndam has been Debited from your Paydeer.in A/C No *******$usermb  towards FASTAG Txn. $refrence. Main Wallet Avl BAL is INR $usbl. Team PayDeer");
                $smsrs2 = json_decode(sendSMS($user['MOBILE'] , $mbmsg , 1307164568497787783) , true);
                  give_fastag_com($refrence , $usid ,46);
              }
              else if($rs_code == 0){
                  $st = "Pending";
                insert_allreport($usid  ,$refrence , "FASTAG" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "FASTAG Transaction" , "MAIN");
              }
              else{
                  $st = "Failed";
              }
              
              $con->query("update fastag_transaction set STATUS='$st',RESPONSE_CODE='$rs_code' ,  RESPONSE='".str_replace("'" , "\'" , $response)."'  , ACKNO='$akno' ,OPERATORID='$opid'  where REFFRENCE_ID='$refrence' ");
              if($rs_code != 1 && $rs_code != 0){
                  $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$usid' ");
              }
        }
        else{
            echo json_encode(array("status"=>false,"response_code"=>  500 , "message"=>"Internel Server Error."));
        }
    }
    else{
        echo json_encode(array("status"=>false, "response_code"=>  400 , "message"=>"You have not sufficient balance.. Please add balance."));
    }
}


if(isset($_POST['check_status'])){
$refrence = $_POST['ref_id'];

$transaction = $con->query("select * from fastag_transaction where REFFRENCE_ID='$refrence'")->fetch_assoc();
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
       
    //   echo $main_body;
curl_setopt_array($curl, [
  CURLOPT_URL =>  $paysprint['URL']."/api/v1/service/fastag/Fastag/status",
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
 $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','FASTAG Check Status','$refrence','$tkn','$main_body','$response')");

       $rslt = json_decode($response);
          $status = $rslt->status;
          $stcode = $rslt->data->status;
          $akno = $rslt->data->txnid;
          $opid = $rslt->data->operatorid;
          
              
        //   echo "<br>".$txn_st;
          if($stcode == 1){
              $st  = "Success";
              
                  give_fastag_com($refrence , $usid ,46);
                  
          }
          else if($stcode == 0){
              $st = "Failed";
              $update_bal = $user['MAIN_BAL'] + $transaction['AMOUNT'];
              $deduct_bal = "update user set MAIN_BAL='$update_bal' where ID='$usid' ";
              insert_allreport($usid  ,$refrence , "FASTAG Refund" , $user['MAIN_BAL']  , $update_bal , $transaction['AMOUNT'] , "Credit" , "FASTAG Transaction Refund" , "MAIN");
          }
          else{
              $st  = "Pending";
          }
        $con->query("update fastag_transaction set STATUS='$st',  CHECK_RESPONSE='".str_replace("'" , "\'" , $response)."'  , ACKNO='$akno' ,OPERATORID='$opid'  where REFFRENCE_ID='$refrence' ");
          
          
}

