<?php
include("../../../Db/config.php");
include("../Functions/all_function.php");



$singzyData = getsignzyAuthLive();
extract($singzyData);



    $reqid = $_GET['requestId'];
    
     $arr = array(
           "task" => "getEadhaar",
           "essentials" => [
                "requestId" => $reqid
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
    
    $data = json_decode($response , true);
    
    $errorCode = $data['error']['statusCode'];
    $errorMessage =$data['error']['message'];
    $con->query("INSERT INTO `API_HITLOG`(`USER_ID`, `SEVICE`, `TRANSACTION_ID`, `TOKEN`, `REQUEST_LOG`, `RESPONSE_LOG`) VALUES ('$ID','GetAdhaar','$reqid','','$postData','$response')");
    if($errorMessage!="" || $errorMessage !=null){
        echo "<h1 style='text-align:center '>Error: $errorMessage  <br> <a href='../../NewOnboard'>Click here</a> to restart the proccess</h1>";
        exit;
    }
    $user =   $con->query("select * from register_user_data where REQ_ID='$reqid' ")->fetch_assoc();
    $ID = $user['USER_ID'];
    $con->query("update register_user_data set AADHAAR_DATA='$response' where REQ_ID='$reqid' ");
    $name = $data['result']['name'];
    $address = $data['result']['address'];
    $u_dob = $data['result']['dob'];
    $u_gender = $data['result']['gender'];
    $uid = $data['result']['uid'];
    $pic = $data['result']['photo'];
    $address = $data['result']['splitAddress']['addressLine'];
    $city = $data['result']['splitAddress']['city'][0];
    
    $country = $data['result']['splitAddress']['country'][0];
    $district= $data['result']['splitAddress']['district'][0];
    $state= $data['result']['splitAddress']['state'][0][0];
    $pincode= $data['result']['splitAddress']['pincode'];
    
    $sql = $con->query("UPDATE user SET `FIRST_NAME`='$name',`LAST_NAME`='',`ADDRESS`='$address',`CITY`='$city',`STATE`='$state',`PIN`='$pincode',
                        `ADHAAR`='$uid',`PAN`='$pan_number',`US_STATUS`='Deactive', `PASSWORD`='$password' , `ADHAAR_PIC`='$pic'  WHERE ID='$ID'");
    
    
    $query_p = $con->query("INSERT INTO `user_profile`(`MAIN_OWNER`, `MAIN_OWNER_ID`, `OWNER_ID`, `USER_ID`, `ALTERNATE_PHONE_NO`, `DOB`, `GENDER`, `COUNTRY`, `STATE`,`PROFILE_IMG`,`FACEBOOK_URL`,`TWITTER_URL`,`LINKEDIN_URL`,`INSTAGRAM_URL`,`DRIBBLE_BOX_URL`,`DROPBOX_URL`,`GOOGLE_PLUS_URL`,`PINTEREST_URL`,`SKYPE_URL`,`VINE_URL`,`AADHAR_CARD_NO`,`PAN_CARD_NO`,`BANK`,`B_NAME`,`AC_HOLDER_NAME`,`AC_NUM`,`IFSC_CODE`,`PASSBOOK`)
    VALUES ('ADMIN','1','1','$ID','','$u_dob','$u_gender','$country','$state','$u_photo','','','','','','','','','','','$uid','$pan_number','','','','','','')");
    if($sql && $query_p){
        echo "<h1 style='text-align:center '>Don't Refresh the page. Getting Details<br> Redirecting </h1>";
        header("location:../../NewOnboard?step1&requestId=$reqid");
    }
    else{
        echo "<h1 style='text-align:center '>Error: $errorMessage  <br> <a href='../../NewOnboard'>Click here</a> to restart the proccess</h1>";
        exit;
    }
    
    
    
    // echo "<h1>Processing, Please wait <br> Don't Refresh or back the page.</h1>"
?>