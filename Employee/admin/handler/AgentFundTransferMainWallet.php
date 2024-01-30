<?php
session_start();
require_once('../../Db/config.php');
include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");

      $_SESSION["token_id"] = $token_id;
      $id = $_SESSION["UsId"];
      $fundType = mysqli_real_escape_string($con, $_POST["fundType"]); 
      
      $mobile = mysqli_real_escape_string($con, $_POST["mobile"]);  
      $usermobile= $con->query("SELECT * FROM `user` WHERE MOBILE='$mobile' OR PARTNER_ID = '$mobile'")->fetch_assoc();
      $tran_user_id = $usermobile['ID'];
      $user_prev_bal = $usermobile['MAIN_BAL'];
    
      $amt = mysqli_real_escape_string($con, $_POST["amt"]);  
      $remark = mysqli_real_escape_string($con, $_POST["remark"]);  
        $refid = "PDR".date("Ymd").mt_rand(999 , 9999);
      if($fundType == "Debit")
       {
           if($user_prev_bal > $amt){
               $update_bal= $user_prev_bal - $amt;
              $con->query("INSERT INTO `fund_transfer`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `OWNER_ID`, `TRANSFER_USER_ID`, `USER_PREVIOUS_AMOUNT`, `AMOUNT`, `USER_AFTER_AMOUNT`, `FUND_TYPE`, `WALLET_TYPE`,
      `OWNER_PREVIOUS_AMOUNT`, `OWNER_AFTER_AMOUNT`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`,
      `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE` , `REF_ID`) 
               VALUES ('ADMIN','1','$token_id','Admin','$tran_user_id','$user_prev_bal','$amt','$update_bal','$fundType','MAIN_BAL','','','$remark','','','','','','','','','','','','','','','','','','' , '$refid')");
               
            //   insert_allreport($tran_user_id  ,$refid , $trans , $user_prev_bal  , $update_bal , $amt , $fundType , '');
               $con->query("UPDATE `user` SET `MAIN_BAL`='$update_bal' WHERE ID ='$tran_user_id'");
              insert_allreport($tran_user_id  ,$refid , "Fund Transfer" ,$user_prev_bal  , $update_bal , $amt , "Debit" , "Fund Transfer", "MAIN");
               
               echo "Balance Debited";

           }else{
               echo "Low User Balance";
           } 
           
       }elseif($fundType == "Credit"){
              $update_bal= $user_prev_bal + $amt;
               $con->query("INSERT INTO `fund_transfer`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `OWNER_ID`, `TRANSFER_USER_ID`, `USER_PREVIOUS_AMOUNT`, `AMOUNT`, `USER_AFTER_AMOUNT`, `FUND_TYPE`,`WALLET_TYPE`,
              `OWNER_PREVIOUS_AMOUNT`, `OWNER_AFTER_AMOUNT`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`,
              `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE` , `REF_ID`) 
                       VALUES ('ADMIN','1','$token_id','Admin','$tran_user_id','$user_prev_bal','$amt','$update_bal','$fundType','MAIN_BAL','','','$remark','','','','','','','','','','','','','','','','','','' , '$refid')");
                       
                    //   insert_allreport($tran_user_id  ,$refid , $trans , $user_prev_bal  , $update_bal , $amt , $fundType);
               $con->query("UPDATE `user` SET `MAIN_BAL`='$update_bal' WHERE ID ='$tran_user_id'");
              insert_allreport($tran_user_id  ,$refid , "Fund Transfer" ,$user_prev_bal  , $update_bal , $amt , "Credit" , "Fund Transfer", "MAIN");
              
               echo "Balance Credited";
 
       }else{
                echo "Something Went Wrongs";
       }

 
?>
