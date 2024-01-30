<?php
include('../includes/config.php');
include('userdata.php');




// // lead update
if(isset($_POST)){
    
    extract($_POST);
    
   $lead_id= $_POST['lead_id'];
   $activity_id= $_POST['activity_id'];
   $description= $_POST['description'];
   $lead_status_activty= $_POST['lead_status_activty'];
   
   
    $name=$_POST['name'];
    $mobile= $_POST['mobile'];
    $email = $_POST['email'];
    $state= $_POST['state'];
    $district= $_POST['district'];
    $block=$_POST['block'];
    $address=$_POST['address'];
    $date= $_POST['date'];
    $time=$_POST['time'];
    $lead_status= $_POST['lead_status'];
    $remark=$_POST['remark'];
    $lead_user_id=$_POST['lead_user_id'];
    $activity_user_id=$_POST['activity_user_id'];
    
    

    $lead_update =  $con->query("UPDATE `lead` SET `USER_ID`='$lead_user_id',`NAME`='$name',`MOBILE`='$mobile',`EMAIL`='$email',`STATE`='$state',`DISTRICT`='$district',`BLOCK`='$block',`ADDRESS`='$address',`STATUS`='$lead_status',`REMARK`='$remark' WHERE ID='$lead_id'");


  if($lead_update){

            // $con->query("UPDATE `activity` SET `LEAD_ID`='$lead_id',`USER_ID`='$activity_user_id',`DATE`='$date',`TIME`='$time',`DESCRIPTION`='$description',`STATUS`='$lead_status_activty' WHERE ID='$activity_id'");
             $con->query("INSERT INTO `activity`(`LEAD_ID`,`USER_ID`, `DATE`, `TIME`, `DESCRIPTION`, `STATUS`) VALUES ('$lead_id','$activity_user_id','$date','$time','$description','$lead_status_activty')");

      echo 1;
  }else{
      echo 0;
  }
}


?>

