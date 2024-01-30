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
    //  echo "UPDATE `slab_commission` SET `MIN_AMOUNT`='$start_range',`MAX_AMOUNT`='$end_range',`TDS`='$tds',`GST`='$gst',`TYPE`='$comm_type',`AMOUNT_TYPE`='$amount_type',`AMOUNT`='$retailer_comm',`CHARGE`='$charges',`DS_COM`='$distributor_comm' WHERE ID='$packid'";
      $update=$con->query("UPDATE `slab_commission` SET `MIN_AMOUNT`='$start_range',`MAX_AMOUNT`='$end_range',`TDS`='$tds',`GST`='$gst',`TYPE`='$comm_type',`AMOUNT_TYPE`='$amount_type',`AMOUNT`='$retailer_comm',`CHARGE`='$charges',`DS_COM`='$distributor_comm' WHERE ID='$packid'");
  
      if($update)  
            {  
          echo 1;
      }else{
           echo 0;
          
      }   
 } 
 
 //delete query

// function delete(){
//   global $con;

//   $ID = $_POST["ID"];

//  $sql=$con->query("DELETE FROM `commission_package` WHERE ID = $ID");
// //   echo "DELETE FROM `commission_package` WHERE ID = $ID";
//  if($sql){
//      echo 1;
//      }else{
//          echo 0;
//      }
 
// }

// if(isset($_POST["action"])){
//   // Choose a function depends on value of $_POST["action"]
//   if($_POST["action"] == "delete"){
//     delete();
//   }
// }

if(isset($_POST["action"]) && $_POST["action"] == "delete"){
    $id = $_POST["ID"];
    $sql = $con->query("DELETE FROM `slab_commission` WHERE ID='$id'");
    //echo "DELETE FROM `slab_commission` WHERE ID='$id'";
    
    if($sql){
        echo 1;
    }else{
        echo 0;
    }
}


?>
