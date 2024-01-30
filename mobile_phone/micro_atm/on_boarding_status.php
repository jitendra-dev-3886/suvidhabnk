<?php
    
    if(isset($_POST['user_id'])){
        
        include("../includes/config.php");
        $user_id = $_POST['user_id'];
        $password = $_POST['password'];
        $token = $_POST['token'];
        

        $qry = "select * FROM `user` WHERE ID ='$user_id' AND PASSWORD='$password' AND TOKEN_ID='$token'";
        $chk = mysqli_query($con ,$qry);
        if(mysqli_num_rows($chk) > 0) {
            
        
        $mysql_qry = "select * FROM `bankit_matm` WHERE USER_ID ='$user_id'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
                $row = mysqli_fetch_array($result);
                
                $data = array(
                        "FIRST_NAME"=>$row['FIRST_NAME'],
                        "LAST_NAME"=>$row['LAST_NAME'],
                        "SERIAL_NUMBER"=>$row['SERIAL_NUMBER'],
                        "AADHAAR_NO"=>$row['AADHAAR_NO'],
                        "PAN_NO"=>$row['PAN_NO'],
                        "MOBILE_NUMBER"=>$row['MOBILE_NUMBER'],
                        "EMAIL"=>$row['EMAIL'],
                        "STATUS"=>$row['STATUS'],
                        "AGENT_ID"=>$row['AGENT_ID'],
                        "PARTNER_AGENT_ID"=>$row['PARTNER_AGENT_ID']
                    ); 
                
                $current_stat = strtolower($row['STATUS']);
                if($current_stat =="rejected"){
                $myArr = array(
                "status" =>false,
                "response_code"=>3,
                "message"=>"Rejected, Apply Again",
                "data"=>$data,
                "cred"=>null
                );
                echo json_encode($myArr);
            }
            
            else if($current_stat =="pending"){
                $myArr = array(
                "status" =>false,
                "response_code"=>2,
                "message"=>"Pending, Either wait or Contact the admin",
                "data"=>$data,
                "cred"=>null
                );
                echo json_encode($myArr);
            }
            
            else if($current_stat =="success" || $current_stat =="active"){
                
                $bank = $con->query("SELECT * FROM `bankit_api`")->fetch_assoc();
                $cred = array(
                        "developer_id"=>$bank['developer_id'],
                        "password"=>$bank['password']
                    );
                
                $myArr = array(
                "status" =>true,
                "response_code"=>1,
                "message"=>"Active",
                "data"=>$data,
                "cred"=>$cred
                );
                echo json_encode($myArr);
            }
        
        }
        else{
        
                $myArr = array(
                "status" =>false,
                "response_code"=>0,
                "message" =>"New OnBoarding",
                "data"=>null,
                "cred"=>null,
                "details"=>null
                );
                echo json_encode($myArr);
                
            
        }
            
        }
        else{
                $myArr = array(
                "status" =>false,
                "response_code"=>990,
                "message" =>"Not Authorised",
                "data"=>null,
                "cred"=>null,
                "details"=>null
                );
                echo json_encode($myArr);
            
        }
        
    }

?>