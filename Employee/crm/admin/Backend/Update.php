<?php

include('../includes/config.php');

if(isset($_POST['pageid']) && $_POST['pageid'] == 2){
    
$uid=$_POST['sid'];

$sql = "DELETE FROM `state_distric_block` WHERE ID='$uid'";

$run = mysqli_query($con,$sql);


if($run){
    echo 1;
}else{
    echo 0;
}
}


if(isset($_POST['pageid']) && $_POST['pageid'] == 1){
    
$uid=$_POST['uid'];
$update_statename=$_POST['updatestate'];
$update_districname=$_POST['updatedistricname'];
$update_blockname=$_POST['updateblockname'];

$sql = "UPDATE `state_distric_block` SET `STATE_NAME`='$update_statename',`DISTRIC_NAME`='$update_districname', `BLOCK_NAME`='$update_blockname' WHERE ID='$uid'";

$run = mysqli_query($con,$sql);


if($run){
    echo 1;
}else{
    echo 0;
}

}





?>


