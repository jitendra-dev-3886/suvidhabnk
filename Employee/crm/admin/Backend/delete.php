<?php



include('../includes/config.php');

$state_id=$_POST['id'];
$sql="DELETE FROM `state_distric_block` WHERE ID={$state_id}";
$result=mysqli_query($con,$sql) or die("sql query failed");
if($result){
    echo 1;
}else{
    echo 0;
}
?>