<?php

session_start();
require_once('../../Db/config.php');
require("../include/Auth.php");
include("../Backend/Userinfo/getuserinfo.php");
include("../Backend/Functions/all_function.php");
include("../../Agent/Backend/BBPS/Paysprint/bbps_function.php");

if(isset($_POST['refid'])){
    $refid = $_POST['refid'];
    $opid = $_POST['opid'];
    
    
}