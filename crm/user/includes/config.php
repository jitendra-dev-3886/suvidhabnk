<?php
ob_start();
$con = new mysqli("localhost","paydeer","Team@Webspidy","paydeer_crm");
// Check connection
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}
date_default_timezone_set("Asia/Kolkata");
?>
