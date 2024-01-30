<?php
error_reporting(0);


    if(isset($_POST['id'])){
        include("../includes/config.php");
        include("../includes/main_function.php");
        $id = $_POST['id'];
        $user_type = $_POST['user_type'];
        $token = $_POST['token'];
        $password = $_POST['password'];
        $amount = $_POST['amount'];
        $mobile = $_POST['to_mobile'];
        $ref = generateRandomString();
        
        $mysql_qry = "select * FROM user WHERE ID ='$id' AND USER_TYPE = '$user_type' AND TOKEN_ID='$token' AND PASSWORD='$password'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_array($result);
            
            $my_mobile = $row['MOBILE'];
            $my_oldbal = $row['MAIN_BAL'];
            
            if($my_oldbal<(int)$amount){
                $myArr = array(
                "status" =>false,
                "message" =>"Payment Unsuccesful, You don't have enough balance");
                echo json_encode($myArr);
                return;
            }
            
            $my_newbal = (int)$my_oldbal-(int)$amount;
            $mysql = "UPDATE user SET MAIN_BAL='$my_newbal' WHERE ID='$id'";
            $mycheck = mysqli_query($con, $mysql);
            
            
            $his = $con->query("SELECT * FROM `user` WHERE MOBILE='$mobile' and US_STATUS='ACTIVE'")->fetch_assoc(); 
            $his_id = $his['ID'];
            $his_oldbal = $his['MAIN_BAL'];
            $his_newbal = (int)$his_oldbal+(int)$amount;
            $hissql = "UPDATE `user` SET MAIN_BAL='$his_newbal' WHERE MOBILE='$mobile'";
            $hischeck = mysqli_query($con, $hissql);
            
         if($mycheck && $hischeck){   
                $myArr = array(
                "status" =>true,
                "message" =>"Payment Successful");
                echo json_encode($myArr);
            }
            else{
                $myArr = array(
                "status" =>false,
                "message" =>"Payment Unsuccesful");
                echo json_encode($myArr);
            }
            
            
            //mine
            //will be resumed later...
            // $query = "INSERT INTO `user_profile`(`MAIN_OWNER`, `MAIN_OWNER_ID`)
            // VALUES ('$main_owner','$main_owner_id')";
            // $run_query = mysqli_query($con , $query);
            
            
            //his
            
            
            
            
            
             //mine
             insert_allreport($id  ,$ref , "Add Fund(Mobile Number)" , $my_oldbal  , $my_newbal , $amount , "Debit" , "Fund Paid to: ".$mobile, $ip_address, $device);
             //his
             insert_allreport($his_id  ,$ref , "Recieved Fund(Mobile Number)" , $his_oldbal  , $his_newbal , $amount , "Credit" , "Fund Paid by: ".$my_mobile, $ip_address, $device);
            
        }
        else{
            
                
                $myArr = array(
                "status" =>false,
                "message" =>"Payment Unsuccesful");
                echo json_encode($myArr);
            
        }
        
        
        
    }
    else
    {
        
                $myArr = array(
                "status" =>false,
                "message" =>"Sonething went wrong..");
                echo json_encode($myArr);
    }
    
    
    
    
    
    
    
    
    function generateRandomString() {
    $length = 25;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

?>
