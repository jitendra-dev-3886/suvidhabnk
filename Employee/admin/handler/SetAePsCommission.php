<?php
include('../../Db/config.php');

 if(isset($_POST["start_range"]))  
 {  
      $packid = $_POST['packId'];
      $start_range = mysqli_real_escape_string($con, $_POST["start_range"]);  
      $end_range = mysqli_real_escape_string($con, $_POST["end_range"]);  
      $retailer_comm = mysqli_real_escape_string($con, $_POST["retailer_comm"]);  
      $charges = mysqli_real_escape_string($con, $_POST["charges"]);  
      $amount_type = mysqli_real_escape_string($con, $_POST["amount_type"]);  
      $distributor_comm = mysqli_real_escape_string($con, $_POST["distributor_comm"]);  
      $ms_comm = mysqli_real_escape_string($con, $_POST["ms_comm"]);  
      $gst = mysqli_real_escape_string($con, $_POST["gst"]);  
      $tds = mysqli_real_escape_string($con, $_POST["tds"]);
      $comm_type = mysqli_real_escape_string($con, $_POST["comm_type"]);
      
      $query = "INSERT INTO `slab_commission`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER`, `OWNER_ID`, `COMM_PACK_ID`, `MIN_AMOUNT`, `MAX_AMOUNT`, `TDS`, `GST`, `TYPE`, `AMOUNT_TYPE`, `AMOUNT`, `STATUS`, `CHARGE`, `DS_COM`, `MS_COM`) 
      VALUES ('ADMIN','1','1','1','$packid','$start_range','$end_range','$tds','$gst','$comm_type','$amount_type','$retailer_comm','0','$charges','$distributor_comm','$ms_comm')";  
      
      if(mysqli_query($con, $query))  
            {  
           echo '<script type="text/javascript">alert("AepsCommission Created")  
           location.replace("SetAePsCommission.php?pack_id='.$packid.'")
</script>';

      }else{
           echo '<script type="text/javascript">alert("Failed to Create AepsCommission")  
             location.replace("SetAePsCommission.php")
</script>';
          
      }   
 } 
 
 //delete query

function delete(){
  global $con;

  $ID = $_POST["ID"];

 mysqli_query($con, "DELETE FROM `commission_package` WHERE ID = $ID");
  echo "DATA DELETE SUCCESSFULLY";
}

if(isset($_POST["action"])){
  // Choose a function depends on value of $_POST["action"]
  if($_POST["action"] == "delete"){
    delete();
  }
}



?>
