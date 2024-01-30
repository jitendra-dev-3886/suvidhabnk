<?php


if(isset($_POST['id'])){
    include("../includes/config.php");
    $select =  $_POST['id'];
        
        
$op = $con->query("DELETE FROM `dmt_user` WHERE ID='$select'");
if ($op) {
  echo 1;
} else {
  echo 0;
}

$con->close();
        
        
}



?>