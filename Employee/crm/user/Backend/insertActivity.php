<?php
include('../includes/config.php');
include('userdata.php');





// lead update
if(isset($_POST['pageid']) && $_POST['pageid'] == 8){
    
   $lead_id= $_POST['lead_id'];
   $date = $_POST['date'];
   $uid = $_POST['uid'];
   $time= $_POST['time'];
   $description= $_POST['description'];
   $leadStatus= $_POST['leadStatus'];


  $lead_insert =  $con->query("INSERT INTO `activity`(`LEAD_ID`,`USER_ID`, `DATE`, `TIME`, `DESCRIPTION`, `STATUS`) VALUES ('$lead_id','$id','$date','$time','$description','$leadStatus')");
  if($lead_insert){
    //   $con->query("UPDATE `lead` SET `STATUS`='$leadStatus' WHERE ID='$lead_id'");
      echo 1;
  }else{
      echo 0;
  }
}


?>

