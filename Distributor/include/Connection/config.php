<?php
error_reporting(0);
$con = new mysqli("localhost","paydeer","I143@Webspidy#","paydeer_db");
// Check connection
if ($con -> connect_errno) {
  echo "Failed to connect to MySQL: " . $con -> connect_error;
  exit();
}
date_default_timezone_set("Asia/Kolkata");
?>
