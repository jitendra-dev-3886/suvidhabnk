<?php

include("../../../Db/config.php");
include("../Functions/all_function.php");
// include("../onBoard/enc.php");
include("../onBoard/onEnc.php");



$exoCred = $con->query("SELECT * FROM `exotelAppCred` WHERE ID='1' ORDER BY ID ASC LIMIT 1")->fetch_assoc();


$appSecret = encrypt($exoCred['APP_SECRET']);
$appId = encrypt($exoCred['APP_ID']);
$signature = encrypt($exoCred['SIGNATURE']);
$sid = encrypt($exoCred['S_ID']);


// $appSecret = "aramidahuziv";
// $appId = "3547a3584f6e46128e0fb4927cee48fc";
// $signature = "com.india.paydeer";
// $sid = "paydeer2";


if($_POST['exoCred']=="exoCred"){

  echo json_encode([
    "appSecret" =>$appSecret,
    "appId" =>$appId,
    "signature" =>$signature,
    "sid" =>$sid
 ]);
    
}




?>