<?php

session_start();
include('../Db/config.php');
require("include/Auth.php");
 

   $xid=$_POST['id'];
   $delete="DELETE FROM `distributor_appoinment` WHERE ID='$xid'";
   $resuil=mysqli_query($con,$delete) or die("sql query failed");
  if($resuil){
     echo 1;
 }else{
     echo 0;
 }
?>