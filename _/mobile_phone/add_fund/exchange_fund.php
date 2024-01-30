<?php

    include("../includes/config.php");
    include("../includes/main_function.php");
    
    $mobile= $_POST['mobile'];
    $password = $_POST['password'];
    $token = $_POST['token'];
    $amount = $_POST['amount'];
    
    // from Agent WalletTransfer
    $aeps_to_main = $_POST['aeps_to_main'];
    


        $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile' AND PASSWORD = '$password' AND TOKEN_ID = '$token'";
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
            
            
            $fetch_again = "select * FROM user WHERE MOBILE ='$mobile' AND PASSWORD = '$password' AND TOKEN_ID = '$token'";
            $fetch = mysqli_query($con ,$fetch_again);
            
            $row = mysqli_fetch_array($fetch);

            $usertype_id = $row['USER_TYPE'];
            $user_type = $con->query("SELECT * FROM `user_type` WHERE ID='$usertype_id' and STATUS='ACTIVE'")->fetch_assoc(); 
            $usertypename =  $user_type['NAME'];
            
        
            $order_id = date('YmdHis') . gettimeofday()['usec'];
            //Uodate history here if needed...
            
            $con->query("UPDATE user SET AEPS_BAL='$aeps_f' WHERE MOBILE ='$mobile' AND PASSWORD = '$password'");
            insert_allreport($user_id  ,$order_id , "Fund Wallet Exchange" , $a_bal  , $aeps_f , $amount , "Debit" , "Fund Wallet Exchange", $ip_address, $device, "AEPS");
            
            $con->query("UPDATE user SET MAIN_BAL='$main_f'  WHERE MOBILE ='$mobile' AND PASSWORD = '$password'");
            insert_allreport($user_id  ,$order_id , "Fund Wallet Exchange" , $m_bal  , $main_f , $amount , "Credit" , "Fund Wallet Exchange", $ip_address, $device, "MAIN");
            
            
            $myArr = array(
                "status" =>true,
                "message" =>"Balance Transfferred",
                "user"=>[
                "email"=>$row["EMAIL"],
                "mobile"=>$row["MOBILE"],
                "password"=>$row["PASSWORD"],
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
