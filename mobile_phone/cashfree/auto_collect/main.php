<?php

include("../../includes/configuration.php");
include("../../../Agent/Backend/Functions/all_function.php");
date_default_timezone_set("Asia/Kolkata");
include("../../my_curls/myCurl.php");


$token = create_cashfree_token_cac();

if(isset($_POST['redirect_url'])){

    $url = "https://cac-api.cashfree.com/cac/v1/verifyToken";
    $arr = array(
        "task" => "url",
        "essentials"=> [
          "signup"=> false,
          "redirectUrl"=> "https://paydeer.app/mobile_phone/signzy/digi_locker/redirect_url.php",
          "redirectTime"=> 1,
          "callbackUrl"=> "https://paydeer.app/mobile_phone/signzy/digi_locker/redirect_url.php"
      ]
    );
    $postData = json_encode($arr);
    
    
      $header = array(
        "Authorization: Bearer $token",
      );
    
    
    $response = postCurl($postData, $url, $header);
    
    echo $response;
    
    // $errors = json_decode($response);
    // $errorCode = $errors->error->statusCode;
    // $errorMessage =$errors->error->message;
    // if($errorMessage=="" || $errorMessage==null){
    //     echo json_encode(["message"=>"Response Recieved", "response_code"=>1, "status"=>true, "receivableData"=>$errors]);
    // }
    // else{
    //     echo json_encode(["message"=>$errorMessage, "response_code"=>300, "status"=>false]);
    // }
}



?>