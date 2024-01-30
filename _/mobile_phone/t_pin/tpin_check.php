<?php

    include("../includes/config.php");
    
    if(isset($_POST['user_id'])){
        
        $id = $_POST['user_id'];
        $password = $_POST['password'];
        $token = $_POST['token'];
        
        $mysql_qry = "select * FROM user WHERE ID ='$id' AND PASSWORD='$password' AND TOKEN_ID='$token'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
        $mysqlX = "select * FROM tpin WHERE USER_ID ='$id'";
        $resultX = mysqli_query($con ,$mysqlX);
        if(mysqli_num_rows($resultX) > 0) {
            
            $row = mysqli_fetch_array($resultX);
            $TPIN = $row['TPIN'];
            $myArr = array(
                "status" =>true,
                "message" =>$TPIN,
                "response_code"=>1
            );
            echo json_encode($myArr); 
            
            
        }else{
            
            
                $myArr = array(
                "status" =>false,
                "message" =>"No T-Pin Data Found",
                "response_code"=>2
            );
            echo json_encode($myArr); 
            
        }
            
    
        }else{
            
                $myArr = array(
                "status" =>false,
                "message" =>"Session Expired",
                "response_code"=>999
            );
            echo json_encode($myArr); 
        }
        
        
    }



?>