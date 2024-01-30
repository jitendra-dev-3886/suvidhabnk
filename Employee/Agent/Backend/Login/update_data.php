<?php

    
    include("../../../Db/config.php");
    include("../Userinfo/getuserinfo.php");
    include("../Functions/all_function.php");
    include("../Auth/userdata.php");

    $path = "../../../Dashboard/User/img/profile/";

    
    if(isset($_POST['update_profile_details'])){
        
        $user_type_id = $user['USER_TYPE'];
        $f_name = $_POST['f_name'];
        $l_name = $_POST['l_name'];
        $a_number = $_POST['a_number'];
        $dob = $_POST['dob'];
        $gender = $_POST['gender'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $pin = $_POST['pin'];
        $address = $_POST['address'];
        $token_id = $_POST['token'];
            
        $sql = "UPDATE `user` SET `FIRST_NAME`='$f_name',`LAST_NAME`='$l_name',`ADDRESS`='$address',`CITY`='$address',`STATE`='$state',`PIN`='$pin' WHERE ID='$usid'";
        mysqli_query($con, $sql);
        
        
        $sql_profile = "UPDATE `user_profile` SET `ALTERNATE_PHONE_NO`='$a_number',`DOB`='$dob',`GENDER`='$gender',`COUNTRY`='$country',`STATE`='$state' WHERE USER_ID='$usid'";
        mysqli_query($con, $sql_profile);   
        
            $myArr = array(
            "status" =>true,
            "message" =>"Profile Updated",
            "code"=>0
            );

        echo json_encode($myArr);
            
        
    }


if(isset($_POST['profile_picture'])){
    
        
        $p_image =  $_POST['profile_picture'];
        $id = $user['ID'];
            
            $data = base64_decode($p_image);
            
        
            
            $imageName = $user['MOBILE'].".png";
            $insertion = $path.$imageName;
    
        
            file_put_contents("$insertion" ,$data);
            
            
            
            $sql_profile = "UPDATE `user_profile` SET `PROFILE_IMG` ='$imageName' WHERE USER_ID='$id'";
            if(mysqli_query($con, $sql_profile)){
                    
            $myArr = array(
                "status"=>true,
                "response_code"=>1,
                "message"=>"Profile Picture updated",
                "txnstatus"=>1
                );
            echo json_encode($myArr);      
                
            }else{
                
                $myArr = array(
                "status"=>false,
                "response_code"=>2,
                "message"=>"Failed due to internal server issue",
                "txnstatus"=>2
                );
            echo json_encode($myArr);
                
        }   
}

if(isset($_POST['update_my_password'])){

        $password = $_POST['password'];
        $mobile = $user['MOBILE'];
        $new_password = $_POST['new_password'];
            
            
        $mysql_qry = "select * FROM user WHERE ID='$usid' AND MOBILE ='$mobile' AND PASSWORD = '$password'";
        $result = mysqli_query($con ,$mysql_qry);
        if(mysqli_num_rows($result) > 0) {
            //update_older
            $sql_profile = "UPDATE `user` SET `PASSWORD`='$new_password' WHERE ID='$usid'";
            if(mysqli_query($con, $sql_profile)){
             $myArr = array(
                "status" =>true,
                "message" =>"Password Updated",
                "code"=>0
                );    
            }else{ 
                $myArr = array(
                "status" =>false,
                "message" =>" Invalid Password",
                "code"=>20
                );
            }
    }
    else{ 
         $myArr = array(
         "status" =>false,
         "message" =>" Invalid Password",
         "code"=>20
         );
    }
    echo json_encode($myArr);
}


?>