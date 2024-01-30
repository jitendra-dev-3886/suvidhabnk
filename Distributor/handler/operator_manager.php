<?php
    session_start();
    include("../../Db/config.php");

   $id = $_SESSION['id'];
   
  if(isset($_POST['submitoperator_manager']))
   {
     $service = $_POST['selectservice'];
     $serviceapi = $_POST['serviceapi'];
     $productname = $_POST['productname'];
     $productcode = $_POST['productcode'];
     $apiservicename = $_POST['apiservicename'];
     $status = $_POST['status'];
     
     
     $query = "INSERT INTO `operatorManager`( `SERVICE`, `SERVICEAPI` , `PRODUCTNAME`, `PRODUCTCODE` , `APISERVICENAME`, `STATUS`)
     		VALUES('$service' , '$serviceapi' , '$productname' , '$productcode' , '$apiservicename' , '$status') ";
    $query_run = mysqli_query($con,$query);
    
     if($query_run)
     {
          header("location:../operator_manager?status=add_operator_manager&msg=Successfully&desc=Addedd ");  
      }
     else
     {
          header("location:../operator_manager?status=add_operator_manager&error=OOPS&desc=Something went wrong ");
    //   echo '<script>alert("Failed to Update Operator Manaager")</script>';
     }

  }
  
  if(isset($_POST['update_operator_manager']))
   {
     $service = $_POST['selectservice'];
     $serviceapi = $_POST['serviceapi'];
     $productname = $_POST['productname'];
     $productcode = $_POST['productcode'];
     $apiservicename = $_POST['apiservicename'];
     $status = $_POST['status'];
     $row_id = $_POST['row_id'];
     
     
     $query = "update `operatorManager` set  `SERVICE`='$service' , `SERVICEAPI`='$serviceapi' , `PRODUCTNAME`='$productname', `PRODUCTCODE`='$productcode' , 
     `APISERVICENAME`='$apiservicename', `STATUS`='$status' where ID='$row_id' ";
     
    $query_run = mysqli_query($con,$query);
    
     if($query_run)
     {
  header("location:../operator_manager?status=add_operator_manager&msg=Successfully&desc=Updated ");   
  }
 
     else
     {
  header("location:../operator_manager?status=add_operator_manager&error=OOPS&desc=Something went wrong "); 
  }

  }

     ?>