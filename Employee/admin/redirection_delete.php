<?php

session_start();
include('../Db/config.php');
require("include/Auth.php");
 

   $blog_id=$_POST['id'];
   $delete="DELETE FROM `redirection_link` WHERE ID='$blog_id'";
   $resuil=mysqli_query($con,$delete) or die("sql query failed");
  if($resuil){
     echo 1;
 }else{
     echo 0;
 }


?>