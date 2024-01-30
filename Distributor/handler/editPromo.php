<?php
include("../config.php");

 if(isset($_POST["promoCode"]))  
 {  
      $name = mysqli_real_escape_string($conn, $_POST["name"]);  
      $desc = mysqli_real_escape_string($conn, $_POST["desc"]);  
      $amt = mysqli_real_escape_string($conn, $_POST["amt"]);  
      $d_type = mysqli_real_escape_string($conn, $_POST["d_type"]);  
      $validity = mysqli_real_escape_string($conn, $_POST["validity"]);  
      
 //update query
 $promo_id = $_POST['promo_id'];
 $u_query="UPDATE `promocode` SET `NAME`='$name',`DESCRIPTION`='$desc',`AMOUNT`='$amt',`DISCOUNT`='$d_type',`VALIDITY`='$validity' WHERE ID = '$promo_id'";
//  echo $u_query;
//  die();
 if(mysqli_query($conn,$u_query))
 
          {  
           echo '<script type="text/javascript">alert("PromoCode Updated")  
           location.replace("PromoCodeList.php")
</script>';

      }else{
           echo '<script type="text/javascript">alert("Failed to Updated PromoCode")  
             location.replace("PromoCodeList.php")
</script>';
          
      }
      
 }
 
?>
