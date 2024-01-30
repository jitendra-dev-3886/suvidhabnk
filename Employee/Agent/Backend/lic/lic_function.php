<?php
// error_reporting(E_ALL);
// include("../../../../connection/config.php");
// ini_set("display_errors" , 1);

// give_com("wEoLBGVcMs" , 2 , 28);

// function give_com($ref_id , $user_id , $usertype){
//     global $con;
// $time = date("Y-m-d g:i:s A");
//         $user_type_rows = $con->query("select * from user_type ")->num_rows;
//         $rch = $con->query("select * from recharge_transaction where REFERENCE_ID='$ref_id'")->fetch_assoc();
//         $user = $con->query("select * from user  where ID='$user_id' and USER_TYPE='$usertype'")->fetch_assoc();
//         $owner = $user['OWNER_ID'];
//         $crnt_bal = $user['MAIN_BAL'];
//         $com = $user['RC_COMM'];
//         $pack = $con->query("select * from operator_comm where PACKAGE_ID='$com' and OP_ID='".$rch['OPERATOR']."' ")->fetch_assoc();
//         $com = $pack['PERCENTAGE'];
//         // print_r($pack);
//         // exit;
//         $com_amount = ($rch['AMOUNT']/100)*$com;
//         $update_bal = $crnt_bal+$com_amount;
//         $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' and USER_TYPE='$usertype'");
//          $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`, `TIME`) 
//                     VALUES ('Recharge','$ref_id','$user_id','$usertype','".$rch['AMOUNT']."','$com_amount','$time')");
//         // echo "<pre>";
//         // print_r($user);
//         // echo "<br>";

//         if(strtolower($owner) != "admin"){
//         // echo "<br>";
//             $i = 1;
//             while($user_type_rows >= $i){
//             // echo "work";
//                 $i++;
//                      $user2 = $con->query("select * from user  where ID='$owner'")->fetch_assoc();
//                     $owner2 = $user2['OWNER_ID'];
//                     $us_type = $user2['USER_TYPE'];
//                     // echo $owner2; 
//                     $crnt_bal2 = $user2['MAIN_BAL'];
//                     $com2 = $user2['RC_COMM'];
                    
//                     $pack2 = $con->query("select * from operator_comm where PACKAGE_ID='$com2' and OP_ID='".$rch['OPERATOR']."' ")->fetch_assoc();
//                     $com2 = $pack2['PERCENTAGE'];
//                     $com_amount2 = ($rch['AMOUNT']/100)*$com2;
//                     $update_bal2 = $crnt_bal2+$com_amount2;
//                     $con->query("update user set MAIN_BAL='$update_bal'  where ID='$user_id' and USER_TYPE='$usertype'");
//                     $con->query("INSERT INTO `commission_report`(`SERVICE`, `REFFRENCE`, `USER_ID`, `USER_TYPE`, `AMOUNT`, `COMMISSION`, `TIME`) 
//                     VALUES ('Recharge','$ref_id','$owner','$us_type','".$rch['AMOUNT']."','$com_amount2','$time')");
//                     // print_r($user2);
//                     if(strtolower($owner2) == "admin"){
//                         break;
//                     }
//             }
//         }
    
//     // return true;
// }






?>