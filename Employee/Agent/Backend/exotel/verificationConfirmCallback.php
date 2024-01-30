<?php

include("../../../Db/config.php");
$json = file_get_contents('php://input');
if($json!=null || $json!=""){
    
    $check =  $con->query("INSERT INTO `exoVerificationCallback`(`RESPONSE`) VALUES ('$json')");

}
else{
    $check =  $con->query("INSERT INTO `exoVerificationCallback`(`RESPONSE`) VALUES ('Empty')");
}


?>