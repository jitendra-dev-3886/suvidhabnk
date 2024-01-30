<?php

include('../includes/config.php');

      if(isset($_POST['type']) == 1){
          
       $state=$_POST['state'];
       $distric=$_POST['distric'];
       $block=$_POST['bname'];
    //   echo "INSERT INTO `state_distric_block`(`STATE_CODE`, `STATE_NAME`, `DISTRIC_CODE`, `DISTRIC_NAME`, `BLOCK_CODE`, `BLOCK_VERSION`, `BLOCK_NAME`) VALUES ('$statecode','$state','$districcode','$distric','$blockcode','$blockversion','$block')";
    //   exit();
       
        $insert="INSERT INTO `state_distric_block`(`STATE_CODE`, `STATE_NAME`, `DISTRIC_CODE`, `DISTRIC_NAME`, `BLOCK_CODE`, `BLOCK_VERSION`, `BLOCK_NAME`) VALUES ('','$state','','$distric','','','$block')";
       if(mysqli_query($con,$insert)){
    // echo "<script>alert('data added')location.replace(''../addState.php')</script>";
   echo 1;
}else{
    echo "fail to add";
}
}
    
    ?>
    
      