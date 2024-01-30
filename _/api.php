<?php

session_start();
error_reporting(0);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);

// echo "work";
include("../includes/config.php");

if(isset($_GET['apikey'])){
    $api_key = $_GET['apikey'];
    $mobile_no = $_GET['mobile_no'];
    $op_code = $_GET['operator'];
    $circle = $_GET['circle'];
    $amount = $_GET['amount'];
    $ip = $_SERVER['REMOTE_ADDR'];
    $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();

    if($con->query("select * from Api_users where API_KEY='$api_key'")->num_rows == 1){
        $api_user_bal = $api_user['RCBAL'];
        $api_user_ip = $api_user['IP'];
        if($ip == $api_user_ip){
            if($api_user_bal > $amount){
                    $op = $con->query("select * from switchOperator where API_USER_CODE='$op_code'")->fetch_assoc();
                    $op_lng_code = $op['LONGCODE'];
                    $op_name = $op['PRODUCTNAME'];
                    $serchApi = $op['APICOMPANY'];
                    $backup_api = $op['BACKUP_API'];
                    api_recharge($serchApi , $mobile_no , $op_lng_code , $amount , $api_key ,$backup_api , $op_name);
                    // if($serchApi == "MYRC"){
                    //     myrc($mobile_no , $op_lng_code , $amount , $circle , $api_key);
                    //   }
                
            }else{
                $api_response = json_encode(array("status" => "Failed" , "msg"=>"Invaild Amount"));
                echo $api_response;
            }
            
        }else{
                $ip_error = "Invaild IP ".$ip;
                $api_response = json_encode(array("status" => "Failed" , "msg"=>$ip_error , "code"=>"403"));
                echo $api_response;
        }
        
    }else{
            $api_response = json_encode(array("status" => "Failed" , "msg"=>"Invaild Api Key" , "code"=>"404" ));
            echo $api_response;
    }
}



// api_recharge($api_name , $mobile , $operator , $amount , $api_key);

// function to recharge api user 

