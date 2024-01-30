<?php

include("../../../Db/config.php");
include("enc.php");
include("onEnc.php");

if(isset($_POST['availablity'])){
    
    $mobile = decrypt($_POST['mobile']);
    
    if($con->query("SELECT * FROM `user` WHERE MOBILE='$mobile' and US_STATUS='Active'")->num_rows == 0){
        echo json_encode(["response_code" => 1 , "message"=>"Good to proceed.", "status"=>true]);
        exit;
    }
    else{
        echo json_encode(["response_code"=>5,"message"=>"user already exists with this mobile number", "status"=>false]);
        exit;
    }
}




// echo encrypt("Something is good");







?>