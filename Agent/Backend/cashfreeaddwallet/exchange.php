<?php

include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");
include("../Auth/userdata.php");
    
        $amount = $_POST['amount'];
    
        $mobile = $user['MOBILE'];
        // from Agent WalletTransfer
        $aeps_to_main = $_POST['aeps_to_main'];
    
        $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
           
           $early = mysqli_fetch_array($result);
           $user_id = $early['ID'];    
           $m_bal = $early['MAIN_BAL']; 
           $a_bal = $early['AEPS_BAL']; 
           $main_f =  $early['MAIN_BAL']; 
           $aeps_f =  $early['AEPS_BAL']; 
           
            if($aeps_f=="" || $aeps_f<$amount){
                
                  $myArr = array(
                "status" =>false,
                "message" =>"Insufficient Fund in AePS Balance to transfer",
                "user"=>[
                "email"=>null,
                "mobile"=>null,
                "password"=>null
                ,"name"=>null,
                "userStatus"=>null,
                "token"=>null,
                "id"=>null,
                "mainBalance"=>null,
                "aepsBalance"=>null,
                "ownerStatus"=>null,
                "ownerId"=>null,
                "lastName"=>null,
                "pin"=>null,
                "address"=>null
                ]
                );

            echo json_encode($myArr);
                
                return;
            }
           
            
            $main_f = $main_f+$amount;
            $aeps_f = $aeps_f-$amount;
            
            
    
            
    
            
            $order_id = date('YmdHis') . gettimeofday()['usec'];
            //Uodate history here if needed...
            
            $con->query("UPDATE user SET AEPS_BAL='$aeps_f' WHERE MOBILE ='$mobile'");
            insert_allreport($user_id  ,$order_id , "Fund Wallet Exchange" , $a_bal  , $aeps_f , $amount , "Debit" , "Fund Wallet Exchange", "AEPS");
            
            $con->query("UPDATE user SET MAIN_BAL='$main_f'  WHERE MOBILE ='$mobile'");
            insert_allreport($user_id  ,$order_id , "Fund Wallet Exchange" , $m_bal  , $main_f , $amount , "Credit" , "Fund Wallet Exchange");
            
            
            $fetch_again = "select * FROM user WHERE MOBILE ='$mobile'";
            $fetch = mysqli_query($con ,$fetch_again);
            
            $row = mysqli_fetch_array($fetch);
            
            
            $myArr = array(
                "status" =>true,
                "message" =>"Balance Transfferred",
                "user"=>[
                "email"=>$row["EMAIL"],
                "mobile"=>$row["MOBILE"],
                "password"=>"",
                "name"=>$row['FIRST_NAME'],
                "lastname"=>$row['LAST_NAME'],
                "ownerid"=>$row['MAIN_OWNER_ID'],
                "ownerstatus"=>$row['MAIN_OWNER'],
                "userstatus"=>$row['USER_TYPE'],
                "token"=>$row['TOKEN_ID'],
                "id"=>$row['ID'],
                "mainbalance"=>$row['MAIN_BAL'],
                "aepsbalance"=>$row['AEPS_BAL'],
                "userstatusname"=>$usertypename,
                "pin"=>$row['PIN'],
                "address"=>$row['ADDRESS']
                ]
                );

            echo json_encode($myArr);
        }
        else{ 
                $myArr = array(
                "status" =>false,
                "message" =>"You are no longer authorised",
                "user"=>[
                "email"=>null,
                "mobile"=>null,
                "password"=>null
                ,"name"=>null,
                "userStatus"=>null,
                "token"=>null,
                "id"=>null,
                "mainBalance"=>null,
                "aepsBalance"=>null,
                "ownerStatus"=>null,
                "ownerId"=>null,
                "lastName"=>null,
                "pin"=>null,
                "address"=>null
                ]
                );

            echo json_encode($myArr);
        }


?>
