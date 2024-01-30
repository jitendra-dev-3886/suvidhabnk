<?php

include("../includes/config.php");
include("../includes/fetch_data.php");
include("../includes/main_function.php");
include("../aeps/aeps_function.php");

      
    
$json = file_get_contents('php://input');
// Converts it into a PHP object
$data = json_decode($json);

    if($data!=null){
    
    $TRANSTYPE = $data->operator;
    $TXNID = $data->ClientRefID;
    $RESPONSE = $data->txnStatus;
    $BANKRRN = $data->RRN;
    $TRANSAMOUNT = $data->amount;
    $ERROR_CODE = $data->errorCode;
    $ERROR_MESSAGE = $data->errorMsg;
    $AGENT_ID = $data->agentId;
    $MOBILE = $data->mobile;
    $CARDNUMBER = $data->cardNo;
    $BALAMOUNT = $data->cardBalance;
    $DATE = $data->transactionDatetime;
    $DEVICE_NO = $data->deviceNo;
    $SERVICE = $data->service;
    
    
    
    /*
    $TRANSTYPE = "Cash Withdrawal";
    $TXNID = "12121***";
    $RESPONSE = "Success";
    $BANKRRN = "03****";
    $TRANSAMOUNT = "3000";
    $ERROR_CODE = "0";
    $ERROR_MESSAGE ="Success"; 
    $AGENT_ID = "7986672305";
    $MOBILE = "9999*****";
    $CARDNUMBER = "510372******3579";
    $BALAMOUNT ="32024.98"; 
    $DATE = "2020-11-09 17:29:34";
    $DEVICE_NO = "BK***";
    $SERVICE = "Micro ATM";
    
    {"operator":"Cash Withdrawal","ClientRefID":"12121***","txnStatus":"Success","RRN":"03****","amount":"3000","errorCode":"
0","errorMsg":"Success","service":"Micro
ATM","agentId":"75***","mobile":"9999*****","cardNo":"510372******3579","cardBalance":"32024.98","trans
actionDatetime":"2020-11-09 17:29:34","deviceNo":"BK***"}
    
    */
    

    //locate user...
    $bankit_user = $con->query("SELECT * FROM `bankit_matm` WHERE AGENT_ID='$AGENT_ID'")->fetch_assoc();
    $user_id = $bankit_user['USER_ID'];
    $id = $user_id;
    $user = $con->query("SELECT * FROM `user` WHERE ID='$user_id'")->fetch_assoc();
    $user_type = $user['USER_TYPE'];

    //insert Queury
     $query = "INSERT INTO `micro_atm`(`USER_ID`, `USER_STATUS`, `RESPONSE`, `TRANSAMOUNT`, `BALAMOUNT`, `BANKRRN`, `TXNID`, `TRANSTYPE`, `TYPE`, `CARDNUMBER`, `CARDTYPE`, `TERMINALLD`, `BANKNAME`, `DATE`, `DEVICE_NO`,`SERVICE`,`AGENT_ID`,`MOBILE`,`ERROR_CODE`,`ERROR_MESSAGE` ,`API_RESPONSE`) 
            VALUES ('$user_id','$user_type','$RESPONSE','$TRANSAMOUNT','$BALAMOUNT','$BANKRRN','$TXNID','$TRANSTYPE','$SERVICE','$CARDNUMBER','','','','$DATE','$DEVICE_NO','$SERVICE','$AGENT_ID','$MOBILE','$ERROR_CODE','$ERROR_MESSAGE' , '$json')";
        $run_query = mysqli_query($con , $query);
        
        if($TRANSTYPE=="Cash Withdrawal" && $RESPONSE == "Success"){
              $old_bal = $user['MAIN_BAL'];
              $new_bal = $old_bal + (int)$transAmount;
              $sql = "UPDATE user SET MAIN_BAL='$new_bal' WHERE ID='$id'";
              mysqli_query($con, $sql);
             //Commission system ===>> apply commission logic here... 
            insert_allreport($user_id  ,$TXNID , "ATM" , $old_bal  , $new_bal , $TRANSAMOUNT , "Atm Withdraw" , "Micro Atm Transaction", "Not Available", "Android");
            give_micro_com($reference , $user_id , $user_status, "No Ip detail", "Android");
        //yaha comission dilado function se
            
            
        }
        else if($TRANSTYPE=="Cash Withdrawal" && $RESPONSE != "Success"){
            $old_bal = $user['MAIN_BAL'];
            insert_allreport($user_id  ,$TXNID , "ATM" , $old_bal  , $old_bal , $TRANSAMOUNT , "Atm Withdraw" , "Micro Atm Transaction", "Not Available", "Android");
        }
        else if($TRANSTYPE!="Cash Withdrawal" && $RESPONSE == "Success"){
            $old_bal = $user['MAIN_BAL'];
            insert_allreport($user_id  ,$TXNID , "ATM" , $old_bal  , $old_bal , $TRANSAMOUNT , "Enquiry" , "Micro Atm Transaction", "Not Available", "Android");
        }
        else{
            insert_allreport($user_id  ,$TXNID , "ATM" , $user['MAIN_BAL']  , $user['MAIN_BAL'] , $TRANSAMOUNT , "Enquiry" , "Micro Atm Transaction", "Not Available", "Android");
        }
    }


?>