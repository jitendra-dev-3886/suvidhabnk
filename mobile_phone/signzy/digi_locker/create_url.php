<?php

include("../../includes/configuration.php");
include("../../../Agent/Backend/Functions/all_function.php");
date_default_timezone_set("Asia/Kolkata");
include("../../my_curls/myCurl.php");


$singzyData = getsignzyAuthLive();
extract($singzyData);


// include("../../includes/register_verify.php");


if(isset($_POST['redirect_url'])){

    $url = "https://signzy.tech/api/v2/patrons/$userId/digilockers";
    $arr = array(
        "task" => "url",
        "essentials"=> [
          "signup"=> false,
          "redirectUrl"=> "https://paydeer.in/mobile_phone/signzy/digi_locker/redirect_url.php",
          "redirectTime"=> 1,
          "callbackUrl"=> "https://paydeer.in/mobile_phone/signzy/digi_locker/redirect_url.php"
      ]
    );
    $postData = json_encode($arr);
    
    $header = array(
        "Authorization: $id",
        "accept: */*",
        "accept-language: en-US,en;q=0.8",
        "content-type: application/json"
      );
    
    
    $response = postCurl($postData, $url, $header);
    
    $errors = json_decode($response);
    $errorCode = $errors->error->statusCode;
    $errorMessage =$errors->error->message;
    if($errorMessage=="" || $errorMessage==null){
        echo json_encode(["message"=>"Response Recieved", "response_code"=>1, "status"=>true, "receivableData"=>$errors]);
    }
    else{
        echo json_encode(["message"=>$errorMessage, "response_code"=>300, "status"=>false]);
    }

}

?>