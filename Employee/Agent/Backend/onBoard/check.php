<?php

include("../../../Db/config.php");
include("../Functions/all_function.php");


$exoStatus = $con->query("SELECT * FROM `exoStatusCallback` WHERE MOBILE='8240193509' and STATUS='Success' ORDER BY ID DESC LIMIT 1")->fetch_assoc();

$timestamp = date("Y-m-d H:i:s");

echo "Current Time is ".$timestamp."<br>";
echo "That Time was ".$exoStatus['TIME']."<br>";

$from_time = strtotime($exoStatus['TIME']);
$to_time = strtotime($timestamp);
echo round(abs($to_time - $from_time) / 60,2). " minute";

?>