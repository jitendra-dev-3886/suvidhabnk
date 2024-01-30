<?php
session_start();
ini_set("display_errors" , 1);
include("../../../Db/config.php");
include("../Userinfo/getuserinfo.php");
include("../Functions/all_function.php");

if(isset($_POST['mobile'])){

    $mobile = filterVal($_POST['mobile']);
    $password = filterVal($_POST['password']);
    
        $query = $con->query("select * FROM admin WHERE MOBILE='$mobile' AND PASSWORD ='$password' AND US_STATUS='ACTIVE'");
        $row = $query->num_rows;
        if($row!=0){
                $fetch_row=$query->fetch_assoc();
                $user_id = $fetch_row['ID'];
                $_SESSION['amid'] = $user_id;
                $_SESSION['adminToken'] = "";
                
    	        echo json_encode(["rs_code" => 200 ,  "User_Exist"=>"Yes" , "Status"=> true]);
        }else{
            $msg = "Login Failed";
            echo json_encode(array("rs_code"=> "404" , "User_Exist"=>"No" , "Status"=> false));
    	}
}



?> 