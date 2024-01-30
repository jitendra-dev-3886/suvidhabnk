<?php
session_start();
include("../../../../../Db/config.php");


$sql = "SELECT PRODUCTNAME, API_USER_CODE FROM switchOperator";
$result = mysqli_query($con, $sql);

$data = array();
while ($row = mysqli_fetch_assoc($result)) {
  $data[] = $row;
}

$json_data = json_encode($data);

header('Content-Type: application/json');
echo $json_data;


?>