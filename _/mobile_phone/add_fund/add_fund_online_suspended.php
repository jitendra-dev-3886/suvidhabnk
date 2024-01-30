<?php

$samar="one";

// if($samar == "one"){
    if(isset($_POST['online_fund'])){
        include("../includes/config.php");
        include("../includes/main_function.php");
        
        $order_id = $_POST['order_id'];
        $mobile = $_POST['mobile'];
        $password = $_POST['password'];
        $amount = $_POST['amount'];
        $status = $_POST['status'];
        $device = $_POST['device'];
        $ip_address = $_POST['ip_address'];
        
        
        //Testing variables
        // $mobile = "8240193509";
        // $password = "12345";
        // $amount = "5";
        // $status = "success";
        
        $mysql_qry = "select * FROM user WHERE MOBILE ='$mobile' AND PASSWORD = '$password'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            $owner = $row['MAIN_OWNER'];
            $owner_id = $row['MAIN_OWNER_ID'];
            $user_id = $row['ID'];
            if($status=="success"){
                //Users algo
                $old_bal = $row['MAIN_BAL'];
                $curr_bal = (int)$old_bal+(int)$amount;
                $sql = "UPDATE user SET MAIN_BAL='$curr_bal' WHERE MOBILE='$mobile'";
                mysqli_query($con, $sql);
                insert_allreport($user_id  ,$order_id , "Add Fund" , $old_bal  , $curr_bal , $amount , "Credit" , "Add Fund Transaction", $ip_address, $device);
            
                //Admins Algo
                $admin_qry = "select * FROM admin";
                $admin_result = mysqli_query($con ,$admin_qry);
                $admin_row = mysqli_fetch_array($admin_result);
                $old_bal = $admin_row['MAIN_BAL'];
                $curr_bal = (int)$old_bal-(int)$amount;
                $admin_sql = "UPDATE admin SET MAIN_BAL='$curr_bal'";
                mysqli_query($con, $admin_sql);
                insert_allreport_for_admin("1"  ,$order_id , "Add Fund" , $old_bal  , $curr_bal , $amount , "Debit" , "Add Fund Transaction", $ip_address, $device);
                
                $myArr = array(
                "status" =>true,
                "message" =>"Success",
                "code" =>1
                );

            echo json_encode($myArr);
                
            }else{
                
                //Users algo
                $old_bal = $row['MAIN_BAL'];
                $curr_bal = $row['MAIN_BAL'];
                insert_allreport($user_id  ,$order_id , "Add Fund" , $old_bal  , $curr_bal , $amount , "Credit" , "Add Fund Transaction", $ip_address, $device);
            
                //Admins Algo
                $admin_qry = "select * FROM admin";
                $admin_result = mysqli_query($con ,$admin_qry);
                $admin_row = mysqli_fetch_array($admin_result);
                $old_bal = $admin_row['MAIN_BAL'];
                $curr_bal = $old_bal;
                insert_allreport_for_admin("1"  ,$order_id , "Add Fund" , $old_bal  , $curr_bal , $amount , "Debit" , "Add Fund Transaction", $ip_address, $device);
                
                $myArr = array(
                "status" =>false,
                "message" =>"Failed due to failed status",
                "code" =>999
                );

            echo json_encode($myArr);
                
            }
            
               
        }
        else{
                $myArr = array(
                "status" =>false,
                "message" =>"failed due to internal error",
                "code" =>0
                );

            echo json_encode($myArr);
        }
        
    }
    
    

?>