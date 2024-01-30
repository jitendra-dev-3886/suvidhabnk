<?php
session_start();
ob_start();
// session Data
include("../Db/config.php");
if(!isset($_SESSION['UsId'])){
    echo "<script>location.replace('../Agent/Login.php')</script>";
}

$usid = $_SESSION['UsId']; 
// print_r($_SESSION); 
// user details
$user = $con->query("SELECT * FROM `user` WHERE ID='$usid'")->fetch_assoc();
$ustypeid = $user['USER_TYPE']; 
// fetch user profile credential
$profile = $con->query("SELECT * FROM `user_profile` WHERE USER_ID='$usid'")->fetch_assoc();

$user_type = $con->query("SELECT * FROM `user_type` WHERE ID='$ustypeid' and STATUS='ACTIVE'")->fetch_assoc(); 

//fetch DMT Data 
$dmt_user = $con->query("SELECT * FROM `dmt_user` WHERE USER_ID='$usid' and USER_TYPE='$ustypeid' ")->fetch_assoc(); 

// fetch paysprint credential
$paysprint = $con->query("SELECT * FROM `paysprint_api` WHERE ID='1' and STATUS='ACTIVE'")->fetch_assoc();

//fetch news details
$news = $con->query("SELECT * FROM `news_alert` WHERE OWNER='ADMIN' AND OWNER_ID='1' AND USER_TYPE='$ustypeid' AND STATUS='active' order by ID desc")->fetch_assoc();
$date_now = date("Y-m-d");


?>