function api_recharge($api_name , $mobile , $operator , $amount , $api_key , $backup_api , $op_name){
    global $con; // use connection in function 
    
    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");
    // echo $api_name;
    //search api from db 
    $api = $con->query("SELECT * FROM `rechargeApi` WHERE NAME='$api_name' and `STATUS` ='Activate'")->fetch_assoc();
    $url_p = $api['APIURL']; // p defines to parameter
    $mobile_p = $api['MBPARAMETER'];
    $operator_p = $api['OPRAMETER'];
    $amount_p = $api['AMNTPARAMETER'];
    $format = $api['APITYPE'];
    $circle_p = $api['APITYPE'];
    $txn_p = $api['TXNIDPARAMETER'];
    $optional_p = $api['OPTNLPARAMETER'];
    $response_type_p = $api['APITYPE'];
    $hit_type_p = $api['APIHITTYPE'];
    
    //result parameters
    $rs_txn_id = $api['RESULT_TXN_PARA'];
    $rs_op_id = $api['RESULT_OP_ID_PARA'];
    $rs_status = $api['RESULT_ST_PARA'];
    $rs_error = $api['RESULT_ERROR_PARA'];
    $success_response = $api['SCSRESPONSE'];
    $pending_response = $api['PNDRESPONDE'];
    
    $txn_id = mt_rand(1000000 , 200000000); // random number genrate for trans. ID
    //start curl request 
    $ch = curl_init();
    //api request url 
    $live_url = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&$txn_p=$txn_id&$optional_p";
    //curl setup
    curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //check api HIT type POST or GET
    if($hit_type_p == "POST"){
        curl_setopt($ch, CURLOPT_POST, TRUE);
    }else{
        curl_setopt($ch, CURLOPT_POST, FALSE);
    }
    
    //curl response 
    $response = curl_exec($ch);
    //curl close 
    curl_close ($ch);
    //insert into api hit all response
    $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('$live_url' , '$response')");
    // echo $response;
    //get api response type
    if($response_type_p == "JSON"){
        $result = json_decode($response);
    }else if($response_type_p == "XML"){
        $result = simplexml_load_string($response);
    }
    $status_r =  $result->$rs_status; // here r represent response 
    $error_r =  $result->$rs_error;
    $txn_id_r =  $result->$rs_txn_id;
    $operator_id_r =  $result->$rs_op_id;
    
     $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();
     $api_user_id = $api_user['ID'];
     $api_user_bal = $api_user['RCBAL'];
     $api_user_comm = $api_user['COMM_PACK'];
     $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$api_user_comm' and OP_NAME='$op_name'")->fetch_assoc();
     $prcent = $q2['PERCENTAGE'];
     $am = ($amount/100)*$prcent;
     $am2 = $amount-$am;
     $am3 = $api_user_bal - $am2;
     //display api response in our json format
     $api_response = json_encode(array("status" => $status_r , "transaction_id" => $txn_id_r , "operator_id" => $operator_id_r , "msg"=>$error_r ));
    // check wheater status is success or pending
    if($status_r == $success_response ||$status_r == $pending_response){
           $insert_data = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('$ms_admin','1','API_USER','$api_user_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
           if($con->query("update Api_users set RCBAL='$am3' where API_KEY='$api_key'")){
               $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date')");
           }
         echo $api_response;
        }else{
            $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,
            `API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('ADMIN','1','API_USER','$api_user_id', '$mobile'
            ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");            
                // shift to backup api
              $backup_op = $con->query("select * from operatorManager where PRODUCTNAME='$op_name' and SERVICEAPI='$backup_api'")->fetch_assoc();
              $backup_op_longcode = $backup_op['PRODUCTCODE'];
              backup_api($backup_api , $mobile , $backup_op_longcode , $amount , $api_key , $op_name);
    }
}


//function for backup api
function backup_api($api_name , $mobile , $backup_op_longcode , $amount , $api_key , $op_name){
    global $con; // use connection in function 

    date_default_timezone_set('Asia/Kolkata');
    $date = date("Y-m-d");
    $time = date("g:i:s A");
        
    //search api from db 
    $api = $con->query("SELECT * FROM `rechargeApi` WHERE NAME='$api_name' and `STATUS` ='Activate'")->fetch_assoc();
   
    $url_p = $api['APIURL']; // p defines to parameter
    $mobile_p = $api['MBPARAMETER'];
    $operator_p = $api['OPRAMETER'];
    $amount_p = $api['AMNTPARAMETER'];
    $format = $api['APITYPE'];
    $circle_p = $api['APITYPE'];
    $txn_p = $api['TXNIDPARAMETER'];
    $optional_p = $api['OPTNLPARAMETER'];
    $response_type_p = $api['APITYPE'];
    $hit_type_p = $api['APIHITTYPE'];
    
    //result parameters
    $rs_txn_id = $api['RESULT_TXN_PARA'];
    $rs_op_id = $api['RESULT_OP_ID_PARA'];
    $rs_status = $api['RESULT_ST_PARA'];
    $rs_error = $api['RESULT_ERROR_PARA'];
    $success_response = $api['SCSRESPONSE'];
    $pending_response = $api['PNDRESPONDE'];
    
    $txn_id = mt_rand(1000000 , 200000000); // random number genrate for trans. ID
    //start curl request 
    $ch = curl_init();
    //api request url 
    $live_url = "$url_p&$mobile_p=$mobile&$operator_p=$operator&$amount_p=$amount&$txn_p=$txn_id&$optional_p=$hit_type_p";
    //curl setup
    curl_setopt($ch, CURLOPT_URL, $live_url); //Using live here
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    //check api HIT type POST or GET
    if($hit_type_p == "POST"){
        curl_setopt($ch, CURLOPT_POST, TRUE);
    }else{
        curl_setopt($ch, CURLOPT_POST, FALSE);
    }
    
    //curl response 
    $response = curl_exec($ch);
    //curl close 
    curl_close ($ch);
    //insert into api hit all response
    $con->query("INSERT INTO `ApiHit`(`API`, `RESPONSE`) VALUES('BACKUP_API.$live_url' , '$response')");
    
    //get api response type
    if($response_type_p == "JSON"){
        $result = json_decode($response);
    }else if($response_type_p == "XML"){
        $result = simplexml_load_string($response);
    }
    $status_r =  $result->$rs_status; // here r represent response 
    $error_r =  $result->$rs_error;
    $txn_id_r =  $result->$rs_txn_id;
    $operator_id_r =  $result->$rs_op_id;
    
     $api_user = $con->query("select * from Api_users where API_KEY='$api_key'")->fetch_assoc();
     $api_user_id = $api_user['ID'];
     $api_user_bal = $api_user['RCBAL'];
     $api_user_comm = $api_user['COMM_PACK'];
     $q2 = $con->query("SELECT * FROM operator_comm where PACKAGE_ID='$api_user_comm' and OP_NAME='$op_name'")->fetch_assoc();
     $prcent = $q2['PERCENTAGE'];
     $am = ($amount/100)*$prcent;
     $am2 = $amount-$am;
     $am3 = $api_user_bal - $am2;
     //display api response in our json format
     $api_response = json_encode(array("status" => $status_r , "transaction_id" => $txn_id_r , "operator_id" => $operator_id_r , "msg"=>$error_r ));
   
    //  echo $api_response;
    // check wheater status is success or pending
    if($status_r == $success_response ||$status_r == $pending_response){
       $insert_data = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` , `API_NAME` ,  `OP` , `DATE`,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`) VALUES('ADMIN','1','API_USER','$api_user_id', '$mobile' ,'$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '$am3' ,'Debit' , '$am2' , '$time')");
       if($con->query("update Api_users set RCBAL='$am3' where API_KEY='$api_key'")){
           $con->query("INSERT INTO `comm_rpt`(`TYPE`, `USER_ID`, `PERCENT`, `AMOUNT` , `OP_NAME` , `DATE`) VALUES('API_USER','$api_user_id','$prcent','$am' , '$op_name' , '$date')");
       }
    }else{
        $query3 = $con->query("INSERT INTO `recharge_history`(`OWNER` , `OWNER_ID`,`PERSON` , `PERSON_ID` ,`NUMBER`, `AMOUNT`, `OPERATOR_ID`, `STATUS`, `TRANS_ID`, `ORDER_ID` ,`API_NAME` ,  `OP` , `DATE`  ,`REMAIN_BAL` , `TRANS_TYPE`,`DEDUCT_BAL` , `TIME`)  VALUES('ADMIN','1','API_USER','$api_user_id', '$mobile','$amount','$operator_id_r' ,'$status_r','$txn_id_r','$txn_id' , '$api_name' , '$op_name' , '$date', '' ,'Failed' , '' , '$time')");            
    }
}
?>