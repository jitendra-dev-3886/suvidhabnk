<?php
include("../config.php");

 if(isset($_POST["name"]))  
 {  
      $property_id = $_POST['property_id'];
      $name = mysqli_real_escape_string($conn, $_POST["name"]);  
      $price = mysqli_real_escape_string($conn, $_POST["price"]);  
      $desc = mysqli_real_escape_string($conn, $_POST["desc"]);  
      $validity = mysqli_real_escape_string($conn, $_POST["validity"]);  
      $user = mysqli_real_escape_string($conn, $_POST["user"]);  
      $status = mysqli_real_escape_string($conn, $_POST["status"]);
      
      $query = "UPDATE `subscription` SET `NAME`='$name',`PRICE`='$price',`DESCRIPTION`='$desc',`VALIDITY`='$validity',`USER`='$user',`STATUS`='$status' WHERE ID = '$property_id'";  
      if(mysqli_query($conn, $query))  
       {  
           echo '<script>Subscription Create </script>';  
      }else{
           echo '<script>Failed to Create Subscription </script>';  
          
      } 
 } 
 
?>
