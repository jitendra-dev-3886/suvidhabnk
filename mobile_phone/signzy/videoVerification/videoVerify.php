<?php

    include("../../util/uploader.php");
    include("../../includes/configuration.php");
    include("../../../Agent/Backend/Functions/all_function.php");
    include("Asia/Kolkata");
    include("../../my_curls/myCurl.php");
    
    
    
    $singzyData = getsignzyAuthLive();
    extract($singzyData);
    
    $json = file_get_contents('php://input');
    $data = json_decode($json);

    if($data!=null || $data!=""){
        
        $imageStringF = $data->fImageBase64;
        $mobile = $data->mobile;
        
        $Firstimagename = uploadImage($imageStringF, $mobile);
        sleep(10);
        $furl = "https://paydeer.in/mobile_phone/signzy/videoVerification/".$Firstimagename;
        
        $givenOTP = mt_rand(99999 , 1000000);
        
        $matchImage = array(
                $furl
            );

   $postData = json_encode(array(
       
    "task" => "url",
      "essentials" => [
          "matchImage" => $matchImage,
          "customVideoRecordTime" => "10",
          "hideTopLogo" => false,
          "hideBottomLogo" => true,
          "callbackUrl" => "https://paydeer.in/mobile_phone/signzy/callback.php",
          "redirectUrl" => "https://paydeer.in/mobile_phone/signzy/digi_locker/redirect_url.php",
          "idCardVerification" => false,
          "languageCode" => "en",
          "customText" => "$givenOTP",
          "customizations"=>[
              "logoUrl" => "https://pbs.twimg.com/profile_images/1451144624685273093/9MzOvU93_400x400.jpg"
            ]
      ]
    
    ));
    


    $url = "https://signzy.tech/api/v2/patrons/$userId/videoiframes";
    $header = array(
        "Authorization: $id",
        "Content-type: application/json"
    );
    
    
    $response = postCurl($postData, $url, $header);
    $errors = json_decode($response);
    $errorCode = $errors->error->statusCode;
    $errorMessage =$errors->error->message;
    if($errorMessage=="" || $errorMessage==null){
        if($errors!=null || $errors!=""){
            echo json_encode(["message"=>"Response Recieved", "response_code"=>1, "status"=>true, "receivableData"=>$errors]);
        }
        else{
            echo json_encode(["message"=>"Something went wrong343\n".$errors, "response_code"=>300, "status"=>false]);
        }
    }
    else{
        
        echo json_encode(["message"=>$errorMessage, "response_code"=>300, "status"=>false]);
    }
}


?>