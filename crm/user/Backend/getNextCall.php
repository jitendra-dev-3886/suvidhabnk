<?php
include('../includes/config.php');
include('userdata.php');


$BlockArray = explode(",",$user['BLOCK']);
$StateArray = explode(",",$user['STATE']);
$DistrictArray = explode(",",$user['DISTRICT']);


$userBlock = implode("','",$BlockArray);
$userState = implode("','",$StateArray);
$userDistrict = implode("','",$DistrictArray);


$status = $_POST['status'];
$today=date("Y-m-d"); 
 
 

        $next_call = $con->query("SELECT * FROM `lead` WHERE STATUS ='Next Call' AND STATE IN('$userState') AND DISTRICT IN('$userDistrict') AND BLOCK IN('$userBlock') ORDER BY ID DESC LIMIT 15000")->num_rows;
       
       echo json_encode([
               "next_call"=>$next_call,
          ]);

?>