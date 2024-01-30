<?php
include('../includes/config.php');


if(isset($_POST['type']) == 1)
{
$date = date("Y-m-d");
$typeusr = $_POST['typeusr'];
$fname = $_POST['fname'];
$email = $_POST['email'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
$district = $_POST['alldistrict'];
$block = $_POST['allblock'];
$state = $_POST['state'];
$password = $_POST['password'];
$password=md5($password);
$sql=  $con->query("INSERT INTO `user`( `TYPE`,`FULL_NAME`, `EMAIL`, `MOBILE`, `ADDRESS`,`DISTRICT`,`BLOCK`,`STATE`, `PASSWORD`,`DATE`,`TOKEN`) VALUES ('$typeusr','$fname','$email','$mobile','$address','$district','$block','$state','$password','$date','')");
if($sql){
    echo 1;
}else{
    echo 0;
}

}



?>