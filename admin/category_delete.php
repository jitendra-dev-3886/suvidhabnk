<?php

session_start();
include('../Db/config.php');
require("include/Auth.php");
 

   $category_id=$_POST['id'];
   $delete="DELETE FROM `add_category` WHERE ID='$category_id'";
   $resuil=mysqli_query($con,$delete) or die("sql query failed");
  if($resuil){
     echo 1;
 }else{
     echo 0;
 }


?>