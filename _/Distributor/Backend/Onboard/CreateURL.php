<?php
include("../../../Db/config.php");
include("../Functions/all_function.php");

date_default_timezone_set("Asia/Kolkata");

// $singzyData = getsignzyAuth();
// extract($singzyData);

$singzyData = getsignzyAuthLive();
extract($singzyData);



if(isset($_POST['redirect_url'])){
    $mobile = $_POST['information']['mobile'];
    $email = $_POST['information']['email'];
    $usid = decrypt_token($_POST['information']['usid']);
    
    if($usid == "" ||$mobile == "" ||$email == "" ){
         echo json_encode(["message"=>"User not found.", "response_code"=>300, "status"=>false]);
         exit;
    }
    $url = "https://signzy.tech/api/v2/patrons/$userId/digilockers";
    $arr = array(
        "task" => "url",
        "essentials"=> [
          "signup"=> false,
          "redirectUrl"=> "https://paydeer.in/Distributor/Backend/Onboard/updateAdhaar",
          "redirectTime"=> 1,
          "callbackUrl"=> "https://paydeer.in/Distributor/Backend/Onboard/updateAdhaarCall"
      ]
    );
    $postData = json_encode($arr);
    
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
    
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$usid','CreateAdharURL','','','$postData','$response')");
    if($errorMessage=="" || $errorMessage==null){
        $reqid= $errors->result->requestId;
        $con->query("INSERT INTO `register_user_data`(`REQ_ID`, `MOBILE`, `EMAIL`, `USER_ID`) VALUES ('$reqid','$mobile','$email','$usid')");
        
        echo json_encode(["message"=>"Response Recieved", "response_code"=>1, "status"=>true, "receivableData"=>$errors]);
    }
    else{
        echo json_encode(["message"=>$errorMessage, "response_code"=>300, "status"=>false]);
    }

}

?>