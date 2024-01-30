<?php

include("../includes/config.php");

$indexing = $_POST['indexing'];
$howmuch = "400";
$given_id = $_POST['given_id'];
$response  = array();
$trans_type = $_POST['trans_type'];
if($trans_type=="ALL"){
    $trans_type = "";
}



if($indexing=="0"){
    $allreports = $con->query("SELECT * FROM `reward_coupon` WHERE USER_ID='$id' AND TRANSACTION_TYPE LIKE '%$trans_type%' ORDER BY ID DESC LIMIT $indexing, $howmuch");
}
else{
    $allreports = $con->query("SELECT * FROM `reward_coupon` WHERE USER_ID='$id' AND ID <'$given_id' AND TRANSACTION_TYPE LIKE '%$trans_type%' ORDER BY ID DESC LIMIT $indexing, $howmuch");
}

while($row = $allreports->fetch_assoc()){
    array_push($response, $row);
}

echo json_encode($response);




?>