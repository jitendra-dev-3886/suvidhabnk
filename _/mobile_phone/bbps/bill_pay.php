<?php

include("../includes/config.php");


 
 $refrence =  substr(str_shuffle("123457890QWERTYUIOPASDFGHJKLZXCVBNMasdfghjklqwertyuiopzxcvbnm") , 0 , 10);

$base_url = "https://api.paysprint.in";
// send otp for registeration
if(isset($_POST['op'])){
    $operator = $_POST['op'];
    $canumber = $_POST['num'];
    $amount = $_POST['amount'];
    $usertype_id = $_POST['usertype_id'];
    $id = $_POST['id'];
    
    $ip_address = $_POST['ip_address'];
    $device = $_POST['device'];

    include("../includes/fetch_data.php");
    include("../includes/main_function.php");
    
    $insert_report = "INSERT INTO `pay_bill_api`(`MESSAGE`, `STATUS`, `RESPONSE_CODE`, `RESPONSE`,`OPERATORID`, `ACKNO` , `USER_ID` , `REFFRENCE_ID` , `CA_NUM` , `OPERATOR` ,`AMOUNT`) VALUES ('".$responseJson['message']."'
            ,'Pending','','','', '',  '$id' , '$refrence'  ,'$canumber'  , '$operator' , '$amount' )";
    
    
    $user = $con->query("select * from user  where ID='$id' and USER_TYPE='$usertype_id'")->fetch_assoc();
    $user_bal = $user['MAIN_BAL']-$amount;
    if($user_bal >= 0){
        
        $deduct_bal = "update user set MAIN_BAL='$user_bal' where ID='$id' and USER_TYPE='$usertype_id'";
        if($con->query($insert_report) && $con->query($deduct_bal) ){
      $data = json_encode(array(
        "operator" =>$operator,
        "canumber" => $canumber,
        "amount" => $amount,
        "referenceid" => $refrence,
        "latitude" => $_POST['long'],
        "longitude" => $_POST['lati'],
        "mode" => "online", 
        "bill_fetch" => [
          "billAmount " => $amount,
          "billnetamount " => $amount, 
          "billdate " => $_POST['Billdate'], 
          "dueDate " => $_POST['dueDate'], 
          "acceptPayment " =>true, 
          "acceptPartPay " =>false, 
          "cellNumber " =>  $user['MOBILE'],
          "userName " => $_POST['name'],
        ]
      ));
    $tkn = create_token();
    
            $curl = curl_init();
            curl_setopt_array($curl, [
              CURLOPT_URL => "$base_url//api/v1/service/bill-payment/bill/paybill",
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
            //echo $amount;
            
            $rstl = json_decode($response);
            $rs_code = $rstl->response_code; 
            $msg = $rstl->message;
            $akno = $rstl->ackno;
            $opid = $rstl->operatorid;
              
              if($rs_code == 1){
                  $st = "Success";
                insert_allreport($id  ,$refrence , "BBPS" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "BBPS Transaction",$ip_address, $device);
              }
              else if($rs_code == 0){
                  $st = "Pending";
                insert_allreport($id  ,$refrence , "BBPS" , $user['MAIN_BAL']  , $user_bal , $amount , "Debit" , "BBPS Transaction",$ip_address, $device);
              }
              else{
                  $st = "Failed";
                insert_allreport($id  ,$refrence , "BBPS" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $amount , "Failed" , "BBPS Transaction",$ip_address, $device);
              }
              
              $con->query("update pay_bill_api set STATUS='$st',RESPONSE_CODE='$rs_code' ,  RESPONSE='".str_replace("'" , "\'" , $response)."'  , ACKNO='$akno' ,OPERATORID='$opid'  where REFFRENCE_ID='$refrence' ");
                
              if($rs_code != 1 && $rs_code != 0){
                  $con->query("update user set MAIN_BAL='".$user['MAIN_BAL']."' where ID='$id' and USER_TYPE='$usertype_id' ");
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