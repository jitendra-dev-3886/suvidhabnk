<?php
session_start();
include('../../../Db/config.php');

// include("../Userinfo/getuserinfo.php");
// include("../Functions/all_function.php");
include("userdata.php");

//fetch User Data 
if(isset($_POST['check_user'])){
    if(!isset($_SESSION['UsId']) || $_SESSION['UsId'] == ""){
        session_destroy();
        echo json_encode(array("response_code"=>1 , "msg"=>"Session Destroyed. Please login again to continue."));
        exit;
    }
    else if($usid == ""){
        session_destroy();
        echo json_encode(array("response_code"=>1 , "msg"=>"Token Invaild. Please login again to continue."));
        exit;
    }
    else{
        echo json_encode(array("response_code"=>2 , "msg"=>"Session is working. "));
        exit;
    }
}
