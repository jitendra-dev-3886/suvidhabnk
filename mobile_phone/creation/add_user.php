<?php
    
    $companyname = "HRC MULTI";
    $id = $_POST['id'];
    $my_status = $_POST['my_status'];
    $token = $_POST['token'];
    $password = $_POST['password'];
    
    $user_email = $_POST['user_email'];
    $user_number = $_POST['user_number'];
    $user_city = $_POST['user_city'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $creation = $_POST['creation'];
    
    
    $id = "3";
    $my_status = "1";
    $token = "r1tT0VIl5bFr8yreRBSN";
    $password = "Kanu#1234";
    
    $user_email = "sksamar131hv297@gmail.co";
    $user_number = "8240193899";
    $user_city = "Kolkata";
    $first_name = "Siddiq";
    $last_name = "Meer";
    $creation = "34";
    
    
    
    
    if(isset($_POST['token'])){
        
        include("../includes/config.php");
        include("../includes/main_function.php");
        
        $mysql_qry = "select * FROM user WHERE ID ='$id' AND PASSWORD = '$password' AND TOKEN_ID = '$token'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            
            
        $mysql_qry_email = "select * FROM user WHERE EMAIL ='$user_email'";
        $result_email = mysqli_query($con ,$mysql_qry_email);
        
        $mysql_qry_mobile = "select * FROM user WHERE MOBILE = '$user_number'";
        $result_mobile = mysqli_query($con ,$mysql_qry_mobile);
        
        if(mysqli_num_rows($result_email) > 0) {
            //email already exists..
                $myArr = array(
                "status" =>false,
                "message" =>"Failed, As email already exists"
                );
                echo json_encode($myArr);
        }
        else if(mysqli_num_rows($result_mobile) > 0){
                //mobile already exists..
                $myArr = array(
                "status" =>false,
                "message" =>"Failed, As mobile number already exists"
                );
                echo json_encode($myArr);
        }
        else{
            //create an account
            $date = date("Y-m-d H:i:s");
            $user_password = mt_rand(100000,999999);
            $query = "INSERT INTO `user`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `TOKEN_ID`, `USER_TYPE`, `OWNER_ID`, `SERVICES`, `FIRST_NAME`, `LAST_NAME`, `MOBILE`,
            `EMAIL`, `MAIN_BAL`, `AEPS_BAL`, `ADDRESS`, `CITY`, `STATE`, `PIN`, `ADHAAR`, `PAN`, `RC_COMM`, `AEPS_COMM`, `DMT_COMM`, `US_STATUS`, `PASSWORD`, `OTP`, 
            `LOGIN_AUTH`, `DATE`) VALUES ('$my_status','$id','','$creation','$id','','$first_name','$last_name','$user_number','$user_email','0','0',
            '','','$user_city','','','','','','','Active','$user_password','1','1','$date')";
            $run_query = mysqli_query($con , $query);
            if($run_query){
                        
                $myArr = array(
                "status" =>true,
                "message" =>"Success, the password and the credential has been sent to the registered mobile and email"
                );
                echo json_encode($myArr);   
                
                
                $Email_message = "Dear $first_name $last_name,\n Your  password for online registration of $companyname is: $user_password.\n Thanks & Regards, \n Team $companyname \n M: $companyemail \n E: $companyemail";
                $Mobile_sms = urlencode("Dear $first_name $last_name, Your one time password for online registration of $companyname is: $user_password. Thank You, By Team $companyname.");
                if($user_email != ""){
                    SendMail($user_email,$Email_message);
                }
            }
            else{
                $myArr = array(
                "status" =>false,
                "message" =>"Failed, As there is an internal error"
                );
                echo json_encode($myArr);
            }
            
            
            
        }
            
        }
        else{
            
                $myArr = array(
                "status" =>false,
                "message" =>"Failed, Your are no longer authorised to use this service"
                );
                echo json_encode($myArr);
        }
        
        
        
    }
    



?>