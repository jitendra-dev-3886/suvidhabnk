<?php
session_start();

require("../../../../Db/config.php");
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
require("../../Backend/Functions/all_function.php");
require("../../Auth/Auth.php");


// From auth.php check request;
$reqBodyAr = json_decode($reqBody , true);

// Add beneficiary 
    extract($reqBodyAr);
    
$oldrow = $con->query("select * from payout_users where REG_TYPE='API' and ACCOUNT='$beneAcc' and IFSC='$beneIFSC' ");
if($oldrow->num_rows == 0){
    echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 404 , "message"=>"Bene Not Found.", "RequestId"=> $refId]) , $refId);
    exit;
}

$oldrowdt = $oldrow->fetch_assoc();

 echo ApiHit($reqBody ,  $data['Token'] , json_encode(["response_code" => 111 , "message"=>"Bene Id Found." , "BeneId" => $oldrowdt['BENEID'], "RequestId"=> $refId]) , $refId);
exit;

