<?php

include("../includes/config.php");
$id = $_POST['user_id'];
$token_id = $_POST['token'];
$mysql_qry = "select * FROM user WHERE ID ='$id' AND TOKEN_ID = '$token_id'";
$result = mysqli_query($con ,$mysql_qry);
if(mysqli_num_rows($result) > 0) {
    
}else{
    
    $rs = json_encode(array("statuscode"=>  999 ,"responsecode"=>  999 , "message"=>"Session Expired", "response_code"=>999, "status"=>false));
    echo $rs;
    return;
}
    
    
    
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