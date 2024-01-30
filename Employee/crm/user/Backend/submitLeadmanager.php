<?php

include('../includes/config.php');

if(isset($_POST['type']) == 1)
{
    
$lead = $_POST['leaddata'];
$status = $_POST['status'];

$sql = $con->query("INSERT INTO `lead_manager`(`LEAD_MANAGER`, `STATUS`) VALUES ('$lead','$status')");
		
// echo "INSERT INTO `lead_manager`(`LEAD_MANAGER`, `STATUS`) VALUES ('$lead','$status')";
// $run = mysqli_query($con,$sql);
if($sql){
    echo 1;
}else{
    echo 0;
}

}

    
?>