<?php

include('../includes/config.php');
include('userdata.php');

$leadid = $_POST['leadid'];

$response = array();
        
        $op = $con->query("SELECT * FROM `activity` WHERE LEAD_ID='$leadid' ORDER BY ID DESC");
        if($op->num_rows > 0)
        {
         while($row = $op->fetch_assoc()){
             
             array_push($response, $row);
         }
            
            
        }
        echo json_encode($response);

?>