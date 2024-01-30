<?php
session_start();
require_once('../../Db/config.php');
include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");

      $_SESSION["token_id"] = $token_id;
      $id = $_SESSION["dtid"];
      
      $myData = $con->query("SELECT * FROM `user` WHERE ID='$id'")->fetch_assoc();
      $myBal = $myData['MAIN_BAL'];
      
      $fundType = mysqli_real_escape_string($con, $_POST["fundType"]); 
      
      $mobile = mysqli_real_escape_string($con, $_POST["mobile"]);  
      $usermobile= $con->query("SELECT * FROM `user` WHERE MOBILE='$mobile'")->fetch_assoc();
      $name = $usermobile['FIRST_NAME'];
      $tran_user_id = $usermobile['ID'];
      $user_prev_bal = $usermobile['MAIN_BAL'];
    
      $amt = mysqli_real_escape_string($con, abs($_POST["amt"]));  
      $remark = mysqli_real_escape_string($con, $_POST["remark"]);  
        $refid = "PDR".date("Ymd").mt_rand(999 , 9999);
      if($fundType == "Credit"){
                
             if($myBal > $amt){  
              $updateMyBal = $myBal - $amt;
              $con->query("UPDATE `user` SET `MAIN_BAL`='$updateMyBal' WHERE ID ='$id'");
              
              $update_bal= $user_prev_bal + $amt;
               $con->query("INSERT INTO `fund_transfer`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `OWNER_ID`, `TRANSFER_USER_ID`, `USER_PREVIOUS_AMOUNT`, `AMOUNT`, `USER_AFTER_AMOUNT`, `FUND_TYPE`,`WALLET_TYPE`,
              `OWNER_PREVIOUS_AMOUNT`, `OWNER_AFTER_AMOUNT`, `REMARK`, `STATUS`, `IP_ADDRESS`, `BROWSER`, `OS`, `DEVICE`, `LOCATION`, `TRANS_DATE`, `TRANS_TIME`, `COUNTRY`, `STATE`, `CITY`, `ZIP`,
              `LATTITUDE`, `LONGITUDE`, `API_IP`, `INTERNET_ISP`, `INTERNET_ORG`, `MESSAGE` , `REF_ID` ,`DATE`) 
                       VALUES ('ADMIN','1','$token_id','$id','$tran_user_id','$user_prev_bal','$amt','$update_bal','$fundType','MAIN_BAL','','','$remark'
                       ,'','','','','','','','','','','','','','','','','','' , '$refid' , '".date("Y-m-d g:i:s A")."')");
                       
                    //   insert_allreport($tran_user_id  ,$refid , $trans , $user_prev_bal  , $update_bal , $amt , $fundType);
                       
              insert_allreport($id  ,$refid , "Fund Transfer to user" ,$myBal  , $updateMyBal , $amt , "Debit" , "Fund Transfer", "MAIN");
              insert_allreport($tran_user_id  ,$refid , "Fund Recived from DT" ,$user_prev_bal  , $update_bal , $amt , "Credit" , "Fund Transfer", "MAIN");
              
               $con->query("UPDATE `user` SET `MAIN_BAL`='$update_bal' WHERE ID ='$tran_user_id'");
               echo "Balance Successfully Credited to $name";
             }else{
                 echo "Insufficiant Fund"; 
             }
 
       }else{
                echo "Something Went Wrongs";
       }

 
?>
