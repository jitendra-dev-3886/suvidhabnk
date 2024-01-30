<?php

session_start();
require_once('../../Db/config.php');

    extract($_POST);
    if(strtolower($usst) == "active"){
        $update = "Deactive";
    }
    else{
        $update = "Active";
    }
    
    if($con->query("update user set US_STATUS='$update' where ID='$userid'")){
       
        echo 200;
    }
    else{
        echo 500;
    }

