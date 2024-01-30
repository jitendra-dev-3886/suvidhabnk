<?php



date_default_timezone_set('Asia/kolkata');    
$timezone = date_default_timezone_get();    

$reference_id = $_POST['reference_id'];
$transactionType = $_POST['transactionType'];

$commitDate = $validity['TRANS_DATE'];

$now = time();
$commitDate = strtotime($commitDate);
$datediff = $now - $commitDate;

$daysGone =  round($datediff / (60 * 60 * 24));



?>