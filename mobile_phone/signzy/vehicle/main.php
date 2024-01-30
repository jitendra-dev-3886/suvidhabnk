<?php


include("../../includes/configuration.php");
include("../../../Agent/Backend/Functions/all_function.php");
date_default_timezone_set("Asia/Kolkata");
include("../../my_curls/myCurl.php");


//Run karke dekh lo postman me pehle.. kaam karna chahiye.../ thik hai //dono me post kar dena data / ok
//wait...

// $singzyData = getsignzyAuth();
$singzyData = getsignzyAuthLive();
extract($singzyData);


$vehichleNumber = $_POST['vehichleNumber'];

if(isset($_POST['vehichleNumber'])){

    
    // POST :: https://preproduction.signzy.tech/api/v2/patrons/$userId/vehicleregistrations
    // For Production Credentials
    // POST :: https://signzy.tech/api/v2/patrons/$userId/vehicleregistrations

    $url = "https://signzy.tech/api/v2/patrons/$userId/vehicleregistrations";
    $arr = array(
        "task" => "detailedSearch",
    "essentials"=> [
      "vehicleNumber"=> "$vehichleNumber",
      "signzyID"=> ""
    ]
    
    );
    
    //   "blacklistCheck"=> true,
    
    $postData = json_encode($arr);
    
    $header = array(
    "Authorization: $id",
    "accept: */*",
    "accept-language: en-US,en;q=0.8",
    "content-type: application/json"
      );
    
    
    $response = postCurl($postData, $url, $header);
    
    
    
    $curl = curl_init();

    
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