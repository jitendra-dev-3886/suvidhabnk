<?php
ob_start();
error_reporting(0);
$con = new mysqli("localhost","suvidhabnk","#Suvidhabnk@1234","suvidhabnk_db");
// Check connection
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}
date_default_timezone_set("Asia/Kolkata");
?>
