<?php
include("../config.php");

 if(isset($_POST["name"]))  
 {  
      $name = mysqli_real_escape_string($conn, $_POST["name"]);  
      $desc = mysqli_real_escape_string($conn, $_POST["desc"]);  
      $amt = mysqli_real_escape_string($conn, $_POST["amt"]);  
      $d_type = mysqli_real_escape_string($conn, $_POST["d_type"]);  
      $validity = mysqli_real_escape_string($conn, $_POST["validity"]);  

      $query = "INSERT INTO `promocode`(`NAME`, `DESCRIPTION`, `AMOUNT`, `DISCOUNT`, `VALIDITY`) VALUES ('$name','$desc','$amt','$d_type','$validity')";  
      if(mysqli_query($conn, $query))  
      
            {  
           echo '<script type="text/javascript">alert("PromoCode Created")  
           location.replace("PromoCode.php")
</script>';

      }else{
           echo '<script type="text/javascript">alert("Failed to Create PromoCode")  
             location.replace("PromoCode.php")
</script>';
          
      }   
 }
 

 
?>
