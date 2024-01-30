<?php
include('../Db/config.php');


// UPDATE QUERY

if(isset($_POST['id']) && $_POST['id'] == 7){
$upid= $_POST['updates_id'];
$upate_service= $_POST['upate_service'];
$update_serviceapi =$_POST['update_serviceapi'];
$update_pro_name =$_POST['update_pro_name'];
$update_backup =$_POST['update_backup'];
$update_pro_code=$_POST['update_pro_code'];
$update_api_ser_name=$_POST['update_api_ser_name'];
$update_status=$_POST['update_status'];

  $update_query="UPDATE `operatorManager` SET `SERVICE`='$upate_service',`SERVICEAPI`='$update_serviceapi',`BACKUPAPI`='$update_backup',`PRODUCTNAME`='$update_pro_name',`PRODUCTCODE`='$update_pro_code',`APISERVICENAME`='$update_api_ser_name',`STATUS`='$update_status' WHERE ID='$upid'";
  $runs=mysqli_query($con,$update_query);
  
  if($runs){
      echo 1;
  }else{
      echo 0;
  }

}



?>

