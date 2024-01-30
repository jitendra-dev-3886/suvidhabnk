<?php


$requestId = $_POST['requestId'];
$fileIds = $_POST['fileIds'];

include("../../includes/configuration.php");
include("../../../Agent/Backend/Functions/all_function.php");
date_default_timezone_set("Asia/Kolkata");
include("../../my_curls/myCurl.php");

// $singzyData = getsignzyAuth();
// extract($singzyData);

$singzyData = getsignzyAuthLive();
extract($singzyData);


if(isset($_POST['get_files'])){

    $arr = array(
       "task" => "getFiles",
       "essentials" => [
            "requestId" => $requestId,
            "fileIds"=> [$fileIds]
       ]
    );
    
    $postData = json_encode($arr);    
    $url = "https://signzy.tech/api/v2/patrons/$userId/digilockers";
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