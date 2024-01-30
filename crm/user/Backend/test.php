<?php

include('../includes/config.php');

$mysql_qry = "SELECT * FROM `user` WHERE ID ='24'";
$result = mysqli_query($con ,$mysql_qry);
$row = mysqli_fetch_all($result, MYSQLI_ASSOC);





$BlockArray = explode(",",$row[0]['BLOCK']);

$StateArray = explode(",",$row[0]['STATE']);

$DistrictArray = explode(",",$row[0]['DISTRICT']);


if(in_array('Jharkhand', $StateArray)){
    
    echo json_encode($row[0]['STATE']);
}
else{
    echo json_encode("Not in my array");
}



?>