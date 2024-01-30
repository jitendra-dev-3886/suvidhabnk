<?php


include("../includes/configuration.php");
include("../../Agent/Backend/Functions/all_function.php");
date_default_timezone_set("Asia/Kolkata");

$singzyData = getsignzyAuth();
extract($singzyData);

// echo "id: ".$id."<br>";
// echo "ttl: ".$ttl."<br>";
// echo "created: ".$created."<br>";
// echo "userId: ".$userId."<br>";



?>