<?php
include('../includes/config.php');


if(isset($_POST['type']) == 1)
{
    
    $mobile=$_POST['mobile'];
    $dat =$con->query("SELECT * FROM `user` WHERE MOBILE='$mobile' ");   
    
    if(mysqli_num_rows($dat) < 1 )
    {
    
    
        $date = date("Y/m/d"); 
        $typeusr = $_POST['typeusr'];
        $fname = $_POST['fname'];
        $emp_id = $_POST['emp_id'];
        $email = $_POST['email'];
        $mobile = $_POST['mobile'];
        $address = $_POST['address'];
        $district = $_POST['alldistrict'];
        $block = $_POST['allblock'];
        $state = $_POST['allstate'];
        $password = $_POST['password'];
        $sql=  $con->query("INSERT INTO `user`( `EMPLOYEE_ID`,`TYPE`,`FULL_NAME`, `EMAIL`, `MOBILE`, `ADDRESS`,`DISTRICT`,`BLOCK`,`STATE`, `PASSWORD`,`DATE`,`TOKEN`) VALUES ('$emp_id','$typeusr','$fname','$email','$mobile','$address','$district','$block','$state','$password','$date','')");
        if($sql){
        $dat = array("stat"=>1,"msg"=>"User Created Sucessfully");
        
        echo json_encode($dat);
        
            
        }else{
        
        $dat = array("stat"=>0,"msg"=>"something went wrong");
        echo json_encode($dat);
        
            
        }
    
        
    }
    else
    {
        $dat = array("stat"=>0,"msg"=>"number already Exist");
        echo json_encode($dat) ;   
    }

    
    
    
    
    
}



?>