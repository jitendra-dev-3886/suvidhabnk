<?php
include('../../Db/config.php');

 
	if($_POST['type']==1){
	    
      $packid = $_POST['packId'];
      $start_range = mysqli_real_escape_string($con, $_POST["start_range"]);  
      $end_range = mysqli_real_escape_string($con, $_POST["end_range"]);  
      $charges = mysqli_real_escape_string($con, $_POST["charges"]);  
      $comm_type = mysqli_real_escape_string($con, $_POST["comm_type"]);
      $amount_type = mysqli_real_escape_string($con, $_POST["amount_type"]);  
      $retailer_comm = mysqli_real_escape_string($con, $_POST["retailer_comm"]);  
      $distributor_comm = mysqli_real_escape_string($con, $_POST["distributor_comm"]);  
      $gst = mysqli_real_escape_string($con, $_POST["gst"]);  
      $tds = mysqli_real_escape_string($con, $_POST["tds"]);
     
    //  echo("UPDATE `slab_commission` SET `MIN_AMOUNT`='$start_range',`MAX_AMOUNT`='$end_range',`TDS`='$tds',`GST`='$gst',`TYPE`='$comm_type',`AMOUNT_TYPE`='$amount_type',`AMOUNT`='$retailer_comm',`CHARGE`='$charges',`DS_COM`='$distributor_comm' WHERE ID='$packid'") ;
    //  exit;
    $update=$con->query("UPDATE `slab_commission` SET `MIN_AMOUNT`='$start_range',`MAX_AMOUNT`='$end_range',`TDS`='$tds',`GST`='$gst',`TYPE`='$comm_type',`AMOUNT_TYPE`='$amount_type',`AMOUNT`='$retailer_comm',`CHARGE`='$charges',`DS_COM`='$distributor_comm' WHERE ID='$packid'");
  
      if($update)  
            {  
          echo 1;
      }else{
           echo 0;
          
      }   
}
 //display query


 //display query
  // Delete query
if(count($_POST)>0){
	if($_POST['type']==3){
		$id=$_POST['id'];
		$sql = "DELETE FROM `slab_commission` WHERE ID=$id ";
		if (mysqli_query($con, $sql)) {
			echo $id;
		} 
		else {
			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		mysqli_close($conn);
	}
}


?>
