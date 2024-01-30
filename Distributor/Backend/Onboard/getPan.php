<?php
include("../../../Db/config.php");
include("../Functions/all_function.php");

$requestId = $_POST['requestId'];
$panNumber = $_POST['panNumber'];
$panName = $_POST['pannname'];
date_default_timezone_set("Asia/Kolkata");

// $singzyData = getsignzyAuth();
// extract($singzyData);

$user =   $con->query("select * from register_user_data where REQ_ID='$requestId' ")->fetch_assoc();
if($user['AADHAAR_DATA'] == ""){
     echo json_encode(["message"=>"Adhaar not fetched properly. Please do onboarding again.", "response_code"=>123, "status"=>false, "receivableData"=>""]);
    exit;
}
$ID = $user['USER_ID'];
$userdata = $con->query("select * from user where ID='$ID' ")->fetch_assoc();
if($userdata['FIRST_NAME'] == ""){
     echo json_encode(["message"=>"User data not fetched properly. Please do onboarding again.", "response_code"=>123, "status"=>false, "receivableData"=>""]);
    exit;
}

// print_r($ID);     
$singzyData = getsignzyAuthLive();
extract($singzyData);

if(isset($_POST['pull_document'])){
    $arr = array(
       "task" => "pullDocuments",
      "essentials"=> [
          "requestId"=> $requestId,
          "docType"=> "PANCR",
          "name"=>$panName,
          "panNumber"=> $panNumber
      ]
    );
    
    $postData = json_encode($arr);    
    // echo $postData;
    $url = "https://signzy.tech/api/v2/patrons/$userId/digilockers";
    $header = array(
        "Authorization: $id",
        "accept: */*",
        "accept-language: en-US,en;q=0.8",
        "content-type: application/json"
    );
      $curl = curl_init();
        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => $postData,
          CURLOPT_HTTPHEADER => $header,
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
    $errors = json_decode($response);
    $errorCode = $errors->error->statusCode;
    $errorMessage =$errors->error->message;
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','FetchPAN','$requestId','','$postData','$response')");
    if($errorMessage=="" || $errorMessage==null){
        $name = $errors->essentials->name;
        $pannum = $errors->essentials->panNumber;
        $pdf = $errors->result->pdf;
        $xml = $errors->result->xml;
        $con->query("update register_user_data set PAN_DATA='$response' , PAN_NAME='$name' , PAN_NO='$pannum' , PAN_XML='$xml' , PAN_PDF='$pdf' where REQ_ID='$requestId' ");
        echo json_encode(["message"=>"Response Recieved", "response_code"=>1, "status"=>true, "receivableData"=>$errors]);
    }
    else{
        echo json_encode(["message"=>$errorMessage, "response_code"=>300, "status"=>false, "receivableData"=>$errors]);
    }
}

?>