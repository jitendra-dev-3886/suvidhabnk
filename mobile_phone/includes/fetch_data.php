<?php


// fetch paysprint credential
$paysprint = $con->query("SELECT * FROM `paysprint_api` WHERE ID='1' and STATUS='ACTIVE'")->fetch_assoc();


$user = $con->query("SELECT * FROM `user` WHERE ID='$id' and US_STATUS='ACTIVE'")->fetch_assoc(); 

$all_reports_data = $con->query("SELECT * FROM `report` WHERE REFERENCE_ID='$reference_id'")->fetch_assoc(); 

$comm_reports_data = $con->query("SELECT * FROM `commission_report` WHERE REFFRENCE='$reference_id'")->fetch_assoc(); 


// fetch user profile credential
$profile = $con->query("SELECT * FROM `user_profile` WHERE USER_ID='$id'")->fetch_assoc();



$user_type = $con->query("SELECT * FROM `user_type` WHERE ID='$usertype_id' and STATUS='ACTIVE'")->fetch_assoc(); 

//fetch DMT Data 
$dmt_user = $con->query("SELECT * FROM `dmt_user` WHERE USER_ID='$id' and USER_TYPE='$usertype_id' ")->fetch_assoc(); 

// fetch paysprint credential
$paysprint = $con->query("SELECT * FROM `paysprint_api` WHERE ID='1' and STATUS='ACTIVE'")->fetch_assoc();

$news = $con->query("SELECT * FROM `news_alert` WHERE OWNER='ADMIN' AND OWNER_ID='1' AND USER_TYPE='$usertype_id' AND STATUS='active' order by ID desc")->fetch_assoc();


?>