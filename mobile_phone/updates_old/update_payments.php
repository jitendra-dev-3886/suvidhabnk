<?php

    $type = $_POST['type'];
    if($type!=""){
        
        $check = strtolower($type);
        if($check=="dmt"){
            include("dmt_update.php");
        }
        else if($check=="aeps"){
            include("aeps_update.php");
        }
        else if($check=="recharge"){
            include("recharge_update.php");
        }
        else if($check=="bbps"){
            include("bbps_update.php");
        }
        
        
    }


?>