<?php
require_once('../../Db/config.php');
require("../Backend/Functions/all_function.php");
    

// insert Api Code
if(isset($_POST['addapi_user']) == 1){
       
       $name= filterVal($_POST['name']);
       $mobile= filterVal($_POST['mobile']);
       $pass= filterVal($_POST['pass']);
       $status= filterVal($_POST['status']);
       $ip_addr= filterVal($_POST['ip']);  
       
       $password=$pass;
       
        $add_userapi="INSERT INTO `api_user`(`TOKEN`, `NAME`, `MOBILE`, `MAIN_BAL`, `AEPS_BAL`, `PASSWORD`, `STATUS`, `IP`) VALUES ('','$name','$mobile','','','$password','$status','$ip_addr')";
        $run=mysqli_query($con,$add_userapi);
        if($run){
            $insid = mysqli_insert_id($con);
            $token = encrypt_token(json_encode(["MOBILE" => $mobile, "USERID"=> $insid, "IP" => $ip_addr, "PASSWORD" => $password] , true));
            $con->query("update api_user set TOKEN='$token' where ID='$insid'");
            echo 1;
        }else{
            echo 0;
        }
    }
    
?>