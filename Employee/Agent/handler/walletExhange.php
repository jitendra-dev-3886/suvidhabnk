<?php
session_start();
require_once('../../Db/config.php');
require_once('../include/Auth.php');
$usid = $_SESSION['UsId']; 
$transfer_to   = $_POST['wallet_type'];
$wallet_amount = $_POST['amount'];


if($_POST['type']==1){
    

     $main_wallet = $user['MAIN_BAL'];    
     $aeps_wallet = $user['AEPS_BAL'];    
     
     $main_owner = $user['MAIN_OWNER']; 
     $main_owner_id = $user['MAIN_OWNER_ID']; 
     $owner_id = $user['OWNER_ID']; 
     
    if($transfer_to == "AEPS_TO_MAIN"  && $aeps_wallet >= $wallet_amount ){
     
    $move_aeps_balance = $aeps_wallet - $wallet_amount;
    $move_main_balance = $main_wallet + $wallet_amount;
   
     $insert_transaction = "INSERT INTO `wallet_exchange`(`USER_TYPE`, `USER_ID`, `WALLET_TYPE`, `TRANS_ID`, `AMOUNT`, `MAIN_BAL_BEFORE`, `MAIN_BAL_AFTER`, `AEPS_BAL_BEFORE`, `AEPS_BAL_AFTER`, `STATUS`) VALUES 
     ('','$usid','AEPS TO MAIN','','$wallet_amount','$move_main_balance','$main_wallet','$aeps_wallet','$move_aeps_balance','Success')";
     
    //   echo $insert_transaction;
    //   die();
      
     if($con->query($insert_transaction)){
         $update_wallet = $con->query("UPDATE `user` SET `MAIN_BAL`='$move_main_balance',`AEPS_BAL`='$move_aeps_balance' WHERE ID='$usid'");
                echo "Amount Exchange AePS to Main wallet";
     }
    }else{
         echo "Insufficient Balance in Users Wallet";
    }

}else{
    echo "Failed to Add";
}

?>