<?php

include("../../Db/config.php");
include("../Backend/Functions/all_function.php");

if(isset($_POST["pageid"]) && $_POST["pageid"] == 1){
    
    $department_name = $_POST["dname"];
    $status = $_POST["status"];
    
    $add_dempt = $con->query("INSERT INTO `department`(`NAME`, `STATUS`) VALUES ('$department_name','$status')");
    
    if($add_dempt){
        echo 1;
    }else{
        echo 0;
        
    }
}


if(isset($_POST["pageid"]) && $_POST["pageid"] == 2){
    
   
    $status = $_POST["dstatus"];
    $id = $_POST["id"];
    
    $update_depmt = $con->query("UPDATE department SET STATUS='$status' WHERE ID='$id'");
    
    if($update_depmt){
        echo 1;
    }else{
        echo 0;
        
    }
}




?>