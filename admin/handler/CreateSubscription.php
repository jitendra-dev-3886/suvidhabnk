<?php
include("../config.php");

 if(isset($_POST["name"]))  
 {  
      $name = mysqli_real_escape_string($conn, $_POST["name"]);  
      $price = mysqli_real_escape_string($conn, $_POST["price"]);  
      $desc = mysqli_real_escape_string($conn, $_POST["desc"]);  
      $validity = mysqli_real_escape_string($conn, $_POST["validity"]);  
      $user = mysqli_real_escape_string($conn, $_POST["user"]);  
      $status = mysqli_real_escape_string($conn, $_POST["status"]);
      
      $query = "INSERT INTO `subscription`(`NAME`, `PRICE`, `DESCRIPTION`, `VALIDITY`, `USER`, `STATUS`) VALUES ('$name','$price','$desc','$validity','$user','$status')";  
      if(mysqli_query($conn, $query))  
      
            {  
           echo '<script type="text/javascript">alert("Subscription Created")  
           location.replace("CreateSubscription.php")
</script>';

      }else{
           echo '<script type="text/javascript">alert("Failed to Create Subscription")  
             location.replace("../CreateSubscription.php")
</script>';
          
      }   
 } 
 
?>
