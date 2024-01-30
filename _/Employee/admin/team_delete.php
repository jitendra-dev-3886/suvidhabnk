<?php

session_start();
include('../Db/config.php');
require("include/Auth.php");
 

   $team_id=$_POST['id'];
   $delete="DELETE FROM `team` WHERE ID='$team_id'";
   $resuil=mysqli_query($con,$delete) or die("sql query failed");
  if($resuil){
     echo 1;
 }else{
     echo 0;
 }


?>